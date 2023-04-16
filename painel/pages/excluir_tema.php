<div class="box-content">
    <?php
        if(isset($_POST["action"])){

            if($_POST["action"] == 0)
                $result = Painel::deleteTema($_POST["vest"]);
            else
                $result = Painel::deleteVestibular($_POST["action"]);

            if($result == 1)
                echo "<p class='mensagem sucesso'>Tema excluído com sucesso.</p>";
            else
                echo "<p class='mensagem falha'>Algo deu errado excluindo o tema... Tente novamente.</p>";
            
        }

        $themes = Questao::selectThemes();
        $exams = Questao::selectExams();
    ?>



    <h1>Excluir um tema</h1>

    <p class="aviso2">Aviso: tenha muito cuidado, pois o item excluído será perdido permanentemente!</p>

    <form action="<?php echo INCLUDE_PATH_PAINEL?>Excluir-Tema" method="POST" id="form-temas">
        <div class="temas-container">
            <h4>Temas cadastrados: </h4>
            
            <ul>
                <?php
                    foreach ($themes as $key => $tema)
                        if($tema['id_materia'] == $_SESSION['materia_prof'])
                            echo "<li>".$tema["descricao"]."</li>";
                ?>
            </ul>
        </div>

        <p class="aviso">Escreva o nome do tema de forma idêntica ao que está escrito.</p>

        <div class="field">
            <label for="nome_id">Nome do tema: </label>
            <input id="nome_id" type="text" name="vest" maxlength="200" required>
        </div>

        <button class="botaotofill-vermelho botao" type="submit" value="0"  name="action" form="form-temas">Excluir</button>
    </form>
</div>