<?php
    include_once("../config.php");

	if(isset($_GET['loggout'])){
		Painel::loggout();
    }
    
    if(!isset($_SESSION['id'])){
        header("Location:".INCLUDE_PATH);
    }

    $materia = $_SESSION['materia_prof'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Painel de Controle</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">

    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>public/images/favicon.ico" type="image/x-icon">
    <link href="<?php echo INCLUDE_PATH; ?>public/css/main.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL ?>css/main.css" rel="stylesheet">

    <?php
        if(isset($_GET['url'])){

            $url = strtolower(str_replace("-", "_", $_GET['url']));

            //Separando a url de possíveis parâmetros
            $explode = explode(".", $url);

            if(file_exists('css/page_'.$explode[0].'.css'))
                echo'<link href="'.INCLUDE_PATH_PAINEL.'css/page_'.$explode[0].'.css" rel="stylesheet">';
        }else{
            echo'<link href="'.INCLUDE_PATH_PAINEL.'css/home.css" rel="stylesheet">';
        }
    ?>

</head>
<body>

    <div class="menu">
        <div class="menu-wrapper">
            <div class="box-usuario desktop">
                <a class="perfil-usuario" href="<?php echo INCLUDE_PATH_PAINEL ?>Perfil">
                    <div class="foto" href="#">
                        <i class="fa-duotone fa-user-tie icone"></i>
                    </div>

                    <div class="info-usuario">
                        <p class="nome"><?php echo $_SESSION['nome_admin']; ?></p>

                        <p class="nivel"><?php echo Adm::getOffice($_SESSION['type_admin']); ?></p>
                    </div>
                </a>
            
                <div class="logo"><a href="<?php echo INCLUDE_PATH; ?>"><img src="<?php echo INCLUDE_PATH; ?>public/images/logo.ico"></a></div>
            
                <div class="botao-menu-mobile">
                    <i class="fa-regular fa-bars" aria-hidden="true"></i>
                </div>
            </div>



            <div class="box-usuario mobile">
                <div class="mobile-container1">
                    <a class="perfil-usuario" href="<?php echo INCLUDE_PATH_PAINEL ?>Perfil">
                        <div class="foto" href="#">
                            <i class="fa-duotone fa-user-tie icone"></i>
                        </div>

                        <div class="info-usuario">
                            <p class="nome"><?php echo $_SESSION['nome_admin']; ?></p>

                            <p class="nivel"><?php echo Adm::getOffice($_SESSION['type_admin']); ?></p>
                        </div>
                    </a>
                </div>
                
                <div class="mobile-container2">
                    <div class="logo"><a href="<?php echo INCLUDE_PATH; ?>"><img src="<?php echo INCLUDE_PATH; ?>public/images/logo.ico"></a></div>
                </div>
            
                <div class="mobile-container3">
                    <div class="botao-menu-mobile">
                        <i class="fa-regular fa-bars" aria-hidden="true"></i>
                    </div>
                </div>
            </div>



            <div class="box-links">
                <div class="itens">
                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fa-light fa-bars-progress"></i> Início</a>
                    
                    <div class="expanding-section active exibir">
                        <a href="#" class="label"><i class="fa-light fa-bars label-icon"></i> Exibir <i class="fa-regular fa-chevron-up chevron"></i></a>

                        <div class="content">
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>Relatorios"><i class="fa-duotone fa-chart-simple"></i> Relatórios</a>
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>Exibir-Questoes"><i class="fa-duotone fa-pencil"></i> Todas as questões</a>

                            <?php if($_SESSION['type_admin'] == 2){ ?>
                                <div class="itens">
                                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>Exibir-Usuarios"><i class="fa-duotone fa-users"></i> Usuários cadastrados</a>
                                </div>
                            <?php } ?>  
                        </div>
                    </div>

                    <div class="expanding-section cadastrar">
                        <a href="#" class="label"><i class="fa-light fa-plus label-icon"></i> Cadastrar <i class="fa-regular fa-chevron-down chevron"></i></a>
                        
                        <div class="content">
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>Cadastrar-Questao"><i class="fa-duotone fa-files"></i> Nova questão</a>
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>Cadastrar-Vestibular"><i class="fa-duotone fa-messages"></i> Novo vestibular</a>
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>Cadastrar-Tema"><i class="fa-duotone fa-tags"></i> Novo tema</a>

                            <?php if($_SESSION['type_admin'] == 2){ ?>
                                <a href="<?php echo INCLUDE_PATH_PAINEL ?>Cadastrar-Materia"><i class="fa-duotone fa-book-bookmark"></i> Nova matéria</a>

                                <a href="<?php echo INCLUDE_PATH_PAINEL ?>Cadastrar-Adm"><i class="fa-duotone fa-user-shield"></i> Novo administrador</a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="expanding-section excluir">
                        <a href="#" class="label"><i class="fa-light fa-plus label-icon"></i> Excluir <i class="fa-regular fa-chevron-down chevron"></i></a>

                        <div class="content">
                            <!-- <a href="<?php echo INCLUDE_PATH_PAINEL ?>Excluir-Vestibular-Tema">Excluir vestibular / tema</a> -->
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>Excluir-Vestibular"><i class="fa-duotone fa-message-slash"></i> Excluir vestibular</a>
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>Excluir-Tema"><i class="fa-duotone fa-bookmark-slash"></i> Excluir tema</a>
                        </div>
                    </div>
                    
                    <div class="links-mobile">
                        <a href="<?php echo INCLUDE_PATH ?>" class="home"><i class="fa-duotone fa-house"></i> Home</a>

                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout" class="sair"><i class="fa-duotone fa-arrow-right-from-bracket"></i> Sair</a>
                    </div>
                </div>  
            </div>

            

            <div class="links desktop">
                <a href="<?php echo INCLUDE_PATH ?>" class="left"><i class="fa-duotone fa-house"></i> Home</a>
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout" class="loggout right"><i class="fa-duotone fa-arrow-right-from-bracket"></i> Sair</a>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="center">
            <?php 
                
                if(isset($_GET['url'])){

                    //Verificando de há algum parâmetro na
                    if(count($explode) > 1)
                        $pagina =  $explode[1];
                    else
                        $pagina = 1;

                    if($explode[0] != 'Exibir-Questoes' or $explode[0] != 'Analise-Questao'){
                        $_SESSION['partenome'] = '';
                        $_SESSION['vestibular'] = '';
                        $_SESSION['ano'] = '';
                        $_SESSION['tema'] = '';
                        $_SESSION['materia'] = '';
                    }

                    if(file_exists("pages/".$explode[0].".php"))
                        include("pages/".$explode[0].".php");
                    else
                        include("pages/home.php");

                }else
                    include("pages/home.php");
            
            ?>
        </div>
    </section>

    <script src="<?php echo INCLUDE_PATH ?>public/js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>

    <script>
        const accordion = document.getElementsByClassName('expanding-section');

        for (i = 0; i < accordion.length; i++) {
            accordion[i].addEventListener('click', function(){
                const chevron = this.querySelector(".chevron");

                if (!this.classList.contains('active')) {
                    chevron.classList.replace("fa-chevron-down", "fa-chevron-up");
                } else {
                    chevron.classList.replace("fa-chevron-up", "fa-chevron-down");
                }

                this.classList.toggle('active');
            })
        }
    </script>
</body>
</html>