<?php
header('Content-Type: text/html; charset=utf-8');

require_once 'Akna.php';

$user    = '';
$pass    = '';

$akna = new Akna( $user, $pass );

$contacts  = $akna->emailMarketing->contacts;
$messages  = $akna->emailMarketing->messages;
$campaigns = $akna->emailMarketing->campaigns;

try {

	// $result_1 = $contacts->get('daniel@apiki.com', 'Apiki 1');
	// var_dump($result_1);

	// $result_2 = $contacts->getLists();
	// var_dump($result_2);

	// $result_3 = $messages->create( array( 
	// 	'nome' => 'Teste', 
	// 	'html' => htmlspecialchars( '<h1>Curso à distância</h1>' ) 
	// ) );
	// var_dump($result_3);

	// $result_4 = $messages->test( array(
	// 	'titulo'          => 'Teste',
	// 	'email_remetente' => 'daniel.antunes.rocha@gmail.com',
	// 	'assunto'         => 'Teste de envio 15.07',
	// 	'email'           => 'daniel@apiki.com'
	// ) );
	// var_dump($result_4);

	// $result_5 = $campaigns->addAction( array(
	// 	'nome'              => 'Itaú 6',
	// 	'mensagem'          => 'Teste',
	// 	'data_encerramento' => '2013-07-30',
	// 	'nome_remetente'    => 'CESP - Relações com Investidores',
	// 	'email_remetente'	=> 'firb.cesp@firb.com',
	// 	'email_retorno'		=> 'firb.cesp@firb.com',
	// 	'assunto'			=> 'Assunto 1',
	// 	'lista'				=> array( 'Apiki 1', 'Apiki 2' ),
	// 	'agendar'			=> array( 'datahora' => date( 'Y-m-d H:i:s' ) )
	// ) );
	
	// var_dump($result_5);

} catch( Akna_Exception $e ){

	echo $e->getmessage();

}