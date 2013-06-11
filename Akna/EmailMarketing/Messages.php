<?php 
require_once 'Akna/Client.php';

/**
 * This class allows interaction with messages.
 *
 * @category Akna
 * @package  Akna_EmailMarketing
 * @author   Daniel Antunes <daniel.antunes.rocha@gmail.com>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/php-akna
 * @version  0.2
 */
class Akna_EmailMarketing_Messages extends Akna_Client
{
    /**
     * Creates a message
     * 
     * @since 0.2
     * 
     * @param array $fields The fields nome and html are required
     * @return boolean
     */
    public function create( $fields = array() )
    {
        if( !isset( $fields['nome'] ) || empty( $fields['nome'] ) )
            throw new Akna_Exception( 'O nome da mensagem é requerido' );

        if( !isset( $fields['html'] ) || empty( $fields['html'] ) )
            throw new Akna_Exception( 'O HTML da mensagem é requerido' );

        $this->getHttpClient()->send( '15.05', 'emkt', $fields );

        // if anything goes wrong an exception will be thrown anyway
        return true;
    }

    /**
     * Sends a test e-mail from message
     * 
     * @since 0.2
     * 
     * @param array $fields The fields titulo, email_remetente, assunto and email are required
     * @return boolean
     */    
    public function test( $fields = array() )
    {
        if( !isset( $fields['titulo'] ) || empty( $fields['titulo'] ) )
            throw new Akna_Exception( 'O titulo da mensagem é requerido' );
            
        if( !isset( $fields['email_remetente'] ) || empty( $fields['email_remetente'] ) )
            throw new Akna_Exception( 'O e-mail do remetente é requerido' );   

        if( !isset( $fields['assunto'] ) || empty( $fields['assunto'] ) )
            throw new Akna_Exception( 'O assunto da mensagem é requerido' );   

        if( !isset( $fields['email'] ) || empty( $fields['email'] ) )
            throw new Akna_Exception( 'O e-mail do destinatário é requerido' );

        $this->getHttpClient()->send( '15.07', 'emkt', $fields );

        // if anything goes wrong an exception will be thrown anyway
        return true;
    }
}