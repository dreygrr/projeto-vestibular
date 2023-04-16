<?php

/*
   Classe que contém os métodos relacionadaos as Questões, como os filtros utilizados
   na Área de Questões e a adição de novas questões pelos professores
*/

    class Questao {

        private static $tema = "";
        private static $ano = "";
        private static $partenome = "";
        private static $vestibular = "";
        private static $materia = "";

        public static function selectExams() {

            $sql = MySql::getConnect()->prepare("SELECT * FROM `vestibular` ORDER BY descricao");
			$sql->execute();
			return $sql->fetchAll();
        }

        public static function selectThemes() {

            $sql = MySql::getConnect()->prepare("SELECT * FROM `sub_tema` ORDER BY descricao");
			$sql->execute();
			return $sql->fetchAll();
        }

        public static function addQuestObj($enunciado, $pergunta, $alter_a, $alter_b, $alter_c, $alter_d, $alter_e, $gabarito, $explic, $tema, $vest, $ano, $tipo, $conteudo, $materia){

            $sql = MySql::getConnect()->prepare("INSERT into questoes (enunciado, pergunta, alternativa_a, alternativa_b, alternativa_c, alternativa_d, alternativa_e, alternativa_certa, explicacao, imagem, id_sub_tema, id_vestibular, ano, tipo, id_materia) values (?, ?, ?, ?, ?, ?, ?, ?, ?, '$conteudo', ?, ?, ?, ?, ?)");
        
            $sql->execute(array($enunciado, $pergunta, $alter_a, $alter_b, $alter_c, $alter_d, $alter_e, $gabarito, $explic, $tema, $vest, $ano, $tipo, $materia));

            return $sql->rowCount();
        }

        public static function addQuestDissert($enunciado, $pergunta, $quest_a, $quest_b, $quest_c, $resp_a, $resp_b, $resp_c, $tema, $vest, $ano, $tipo, $conteudo, $materia){

            $sql = MySql::getConnect()->prepare("INSERT into questoes (enunciado, pergunta, alternativa_a, alternativa_b, alternativa_c, alternativa_d, alternativa_e, alternativa_certa, imagem, id_sub_tema, id_vestibular, ano, tipo, id_materia) values (?, ?, ?, ?, ?, ?, ?, ?, '$conteudo', ?, ?, ?, ?, ?)");

            $sql->execute(array($enunciado, $pergunta, $quest_a, $quest_b, $quest_c, $resp_a, $resp_b, $resp_c, $tema, $vest, $ano, $tipo, $materia));

            return $sql->rowCount();
        }

        public static function selectQuestion($id){

            $sql = MySql::getConnect()->prepare("SELECT vestibular.`descricao` AS `vestibular`, questoes.`ano`, questoes.`especial`, questoes.`imagem`, sub_tema.`descricao` AS `subtema`, questoes.`enunciado`, questoes.`alternativa_a`, questoes.`alternativa_b`, questoes.`alternativa_c`, questoes.`alternativa_d`,questoes.`alternativa_e`, questoes.`alternativa_certa`, questoes.`explicacao`, questoes.`pergunta`, questoes.`id`, questoes.`tipo`, questoes.`id_materia`, questoes.`id_vestibular`, questoes.`id_sub_tema` FROM questoes, materia, vestibular, sub_tema WHERE questoes.`id_vestibular` = vestibular.`id` and questoes.`id_sub_tema` = sub_tema.`id` and questoes.`id_materia` = materia.`id` AND questoes.id = $id");
            
			$sql->execute();
			return $sql->fetchAll();
        }

        public static function filterQuestions($tema, $ano, $partenome, $vestibular, $materia){
            self::$tema = $tema;
            self::$ano = $ano;
            self::$partenome = $partenome;
            self::$vestibular = $vestibular;
            self::$materia = $materia;
        }

        public static function resultFilter($inicio, $total_reg){

            $tema = self::$tema;
            $ano = self::$ano;
            $enunciado = self::$partenome;
            $vestibular = self::$vestibular;
            $materia = self::$materia;

            $sql = MySql::getConnect()->prepare("SELECT vestibular.`descricao` AS `vestibular`, questoes.`ano`, questoes.`especial`, questoes.`imagem`, sub_tema.`descricao` AS `subtema`, questoes.`enunciado`, questoes.`alternativa_a`, questoes.`alternativa_b`, questoes.`alternativa_c`, questoes.`alternativa_d`,questoes.`alternativa_e`, questoes.`alternativa_certa`, questoes.`explicacao`, questoes.`pergunta`, questoes.`id`, questoes.`tipo`, materia.`nome` FROM questoes, materia, vestibular, sub_tema WHERE questoes.`id_vestibular` = vestibular.`id` and questoes.`id_sub_tema` = sub_tema.`id` and questoes.`id_materia` = materia.`id` AND (questoes.enunciado LIKE '%$enunciado%' or questoes.pergunta LIKE '%$enunciado%') AND (questoes.ano LIKE '%$ano%' AND vestibular.descricao LIKE '%$vestibular%' AND sub_tema.descricao LIKE '%$tema%' and materia.nome LIKE '%$materia%') LIMIT $inicio, $total_reg");
            
			$sql->execute();
			return $sql->fetchAll();
        }

        public static function totalResultFilter(){

            $tema = self::$tema;
            $ano = self::$ano;
            $enunciado = self::$partenome;
            $vestibular = self::$vestibular;
            $materia = self::$materia;

            $sql = MySql::getConnect()->prepare("SELECT vestibular.`descricao` AS `vestibular`, questoes.`ano`, questoes.`especial`, questoes.`imagem`, sub_tema.`descricao` AS `subtema`, questoes.`enunciado`, questoes.`alternativa_a`, questoes.`alternativa_b`, questoes.`alternativa_c`, questoes.`alternativa_d`,questoes.`alternativa_e`, questoes.`alternativa_certa`, questoes.`explicacao`, questoes.`pergunta`, questoes.`id`, questoes.`tipo`, materia.`nome` FROM questoes, materia, vestibular, sub_tema WHERE questoes.`id_vestibular` = vestibular.`id` and questoes.`id_sub_tema` = sub_tema.`id` and questoes.`id_materia` = materia.`id` AND (questoes.enunciado LIKE '%$enunciado%' or questoes.pergunta LIKE '%$enunciado%') AND (questoes.ano LIKE '%$ano%' AND vestibular.descricao LIKE '%$vestibular%' AND sub_tema.descricao LIKE '%$tema%' and materia.nome LIKE '%$materia%')");
            
			$sql->execute();
			return $sql->fetchAll();
        }

        public static function resetFilter(){
            self::$tema = "";
            self::$ano = "";
            self::$partenome = "";
            self::$vestibular = "";
            self::$materia = "";
        }

        public static function acertQuestion($id_questao){

            $stmt = MySql::getConnect()->prepare("SELECT * from resolucao where resolucao.id_questao = $id_questao");
            $stmt->execute();
            $qtdResp = count($stmt->fetchAll());

            $stmt2 = MySql::getConnect()->prepare("SELECT * from resolucao where resolucao.id_questao = $id_questao and resolucao.acertou = 's'");
            $stmt2->execute();
            $acertResp = count($stmt2->fetchAll());
            
            return [$acertResp, $qtdResp];

        }

        public static function alterQuestObj($enunciado, $pergunta, $alter_a, $alter_b, $alter_c, $alter_d, $alter_e, $gabarito, $explic, $tema, $vest, $ano,  $conteudo, $id){

            $sql = MySql::getConnect()->prepare("UPDATE questoes SET enunciado = ?, pergunta = ?, alternativa_a = ?, alternativa_b = ?, alternativa_c = ?, alternativa_d = ?, alternativa_e = ?, alternativa_certa = ?, explicacao = ?, imagem = '$conteudo', id_sub_tema = ?, id_vestibular = ?, ano = ? WHERE id = ?");
        
            $sql->execute(array($enunciado, $pergunta, $alter_a, $alter_b, $alter_c, $alter_d, $alter_e, $gabarito, $explic, $tema, $vest, $ano, $id));

            return $sql->rowCount();
        }

        public static function alterQuestDissert($enunciado, $pergunta, $quest_a, $quest_b, $quest_c, $resp_a, $resp_b, $resp_c, $tema, $vest, $ano, $conteudo, $id, $explic){

            $sql = MySql::getConnect()->prepare("UPDATE questoes SET enunciado = ?, pergunta = ?, alternativa_a = ?, alternativa_b = ?, alternativa_c = ?, alternativa_d = ?, alternativa_e = ?, alternativa_certa = ?, explicacao = ?, imagem = '$conteudo', id_sub_tema = ?, id_vestibular = ?, ano = ? WHERE id = ?");

            $sql->execute(array($enunciado, $pergunta, $quest_a, $quest_b, $quest_c, $resp_a, $resp_b, $resp_c, $explic, $tema, $vest, $ano, $id));

            return $sql->rowCount();
        }

    }

?>