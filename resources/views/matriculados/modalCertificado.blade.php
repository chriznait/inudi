<div class="modal fade" id="modal-certificados" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Registro para generar certificado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="formGenerarCertificado" action="{{ route('matriculados.updateCertificado')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="idRegistro" id="idRegistro" value="">
                    </div>
                    <div class="col-sm-12">
                        <label for="">
                            Dni:
                        </label>
                        <input type="text" name="dni" id="dni" class="form-control" value='' disabled>
                    </div>
                    <div class="col-sm-12">
                        <label for="certificado">Generar Certificado:</label>
                        <select name="certificado" id="certificado" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label for="nota">Nota:</label>
                        <input type="text" name="nota" id="nota" class="form-control" value=''>
                    </div>
                    <hr>
                    <div class="col-sm-12">
                        <br>
                        <button type="submit" class="btn btn-primary float-right">Subir</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>