<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
date_default_timezone_set('America/Sao_Paulo');
//
//Adicona os path padrões do sistema
$path = PATH_SEPARATOR . '../Class/';
$path .= PATH_SEPARATOR . 'Class/';
$path .= PATH_SEPARATOR . '../privado/';
$path .= PATH_SEPARATOR . 'privado/';
$path .= PATH_SEPARATOR . '../_BD/';
$path .= PATH_SEPARATOR . '_BD/';
set_include_path(get_include_path() . $path);
//
require_once("usuarios.class.php");
require_once("constantes.lca");
//
//Se não existe define como null para evitar avisos de erro
if (!isset($_POST['operacao'])) {
	$_POST['operacao'] = null;
}
if (!isset($_SESSION['logado'])) {
	$_SESSION['logado'] = null;
}
//
//inicia as classes nescessarias
$usuarios = new usuarios();
//
//Efetua o login
if ($_POST['operacao'] == "logar") {
	//
	//Busca os dados do usuario na API
	$dados = $usuarios->buscarUsuarioLogin($_POST['usuario'], $_POST['senha']);
	//
	if(!empty($dados->jwt)){
		//
		$_SESSION['logado'] 						= true;
		$_SESSION['username'] 						= $dados->user->username;
		$_SESSION['email'] 							= $dados->user->email;
		$_SESSION['idusuario']				 	    = $dados->user->id;
		$_SESSION['jwt']				 	    	= $dados->jwt;
		$_SESSION['ultima_atividade']				= time();
		header('Location: ../index.php');
		exit;
	}else{
		$_SESSION['logado'] = false;
		$_SESSION['mensagem'] = "Usuario ou senha incorretos!!!<br>Tente novamente";
    	$_SESSION['tipoMsg'] = "danger";
		header('location: ../login.html');
		exit;
	}
}

//
//Operação para deslogar do sistema
if ($_POST['operacao'] == "Sair") {
	session_destroy();
	header('Location: login.html');
	exit;
}

if ((time() - $_SESSION['ultima_atividade']) > 86400) {
    // última atividade foi mais de 10 minutos atrás
    session_unset();     // unset $_SESSION
    session_destroy();   // destroindo session data
		//
    header('Location: login.html');
	exit;
}

if(!$_SESSION['logado']){
	header('Location: login.html');
	exit;
}

$_SESSION['ultima_atividade'] = time(); // update ultima ativ.
?>
