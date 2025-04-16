<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio Fácil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"><!-- css bootstrap -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- barra de navegação -->
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand">
                <h3>Câmbio Fácil</h3>
            </a>
        </div>
    </nav>

    <!-- Conteudo principal -->
    <main class="container-fluid bg-success-subtle" style="height: 89vh">
        <!-- linha com o tamanho total do main     -->
        <div class="row h-100">
            <div class="col-10 d-flex align-items-center">
                <div class="card bg-light w-100 py-3 ms-5">
                    <p class="fs-2 mx-5">
                        <i class="bi bi-currency-exchange"></i> Conversor de moedas
                    </p>
                    <div class="d-inline-flex mx-5 gap-3">

                        <div class="input-group shadow-sm">

                            <form class="form-floating w-50">
                                <input id="floatingInputDe" min="0" value='1,00' inputmode="decimal"
                                    class="form-control fs-4 border border-secondary border-end-0">
                                <label for="floatingInputDe">De</label>
                            </form>

                            <select id="select-1"
                                class="form-select form-select-lg border border-secondary border-start-0">
                                <option value="USD">USD</option>
                                <option value="BRL">BRL</option>
                                <option value="EUR">EUR</option>
                            </select>
                        </div>

                        <button type="button" id="btn-mudar-select"
                            class="btn btn-lg btn-success">
                            <i class="bi bi-arrow-left-right"></i>
                        </button>

                        <div class="input-group shadow-sm">

                            <form class="form-floating w-50">
                                <input type="number" id="floatingInputPara" min="0" readonly
                                    class="form-control fs-4 border border-secondary border-end-0">
                                <label for="floatingInputPara">Para</label>
                            </form>

                            <select id="select-2"
                                class="form-select form-select-lg border border-secondary border-start-0">
                                <option value="USD">USD</option>
                                <option value="BRL">BRL</option>
                                <option value="EUR">EUR</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-2 pe-0">
                <div class="card bg-secondary-subtle h-100 rounded-0"></div>

            </div>
        </div>
    </main>

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