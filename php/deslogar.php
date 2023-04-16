<?php

/*
	Desloga o usuário e destrói as sessões
	com as informações do usuário
*/

	include_once("../config.php");

	unset(
		$_SESSION['senha'],
		$_SESSION['status_login'],
		$_SESSION['id_usuario']
	);

	header("location: ".INCLUDE_PATH."pages/login.php");	

?>