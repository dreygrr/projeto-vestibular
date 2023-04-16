<?php 
    include_once("../config.php");
?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <title>Projeto Vestibular</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do meu website">
    <meta name="keywords" content="palavbra-chave, do meu, site">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">

    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>public/images/favicon.ico" type="image/x-icon">

    <link href="<?php echo INCLUDE_PATH; ?>public/css/main.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH; ?>public/css/login.css" rel="stylesheet">
</head>

<body>
    <section class="login">
        <div class="box">
            <a class="logo" href="<?php echo INCLUDE_PATH; ?>"><img src="<?php echo INCLUDE_PATH; ?>public/images/logo.ico"></a>

            <?php 

                if(!empty($_POST['submit'])){

                    $infs = User::login($_POST['e-mail'], $_POST['senha']);

                    $infsUser = $infs[0];
                    $infsAdm = $infs[1];

                    if(!empty($infsUser) or !empty($infsAdm)){

                        if(!empty($infsUser) and empty($infsAdm)){

                            $_SESSION['status_login'] = 1;

                            foreach ($infsUser as $key => $aluno){

                                $_SESSION['id_usuario'] = $aluno['id'];

                                header("location: ".INCLUDE_PATH_ESTUDANTE);
                            }
                        }
                        elseif(empty($infsUser) and !empty($infsAdm)){

                            $_SESSION['status_login'] = 2;

                            foreach ($infsAdm as $key => $prof){

                                $_SESSION['type_admin'] = $prof['type'];
                                $_SESSION['nome_admin'] = $prof['nome'];
                                $_SESSION['materia_prof'] = $prof['id_materia'];
                                $_SESSION['id'] = $prof['id'];
                                $_SESSION['prof_admin'] = $prof['senha'];
                                $_SESSION['email_admin'] = $_POST['e-mail'];

                                header("location: ".INCLUDE_PATH_PAINEL);
                            }
                        }
                    }
                    else
                        echo "<p class='erro'><i class='fa-regular fa-times'></i> E-mail ou Senha incorretos!</p>";
                }
            ?>

            <form method="POST" action="<?php echo INCLUDE_PATH; ?>pages/login.php">
                <h1>Fazer log-in</h1>

                <div class="linha field">
                    <label for="e-mail">E-mail: </label>
                    <input type="e-mail" name="e-mail" id="e-mail" class="informacoes" placeholder="E-mail" maxlength="100" required>
                </div>
                
                <div class="linha field">
                    <label for="senhaId">Senha: </label>
                    <input type="password" name="senha" id="senhaId" class="informacoes" maxlength="16" placeholder="Senha" required>
                </div>

                <div class="linha botao-login-container">
                    <button type="submit" name="submit" value="Entrar">Entrar</button>
                </div>

                <div class="help-links">
                    <a class="basic-link" href="<?php echo INCLUDE_PATH; ?>cadastrar" class="link"><i class="fa-solid fa-arrow-right"></i> Não fez o cadastro ainda?</a>
                    <br>
                    <a class="basic-link" href="<?php echo INCLUDE_PATH; ?>" class="link"><i class="fa-solid fa-arrow-right"></i> Voltar para a home</a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>