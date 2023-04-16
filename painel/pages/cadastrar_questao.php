<?php

    $themes = Questao::selectThemes();
    $exams = Questao::selectExams();

    if(isset($_POST["action"])){

        $tipo = $_POST["action"];

        if(!empty($_POST["texto"]))
            $enunciado = str_replace("\n", "<br>", str_replace("'", "`", $_POST["texto"]));
        else
            $enunciado = "";
        
        $pergunta = str_replace("'", "`", $_POST["enunciado"]);

        $imagem = $_FILES['image']['tmp_name'];
        $tamanho = $_FILES['image']['size'];
        $tipoImg = $_FILES['image']['type'];
        $nome = $_FILES['image']['name'];

        if(!empty($imagem)){
            $fp = fopen($imagem, "rb");
            $conteudo = fread($fp, $tamanho);
            $conteudo = addslashes($conteudo);
        }
        else
            $conteudo = "";

        $ano = $_POST["ano"];
        $tema = $_POST["tema"];
        $vest = $_POST["vest"];

        if($tipo == 1){

            $alter_a = str_replace("'", "`", $_POST["alter_a"]);
            $alter_b = str_replace("'", "`", $_POST["alter_b"]);
            $alter_c = str_replace("'", "`", $_POST["alter_c"]);
            $alter_d = str_replace("'", "`", $_POST["alter_d"]);
            $alter_e = str_replace("'", "`", $_POST["alter_e"]);

            $gabarito = $_POST["gabarito"];
            $explic = str_replace("'", "`", $_POST["explic"]);

            $result = Questao::addQuestObj($enunciado, $pergunta, $alter_a, $alter_b, $alter_c, $alter_d, $alter_e, $gabarito, $explic, $tema, $vest, $ano, $tipo, $conteudo, $materia);

        }else{
            $quest_a = str_replace("'", "`", $_POST["quest_a"]);
            $quest_b = str_replace("'", "`", $_POST["quest_b"]);
            $quest_c = str_replace("'", "`", $_POST["quest_c"]);
            $resp_a = str_replace("'", "`", $_POST["resp_a"]);
            $resp_b = str_replace("'", "`", $_POST["resp_b"]);
            $resp_c = str_replace("'", "`", $_POST["resp_c"]);

            $result = Questao::addQuestDissert($enunciado, $pergunta, $quest_a, $quest_b, $quest_c, $resp_a, $resp_b, $resp_c, $tema, $vest, $ano, $tipo, $conteudo, $materia);

        }

        if($result == 1)
            echo "<div class='mensagem green'>Questão inserida com sucesso!</div>";
        else
            echo "<div class='mensagem red'>Algo na inserção deu errado!</div>";
        
    }
?>

<div class="box-content">
    <h1>Cadastrar Questão Objetiva</h1>

    <form class="form-questao" enctype="multipart/form-data" action="<?php echo INCLUDE_PATH_PAINEL ?>Cadastrar-Questao" method="POST" id="form-objet">

        <p class="obrigatorio">Campos com * são obrigatórios.</p>

        <div class="box-category bloco">
            <h2>1. Corpo da questão</h2>

            <div class="bloco-container">
                <div class="field">
                    <label for="textoQuestaoId">Texto da questão<span class="obrigatorio">*</span></label>
                    <textarea name="texto" id="textoQuestaoId" required></textarea>
                </div>

                <div class="field">
                    <label for="enunciadoId">Comando/Pergunta da questão<span class="obrigatorio">*</span></label>
                    <input id="enunciadoId" type="text" name="enunciado" required>
                </div>
            </div>
        </div>

        <div class="box-category bloco">
            <h2>2. Alternativas da questão</h2>

            <div class="bloco-container">
                <div class="field alternativa">
                    <label for="alter_a_id">A)<span class="obrigatorio">*</span></label>
                    <input id="alter_a_id" type="text" name="alter_a" placeholder="Alternativa A" required>
                </div>

                <div class="field alternativa">
                    <label for="alter_b_id">B)<span class="obrigatorio">*</span></label>
                    <input id="alter_b_id" type="text" name="alter_b" placeholder="Alternativa B" required>
                </div>

                <div class="field alternativa">
                    <label for="alter_c_id">C)<span class="obrigatorio">*</span></label>
                    <input id="alter_c_id" type="text" name="alter_c" placeholder="Alternativa C" required>
                </div>

                <div class="field alternativa">
                    <label for="alter_d_id">D)<span class="obrigatorio">*</span></label>
                    <input id="alter_d_id" type="text" name="alter_d" placeholder="Alternativa D" required>
                </div>

                <div class="field alternativa">
                    <label for="alter_e_id">E)</label>
                    <input id="alter_e_id" type="text" name="alter_e" placeholder="Alternativa E">
                </div>
            </div>
        </div>

        <div class="box-category bloco">
            <h2>3. Informações sobre a questão</h2>

            <div class="bloco-container informacoes">
                <div class="info-row">
                    <div class="field gabarito-campo">
                        <label for="gabarito_id">Alternativa Correta<span class="obrigatorio">*</span></label>
                        <select id="gabarito_id" name="gabarito" required>
                            <option value="">. . .</option>
                            <option value="A">Alternativa A</option>
                            <option value="B">Alternativa B</option>
                            <option value="C">Alternativa C</option>
                            <option value="D">Alternativa D</option>
                            <option value="E">Alternativa E</option>
                        </select>
                    </div>
                    
                    <div class="sep"></div>
                    
                    <div class="field tema-campo">
                        <label for="tema_id">Tema da Questão<span class="obrigatorio">*</span></label>
                        <select id="tema_id" name="tema" required>
                            <option value="">. . .</option>

                            <?php
                                foreach ($themes as $key => $tema)
                                    if($tema['id_materia'] == $_SESSION['materia_prof'])
                                        echo "<option value='".$tema["id"]."'>".$tema["descricao"]."</option>";
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="field vest-campo">
                        <label for="vest_id">Vestibular da Questão<span class="obrigatorio">*</span></label>
                        <select id="vest_id" name="vest" required>
                            <option value="">. . .</option>
                            <?php
                                foreach ($exams as $key => $value) { 
                            ?>
                                
                                <option value="<?php echo $value["id"]; ?>"><?php echo $value["descricao"]; ?></option>

                            <?php } ?>
                        </select>
                    </div>

                    <div class="sep"></div>

                    <div class="field ano-campo">
                        <label for="ano_id">Ano da Questão<span class="obrigatorio">*</span></label>
                        <input id="ano_id" type="number" name="ano" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-category bloco">
            <h2>4. Outras informações</h2>

            <div class="bloco-container">
                <div class="field">
                    <label for="explic_id">Explicação da Questão</label>
                    <textarea id="explic_id" type="text" name="explic"></textarea>
                </div>
                
                <div class="field">
                    <label for="image_id">Imagem da questão</label>

                    <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                    <input id="image_id" type="file" name="image">
                </div>
                
            </div>
        </div>

        <div class="buttons">
            <button class="botaotofill-azul botao" type="submit" value="1"  name="action" form="form-objet">Cadastrar</button>
        </div>
    </form>
