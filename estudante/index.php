<?php 
    include_once("../config.php");
    
	if(!isset($_SESSION['status_login']))
        header("Location:".INCLUDE_PATH);
        
    if(isset($_GET['loggout'])){
        header("Location:".INCLUDE_PATH."php/deslogar.php");
    }

    $user = User::getUserInfs($_SESSION["id_usuario"]);
?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <title>Projeto de Historia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do meu website">
    <meta name="keywords" content="palavras-chave, do meu, site">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">

    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>public/images/favicon.ico" type="image/x-icon">
    <link href="<?php echo INCLUDE_PATH; ?>public/css/main.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_ESTUDANTE; ?>css/main.css" rel="stylesheet">

    <?php

        //Recuperando a url selecionada
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';

        //Separando a url de possíveis parâmetros
        $explode = explode("-", $url);

        //Importar o CSS da página caso exista
        if(file_exists('css/page_'.$explode[0].'.css'))
            echo'<link href="'.INCLUDE_PATH_ESTUDANTE.'css/page_'.$explode[0].'.css" rel="stylesheet">';
    ?>
</head>
<body>

    <div class="menu">
        <div class="menu-wraper">

            <div class="box-usuario">
                <a class="perfil-usuario" href="<?php INCLUDE_PATH_ESTUDANTE; ?>perfil">
                    <div class="foto" href="#">
                        <i class="fa-duotone fa-user icone"></i>
                    </div>

                    <div class="info-usuario">
                        <p class="nome">
                            <?php echo explode(" ", $user[0][0])[0];?>
                        </p>

                        <p class="nivel">Estudante</p>
                    </div>
                </a>

                <a class="logo-container" href="<?php echo INCLUDE_PATH; ?>">
                    <img class="logo" src="<?php echo INCLUDE_PATH; ?>public/images/logo.ico">
                </a>
                
                <div class="botao-menu-mobile">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <div class="clear"></div>
            </div>
            <div class="box-links">
                <div class="itens">
                    <a href="<?php echo INCLUDE_PATH_ESTUDANTE ?>"><i class="fa-light fa-bars-progress"></i> Início</a>
                    <a href="<?php echo INCLUDE_PATH_ESTUDANTE ?>questoes_feitas"><i class="fa-light fa-check"></i> Questões resolvidas</a>
                    <a href="<?php echo INCLUDE_PATH_ESTUDANTE ?>alterar_dados"><i class="fa-light fa-pen"></i> Alterar dados pessoais</a>
                </div>  
            </div>

            <div class="links">
                <a href="<?php echo INCLUDE_PATH ?>" class="left"><i class="fa-duotone fa-house"></i> Home</a>
                <a href="<?php echo INCLUDE_PATH_ESTUDANTE ?>?loggout" class="loggout right"><i class="fa-duotone fa-arrow-right-from-bracket"></i> Sair</a>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <section class="content">

        <?php

            //Verificando de há algum parâmetro na
            if(count($explode) > 1)
                $pagina =  $explode[1];
            else
                $pagina = 1;

            //Verificando se a url escolhida existe
            if(file_exists('pages/'.$explode[0].'.php'))
                include_once('pages/'.$explode[0].'.php');
            else
                header("Location: ".INCLUDE_PATH."pages/erro404.php");
        ?>
    </section>

    <script src="<?php echo INCLUDE_PATH ?>public/js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
</body>
</html>