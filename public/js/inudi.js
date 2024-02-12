$(document).ready(function() {
    var modalInscripcion = $('#modal-inscripcion');
    //loadDepartamento(document.getElementById('idPais'));
    //loadProvincia(document.getElementById('idDepartamento'));
    //loadDistrito(document.getElementById('idProvincia'));

    $('.modalInscripcion').click(function(e) {
        //alert('hola');
        var modalObj = $(this).data('whatever');
        var modal = $('.modal-title');
        $('.modal-title').text('Inscripción para el curso Nro: ' + modalObj);
        $("#idCurso").val(modalObj);
        $("#dniVerificar").focus();
    });


});


function loadDepartamento(paisSelect) {
    console.log(paisSelect.value);
    let paisId = paisSelect.value;
    fetch(`${paisId}/departamento`)
        .then(function(response) {
            return response.json();
        })
        .then(function(jsonData) {
            //buildDepartamento(jsonData);
            var data = JSON.stringify(jsonData);
            data = JSON.parse(data);
            console.log(data);
            buildDepartamento(data);
        })
    
}

function buildDepartamento(data){
    let departamentoSelect = document.getElementById('idDepartamento');
    departamentoSelect.innerHTML = '';
    let option = document.createElement('option'); 
    option.value = '';
    option.text = 'Seleccione un departamento';
    departamentoSelect.appendChild(option);
    data.forEach(element => {
        let option = document.createElement('option'); 
        option.value = element.id;
        option.text = element.nombreDepartamento;
        departamentoSelect.appendChild(option);
    });
    
    let provinciaSelect = document.getElementById('idProvincia');
    provinciaSelect.innerHTML = '';
}

function loadProvincia(departamentoSelect) {
    console.log(departamentoSelect.value);
    let departamentoId = departamentoSelect.value;
    
    fetch(`${departamentoId}/provincia`)
        .then(function(response) {
            return response.json();
        })
        .then(function(jsonData) {
            //buildDepartamento(jsonData);
            var data = JSON.stringify(jsonData);
            data = JSON.parse(data);
            console.log(data);
            buildProvincia(data);
        })
}

function buildProvincia(data){
    let provinciaSelect = document.getElementById('idProvincia');
    provinciaSelect.innerHTML = '';
    let option = document.createElement('option'); 
    option.value = '';
    option.text = 'Seleccione una provincia';
    provinciaSelect.appendChild(option);
    data.forEach(element => {
        let option = document.createElement('option'); 
        option.value = element.id;
        option.text = element.nombreProvincia;
        provinciaSelect.appendChild(option);
    });
    
}
function loadDistrito(provinciaSelect) {
    let provinciaId = provinciaSelect.value;
    fetch(`${provinciaId}/distrito`)
        .then(function(response) {
            return response.json();
        })
        .then(function(jsonData) {
            //buildDepartamento(jsonData);
            var data = JSON.stringify(jsonData);
            data = JSON.parse(data);
            console.log(data);
            buildDistrito(data);
        })
}
function buildDistrito(data){
    let distritoSelect = document.getElementById('idDistrito');
    distritoSelect.innerHTML = '';
    let option = document.createElement('option'); 
    option.value = '';
    option.text = 'Seleccione un distrito';
    distritoSelect.appendChild(option);
    data.forEach(element => {
        let option = document.createElement('option'); 
        option.value = element.id;
        option.text = element.nombreDistrito;
        distritoSelect.appendChild(option);
    });
    
}