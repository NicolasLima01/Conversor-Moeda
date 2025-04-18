// Halibilitando tooltip
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));


// Criando objeto do Modal
const modalAviso = new bootstrap.Modal(document.getElementById('warning-modal'), focus);


//buscando parametros pela url
let params = new URLSearchParams(window.location.search);

//ocorre se não houver parametros na url
if (params.size > 1) {
    //recebendo parametros
    const from = params.get('from'); //parametro from
    const to = params.get('to'); //parametro to

    //modificando valores dos selects de acordos com o valor dos selects
    document.getElementById('select-1').value = from;
    document.getElementById('select-2').value = to;
}
else {
    document.getElementById('select-1').value = 'USD';
    document.getElementById('select-2').value = "BRL";
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


let Select1 = document.getElementById('select-1');
let Select2 = document.getElementById('select-2');

// Botão de trocar moedas

let btnMudaSelect = document.getElementById('btn-mudar-select');
btnMudaSelect.addEventListener('click', function () {

    // RECEBENDO INDICES DOS SELECTS
    let indiceSlt1 = Select1.options[Select1.selectedIndex].index;
    let indiceSlt2 = Select2.options[Select2.selectedIndex].index;

    // RECEBENDO VALORES DOS SELECTS
    let valorSlt1 = Select1.options[Select1.selectedIndex].value;
    let valorSlt2 = Select2.options[Select2.selectedIndex].value;

    if (indiceSlt1 != indiceSlt2) {
        // mudando parametros da url
        params.set("from", valorSlt2);
        params.set("to", valorSlt1);
        let updatedUrl = window.location.origin + window.location.pathname + "?" + params.toString();
        window.open(updatedUrl, '_self')
    } else {
        modalAviso.show();
    }
});

// Detectando indices dos selects e impedindo moedas iguais

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
        if (params.size > 1) {
            const from = params.get('from'); //parametro from
            Select1.value = from; //recebendo valor da url
        }

        //Ocorre se não houver parametros na url
        else {
            Select1.value = "USD";
        }
    }

    //ocorre se as opções forem diferentes
    else {
        // mudando parametros da url
        params.set("from", valorSlt1);
        params.set("to", valorSlt2);
        let updatedUrl = window.location.origin + window.location.pathname + "?" + params.toString();
        window.open(updatedUrl, '_self');
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
        if (params.size > 1) {
            //recebendo parametros
            const to = params.get('to'); //parametro to
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
        params.set("from", valorSlt1);
        params.set("to", valorSlt2);
        let updatedUrl = window.location.origin + window.location.pathname + "?" + params.toString();
        window.open(updatedUrl, '_self');
    }
});

// Adicionando parametro amount na url caso ocorra mudança no input 1
let input1 = document.getElementById('input-1');
input1.addEventListener("change", function () {
    let valorInput = input1.value
    //ocorre se houver uma vírgula
    if (valorInput.indexOf(",") > 0) {
        valorInput = valorInput.replace(',', '.'); //Muda a vírgula para ponto
    }
    valorInput = valorInput.trim().replace(/\s+/g, ''); // Remove espaços no início,meio e fim
    params.set("amount", valorInput);
    let updatedUrl = window.location.origin + window.location.pathname + "?" + params.toString();
    window.open(updatedUrl, '_self');
});

// Ocorre quanto o usuario aperta alguma tecla no input
input1.addEventListener("keypress", function Enter(event) {
    //Ocorre se a tecla for Enter
    if (event.key === "Enter") {
        // Cancela o recarregamento da página após o enter
        event.preventDefault();
        let valorInput = input1.value
        //ocorre se houver uma vírgula
        if (valorInput.indexOf(",") > 0) {
            valorInput = valorInput.replace(',', '.'); //Muda a vírgula para ponto
        }
        // valorInput = valorInput.trim(); //retirando espaços no inicio e fim da string
        valorInput = valorInput.replace(/\s+/g, ''); // Remove todos os espaços
        params.set("amount", valorInput);
        let updatedUrl = window.location.origin + window.location.pathname + "?" + params.toString();
        window.open(updatedUrl, '_self');
    }
});