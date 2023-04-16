<section class="cadastro">

    <?php   
    
        $redes = User::selectTypeNetwork();
        $escolaridades = User::selectSchooling();

        $ano_max = date('Y') - 7;

        if(!empty($_POST['submit'])){

            $nome = $_POST['nome'];

            $email = $_POST['e-mail'];
            $conf_email = $_POST['conf_e-mail'];

            $senha = $_POST['senha'];
            $conf_senha = $_POST['conf_senha'];

            $aniversario = $_POST['aniver'];
            $escolaridade = $_POST['escolar'];
            $rede = $_POST['rede'];

            if($senha == $conf_senha and $email == $conf_email){

                $infs = User::checkEmail($email);

                $infsUser = $infs[0];
                $infsAdm = $infs[1];
                   
                if(empty($infsUser) and empty($infsAdm)){

                    $confirm = User::registerUsers($nome, $senha, $email, $aniversario, $escolaridade, $rede);

                    if($confirm == 1)
                        echo "<div class='msg-sucesso msg'><p><i class='fas fa-check'></i> Cadastro feito com sucesso!</p></div>";
                    else
                        echo "<div class='msg-erro msg'><i class='fas fa-exclamation-triangle'></i> Houve algum erro em seu cadastro. Contate-nos.</div>";
                }
                else
                    echo "<div class='msg-erro msg'><p><i class='fas fa-exclamation-triangle'></i> Já existe um usuário com essse e-mail.</p></div>";
            } else {

                if($email != $conf_email)
                    echo "<div class='msg-erro msg'><i class='fas fa-exclamation-triangle'></i> Os campos <b>'E-mail'</b> e <b>'Confirmar E-mail'</b> devem ser iguais</div>";
                if($senha != $conf_senha)
                    echo "<div class='msg-erro msg'><i class='fas fa-exclamation-triangle'></i> Os campos <b>'Senha'</b> e <b>'Confirmar Senha'</b> devem ser iguais</div>";
            }
        }
    ?>

    <div class="box">
        <div class="center">
            <h3>Crie sua conta</h3>
            <form action="<?php echo INCLUDE_PATH; ?>cadastrar" method="POST">
                <div class="text-box"> 
                    <label for="nome">Nome</label><span> *</span>
                    <input type="text" name="nome" id="nome" class="informacoes" placeholder="Nome" maxlength="50" required>
                </div>
                <div class="text-box">
                    <label for="e-mail">E-mail</label><span> *</span>
                    <input type="e-mail" name="e-mail" id="e-mail" class="informacoes" placeholder="E-mail" maxlength="100" required>
                </div>
                <div class="text-box">
                    <label for="conf_e-mail">Confirmar E-mail</label><span> *</span>
                    <input type="e-mail" name="conf_e-mail" id="conf_e-mail" class="informacoes" placeholder="Confirme seu E-mail" maxlength="100" required>
                </div>
                <div class="text-box">
                    <label for="senha">Senha</label><span> *</span>
                    <input type="password" name="senha" id="senha" class="informacoes" placeholder="Senha" maxlength="16" required>
                </div>
                <div class="text-box">
                    <label for="conf_senha">Confirmar senha</label><span> *</span>
                    <input type="password" name="conf_senha" id="conf_senha" class="informacoes" placeholder="Confirme sua Senha" maxlength="16" required>
                </div>
                <div class="text-box">
                    <label for="nasc">Data de nascimento</label><span> *</span>
                    <input type="date" name="aniver" id="nasc" class="informacoes" max="<?php echo $ano_max."-".date('m')."-".date('d') ?>" required>
                </div>
                <div class="text-box">
                    <label for="escolar">Sua escolaridade</label><span> *</span>
                    <select id="escolar" name="escolar" required>
                        <option value="">Escolaridade</option>
                        <?php  

                            foreach ($escolaridades as $key => $escolaridade)
                                echo"<option value='".$escolaridade['id']."'>".$escolaridade['descricao']."</option>";
                        ?>
                    </select>
                </div>
                <div class="text-box">
                    <label for="rede">Rede da sua escola</label><span> *</span>
                    <select id="rede" name="rede" required>
                        <option value="">Rede</option>
                        <?php  

                            foreach ($redes as $key => $rede)
                                echo"<option value='".$rede['id']."'>".$rede['descricao']."</option>";
                        ?>
                    </select>
                </div>

                <button class="botaofilled-azul" type="submit" name="submit" value="Cadastrar">Cadastrar</button>

                <a href="<?php echo INCLUDE_PATH; ?>pages/login.php" class="basic-link">Já tem o seu cadastro? <i class="fas fa-arrow-right"></i></a>
            </form>
        </div>
    </div>
</section>
