<?php

    $materias = Adm::getSubject();

    foreach ($materias as $key => $materia) {
        
        if($materia['id'] == $_SESSION['materia_prof'])
            $nome_materia = $materia['nome'];
    }

    if(isset($_POST["submit"])){

        $senha_atual = hash("sha512", $_POST["pass"]);

        if($senha_atual == $_SESSION["prof_admin"]){
            if($_POST["newpass"] == $_POST["conf_newpass"]){

                if(Adm::newPass($_POST["newpass"], $_SESSION["id"]) == 1)
                    echo "<div class='mensagem green'>Senha alterada com sucesso</div>";
                else
                    echo "<div class='mensagem red'>Houve algum erro ao alterar a senha, por favor contate-nos e tente mais tarde</div>";
            }
            else
                echo"<div class='mensagem red'>Campo de 'Nova senha' e 'Confirme sua nova senha' estão diferentes</div>";
        }
        else    
            echo"<div class='mensagem red'>Senha atual errada</div>";
    }
?>
<div class="box-content">
    <div class="dados">
        <h1>Alterar senha</h1>
        <form action="<?php echo INCLUDE_PATH_PAINEL; ?>" method="POST">

        <div class="text-box">
            <label for="pass">Senha atual</label>
            <input type="password" name="pass" id="pass" class="informacoes" placeholder="Senha atual" maxlength="16" required>
        </div>
        <div class="text-box">
            <label for="newpass">Nova senha</label>
            <input type="password" name="newpass" id="newpass" class="informacoes" placeholder="Nova senha" maxlength="16" required>
        </div>
        <div class="text-box">
            <label for="conf_newpass">Confirme sua nova senha</label>
            <input type="password" name="conf_newpass" id="conf_newpass" class="informacoes" placeholder="Confirme sua nova senha" maxlength="16" required>
        </div>

        <button type="submit" name="submit" value="action">Alterar Senha</button>
        </form>
    </div> 
</div>