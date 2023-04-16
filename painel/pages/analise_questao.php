<?php

    $themes = Questao::selectThemes();
    $exams = Questao::selectExams();

    if(!empty($_POST["id_questao"]))
        $_SESSION["id_questao"] = $_POST["id_questao"];

    $result = Questao::selectQuestion($_SESSION["id_questao"]);
    $questao = $result[0];

    $areaquestoes = INCLUDE_PATH_PAINEL.'Exibir-Questoes';

    if(isset($_POST["action"])){

        if(!empty($_POST["texto"]))
            $questao['enunciado'] = str_replace("\n", "<br>", str_replace("'", "`", $_POST["texto"]));
        
        if(!empty($_POST["enunciado"]))
            $questao['pergunta'] = str_replace("'", "`", $_POST["enunciado"]);

        $imagem = $_FILES['image']['tmp_name'];

        if(!empty($imagem)){

            $tamanho = $_FILES['image']['size'];
            $tipoImg = $_FILES['image']['type'];
            $nome = $_FILES['image']['name'];

            $fp = fopen($imagem, "rb");
            $novo_conteudo = fread($fp, $tamanho);
            $questao['imagem'] = addslashes($novo_conteudo);
        }

        if(!empty($_POST["ano"]))
            $questao['ano'] = $_POST["ano"];

        if(!empty($_POST["tema"]))
            $questao["id_sub_tema"] = $_POST["tema"];

        if(!empty($_POST["vest"]))
            $questao["id_vestibular"] = $_POST["vest"];

        if(!empty($_POST["explic"]))
            $questao['explicacao'] = str_replace("'", "`", $_POST["explic"]);

        if($_POST["action"] == 1){

            if(!empty($_POST["alter_a"]))
                $questao['alternativa_a'] = str_replace("'", "`", $_POST["alter_a"]);
            
            if(!empty($_POST["alter_b"]))
                $questao['alternativa_b'] = str_replace("'", "`", $_POST["alter_b"]);

            if(!empty($_POST["alter_c"]))
                $questao['alternativa_c'] = str_replace("'", "`", $_POST["alter_c"]);

            if(!empty($_POST["alter_d"]))
                $questao['alternativa_d'] = str_replace("'", "`", $_POST["alter_d"]);

            if(!empty($_POST["alter_e"]))
                $questao['alternativa_e'] = str_replace("'", "`", $_POST["alter_e"]);

            if(!empty($_POST["gabarito"]))
                $questao['alternativa_certa'] = $_POST["gabarito"];

            $result = Questao::alterQuestObj($questao['enunciado'], $questao['pergunta'], $questao['alternativa_a'], $questao['alternativa_b'], $questao['alternativa_c'], $questao['alternativa_d'], $questao['alternativa_e'], $questao['alternativa_certa'], $questao['explicacao'], $questao["id_sub_tema"], $questao["id_vestibular"], $questao['ano'], $questao['imagem'], $_SESSION["id_questao"]);

        }else{

            if(!empty($_POST["quest_a"]))
                $questao['alternativa_a'] = str_replace("'", "`", $_POST["quest_a"]);
            
            if(!empty($_POST["quest_b"]))
                $questao['alternativa_b'] = str_replace("'", "`", $_POST["quest_b"]);

            if(!empty($_POST["quest_c"]))
                $questao['alternativa_c'] = str_replace("'", "`", $_POST["quest_c"]);
            
            if(!empty($_POST["resp_a"]))
                $questao['alternativa_d'] = str_replace("'", "`", $_POST["resp_a"]);
            
            if(!empty($_POST["resp_b"]))
                $questao['alternativa_e'] = str_replace("'", "`", $_POST["resp_b"]);

            if(!empty($_POST["resp_c"]))
                $questao['alternativa_certa'] = str_replace("'", "`", $_POST["resp_c"]);

            $result = Questao::alterQuestDissert($questao['enunciado'], $questao['pergunta'], $questao['alternativa_a'], $questao['alternativa_b'], $questao['alternativa_c'], $questao['alternativa_d'], $questao['alternativa_e'], $questao['alternativa_certa'], $questao["id_sub_tema"], $questao["id_vestibular"], $questao['ano'], $questao['imagem'], $_SESSION["id_questao"], $questao['explicacao']);
        }

        if($result == 1)
            echo "<div class='mensagem green'>Informações da questão alterados com sucesso!</div>";
        else
            echo "<div class='mensagem red'>Nenhum dado foi alterado, caso não seja o resultado esperado, contate-nos</div>";
    }

?>



