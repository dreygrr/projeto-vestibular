<div class="box-content">
    <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout" class="deslogar">Sair <i class="fa-duotone fa-arrow-right-from-bracket"></i></a>

    <div class="perfil">
        <i class="fa-duotone fa-user-tie"></i>

        <div class="user-name">
            <h2><?php echo $_SESSION['nome_admin']; ?></h2>
            
            <p class="nivel"><?php echo Adm::getOffice($_SESSION['type_admin']); ?></p>
        </div>
    </div>

    <div class="sobre">
        <ul>
            <li><b>E-mail: </b><?php echo $_SESSION['email_admin']; ?></li>
            <li><b>Senha: </b><a href="<?php echo INCLUDE_PATH_PAINEL ?>Alterar-Senha" class="basic-link">[mudar senha]</a></li>
        </ul>
    </div>

    <div class="direcoes">
        <h4><i class="fa-regular fa-arrow-right"></i> Atalhos</h4>

        <div class="links">
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>Exibir-Questoes" class="botao botaotofill-roxo"><i class="fa-duotone fa-eye"></i> Visualizar questões</a>

            <a href="<?php echo INCLUDE_PATH_PAINEL ?>Cadastrar-Questao" class="botao botaotofill-azul"><i class="fa-duotone fa-pencil"></i> Cadastrar questão</a>
        </div>
    </div>
</div>