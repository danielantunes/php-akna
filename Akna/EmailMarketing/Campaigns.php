<?php 
require_once 'Akna/Client.php';

/**
 * This class allows interaction with campaigns.
 *
 * @category Akna
 * @package  Akna_EmailMarketing
 * @author   Daniel Antunes <daniel.antunes.rocha@gmail.com>
 * @license  BSD <http://www.opensource.org/licenses/bsd-license.php>
 * @link     http://github.com/w3p/php-akna
 * @version  0.2
 */
class Akna_EmailMarketing_Campaigns extends Akna_Client
{
	/**
	 * Adds a action
	 * 
     * @since 0.2
     * 
	 * @param array $fields The fields nome, mensagem, data_encerramento, nome_remetente, 
	 * email_remetente, email_retorno e assunto are required.
     * 
	 * @return boolean
	 */  
	public function addAction( $fields = array() )
	{
		if( !isset( $fields['nome'] ) || empty( $fields['nome'] ) )
            throw new Akna_Exception( 'O nome da ação é requerido' );

        if( !isset( $fields['mensagem'] ) || empty( $fields['mensagem'] ) )
            throw new Akna_Exception( 'O nome da mensagem é requerido' );

    	if( !isset( $fields['data_encerramento'] ) || empty( $fields['data_encerramento'] ) )
            throw new Akna_Exception( 'A data de encerramento da ação é requerida' );    	

    	if( !isset( $fields['nome_remetente'] ) || empty( $fields['nome_remetente'] ) )
            throw new Akna_Exception( 'O nome do remetente é requerido' );

        if( !isset( $fields['email_remetente'] ) || empty( $fields['email_remetente'] ) )
            throw new Akna_Exception( 'O e-mail do remetente é requerido' );

        if( !isset( $fields['email_retorno'] ) || empty( $fields['email_retorno'] ) )
            throw new Akna_Exception( 'O e-mail para retorno é requerido' );

        if( !isset( $fields['assunto'] ) || empty( $fields['assunto'] ) )
            throw new Akna_Exception( 'O assunto da mensagem é requerido' );

        $this->getHttpClient()->send( '19.05', 'emkt', $fields );

        // if anything goes wrong an exception will be thrown anyway
        return true;
	}    
}
