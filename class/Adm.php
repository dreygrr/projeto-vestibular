<?php

/*
   Classe que contém métodos relacionados ao Administrador do site e aos 
   professores cadastrados
*/

    class Adm{

        public static function getAdms(){

            $sql = MySql::getConnect()->prepare("SELECT `admin.usuarios`.`email`, `admin.usuarios`.`id`, `admin.usuarios`.`nome`, `materia`.`nome` as 'materia', `admin.usuarios`.`type` FROM `admin.usuarios`, `materia` where `admin.usuarios`.`id_materia` = `materia`.`id`");

            $sql->execute();
            return $sql->fetchAll();
        }
        
        public static function getOffice($type){

            $cargos = [
                1 => 'Professor',
                2 => 'Administrador'
            ];

            return $cargos[$type];
        }

        public static function getSubject(){
            $sql = MySql::getConnect()->prepare("SELECT * FROM `materia`");

            $sql->execute();
            return $sql->fetchAll();
        }

        public static function addAdms($name, $email, $pass, $id_materia){
            $sql = MySql::getConnect()->prepare("INSERT  INTO `admin.usuarios` VALUES (null, ?, ?, 1, ?, ?)");
            $sql->execute(array($email, hash("sha512", $pass), $name, $id_materia));

            return $sql->rowCount();
        }

        public static function deleteAdms($id){
            $sql = MySql::getConnect()->prepare("DELETE FROM `admin.usuarios` WHERE id = ?");
            $sql->execute(array($id));

            return $sql->rowCount();
        }

        public static function addMateria($name){
            $sql = MySql::getConnect()->prepare("INSERT  INTO materia VALUES (null, ?)");
            $sql->execute(array($name));

            return $sql->rowCount();
        }

        public static function newPass($nova_senha, $id){
            $senha_codif = hash("sha512", $nova_senha);

            $stmt = MySql::getConnect()->prepare("UPDATE `admin.usuarios` SET senha = ? WHERE id = ?");
            $stmt->execute(array($senha_codif, $id));

            return $stmt->rowCount();
        }
    }
?>