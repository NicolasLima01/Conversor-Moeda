// Criando objeto do modal Modal

const modalAviso = new bootstrap.Modal(document.getElementById('warning-modal'), focus);

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
    else if (opcaoAleatoria === opcaoEscolhida){
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

    //RECEBENDO INDICES DOS SELECTS
    indiceSelect1 = Select1.options[Select1.selectedIndex].index;
    indiceSelect2 = Select2.options[Select2.selectedIndex].index;

    if (indiceSelect1 != indiceSelect2) {
        //MUDANDO INDICES DOS SELECTS
        Select1.selectedIndex = indiceSelect2;
        Select2.selectedIndex = indiceSelect1;
    }
    else {
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

    if (indiceSelect1 === indiceSelect2) {
        modalAviso.show()
        Select1.selectedIndex = getRndOption(0, Select1.length, indiceSelect1);
    }
})
// Caso ocorra no segundo select
Select2.addEventListener('change', function () {
    //RECEBENDO INDICES DOS SELECTS
    indiceSelect1 = Select1.options[Select1.selectedIndex].index;
    indiceSelect2 = Select2.options[Select2.selectedIndex].index;

    if (indiceSelect1 === indiceSelect2) {
        modalAviso.show()
        Select2.selectedIndex = getRndOption(0, Select2.length, indiceSelect2);
    }
})