

<div class="box-content">
    <?php
        if(isset($_POST["action"])){

            if($_POST["action"] == 0)
                $result = Painel::deleteTema($_POST["vest"]);
            else
                $result = Painel::deleteVestibular($_POST["action"]);

            if($result == 1)
                echo "<p class='mensagem sucesso'><i class='fa-regular fa-check'></i> Vestibular excluído com sucesso.</p>";
            else
                echo "<p class='mensagem falha'><i class='fa-regular fa-times'></i> Algo deu errado... Tente novamente.</p>";
        }

        $themes = Questao::selectThemes();
        $exams = Questao::selectExams();
    ?>

    <h1>Excluir um vestibular</h1>

    <p class="aviso">Aviso: tenha muito cuidado pois o item excluído será perdido permanentemente!</p>

    <form action="<?php echo INCLUDE_PATH_PAINEL?>Excluir-Vestibular" method="POST" id="form-vestib">
        <div class="vests-container">
            <h4>Vestibulares cadastrados</h4>

            <ul>
                <?php
                    foreach ($exams as $key => $value) { ?>
                        <li>
                            <p><?php echo $value["descricao"]; ?></p>

                            <button class="trash-icon" type="submit" value="<?php echo $value["id"]; ?>"  name="action" form="form-vestib"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </form>
</div>