</div>


<div class="box-content">
    <h1>Cadastrar Questão Dissertativa</h1>

    <form class="form-questao" enctype="multipart/form-data" action="<?php echo INCLUDE_PATH_PAINEL ?>Cadastrar-Questao" method="POST" id="form-disser">
        <p class="obrigatorio">Campos com * são obrigatórios.</p>

        <div class="box-category bloco">
            <h2>1. Corpo da questão</h2>
            
            <div class="bloco-container">
                <div class="field">
                    <label for="texto_id">Texto inicial da questão<span class="obrigatorio">*</span></label>
                    <textarea id="texto_id" name="texto" required></textarea>
                </div>

                <div class="field">
                    <label for="enunciado_id">Comando/Pergunta da Questão<span class="obrigatorio">*</span></label>
                    <input id="enunciado_id" type="text" name="enunciado" required>
                </div>
            </div>
        </div>

        <div class="box-category bloco itens-respostas">
            <h2>2. Itens e respostas da questão</h2>

            <div class="bloco-container">
                <div class="conjunto primeirofilho">
                    <i class="fa-light fa-arrow-turn-down"></i>
                    
                    <div class="fields">
                        <div class="field">
                            <label for="quest_a_id">Item A<span class="obrigatorio">*</span></label>
                            <input id="quest_a_id" type="text" name="quest_a" required>
                        </div>
                        
                        <div class="field">
                            <label for="resp_a_id">Resposta do item A<span class="obrigatorio">*</span></label>
                            <input id="resp_a_id" type="text" name="resp_a" required>
                        </div>
                    </div>
                </div>
                
                <div class="conjunto">
                    <i class="fa-light fa-arrow-turn-down"></i>

                    <div class="fields">
                        <div class="field">
                            <label for="quest_b_id">Item B<span class="obrigatorio">*</span></label>
                            <input id="quest_b_id" type="text" name="quest_b" required>
                        </div>
    
                        <div class="field">
                            <label for="resp_b_id">Resposta do item B<span class="obrigatorio">*</span></label>
                            <input id="resp_b_id" type="text" name="resp_b" required>
                        </div>
                    </div>
                </div>
                
                <div class="conjunto ultimofilho">
                    <i class="fa-light fa-arrow-turn-down"></i>

                    <div class="fields">
                        <div class="field">
                            <label for="quest_c_id">Item C</label>
                            <input id="quest_c_id" type="text" name="quest_c">
                        </div>
    
                        <div class="field">
                            <label for="resp_c_id">Resposta do item C</label>
                            <input id="resp_c_id" type="text" name="resp_c">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="box-category bloco informacoes2">
            <h2>3. Informações sobre a questão</h2>

            <div class="bloco-container">
                <div class="field">
                    <label for="tema_id2">Tema da Questão<span class="obrigatorio">*</span></label>
                    <select id="tema_id2" name="tema" required>
                        <option value="">. . .</option>
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
                </div>
                
                <div class="fields-row">
                    <div class="field">
                        <label for="vest_id2">Vestibular da Questão<span class="obrigatorio">*</span></label>
                        <select id="vest_id2" name="vest" required>
                            <option value="">. . .</option>
                            <?php
                                foreach ($exams as $key => $value) { 
                            ?>
                                
                                <option value="<?php echo $value["id"]; ?>"><?php echo $value["descricao"]; ?></option>
            
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="sep"></div>

                    <div class="field">
                        <label for="ano_id_2">Ano da Questão<span class="obrigatorio">*</span></label>
                        <input id="ano_id_2" type="number" name="ano" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-category bloco">
            <h2>4. Outras informações</h2>

            <div class="bloco-container">
                <div class="field">
                    <label for="explic_id_2">Explicação da Questão</label>
                    <textarea id="explic_id_2" type="text" name="explic"></textarea>
                </div>
                
                <div class="field">
                    <label for="image_id_2">Entre com a imagem da questão:</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                    <input id="image_id_2" type="file" name="image">
                </div>
            </div>
        </div>

        <div class="buttons">
            <button class="botaotofill-azul botao" type="submit" value="2"  name="action" form="form-disser">Cadastrar</button>
        </div>
    </form>
</div>