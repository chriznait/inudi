$(document).ready(function() {

    $('.btnCertificado').click(function() {
        var id = $(this).data('id');
        $("#certificado option:selected").removeAttr("selected");
        console.log(id);
        $url = '../editCertificado/' + id;
        console.log($url);
        $.ajax({
            url: '/matriculados/editCertificado/' + id,
            type: 'GET',
            success: function(data) {
                console.log(data);
                $('#idRegistro').val(data.estudiante.id);
                $('#dni').val(data.persona.nroDocumento);
                $('#nota').val(data.estudiante.nota);
                if(data.estudiante.estado >=4){
                    $("#certificado option[value='1']").attr("selected", "selected");
                    
                }

            }
        });
    });



});

$('#generarCertificados').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extract info from data-* attributes
   $("#idCurso").val(id);
    //$("#idCursoMat").val(id);
    console.log(id);
});