<?php

/*
   Calsse que tem o método que faz a conexão com banco de dados 
   e retorna ela
*/

    class MySql{

        private static $pdo;

        public static function getConnect() {
            if(self::$pdo == null){
				try{
                    self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    
				    self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				}catch(Exception $e){
					echo '<h2>Erro ao conectar</h2>';
				}
			}

			return self::$pdo;
        }
    }

?>
