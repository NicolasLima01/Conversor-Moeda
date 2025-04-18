<?php
require "class/API.php";

# Moedas
$currency = 0;

if (isset($_GET['from']) && isset($_GET['to'])) {
    $currency = $_GET['from'] . "_" . $_GET['to'];
} else {
    $currency = "USD_BRL";
}

# Valor
if (isset($_GET['amount'])) {
    $amount = $_GET['amount'];
} else {
    $amount = 1;
}

$resposta = API::Request($currency);

//arrendonda o valor com precisão de dois zeros
$cotacao = round($resposta[$currency]["price"], 2);


// definindo zona de tempo.
date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titulo da página -->
    <title>
        <?php
        $moedas = explode("_", $currency); //separando as moedas
        echo ("Converter " . $moedas[0] . " para " . $moedas[1]);
        ?>
    </title>
    <link rel="shortcut icon" href="images/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css"><!-- css bootstrap -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

    <?php require 'menu.php'; ?>

    <!-- Conteudo principal -->
    <main class="container-fluid bg-success-subtle vh-100">

        <!-- linha com a altura total do main -->
        <div class="row h-100">

            <!-- coluna centralizada verticalmente e alinhado no fim horizontalmente -->
            <div class="col-xs-11 offset-xs-0 col-sm-10 col-md-9 offset-md-1
            d-flex align-items-center justify-content-center mb-5">

                <!-- Card -->
                <div class="card bg-light border-secondary mt-0 w-100 mb-5">

                    <!-- Titulo do card -->
                    <div class="card-header bg-light-subtle shadow-sm text-center">
                        <!-- Usando fonte externa -->
                        <h1 class="exo-2 text-success-emphasis">
                            <?php
                            $moedas = explode("_", $currency); //separando as moedas
                            echo ("Converter " . $moedas[0] . " para " . $moedas[1]);
                            ?>
                        </h1>
                    </div>

                    <!-- Conteudo do card -->
                    <div class="card-body px-3">
                        <div class="d-flex justify-content-between flex-wrap flex-sm-nowrap flex-md-nowrap gap-3">
                            
                        <!-- Moeda 1 -->
                            <div class="input-group shadow-sm flex-fill">

                                <!-- input 1 -->
                                <form class="form-floating w-25">
                                    <input class="form-control form-control-lg fs-4 border border-secondary border-end-0"
                                    id="input-1" min="0" inputmode="decimal" autocomplete="off" value="<?php 
                                    //muda o ponto para virgula
                                    echo str_replace('.', ',', $amount);?>">
                                    <label for="input-1">De</label>
                                </form>
                                <!-- Select 1 -->
                                <select id="select-1"
                                    class="form-select form-select-lg border border-secondary border-start-0">
                                    <option selected value="USD">USD - Dólar Americano</option>
                                    <option value="BRL">BRL - Real Brasileiro</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="GBP">GBP - Libra Esterlina</option>
                                    <option value="ARS">ARS - Peso Argentino</option>
                                    <option value="KRW">KRW - Won Sul-Koreano</option>
                                    <option value="JPY">JPY - Ieni Japonês</option>
                                    <option value="CNY">CNY - Yuan Chinês</option>
                                    <option value="AUD">AUD - Dólar Australiano</option>
                                    <option value="CAD">CAD - Dólar Canadense</option>
                                    <option value="INR">INR - Rúpia Indiana</option>
                                    <option value="RUB">RUB - Rublo Russo</option>
                                </select>
                            </div>

                            <!--Botão Troca Moeda -->
                            <button type="button" id="btn-mudar-select"
                                class="btn btn-lg btn-success mx-auto w-10 my-0">
                                <i class="bi bi-arrow-left-right"></i>
                            </button>

                            <!-- Moeda 2 -->
                            <div class="input-group shadow-sm flex-fill">

                                <!-- input 1 -->

                                <form class="form-floating w-25">
                                    <input type="number" id="floatingInputPara" min="0" autocomplete="off" readonly
                                        value="<?php echo $amount * $cotacao ?>"
                                        class="form-control form-control-lg fs-4 border border-secondary border-end-0">
                                    <label for="floatingInputPara">Para</label>
                                </form>

                                <!-- Select 2 -->
                                <select id="select-2"
                                    class="form-select form-select-lg border border-secondary border-start-0 text-start">
                                    <option value="USD">USD - Dólar Americano</option>
                                    <option selected value="BRL">BRL - Real Brasileiro</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="GBP">GBP - Libra Esterlina</option>
                                    <option value="ARS">ARS - Peso Argentino</option>
                                    <option value="KRW">KRW - Won Sul-Koreano</option>
                                    <option value="JPY">JPY - Ieni Japonês</option>
                                    <option value="CNY">CNY - Yuan Chinês</option>
                                    <option value="AUD">AUD - Dólar Australiano</option>
                                    <option value="CAD">CAD - Dólar Canadense</option>
                                    <option value="INR">INR - Rúpia Indiana</option>
                                    <option value="RUB">RUB - Rublo Russo</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">

                            <!-- valor unitario do cambio -->
                            <p class="lead my-2">
                                <?php
                                //Ocorre se houver dados na url
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    $from = $_GET['from'];
                                    $to = $_GET['to'];
                                    $valorArredondado = round($resposta[$currency]["price"], 4);
                                    echo ('1 ' . $from . ' = ' . str_replace('.', ',', $valorArredondado). ' ' . $to);
                                }
                                // ocorre se não houver dados na url
                                else {
                                    $valorArredondado = round($resposta[$currency]["price"], 4);
                                    echo ('1 USD = ' . str_replace('.', ',', $valorArredondado). ' BRL');
                                }
                                ?>
                            </p>

                            <!-- Ultima atualização do Cambio -->
                            <p>
                                <small>
                                    <?php
                                    $dataAtualizacao = date('d/m/Y H:i:s', $resposta[$currency]["timestamp"]);
                                    echo "Última Atualização: " . $dataAtualizacao;
                                    ?>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Fim do Card -->

            </div>

            <!-- segunda coluna -->
            <div class="col-xs-1 col-sm-2 col-md-2 px-0">
                <div class="card bg-secondary-subtle h-100 rounded-0"></div>
            </div>

        </div>
    </main>

    <!-- Rodapé -->
    <?php require 'rodape.php'; ?>

</body>

<!-- Modal de Aviso -->
<div id="warning-modal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Erro!</h4>
            </div>
            <div class="modal-body">
                <p>As moedas não podem ser iguais! Escolha uma diferente.</p>
                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="js/bootstrap.min.js"></script>

<script src="js/convert.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</html>