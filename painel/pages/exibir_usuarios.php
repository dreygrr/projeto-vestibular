<?php  

    $users = Painel::registeredUsers();

    $public = 0;
    $private = 0;

    $fund1 = 0;
    $fund2 = 0;
    $ensinoMedio = 0;
    $superior = 0;

    foreach ($users as $key => $value) {

        if($value['id_rede'] == 1)
            $public ++;
        else
            $private ++;

        switch ($value['id_escolaridade']) {
            case 1:
                $fund1++;
                break;
            case 2:
                $fund2++;
                break;
            case 3:
                $ensinoMedio++;
                break;
            case 4:
                $superior++;
                break;
        }
    }

?>

<div class="box-content">
    <h4>Usuários cadastrados no site: </h4>

    <div class="box-infs">
        <div class="box total">
            <h4>Alunos cadastrados: </h4>

            <div class="container">
                <p class="totalcad"><?php echo count($users); ?></p>
            </div>
        </div>

        <div class="box inst">
            <h4>Cadastros p/ instituição: </h4>

            <div class="container">
                
                <ul>
                    <li>Pública: <b><?php echo $public; ?></b></li>
                    <li>Privada: <b><?php echo $private; ?></b></li>
                </ul>
            </div>
        </div>

        <div class="box escol">
            <h4>Cadastros p/ escolaridade: </h4>
            
            <div class="container">
                <ul>
                    <li>Fundamental I: <b><?php echo $fund1; ?></b></li>
                    <li>Fundamental II: <b><?php echo $fund2; ?></b></li>
                    <li>Ensino Médio: <b><?php echo $ensinoMedio; ?></b></li>
                    <li>Superior: <b><?php echo $superior; ?></b></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="box-content">
    <h4>Tabela de usuários cadastrados: </h4>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Aniversário</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($users as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['nome']; ?></td>
                            <td><?php echo date('d/m/Y',strtotime($value['aniversario'])) ?></td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
