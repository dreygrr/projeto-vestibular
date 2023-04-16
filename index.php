<?php 
    include_once("config.php");
?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <title>Projeto Vestibular</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do meu website">
    <meta name="keywords" content="palavras-chave, do meu, site">


    
    <!--FONT AWESOME GRATUITO-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">

    <!-- FONT AWESOME PREMIUM -->
    <!-- NOTA: Caso esse link não funcione, corrija os ícones da versão premium substituindo pelos gratuitos. -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">

    <!--ICONE DA PAGINA-->
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>public/images/favicon.ico" type="image/x-icon">

    <!--HOME-->
    <link href="<?php echo INCLUDE_PATH; ?>public/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>public/css/page_home.css">
    
    <!--RODAPE-->
    <link href="<?php echo INCLUDE_PATH; ?>public/css/menu_rodape.css" rel="stylesheet">

    <!--NAV-->
    <link href="<?php echo INCLUDE_PATH; ?>public/css/home_nav.css" rel="stylesheet">

    <?php

        //Recuperando a url selecionada
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';
        
        //Separando a url de possíveis parâmetros
        $explode = explode("-", $url);

        //Importar o CSS da página caso exista
        if(file_exists('public/css/page_'.$explode[0].'.css'))
            echo'<link href="'.INCLUDE_PATH.'public/css/page_'.$explode[0].'.css" rel="stylesheet">';
    ?>

</head>
<body>

    <header>
        <div class="center">
            <div class="logo"><a href="<?php echo INCLUDE_PATH; ?>"><img src="public/images/logo.ico"></a></div>

            <nav class="desktop">
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>"><i class="fa-duotone fa-house-chimney"></i> Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>area_de_questoes"><i class="fa-duotone fa-pencil"></i> Área de Questões</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>feedback"><i class="fa-duotone fa-megaphone"></i> Feedback</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>contato"><i class="fa-duotone fa-paper-plane"></i> Contato</a></li>

                    <?php
                        if(!isset($_SESSION['status_login'])){
                    ?>
                        <li><a href="<?php echo INCLUDE_PATH; ?>pages/login.php"><i class="fas fa-sign-in-alt"></i> Entrar</a></li>
                    <?php
                        }
                        elseif($_SESSION['status_login'] == 1){
                    ?>
                        <li><a href="<?php echo INCLUDE_PATH_ESTUDANTE; ?>"><i class="fa-duotone fa-user"></i> Área do Usuário</a></li>
                    <?php
                        }
                        else{
                    ?>
                        <li><a href="<?php echo INCLUDE_PATH_PAINEL; ?>"><i class="fa-duotone fa-user"></i> Área do Prof.</a></li>
                    <?php
                        }
                    ?>
                </ul>
            </nav>



            <!--NAV MOBILE-->
            <nav class="mobile">
                <div class="botao-menu-mobile">
                    <i class="fa-regular fa-bars" aria-hidden="true"></i>
                </div>
                
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>"><i class="fa-duotone fa-house-chimney"></i> Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>area_de_questoes"><i class="fa-duotone fa-pencil"></i> Área de Questões</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>feedback"><i class="fa-duotone fa-megaphone"></i> Feedback</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>contato"><i class="fa-duotone fa-paper-plane"></i> Contato</a></li>

                    <?php
                        if(!isset($_SESSION['status_login'])){
                    ?>
                        <li><a href="<?php echo INCLUDE_PATH; ?>pages/login.php"><i class="fas fa-sign-in-alt"></i> Entrar</a></li>
                    <?php
                        }
                        elseif($_SESSION['status_login'] == 1){
                    ?>
                        <li><a href="<?php echo INCLUDE_PATH_ESTUDANTE; ?>"><i class="fa-duotone fa-user"></i> Área do Usuário</a></li>
                    <?php
                        }
                        else{
                    ?>
                        <li><a href="<?php echo INCLUDE_PATH_PAINEL; ?>"><i class="fa-duotone fa-user"></i> Área do Prof.</a></li>
                    <?php
                        }
                    ?>
                    
                    <!-- <li><a href="<?php echo INCLUDE_PATH; ?>pages/login.php"><i class="fas fa-sign-in-alt"></i> Entrar</a></li> -->
                </ul>
            </nav>
        </div>
    </header>
    
    <?php

        //Verificando de há algum parâmetro na
        if(count($explode) > 1)
            $pagina =  $explode[1];
        else
            $pagina = 1;
        
        //Iniciando as sessões caso elas não existam
        if(!isset($_SESSION['partenome']))
            $_SESSION['partenome'] = '';

        if(!isset($_SESSION['vestibular']))
            $_SESSION['vestibular'] = '';

        if(!isset($_SESSION['ano']))
            $_SESSION['ano'] = '';

        if(!isset($_SESSION['tema']))
            $_SESSION['tema'] = '';

        if(!isset($_SESSION['materia']))
            $_SESSION['materia'] = '';

        //Resetanto os filtros caso o usuário não esteja nas áreas de Resolução ou de Questão
        if($explode[0] != 'area_de_questoes' and $explode[0] != 'resolucao_de_questoes'){

            $_SESSION['partenome'] = '';
            $_SESSION['vestibular'] = '';
            $_SESSION['ano'] = '';
            $_SESSION['tema'] = '';
            $_SESSION['materia'] = '';
        }

        //Verificando se a url escolhida existe
        if(file_exists('pages/'.$explode[0].'.php'))
            include_once('pages/'.$explode[0].'.php');
        else
            header("Location: pages/erro404.php");
    ?>



    <footer id="footer">
        <div class="logo_ifsp_upper">
            <img src="public/images/logo_ifsp1.png">
        </div>

        <div class="container">
            <div class="palavras_chave bloco">
                    <p>Ensino</p>
                    
                    <div class="sep"></div>

                    <a href="http://hto.ifsp.edu.br/institucional/">
                        IFSP
                    </a>
                    
                    <div class="sep"></div>

                    <p>Vestibulares</p>
                    
                    <div class="sep"></div>
                    
                    <p>Resolução de exercícios</p>
            </div>

            <div class="copr bloco">
                Copyright © 2022 IFSP Câmpus Hortolândia
            </div>

            <div class="feedback bloco">
                <a href="<?php echo INCLUDE_PATH; ?>feedback"><b>Conte-nos aqui sobre sua experiência!</b></a>
            </div>

            <div class="devs bloco">
                <p>Desenvolvido por: Paulo Victor, Tifany Almeida dos Santos, Andrey de Assis</p>
            </div>

            <div class="devs bloco">
                <p>Projeto coordenado por Mariana Traldi</p>
            </div>
        </div>

        <div class="logo_ifsp_bottom">
            <img src="public/images/logo_ifsp2.png">
        </div>
    </footer>



    <script src="<?php echo INCLUDE_PATH; ?>public/js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>public/js/scripts.js"></script>

</body>
</html>