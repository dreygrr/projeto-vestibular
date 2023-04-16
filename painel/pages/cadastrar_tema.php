<div class="box-content">
    <?php
        if(isset($_POST["action"])){

            if($_POST["action"] == 1)
                $result = Painel::addVestibular($_POST["name"]);
            else
                $result = Painel::addTema($_POST["name"], $materia);

                if($result == 1)
                    echo "<p class='mensagem sucesso'><i class='fa-regular fa-check'></i> Tema cadastrado com sucesso.</p>";
                else
                    echo "<p class='mensagem falha'><i class='fa-regular fa-times'></i> Algo deu errado... Tente novamente.</p>";
        }

        $themes = Questao::selectThemes();
        $exams = Questao::selectExams();
    ?>



    <h1>Cadastrar um tema</h1>

    <form action="<?php echo INCLUDE_PATH_PAINEL?>Cadastrar-Tema" method="POST" id="form-temas">
        <div class="temas-container">
            <h4>Temas já cadastrados</h4>
            
            <ul>
                <?php
                    foreach ($themes as $key => $tema)
                        if($tema['id_materia'] == $_SESSION['materia_prof'])
                            echo "<li>".$tema["descricao"]."</li>";
                ?>
            </ul>
        </div>

        <p class="aviso">Aviso: não utilizar nenhum caracter especial (@, º, ª...)</p>
		
        <div class="field">
            <label>Nome do tema: </label>
            <input id="nome_id" type="text" name="name" maxlength="200" required>
        </div>

        <button class="botaofilled-verde botao" type="submit" value="2"  name="action" form="form-temas">Adicionar</button>
    </form>
</div>