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
                    echo "<div class='mensagem-green'>Senha alterada com sucesso!</div>";
                else
                    echo "<div class='mensagem-red'>Houve algum erro ao alterar a senha. Por favor, contate-nos e tente mais tarde.</div>";
            }
            else
                echo"<div class='mensagem-red'>Campo de 'Nova senha' e 'Confirme sua nova senha' estão diferentes</div>";
        }
        else    
            echo"<div class='mensagem-red'>Senha atual errada</div>";
    }
?>
<div class="box-content">
    <div class="welcome">
        <i class="fa-duotone fa-badge-check check"></i>
        <h2 class="welcome">Seja bem-vindo(a), <br> <span class="nome"><?php echo $_SESSION['nome_admin']?>!</span></h2><br>
    </div>

    <div class="info">
        <ul>
            <li><b>Sua matéria: </b><?php echo $nome_materia ?></li>
        </ul>
    </div>

    <div class="sugestoes">
        <h3 class="cabecalho"><i class="fa-duotone fa-sparkles"></i> Sugestões</h3>

        <div class="banner roxo">
            <i class="fa-duotone fa-book-open-cover icon"></i>

            <div class="content">
                <h4>Veja todas as questões</h4>

                <p>Veja todas as questões cadastradas até agora. </p>

                <a href="<?php echo INCLUDE_PATH_PAINEL ?>Exibir-Questoes" class="botaotofill-branco botao">Ver questões <i class="fa-regular fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="toright">
            <div class="banner verde">
                <div class="content">
                    <h4>Cadastre uma questão</h4>

                    <p>Cadastre uma questão alternativa ou dissertativa de vestibular.</p>

                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>Cadastrar-Questao" class="botaotofill-branco botao">Cadastrar questão <i class="fa-regular fa-arrow-right"></i></a>
                </div>

                <i class="fa-duotone fa-list-check icon"></i>
            </div>
        </div>

        <div class="banner azul">
            <i class="fa-duotone fa-chart-line icon"></i>

            <div class="content">
                <h4>Analise alguns dados do site</h4>
                
                <p>Veja alguns gráficos que trazem estatísticas sobre certos assuntos do site.</p>

                <a href="<?php echo INCLUDE_PATH_PAINEL ?>Relatorios" class="botaotofill-branco botao">Ver relatórios <i class="fa-regular fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

   <!--  <div class="dados">
        <h3>Alterar senha</h3>
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
    </div>  -->
</div>