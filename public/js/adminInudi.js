$(document).ready(function() {
    $('#tablaUsuarios').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
            "decimal": ",",
            "thousands": "."
        },
        "order": [[ 0, "desc" ]],
        "columnDefs": [
            { "orderable": false, "targets": 4 }
        ]
    });

});