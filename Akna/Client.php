<?php
require_once 'Akna/HttpClient.php';

/**
 * Base class that contains an HttpClient to interact with the API.
 *
 * @category Akna
 * @package  Akna_EmailMarketing
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     https://github.com/w3p/php-akna
 * @version  0.1
 */
class Akna_Client
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
     * @since 0.1
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
     * Sets the HTTP client.
     *
     * @since 0.1
     * 
     * @param Akna_HttpClient $httpClient HTTP client.
     *
     * @return void
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Returns the HTTP client.
     *
     * @since 0.1
     * 
     * @return Akna_HttpClient
     */
    public function getHttpClient()
    {
        if (!isset($this->httpClient)) {
            $this->httpClient = new Akna_HttpClient(
                $this->username, $this->password, $this->company, $this->endpoint
            );
        }

        return $this->httpClient;
    }
}