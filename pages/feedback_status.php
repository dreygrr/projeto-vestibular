<?php 
    include_once("config.php");
?>

<head>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>public/css/page_feedback.css">

    <link href="<?php echo INCLUDE_PATH; ?>public/css/main.css" rel="stylesheet">
    
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
</head>

<main>
    <section class="feedback">
        <div class="enviar-feedback">
            <?php
                if(!isset($_GET['status']) || $_GET['status'] == "erro") {
                    echo <<<HTML
                        <div class="msg-container">
                            <i class="fas fa-times icone-erro"></i>
                            <h3>Não foi possível enviar seu feedback...</h3>

                            <p>Sentimos muito pelo transtorno. Por favor, tente novamente.</p>
                        </div>
                        
                    HTML;

                } else {
                    echo <<<HTML
                        <div class="msg-container">
                            <i class="fas fa-check icone-sucesso"></i>
                            <h3>Agradecemos a sua ajuda!</h3>
                            <p>Seu feedback acabou de ser enviado.</p>
                        </div>
                    HTML;
                }

                echo "<div class='links'>";
                    echo '<a href="'.INCLUDE_PATH.'home"><i class="fas fa-arrow-left"></i> Voltar para a home</a>';
                    echo '<a href="'.INCLUDE_PATH.'area_de_questoes">Área de questões <i class="fas fa-arrow-right"></i></a>';
                echo "</div>";
            ?>
        </div>
    </section>
</main>
