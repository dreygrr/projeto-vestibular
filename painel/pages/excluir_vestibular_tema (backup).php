<?php


    if(isset($_POST["action"])){

        if($_POST["action"] == 0)
            $result = Painel::deleteTema($_POST["vest"]);
        else
            $result = Painel::deleteVestibular($_POST["action"]);

        if($result == 1)
            echo "<div class='mensagem green'>Exclusão feita com sucesso!</div>";
        else
            echo "<div class='mensagem red'>Algo na exclusão deu errado!</div>";
        
    }

    $themes = Questao::selectThemes();
    $exams = Questao::selectExams();

?>

<div class="box-content">
    <h1>Excluir um vestibular</h1>
    <form action="<?php echo INCLUDE_PATH_PAINEL?>Excluir-Vestibular-Tema" method="POST" id="form-vestib" class="yellow formulario">

        <div class="box-category">
            <h2>Vestibulares cadastrados</h2>

            <?php
                foreach ($exams as $key => $value) { 
            ?>
                <div class="element">    
                    <p class="left"><?php echo $value["descricao"]; ?></p>
                    <button type="submit" value="<?php echo $value["id"]; ?>"  name="action" form="form-vestib" class="right"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    <div class="clear"></div>
                </div>

            <?php } ?>
            
        </div>
        <div class="buttons">
            <p>* O item excluído vai ser perdido permanentemente</p>
        </div>

    </form>
</div>


<div class="box-content">
    <h1>Excluir um tema</h1>
    <form action="<?php echo INCLUDE_PATH_PAINEL?>Excluir-Vestibular-Tema" method="POST" id="form-temas" class="blue formulario">

        <h2>Temas cadastrados</h2>
        <div class="box-category">       

        <?php

            foreach ($themes as $key => $tema)
                if($tema['id_materia'] == $_SESSION['materia_prof'])
                    echo "<p>".$tema["descricao"]."</p>";
        ?>
            
        </div>

        <div class="box-category">

            <input type="text" name="vest" placeholder="Nome do Vestibular para excluílo" maxlength="200" required>

        </div>

        <div class="buttons">
            <p>Copie o nome de forma identica ao que está escrito</p>
            <button type="submit" value="0"  name="action" form="form-temas">Excluir</button>
        </div>

    </form>
</div>