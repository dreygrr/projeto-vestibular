<?php

/*
   Classe que contém os métodos relacionados as funções do painel dos
   administradores
*/

    class Painel{

        public static function loggout(){

            session_destroy();

            header("location: ".INCLUDE_PATH."php/deslogar.php");
        }

        public static function registeredUsers(){
            $stmt = MySql::getConnect()->prepare("SELECT * FROM `usuarios`");
			$stmt->execute();
			return $stmt->fetchAll();
        }

        public static function addVestibular($name){
            $stmt = MySql::getConnect()->prepare("INSERT  INTO vestibular VALUES (null, ?)");
            $stmt->execute(array($name));

            return $stmt->rowCount();
        }

        public static function deleteVestibular($id){
            $stmt = MySql::getConnect()->prepare("DELETE FROM vestibular WHERE id = ?");
            $stmt->execute(array($id));

            return $stmt->rowCount();
        }

        public static function addTema($name, $materia){
            $stmt = MySql::getConnect()->prepare("INSERT INTO sub_tema VALUES (null, ?, ?)");
            $stmt->execute(array($name, $materia));

            return $stmt->rowCount();
        }

        public static function deleteTema($name){
            $stmt = MySql::getConnect()->prepare("DELETE FROM sub_tema WHERE descricao = ?");
            $stmt->execute(array($name));

            return $stmt->rowCount();
        }
    }

?>