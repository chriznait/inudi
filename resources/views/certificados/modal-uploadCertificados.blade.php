<div class="modal fade" id="modal-uploadCertificados" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Subir Certificado con Firma Digial</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form enctype="multipart/form-data" id="formGenerarCertificado" action="{{ route('certificados.uploadCertificado')}}" method="POST">
                @csrf
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
                        <label for="pdfFirma">Pdf Firmado</label>
                        <input type="file" name="pdfFirma" id="pdfFirma" class="form-control" required>
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