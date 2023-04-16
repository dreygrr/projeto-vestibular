

<div class="box-content">
    <?php
        if(isset($_POST["action"])){

            if($_POST["action"] == 1)
                $result = Painel::addVestibular($_POST["name"]);
            else
                $result = Painel::addTema($_POST["name"], $materia);

            if($result == 1)
                echo "<p class='mensagem sucesso'><i class='fa-regular fa-check'></i> Vestibular cadastrado com sucesso.</p>";
            else
                echo "<p class='mensagem falha'><i class='fa-regular fa-times'></i> Algo deu errado... Tente novamente.</p>";
            
        }

        $themes = Questao::selectThemes();
        $exams = Questao::selectExams();
    ?>

    <h1>Cadastrar um vestibular</h1>

    <form action="<?php echo INCLUDE_PATH_PAINEL?>Cadastrar-Vestibular" method="POST" id="form-vestib">
        <div class="vests-container">
            <h4>Vestibulares já cadastrados:</h4>
            
            <ul>
                <?php
                    foreach ($exams as $key => $value) { 
                        echo '<li>' . $value["descricao"] . '</li>';
                    }
                ?>
            </ul>
        </div>

        <p class="aviso">Aviso: não utilizar nenhum caracter especial (@, º, ª...)</p>

        <div class="field">
            <label for="nome_vest_id">Nome do vestibular: </label>
            <input id="nome_vest_id" type="text" name="name" maxlength="30" required>
        </div>

        <button class="botaofilled-verde botao" type="submit" value="1"  name="action" form="form-vestib">Adicionar</button>
    </form>
</div>