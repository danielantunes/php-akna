<?php
require_once 'Akna/Client.php';

/**
 * This class allows interaction with contact lists.
 *
 * @category Akna
 * @package  Akna_EmailMarketing
 * @author   Pedro Padron <ppadron@w3p.com.br>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/php-akna
 * @since    0.1
 */
class Akna_EmailMarketing_Contacts extends Akna_Client
{
    /**
     * Adds a contact with optional additional fields to a specific list.
     *
     * @since 0.1
     * 
     * @param string $email  Email address.
     * @param string $list   List name. Will be created if does not exist.
     * @param array  $fields Additional fields.
     *
     * @return boolean
     */
    public function add($email, $list, array $fields = array())
    {
        $fields = array(
            'nome'         => $list,
            'destinatario' => array_merge(array('email' => $email), $fields)
        );

        $this->getHttpClient()->send('11.05', 'emkt', $fields);

        // if anything goes wrong an exception will be thrown anyway
        return true;
    }

    /**
     * Returns a contact in a given list.
     * 
     * @since 0.1
     * 
     * @param string $list  List name.
     * @param string $email Email address.
     *
     * @return array
     */
    public function get($email, $list)
    {
        $fields = array(
            'lista' => $list, 'contato' => $email
        );

        $result = $this->getHttpClient()->send('11.01', 'emkt', $fields);

        return array_change_key_case((array) $result->EMKT->CONTATO, CASE_LOWER);
    }

    /**
     * Returns the contact lists
     * 
     * @since 0.2
     * @return array Contact lists
     */
    public function getLists()
    {
        $result  = $this->getHttpClient()->send( '11.02', 'emkt' );
        $arrList = array();

        foreach( $result->EMKT->LISTA as $list )
            $arrList[] = $list;
            
        return $arrList;
    }
}
