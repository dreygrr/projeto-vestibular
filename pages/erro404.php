<?php 
    include_once("../config.php");
?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <title>Projeto Vestibular</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <meta name="description" content="Descrição do meu website">
    <meta name="keywords" content="palavbra-chave, do meu, site">

    <!--ICONE DA PAGINA-->
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>public/images/favicon.ico" type="image/x-icon">

    <!-- CSS PRINCIPAL -->
    <link href="../public/css/main.css" rel="stylesheet">

    <!-- CSS DA PAGINA DE ERRO -->
    <link href="../public/css/page_erro404.css" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="erro bloco">
            <p>Erro 404</p>
        </div>

        <div class="titulo bloco">
            <i class="fa-solid fa-circle-exclamation icone"></i>
            
            <h1>Ops! Página não encontrada</h1>
        </div>
        
        <div class="voltar bloco">
            <p>Desculpe-nos o transtorno. Tente <b><a href="<?php echo INCLUDE_PATH; ?>" >voltar para a Página Inicial</b></a></p>
        </div>
    </div>
    
    <!-- <section class="erro404">
        <div class="center">

            

        </div>
    </section> -->
</body>
</html>