<?php

/*
   Classe que contém os métodos relacionados ao usuário comum, como login, cadastro, 
   retornar as informações, alterar informações, etc.
*/

    class User{

        public static function login($email, $senha){

            $senhacod = hash("sha512", $senha);

            $aluno = MySql::getConnect()->prepare("SELECT * FROM usuarios WHERE email = ? AND BINARY senha = ?");
            $aluno->execute(array($email, $senhacod));
            
            $adm = MySql::getConnect()->prepare("SELECT * FROM `admin.usuarios` WHERE email = ? AND BINARY senha = ?");
            $adm->execute(array($email, $senhacod));

            return array($aluno->fetchAll(), $adm->fetchAll());
        }

        public static function checkEmail($email) {

            $aluno = MySql::getConnect()->prepare("SELECT * FROM usuarios WHERE email = ?");
            $aluno->execute(array($email));
            
            $adm = MySql::getConnect()->prepare("SELECT * FROM `admin.usuarios` WHERE email = ?");
            $adm->execute(array($email));

            return array($aluno->fetchAll(), $adm->fetchAll());
        }

        public static function getUserInfs($id){

            $user = MySql::getConnect()->prepare("SELECT usuarios.nome, usuarios.email, usuarios.aniversario, rede.descricao, escolaridade.descricao, usuarios.id_rede, usuarios.id_escolaridade FROM usuarios, rede, escolaridade WHERE usuarios.id_rede = rede.id AND usuarios.id_escolaridade = escolaridade.id AND usuarios.id = ?");
            $user->execute(array($id));

            return $user->fetchAll();
        }

        public static function selectTypeNetwork(){

            $stmt = MySql::getConnect()->prepare("SELECT * FROM `rede`");

            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function selectSchooling(){

            $stmt = MySql::getConnect()->prepare("SELECT * FROM `escolaridade`");

            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function registerUsers($nome, $senha, $email, $aniver, $escolaridade, $rede){

            $senhacod = hash("sha512", $senha);

            $stmt = MySql::getConnect()->prepare("INSERT INTO usuarios (nome, senha, email, aniversario, id_escolaridade, id_rede) values(?, ?, ?, ?, ?, ?)");

            $stmt->execute(array($nome, $senhacod, $email, $aniver, $escolaridade, $rede));
            return $stmt->rowCount();
        }

        public static function changePersonalData($email, $nome, $aniver, $escolaridade, $rede) {

            $stmt = MySql::getConnect()->prepare("UPDATE usuarios SET nome = ?, aniversario = ?, id_rede = ?, id_escolaridade = ? WHERE email = ?");

            $stmt->execute([$nome, $aniver, $rede, $escolaridade, $email]);
            return $stmt->rowCount();
        }

        public static function resolvedQuestionTheme($id_materia, $id_user){

            $stmt = MySql::getConnect()->prepare("SELECT sub_tema.descricao, COUNT(questoes.id_sub_tema) AS 'qtd' FROM resolucao, questoes, sub_tema WHERE id_usuario = ? AND resolucao.id_questao = questoes.id AND questoes.id_sub_tema = sub_tema.id AND resolucao.id_materia = ? GROUP BY questoes.id_sub_tema");

            $stmt->execute(array($id_user, $id_materia));
            return $stmt->fetchAll();
        }

        public static function checksQuestionResolved($id_usuario, $id_questao){

            $stmt = MySql::getConnect()->prepare("select * from resolucao where id_usuario = $id_usuario and id_questao = $id_questao");
            $stmt->execute();

            return count($stmt->fetchAll());
        }

        public static function saveResolutionQuest($id_usuario, $id_questao, $resp_dada, $acertou, $id_materia){

            $stmt = MySql::getConnect()->prepare("insert into resolucao (id_usuario, id_questao, resp_escolh, acertou, id_materia) values ($id_usuario, $id_questao, '$resp_dada', '$acertou', $id_materia)");
            $stmt->execute();

            return $stmt->rowCount();
        }
    }

?>