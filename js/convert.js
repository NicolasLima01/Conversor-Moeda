// Criando objeto do Modal

const modalAviso = new bootstrap.Modal(document.getElementById('warning-modal'), focus);

//buscando parametros pela url
const params = new URLSearchParams(window.location.search);

let input1 = document.getElementById('input-1');

//ocorre se não houver parametros na url
if (params.size != 0) {
    //recebendo parametros
    const from = params.get('from'); //parametro from
    const to = params.get('to'); //parametro to

    //modificando valores dos selects de acordos com o valor dos selects
    document.getElementById('select-1').value = from;
    document.getElementById('select-2').value = to;
}

// Funcao para pegar uma opção aleatoria do select
function getRndOption(min, max, opcaoEscolhida) {
    let opcaoAleatoria = Math.floor(Math.random() * (max - min)) + min;
    if (opcaoAleatoria === min && opcaoAleatoria === opcaoEscolhida) {
        opcaoAleatoria = opcaoEscolhida + 1;
        return opcaoAleatoria;
    }
    else if (opcaoAleatoria === max - 1 && opcaoAleatoria === opcaoEscolhida) {
        opcaoAleatoria = opcaoEscolhida - 1;
        return opcaoAleatoria;
    }
    else if (opcaoAleatoria === opcaoEscolhida) {
        opcaoAleatoria = opcaoEscolhida + 1;
        return opcaoAleatoria;
    }
    else {
        return opcaoAleatoria;
    }
}

// Botão de trocar moedas

let btnMudaSelect = document.getElementById('btn-mudar-select');
btnMudaSelect.addEventListener('click', function () {
    let Select1 = document.getElementById('select-1');
    let Select2 = document.getElementById('select-2');

    // RECEBENDO INDICES DOS SELECTS
    let indiceSlt1 = Select1.options[Select1.selectedIndex].index;
    let indiceSlt2 = Select2.options[Select2.selectedIndex].index;

    // RECEBENDO VALORES DOS SELECTS
    let valorSlt1 = Select1.options[Select1.selectedIndex].value;
    let valorSlt2 = Select2.options[Select2.selectedIndex].value;

    if (indiceSlt1 != indiceSlt2) {
        // MUDANDO INDICES DOS SELECTS
        Select1.selectedIndex = indiceSlt2;
        Select2.selectedIndex = indiceSlt1;
        // mudando parametros da url
        window.open('./index.php?from=' + valorSlt2 + '&to=' + valorSlt1, '_self');
    } else {
        modalAviso.show();
    }
});

// Detectando indices dos selects e impedindo moedas iguais

let Select1 = document.getElementById('select-1');
let Select2 = document.getElementById('select-2');

// Caso ocorra no primeiro select
Select1.addEventListener('change', function () {
    //RECEBENDO INDICES DOS SELECTS
    indiceSelect1 = Select1.options[Select1.selectedIndex].index;
    indiceSelect2 = Select2.options[Select2.selectedIndex].index;

    // RECEBENDO VALORES DOS SELECTS
    let valorSlt1 = Select1.options[Select1.selectedIndex].value;
    let valorSlt2 = Select2.options[Select2.selectedIndex].value;

    //ocorre se as opções forem iguais
    if (indiceSelect1 === indiceSelect2) {
        modalAviso.show(); //aviso de erro

        //Ocorre se houver parametros na url
        if (params.size > 0) {
            Select1.value = from; //recebendo valor da url
            console.log("1");
        }

        //Ocorre se não houver parametros na url
        else {
            Select1.value = "USD";
            console.log("2")
        }
    }

    //ocorre se as opções forem diferentes
    else {
        // mudando parametros da url
        window.open('./index.php?from=' + valorSlt1 + '&to=' + valorSlt2, '_self');
    }
});

// Caso ocorra no segundo select
Select2.addEventListener('change', function () {
    //RECEBENDO INDICES DOS SELECTS
    indiceSelect1 = Select1.options[Select1.selectedIndex].index;
    indiceSelect2 = Select2.options[Select2.selectedIndex].index;

    // RECEBENDO VALORES DOS SELECTS
    let valorSlt1 = Select1.options[Select1.selectedIndex].value;
    let valorSlt2 = Select2.options[Select2.selectedIndex].value;

    //ocorre se as opções forem iguais
    if (indiceSelect1 === indiceSelect2) {
        modalAviso.show(); //aviso de erro

        //Ocorre se houver parametros na url
        if (params.size > 0) {
            Select2.value = to; //recebendo valor da url
        }

        //Ocorre se não houver parametros na url
        else {
            Select2.value = "BRL";
        }
    }

    //ocorre se as opções forem diferentes
    else {
        // mudando parametros da url
        window.open('./index.php?from=' + valorSlt1 + '&to=' + valorSlt2, '_self');
    }
});