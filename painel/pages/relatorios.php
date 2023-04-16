<?php

    $dados = array();

    $urlGrafic1 = Relatorios::qtdQuestVest($materia);
    $urlGrafic2 = Relatorios::questPTema($materia);
    $urlGrafic3 = Relatorios::totalDissertObj($materia);
    $urlGrafic4 = Relatorios::acertTotal($materia);

    foreach (Relatorios::acertPTema($materia) as $key => $value) {

        if($value[1] == 's')
            $acert = 'Acertos';
        else
            $acert = 'Erros';

        $dados[$value[0]."_"."$acert"] = $value[2];
    }

?>

<div class="box-content box-graficos">
    <h1>Relatórios da sua matéria</h1>

    <p class="aviso">Para desabilitar um dado, clique no seu nome disponível na legenda do gráfico.</p>

    <div class="graficos">
        <div class="element">
            <h4>Questões cadastradas p/ vestibular</h4>

            <canvas id="questoes-vestibular"></canvas>
        </div>

        <div class="element">
            <h4>Questões cadastradas p/ tema</h4>
            
            <canvas id="questoes-tema"></canvas>
        </div>
        <div class="element">
            <h4>Total de questões objetivas e dissertativas</h4>

            <canvas id="total-obj-dis"></canvas>
        </div>

        <div class="element">
            <h4>Acertos e erros de questões objetivas</h4>

            <canvas id="acertos-erros"></canvas>
        </div>
    </div>
</div>

<div class="box-content">
    <h4>Acertos e erros de questões objetivas p/ tema: </h4>
    
    <table>
        <tr>
            <th>Tema</th>
            <th>Acertos</th>
            <th>Erros</th>
        </tr>

        <?php   
        
            $cont = 1;
            $acertos = 0;
            $totalAcertos = 0;
            $totalErros = 0;

            foreach ($dados as $key => $value) { 
                $interm = explode("_", $key);
                $tema = $interm[0];
                $typeAcert = $interm[1];

                if($cont == 1 and $typeAcert == "Acertos"){
                    $acertos = $value;
                    $cont--;
                    continue;
                }
                else{
                    $cont = 1;
                }
                
        ?>

        <tr>
            <td><?php echo $tema; ?></td>
            <td><?php echo $acertos; ?></td>
            <td><?php echo $value; ?></td>
        </tr>

        <?php 
                
                $totalAcertos = $totalAcertos + $acertos;
                $totalErros = $totalErros + $value;
                $acertos = 0;
            }  
        ?>

        <tr>
            <th>Total</th>
            <th><?php echo $totalAcertos; ?></th>
            <th><?php echo $totalErros; ?></th>
        </tr>

    </table>

    <div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js" integrity="sha512-v3ygConQmvH0QehvQa6gSvTE2VdBZ6wkLOlmK7Mcy2mZ0ZF9saNbbk19QeaoTHdWIEiTlWmrwAL4hS8ElnGFbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const dados = <?php 
            $acertosTotais = Relatorios::acertTotal($materia);

            $questPTema = Relatorios::questPTema($materia);

            $questDissertObj = Relatorios::totalDissertObj($materia);

            $qtdQuestVest = Relatorios::qtdQuestVest($materia);

            echo json_encode([
                "acertosTotais" => $acertosTotais,
                "questaoPorTema" => $questPTema,
                "questDissertObj" => $questDissertObj, 
                "qtdQuestVest" => $qtdQuestVest,
            ]);
        ?>;
        
        console.log(dados);

        new Chart(document.getElementById('acertos-erros'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(dados.acertosTotais),
                datasets: [{
                    label: ' ',
                    data: Object.values(dados.acertosTotais),
                    borderWidth: 3
                }]
            }
        });

        new Chart(document.getElementById('questoes-tema'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(dados.questaoPorTema),
                datasets: [{
                    label: ' ',
                    data: Object.values(dados.questaoPorTema),
                    borderWidth: 3
                }]
            }
        });
        
        new Chart(document.getElementById('total-obj-dis'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(dados.questDissertObj),
                datasets: [{
                    label: ' ',
                    data: Object.values(dados.questDissertObj),
                    borderWidth: 3
                }]
            }
        });

        new Chart(document.getElementById('questoes-vestibular'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(dados.qtdQuestVest),
                datasets: [{
                    label: ' ',
                    data: Object.values(dados.qtdQuestVest),
                    borderWidth: 3
                }]
            }
        });
    </script>
</div>