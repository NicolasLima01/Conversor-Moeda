<?php
require "class/API.php";

# Moedas
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

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio Fácil - Conversor de Moedas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"><!-- css bootstrap -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require 'menu.php'; ?>

    <!-- Conteudo principal -->
    <main class="container-fluid bg-whitw" style="height: 80vh;">
        <!-- linha com o tamanho total do main -->
        <div class="row h-100">
            <div class="col-offset-2 col-8 d-flex align-items-center justify-content-end pe-0">
                <div class="card w-100 mb-5 m">

                    <div class="card-header px-3">
                        <p class=" card-title fs-2">
                            <i class="bi bi-currency-exchange"></i> Conversor de moedas
                        </p>
                    </div>

                    <div class="card-body px-3">
                        <div class="d-inline-flex gap-3">

                            <!-- Moeda 1 -->
                            <div class="input-group shadow-sm">

                                <form class="form-floating w-50">
                                    <input id="input-1" min="0" inputmode="number" value="<?php echo $amount ?>"
                                        class="form-control form-control-lg fs-4 border border-secondary border-end-0">
                                    <label for="input-1">De</label>
                                </form>

                                <select id="select-1"
                                    class="form-select form-select-lg border border-secondary border-start-0">
                                    <option selected value="USD">USD </option>
                                    <option value="BRL">BRL</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>

                            <!--Botão Troca Moeda -->
                            <button type="button" id="btn-mudar-select"
                                class="btn btn-lg btn-success">
                                <i class="bi bi-arrow-left-right"></i>
                            </button>

                            <!-- Moeda 2 -->
                            <div class="input-group shadow-sm">

                                <form class="form-floating w-50">
                                    <input type="number" id="floatingInputPara" min="0" readonly
                                        value="<?php echo $amount * $cotacao ?>"
                                        class="form-control form-control-lg fs-4 border border-secondary border-end-0">
                                    <label for="floatingInputPara">Para</label>
                                </form>

                                <select id="select-2"
                                    class="form-select form-select-lg border border-secondary border-start-0">
                                    <option value="USD">USD</option>
                                    <option selected value="BRL">BRL</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>
                        </div>
                        <p class="fw-lighter my-2">
                            <?php
                            if (isset($_GET['from']) && isset($_GET['to'])) {
                                $from = $_GET['from'];
                                $to = $_GET['to'];
                                echo '1 ' . $from . ' = ' . 1 * round($resposta[$currency]["price"], 4) . ' ' . $to;
                            }
                            else{
                                echo '1 USD = ' . 1 * round($resposta[$currency]["price"], 3) . ' BRL';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class=" col-2 pe-0">
                <div class="card bg-secondary-subtle h-100 rounded-0"></div>
            </div>
        </div>
    </main>

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