<div class="modal fade" id="modal-matriculados" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Subir formato de certificado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form enctype="multipart/form-data" id="formSubirCertificado" action="{{route('matriculados.subirCertificado')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="idCursoMat" id="idCursoMat" value="">
                    </div>
                    <div class="col-sm-12">
                        <input class="form-control-file border col-sm-12" type="file" name="imgCertificado" id="imgCertificado" value="">
                        @if ($errors->has('imgCertificado'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('imgCertificado') }}</strong>
                            </span>
                        @endif
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