<div class="box-content">
    <?php
        echo "<div class='subtema-container'>";
            echo "<h3>Questão sobre </h3>";
            echo "<h1>".$questao['subtema']."</h1>";
        echo "</div>";

        echo "<p><b>(".$questao['vestibular']." ".$questao['ano'].")</b> ".$questao['enunciado']."</p><br>";
                    
        if(!empty($questao['imagem']))
            echo '<img src="data:image/jpeg;base64,'.base64_encode( $questao['imagem'] ).'"/><br>';
                
        if(!empty($questao['pergunta']))
            echo "<br><p><b>".$questao['pergunta']."</b></p><br><br>";

        if($questao['tipo'] == 1){
            
            echo "<br><p><b>A) </b> ".$questao['alternativa_a']."</p>";
            echo "<br><p><b>B) </b> ".$questao["alternativa_b"]."</p>";
            echo "<br><p><b>C) </b> ".$questao['alternativa_c']."</p>";
            echo "<br><p><b>D) </b> ".$questao['alternativa_d']."</p>";

            if(!empty($questao['alternativa_e']))
                echo "<br><p><b>E) </b> ".$questao['alternativa_e']."</p><br>";	
            
            $acertTotal = Questao::acertQuestion($_SESSION["id_questao"], $questao['tipo']);

            echo "<br><p class='right'><b>Acertos:</b> ".$acertTotal[0]."/".$acertTotal[1]."</p>";
            echo "<p><b>Gabarito:</b> ".$questao['alternativa_certa']."</p>";
    ?>
</div>



<div class="box-content">
    <div class="alterar_quest">
        <h1>Alterar dados da questão</h1>
        
        <p class="aviso">Caso não queira alterar alguma informação, deixe o campo em branco. Tenha certeza da informação a ser alterada e deixe o resto em branco ou sem selecionar caso não queira mudar.</p>
        
        <p class="aviso">Caso a alternativa correta seja alterada, os dados e estatísticas de quem acertou ou errou até o momento NÃO mudarão, somente a partir da alteração.</p>

        <form enctype="multipart/form-data" action="<?php echo INCLUDE_PATH_PAINEL ?>Analise-Questao" method="POST" id="form-objet">

            <div class="box-category">
                <h2>1. Corpo da questão</h2>

                <div class="bloco-container">
                    <div class="field">
                        <label for="texto_id">Texto inicial da questão: </label>
                        <textarea id="texto_id" name="texto"></textarea>
                    </div>

                    <div class="field">
                        <label for="enunciado_id">Comando/Pergunta da questão: </label>
                        <input id="enunciado_id" type="text" name="enunciado">
                    </div>
                </div>
            </div>

            <div class="box-category">
                <h2>2. Alternativas da questão</h2>
                
                <div class="bloco-container alternativas">
                    <div class="field alternativa">
                        <label for="alter_a_id">A) </label>
                        <input id="alter_a_id" type="text" name="alter_a">
                    </div>

                    <div class="field alternativa">
                        <label id="alter_b_id" for="alter_b_id">B)</label>
                        <input id="alter_b_id" type="text" name="alter_b">
                    </div>

                    <div class="field alternativa">
                        <label for="alter_c_id">C)</label>
                        <input id="alter_c_id" type="text" name="alter_c">
                    </div>

                    <div class="field alternativa">
                        <label for="alter_d_id">D)</label>
                        <input id="alter_d_id" type="text" name="alter_d">
                    </div>

                    <div class="field alternativa">
                        <label for="alter_e_id">E)</label>
                        <input id="alter_e_id" type="text" name="alter_e">
                    </div>
                </div>
            </div>

            <div class="box-category">
                <h2>3. Informações sobre a questão</h2>
                
                <div class="bloco-container informacoes">
                    <div class="field">
                        <label for="gabarito_id">Alternativa correta: </label>

                        <select id="gabarito_id" name="gabarito">
                            <option value="">. . .</option>
                            <option value="A">Alternativa A</option>
                            <option value="B">Alternativa B</option>
                            <option value="C">Alternativa C</option>
                            <option value="D">Alternativa D</option>
                            <option value="E">Alternativa E</option>
                        </select>
                    </div>



                    <div class="field">
                        <label for="tema_id">Tema da questão: </label>

                        <select name="tema">
                            <option value="">. . .</option>
                            <?php
                                foreach ($themes as $key => $tema)
                                    if($tema['id_materia'] == $_SESSION['materia_prof'])
                                        echo "<option value='".$tema["id"]."'>".$tema["descricao"]."</option>";
                            ?>
                        </select>
                    </div>



                    <div class="field">
                        <label for="vest_id">Vestibular da questão: </label>

                        <select id="vest_id" name="vest">
                            <option value="">. . .</option>
                            <?php
                                foreach ($exams as $key => $value) {
                            ?>
                        
                                <option value="<?php echo $value["id"]; ?>"><?php echo $value["descricao"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>


                        
                    <div class="field">
                        <label for="ano_id">Ano da questão: </label>

                        <input id="ano_id" type="number" name="ano">
                    </div>
                </div>
            </div>

            <div class="box-category">
                <h2>4. Outras informações</h2>
                
                <div class="bloco-container">
                    <div class="field">
                        <label for="explic_id">Explicação da questão: </label>
                        <textarea id="explic_id" name="explic"></textarea>
                    </div>
                    
                    <div class="field">
                        <label for="image_id">Imagem da questão: </label>

                        <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                        <input id="image_id" type="file" name="image">
                    </div>
                </div>
            </div>

            <button class="botaofilled-roxo botao" type="submit" value="1"  name="action" form="form-objet"><i class="fa-regular fa-check"></i> Alterar informações</button>
        </form>

        <a href='<?php echo $areaquestoes ?>' class='botaotofill-azul botao'><i class="fa-regular fa-arrow-left"></i> Voltar para a Área de Questões</a>
    </div>

    <?php
        }

        elseif($questao['tipo'] == 2){

            if(!empty($questao['alternativa_a']))
                echo "<br><br><b>A) </b> ".$questao['alternativa_a']."<br>";

            if(!empty($questao['alternativa_b']))
                echo "<br><b>B) </b> ".$questao['alternativa_b']."<br>";

            if(!empty($questao['alternativa_c']))
                echo "<br><b>C) </b> ".$questao['alternativa_c']."<br>";

            echo "<br><p><b>Respostas esperadas:</b></p><br>";
            if(!empty($questao['alternativa_d']))
                echo"<b>A)</b> ".$questao['alternativa_d']."<br><br>";
        
            if(!empty($questao['alternativa_e']))
                echo"<b>B)</b> ".$questao['alternativa_e']."<br><br>";
        
            if(!empty($questao['alternativa_certa']))
                echo"<b>C)</b> ".$questao['alternativa_certa']."<br>";
    ?>

    <div class="alterar_quest">
        <h3>Alterar dados da questão</h3>
        <span class="aviso">** Caso não queira alterar alguma informação, deixe o campo em branco. Tenha certeza da informação a ser alterada e deixe o resto em branco ou sem selecionar caso não queira mudar **</span>

        <form enctype="multipart/form-data" action="<?php echo INCLUDE_PATH_PAINEL ?>Analise-Questao" method="POST" id="form-disser" class="red formulario">

            <div class="box-category">
                <h2>Corpo da questão</h2>

                <textarea name="texto" placeholder="Texto inicial da questão"></textarea>
                <input type="text" name="enunciado" placeholder="Comando/Pergunta da questão">
            </div>

            <div class="box-category">
                <h2>Itens e respostas da questão</h2>

                <input type="text" name="quest_a" placeholder="Item A">
                <input type="text" name="resp_a" placeholder="Resposta do item A"><br><br>

                <input type="text" name="quest_b" placeholder="Item B">
                <input type="text" name="resp_b" placeholder="Resposta do item B"><br><br>

                <input type="text" name="quest_c" placeholder="Item C" >
                <input type="text" name="resp_c" placeholder="Resposta do item C">
            </div>
            
            <div class="box-category">
                <h2>Informações sobre a questão</h2>

                <select name="tema">
                    <option value="">Tema da Questão</option>
                    <?php
                        foreach ($themes as $key => $value) { 
                            if($value[$id_materia] == $id_materia){
                    ?>
                        
                        <option value="<?php echo $value["id"]; ?>"><?php echo $value["descricao"]; ?></option>

                    <?php 
                            }
                        } 
                    ?>
                </select>

                <select name="vest">
                    <option value="">Vestibular da Questão</option>
                    <?php
                        foreach ($exams as $key => $value) { 
                    ?>
                        
                        <option value="<?php echo $value["id"]; ?>"><?php echo $value["descricao"]; ?></option>

                    <?php } ?>
                </select>

                <input type="number" name="ano" placeholder="Ano da Questão">
            </div>

            <div class="box-category">
                <h2>Outras informações</h2>
                <input type="text" name="explic" placeholder="Explicação da questão">

                <label for="image">Entre com a imagem da questão:</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                <input type="file" name="image">
            </div>

            <div class="buttons">
                <button type="submit" value="2"  name="action" form="form-disser">Alterar informações</button>
            </div>

        </form>
    </div>

    <?php
        }
    ?>

</div>