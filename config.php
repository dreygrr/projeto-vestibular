<?php

    //Iniciando uma sessão e definindo a timezone
    if(!isset($_SESSION)) 
        session_start(); 
    
    date_default_timezone_set('America/Sao_Paulo');

    //Criação de um autoloader para as classes em PHP
    $autoload = function($class){
        include('class/'.$class.'.php');
    };
    spl_autoload_register($autoload);


    //Definir as constantes do sistema

    define("INCLUDE_PATH", "http://localhost/Projeto-Historia/");
    // define("INCLUDE_PATH", "");

    define("INCLUDE_PATH_PAINEL", INCLUDE_PATH."painel/");
    // define("INCLUDE_PATH_PAINEL", "");

    define("INCLUDE_PATH_ESTUDANTE", INCLUDE_PATH."estudante/");
    // define("INCLUDE_PATH_ESTUDANTE", "");

    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("DB", "projeto_historia");

    define("ADM_EMAIL", "dreygrr@gmail.com");
?>