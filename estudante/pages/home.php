<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
</head>

<div class="box-content">
    <div class="welcome">
        <i class="fa-duotone fa-circle-check check"></i>

        <h2 class="welcome">Seja bem-vindo(a), <br> <span class="nome"><?php echo $user[0][0]?>!</span></h2>
    </div>

    <div class="resumo">
        <div class="totalquestoes banner2">
            <i class="fa-regular fa-crown icon"></i>

            <div class="content">
                 <!--PEGANDO O TOTAL DE QUESTÕES FEITAS-->
                <?php
                    $total = 0;
                    $materias = Adm::getSubject();

                    foreach ($materias as $key => $materia) {
                        $result = User::resolvedQuestionTheme($materia['id'], $_SESSION['id_usuario']);

                        if(count($result) > 0) {
                            foreach ($result as $key => $tema) {
                                $total = $total + $tema['qtd'];
                            }
                        }
                    }

                    if ($total == 0) {
                        echo '<h4>Nenhuma questão feita ainda...</h4>';
                    } else {
                        echo '<h4>Questões feitas até agora: </h4>';
                        echo '<p class="qtd">' . $total . '</p>';
                    }
                ?>
            </div>
        </div>

        <div class="sugestoes">
            <h3 class="cabecalho"><i class="fa-duotone fa-sparkles"></i> Sugestões</h3>
            
            <div class="banner roxo">
                <i class="fa-duotone fa-pencil icon"></i>

                <div class="content">
                    <h4>Resolva uma questão</h4>

                    <p>Acesse a área de questões para resolver novas questões. </p>

                    <a href="<?php echo INCLUDE_PATH; ?>area_de_questoes" class="botaotofill-branco botao">Área de questões <i class="fa-regular fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="banner azul">
                <i class="fa-duotone fa-megaphone icon"></i>

                <div class="content">
                    <h4>Dê sua opinião</h4>
                    
                    <p>Comente o que está achando do site até agora. A sua opinião é importante para o melhoramento do site!</p>

                    <a href="../<?php INCLUDE_PATH; ?>feedback" class="botaotofill-branco botao">Feedback <i class="fa-regular fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>