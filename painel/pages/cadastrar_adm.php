<div class="box-content">
    <?php
        if(isset($_POST["cadastrar"])) {
            $nome = $_POST["nome"];
            $id_materia = $_POST["materia"];

            $email = $_POST["email"];
            $conf_email = $_POST["conf_email"];

            $pass = $_POST["pass"];
            $conf_pass = $_POST["conf_pass"];
            
            $cont = 0;

            if($pass == $conf_pass and $email == $conf_email) {

                $infs = User::checkEmail($email);

                $infsUser = $infs[0];
                $infsAdm = $infs[1];
                
                if(empty($infsUser) and empty($infsAdm)){
                    $confirm = Adm::addAdms($nome, $email, $pass, $id_materia);

                    if($confirm == 1)
                        echo "<p class='mensagem sucesso'>Professor(a) cadastrado(a) com sucesso.</p>";
                    else
                        echo "<p class='mensagem falha'>Algo deu errado no cadastro!</p>";
                } else
                    echo "<p class='mensagem falha'>Já existe um usuário com esse e-mail. Tente outro por favor.</p>";
            } else {
                if($email != $conf_email)
                    echo "<p class='mensagem falha'>Os campos do e-mail devem ser iguais.</p>";
                if($pass != $conf_pass)
                    echo "<p class='mensagem falha'>Os campos de senha devem ser iguais.</p>";
            }    
        } elseif(isset($_POST["prof"])) {
            $result = Adm::deleteAdms($_POST["prof"]);

            if($result == 1)
                echo "<p class='mensagem sucesso'>Administrador removido com sucesso.</p>";
            else
                echo "<p class='mensagem falha'>Algo deu errado excluindo o administrador... Tente novamente.</p>";
            }
            
            elseif(isset($_POST["button-materia"])) {
                $result = Adm::addMateria($_POST["name_materia"]);

                if($result == 1)
                    echo "<p class='mensagem sucesso'>Inserção feita com sucesso.</p>";
                else
                    echo "<p class='mensagem falha'>Algo na inserção deu errado...</p>";
            }

        $adms = Adm::getAdms();
        $materias = Adm::getSubject();
    ?>

    <h1>Cadastrar um Professor</h1>
    
    <form action="<?php echo INCLUDE_PATH_PAINEL ?>Cadastrar-Adm" method="POST" id="form-cadastrar">
        <div class="adms-container">
            <h4>Professores já cadastrados: </h4>

            <table>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Matéria</th>
                </tr>

                <?php foreach ($adms as $key => $value) { ?>
                    <tr>
                        <td><?php echo $value["nome"]; ?></td>
                        <td><?php echo $value["email"]; ?></td>
                        <td><?php echo $value["materia"]; ?></td>
                        <form action="<?php echo INCLUDE_PATH_PAINEL ?>Excluir-Adm" method="post" class="form_delete_adm" id="form_delete_adm">
                            <?php if($value["type"] != 2){ ?>
                                <td>
                                    <button type="submit" class="right" value="<?php echo $value["id"]; ?>" name="prof" form="form_delete_adm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>
                            <?php } ?>
                        </form>
                    </tr>
                <?php } ?>
            </table>
        </div>
        
        <div class="field">
            <label for="nome_id">Nome: </label>
            <input id="nome_id" type="text" name="nome" maxlength="50" required>
        </div>

        <div class="field">
            <label for="email_id">E-mail: </label>
            <input id="email_id" type="email" name="email" maxlength="100" required>
        </div>

        <div class="field">
            <label for="conf_email_id">Confirme o e-mail: </label>
            <input id="conf_email_id" type="email" name="conf_email" maxlength="100" required>
        </div>

        <div class="field">
            <label for="senha_id">Senha: </label>
            <input id="senha_id" type="password" name="pass" maxlength="16" required>
        </div>

        <div class="field">
            <label for="conf_senha_id">Confirme a senha: </label>
            <input id="conf_senha_id" type="password" name="conf_pass" maxlength="16" required>
        </div>

        <div class="field">
            <label for="materia_id">Matéria: </label>

            <select id="materia_id" name="materia" required>
                <?php
                    foreach ($materias as $materia) {
                        echo"<option value='".$materia['id']."'>".$materia['nome']."</option>";
                    }
                ?>
            </select>
        </div>

        <button class="botaofilled-verde botao" type="submit" value="0"  name="cadastrar" form="form-cadastrar">Adicionar</button>
    </form>
</div>