<?php
// ==========================================
// PARTE 1: PROGRAMAÇÃO ESTRUTURADA
// ==========================================

// Dados do primeiro cachorro!
$nome_cachorro_1 = "Nelson";
$comida_cachorro_1 = 3;
$sono_cachorro_1 = false;

// Dados do segundo cachorro!
$nome_cachorro_2 = "Jeremias";
$comida_cachorro_2 = 1;
$sono_cachorro_2 = true;

// Funções para manipular os dados dos cachorros!
function comer($quantidade_comida) {
    return $quantidade_comida - 1;
}

function dormir () {
    return true;
}

// Usando as funções (comer e dormir)!
$comida_cachorro_1 = comer($comida_cachorro_1);
$sono_cachorro_2 = dormir();

// Trocar todas as " por ' para não dar erro dentro do php/python
echo "<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Resultado dos auau's!</title>
</head>
    
<body>
    <h1>Resultado dos auau's!</h1>
    <p><strong>$nome_cachorro_1</strong> agora tem <strong>$comida_cachorro_1</strong> unidades de comidas</p>
    <p><strong>$nome_cachorro_2</strong> está com sono? <strong>" . ($sono_cachorro_2 ? 'Sim' : 'Não') . "</strong></p>
</body>
</html>";
?>