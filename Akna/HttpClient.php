<?php
/**
 * Client.php
 *
 * PHP version 5
 *
 * @category Akna
 * @package  Akna
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/akna-client-php
 * @see      http://www.akna.com.br/
 */

require_once 'Akna/Exception.php';

/**
 * Simple HTTP client using stream contexts.
 *
 * To avoid requiring additional dependencies, this class only uses
 * file_get_contents() with stream contexts to perform requests.
 *
 * Since Akna only supports XML as request/response format, all requests
 * and responses are already encoded/decoded by the send() method.
 *
 * Exceptions will be thrown whenever the response's HTTP status code is not
 * 2xx. If Akna returns an additional error message in the response body,
 * it will be used as the exception message.
 *
 * @category Akna
 * @package  Akna
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/akna-client-php
 * @see      http://www.akna.com.br/
 */
class Akna_HttpClient
{
    /**
     * @var string API username
     */
    protected $username;

    /**
     * @var string API password
     */
    protected $password;

    /**
     * @var string Company ID (if user is in more than one company)
     */
    protected $company;

    /**
     * @var string API endpoint
     */
    protected $endpoint;

    /**
     * Class constructor.
     *
     * @param string $username API username
     * @param string $password API password
     * @param string $company  Company ID (if user is in more than one company)
     * @param string $endpoint API endpoint
     *
     * @return void
     */
    public function __construct($username, $password, $company = null,
        $endpoint = 'http://api.akna.com.br/emkt/int/integracao.php'
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->company  = $company;
        $this->endpoint = $endpoint;
    }

    /**
     * Adds an array of parameters as children of a SimpleXmlElement.
     *
     * @param SimpleXmlElement $xmldoc Root XML element
     * @param array            $params Associative array of parameters
     *
     * @return void
     */
    protected function addParametersToXml( $xmldoc, array $params )
    {
        foreach ( $params as $key => $value ) {
            if ( is_array( $value ) ) {
                if( isset( $value[0] ) ) {
                    foreach( $value as $_value ) {
                        $child = $xmldoc->addChild( $key, $_value );
                    }
                } else {
                    $child = $xmldoc->addChild( $key );
                    $this->addParametersToXml( $child, $value );
                }
            } else {
                $xmldoc->addChild( $key, utf8_encode( $value ) );
            }
        }
    }

    /**
     * Sends the request and returns the result as SimpleXmlElement.
     *
     * @param string $functionCode API function code.
     *
     * Each API function is identified by a specific code, such as "11.05" to
     * add a contact to a list. Please refer to the documentation to find all
     * function codes.
     *
     * @param string $module       API module depending on the service.
     *
     * Akna has different products following the same API standard, and they
     * are identified by a name such as "emkt" for email marketing. This will
     * be the first child of the root element in the request XML.
     *
     * @param array  $params       Parameters for the performed action.
     *
     * Array of parameters named exactly as described in the documentation,
     * lowercased and in portuguese.
     *
     * @throws Akna_Exception If request is not successful.
     *
     * @return SimpleXmlElement
     */
    public function send($functionCode, $module, $params = array())
    {
        $content = new SimpleXmlElement(
            "<?xml version=\"1.0\" encoding=\"UTF-8\"?><main><$module trans=\"{$functionCode}\"></$module></main>"
        );

        $this->addParametersToXml( $content->$module, $params );

        $xml = utf8_decode( $content->asXML() );

        // var_dump($xml);
        // exit;

        $postFields = array(
            'User' => $this->username,
            'Pass' => md5($this->password),
            'XML'  => $xml
        );

        if (isset($this->company) && !empty($this->company)) {
            $postFields['Client'] = $this->company;
        }

        $context = stream_context_create(
            array('http' => array(
                'method'          => 'POST',
                'timeout'         => 5,
                'ignore_errors'   => true,
                'follow_location' => false,
                'content'         => http_build_query($postFields),
                'header'          => join("\r\n", array(
                    'Content-type: application/x-www-form-urlencoded',
                    'User-Agent: Akna PHP Client v1.0.0',
                ))
            ))
        );

        $responseBody = file_get_contents($this->endpoint, null, $context);
        
        // the webservice will always return 200 OK, but maybe the user
        // specified the wrong api endpoint, so let's take a look at the http
        // response code
        $regex = "|^HTTP/[\d\.x]+ (?<code>\d+) (?<message>.*)|";

        preg_match($regex, $http_response_header[0], $httpStatus);

        if (floor((int) $httpStatus['code'] / 100) > 2) {

            $message = $httpStatus['message'];

            if (empty($responseBody)) {
                throw new Akna_Exception('Empty response');
            }

            throw new Akna_Exception($message, $httpStatus['code']);
        }

        $sxe    = simplexml_load_string($responseBody);
        $return = array_pop($sxe->xpath('//RETURN'));

        // if there is a <RETURN> element, we must check if it has an error code
        if ($return instanceof SimpleXmlElement) {

            // succesful transactions are identified by <RETURN ID="00">
            if ((string) $return->attributes()->ID != "00") {
                throw new Akna_Exception(
                    (string) $return, (int) $return->attributes()->ID
                );
            }

        }

        return $sxe;
    }
}