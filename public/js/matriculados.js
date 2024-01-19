$(document).ready(function() {


});

$('#modal-matriculados').on('show.bs.modal', function (event) {
    //alert('hola');
    //event.preventDefault();
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extract info from data-* attributes
    var nombre = button.data('nombre');
    //var modalObj = $(this).data('whatever');
    $("#idCursoMat").val(id);
    console.log(id);
});