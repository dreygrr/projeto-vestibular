<div class="box-content">
    <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout" class="deslogar">Sair <i class="fa-duotone fa-arrow-right-from-bracket"></i></a>

    <div class="perfil">
        <i class="fa-duotone fa-user"></i>

        <div class="user-name">
            <h2><?php echo $user[0][0] ?></h2>

            <p class="nivel">Estudante</p>
        </div>
    </div>

    <div class="sobre">
        <h4><a href='<?php echo INCLUDE_PATH_ESTUDANTE;?>alterar_dados'><i class="fa-regular fa-pen"></i></a> Meus dados: </h4>

        <ul>
            <?php
                $data_aniverario = new DateTime($user[0][2]);

                echo "<li><b>Nome:</b> ".$user[0][0]."</li>";
                echo "<li><b>E-mail:</b> ".$user[0][1]."</li>";
                echo "<li><b>Data de Nascimento:</b> ".$data_aniverario->format("d/m/Y")."</li>";
                echo "<li><b>Rede:</b> ".$user[0][3]."</li>";
                echo "<li><b>Escolaridade:</b> ".$user[0][4]."</li>";
            ?>
        </ul>
    </div>

    <div class="direcoes">
        <h4><i class="fa-regular fa-arrow-right"></i> Atalhos</h4>

        <a class="botaotofill-azul botao" href="<?php echo INCLUDE_PATH;?>area_de_questoes" class="link">Resolver questões <i class="fas fa-arrow-right"></i></a>
    </div>
</div>
