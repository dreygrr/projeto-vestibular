<?php

    if(isset($_POST["cadastrar"])){

        $nome = $_POST["nome"];
        $id_materia = $_POST["materia"];

        $email = $_POST["email"];
        $conf_email = $_POST["conf_email"];

        $pass = $_POST["pass"];
        $conf_pass = $_POST["conf_pass"];
        
        $cont = 0;

        if($pass == $conf_pass and $email == $conf_email){

            $infs = User::checkEmail($email);

            $infsUser = $infs[0];
            $infsAdm = $infs[1];
               
            if(empty($infsUser) and empty($infsAdm)){

                $confirm = Adm::addAdms($nome, $email, $pass, $id_materia);

                if($confirm == 1)
                    echo "<div class='mensagem green'>Professor cadastrado com sucesso</div>";
                else
                    echo "<div class='mensagem red'>Algo deu errado no cadastro!</div>";
            }
            else
                echo "<div class='mensagem red'>Já existe um usuário com esse e-mail, tente outro</div>";
        }
        else{

            if($email != $conf_email)
                echo "<div class='mensagem red'>Os campos 'E-mail' e 'Confirmar E-mail' devem ser iguais</div>";
            if($pass != $conf_pass)
                echo "<div class='mensagem red'>Os campos 'Senha' e 'Confirmar Senha' devem ser iguais</div>";
        }    
    }
    elseif(isset($_POST["prof"])){

        $result = Adm::deleteAdms($_POST["prof"]);

        if($result == 1)
            echo "<div class='mensagem green'>Administrador deletado com sucesso</div>";
        else
            echo "<div class='mensagem red'>Algo deu errado na deleção!</div>";
    }
    elseif(isset($_POST["button-materia"])){

        $result = Adm::addMateria($_POST["name_materia"]);

        if($result == 1)
            echo "<p class='mensagem sucesso'><i class='fa-regular fa-check'></i> Matéria cadastrada com sucesso.</p>";
        else
            echo "<p class='mensagem falha'><i class='fa-regular fa-times'></i> Algo deu errado... Tente novamente.</p>";
    }

    $adms = Adm::getAdms();
    $materias = Adm::getSubject();

?>

<div class="box-content">
    <h1>Cadastrar uma matéria</h1>

    <form action="<?php echo INCLUDE_PATH_PAINEL?>Cadastrar-Adm" method="POST" id="form-materia">
        <div class="materias-container">
            <h4>Matérias já cadastradas</h4>

            <ul>
                <?php
                    foreach ($materias as $key => $value) {
                        echo '<li>' . $value["nome"] . '</li>';
                    }
                ?>
            </ul>
        </div>

        <p class="aviso">Aviso: não utilizar nenhum caracter especial (@, º, ª...)</p>

        <div class="field">
            <label for="nome_id">Nome da matéria</label>
            <input id="nome_id" type="text" name="name_materia" maxlength="20" required>
        </div>

        <button class="botaofilled-verde botao" type="submit" value="0"  name="button-materia" form="form-materia">Adicionar</button>
    </form>
</div>