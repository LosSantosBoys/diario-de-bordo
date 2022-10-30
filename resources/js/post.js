moment.locale('pt-BR');

document.getElementsByName('data-publicacao').forEach(function(element, idx) {
    element.innerText = moment(element.innerText).calendar();
});