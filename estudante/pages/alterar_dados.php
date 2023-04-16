<head>
    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
</head>

<div class="box-content">
    <?php

        $redes = User::selectTypeNetwork();
        $escolaridades = User::selectSchooling();

        $ano_max = date('Y') - 7;

        if(isset($_POST["submit"])) {
            if(!empty($_POST["nome"]) or !empty($_POST["aniver"]) or !empty($_POST["escolar"]) or !empty($_POST["rede"])){

                if(!empty($_POST["nome"]))
                    $nome = $_POST["nome"];
                else
                    $nome = $user[0][0];

                if(!empty($_POST["aniver"]))
                    $aniver = $_POST["aniver"];
                else
                    $aniver = $user[0][2];

                if(!empty($_POST["rede"]))
                    $rede = $_POST["rede"];
                else
                    $rede = $user[0][5];

                if(!empty($_POST["escolar"]))
                    $escolar = $_POST["escolar"];
                else
                    $escolar = $user[0][6];

                $result = User::changePersonalData($user[0]['email'], $nome, $aniver, $escolar, $rede);
                
                if($result == 1){

                    echo"<div class='mensagem green'>Dados alterados com sucesso! Novos dados:";

                    if(!empty($_POST["nome"]))
                        echo "<br>Nome: ".$_POST["nome"];

                    if(!empty($_POST["aniver"])){
                        $data_aniverario = new DateTime($_POST["aniver"]);
                        echo "<br>Data de aniversário: ".$data_aniverario->format("d/m/Y");
                    }

                    if(!empty($_POST["rede"]))
                        echo "<br>Rede escolar: ".$_POST["rede"];

                    if(!empty($_POST["escolar"]))
                        echo "<br>Escolaridade: ".$_POST["escolar"];

                    echo"</div>";
                }
                else
                    echo "<div class='msg-cinza'>Nenhum dado foi alterado</div>";
            }
        }
    ?>

    <h3 class="titulo">Alterar informações pessoais</h3>
        
    <!-- <p>
        <?php
            foreach ($user[0] as $key => $value) {
                echo "$key $value" . "<br>";
            }
        ?>
    </p> -->

    <p class="aviso">Caso não queira alterar alguma informação, deixe-a em branco.</p>

    <form action="<?php echo INCLUDE_PATH_ESTUDANTE; ?>alterar_dados" method="POST">

        <div class="text-box">
            <label for="nome">Novo nome</label>
            <input type="text" name="nome" id="nome" class="informacoes" placeholder="Nome" maxlength="50">
        </div>
        <div class="text-box">
            <label for="nasc">Nova data de nascimento</label>
            <input type="date" name="aniver" id="nasc" class="informacoes" max="<?php echo $ano_max."-".date('m')."-".date('d') ?>">
        </div>
        <div class="text-box">
            <label for="escolar">Nova escolaridade</label>
            <select id="escolar" name="escolar">
                <option default value="">Escolaridade</option>
                <?php  

                    foreach ($escolaridades as $key => $escolaridade)
                        echo"<option value='".$escolaridade['id']."'>".$escolaridade['descricao']."</option>";
                ?>
            </select>
        </div>
        <div class="text-box">
            <label for="rede">Nova rede da sua escola</label>
            <select id="rede" name="rede">
                <option default value="">Rede</option>
                <?php  

                    foreach ($redes as $key => $rede)
                        echo"<option value='".$rede['id']."'>".$rede['descricao']."</option>";
                ?>
            </select>
        </div>

        <button class="botaofilled-azul" type="submit" name="submit" value="person">Alterar informações pessoais</button>
    </form>
</div>

<script>
    const inputs = document.querySelectorAll('input:not(button) ');
    const selects = document.querySelectorAll('select');

    inputs.forEach(input => input.onchange = ev => {
        if (input.value) input.classList.toggle('active');
        else input.classList.toggle('active');
    });
    
    selects.forEach(select => select.onchange = ev => {
        if (!select[select.selectedIndex].value) select.classList.toggle('active');
        else select.classList.toggle('active');
    });
    
</script>