<!-- <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
</head> -->

<div class="box-content">
    <h3 class="titulo">Questões resolvidas por tema</h3>

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
    ?>
        <?php
            if ($total == 0) {
                echo '<p class="total" style="margin-bottom: 30px">';
                    echo '<i class="fa-light fa-bolt-slash"></i>';
                    echo 'Nenhuma questão feita ainda...';
                echo '</p>';
            } else {
                echo '<p class="total">';
                    echo '<i class="fa-light fa-bolt"></i>';
                    echo ' Total de questões feitas: ' . $total;
                echo '</p>';
            }
        ?>

    <div class="dados-questoes">
        <?php  
            $materias = Adm::getSubject();

            foreach ($materias as $key => $materia) {
                $result = User::resolvedQuestionTheme($materia['id'], $_SESSION['id_usuario']);

                if(count($result) > 0) {
                    echo "<div class='temas_p_materia'>";
                        echo "<h4>".$materia['nome']."</h4>";

                        echo "<ul>";
                            foreach ($result as $key => $tema) {
                                echo "<li class='temas'><b>".$tema['descricao'].":</b> ".$tema['qtd']."</li>";
                            }
                        echo "</ul>";
                    echo "</div>";
                }
            }
        ?>
    </div>

    <a class="botaotofill-azul botao" href="<?php echo INCLUDE_PATH;?>area_de_questoes" class="link">Resolver mais questões <i class="fas fa-arrow-right"></i></a>
</div>