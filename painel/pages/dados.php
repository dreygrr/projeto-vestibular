<?php 
header('Content-Type: application/json; charset=utf-8');

$acertosTotais = Relatorios::acertTotal($materia);

$questPTema = Relatorios::questPTema($materia);

$questDissertObj = Relatorios::totalDissertObj($materia);


echo "\"";
echo json_encode([
    "acertoTotal" => $acertosTotais,
    "questaoPorTema" => $questPTema,
    "questDisserObj" => $questDissertObj
]);

echo "\"";
