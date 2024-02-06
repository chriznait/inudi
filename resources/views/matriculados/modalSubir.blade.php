<div class="modal fade" id="modal-matriculados" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header alert-primary">
          <h5 class="modal-title " id="staticBackdropLabel">Subir formato de certificado</h5>
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
                        <p><span class="bagde bagde-info">(*) Eje X inicia de izquierda a derecha</span></p>
                        <p><span class=>(*) Eje Y inicia de arriba hacia abajo</span></p>
                    </div>
                    <div class="col-sm-12">
                        <label for="">NOMBRE Eje X</label>
                        <input type="number" name="posXNombre" id="posXNombre" class="form-control" value="0">
                    </div>
                    <div class="col-sm-12">
                        <label for="">NOMBRE Eje Y</label>
                        <input type="number" name="posYNombre" id="posYNombre" class="form-control" value="0">
                    </div>
                    <div class="col-sm-12">
                        <label for="">NOTA Eje X</label>
                        <input type="number" name="posXNota" id="posXNota" class="form-control" value="0">
                    </div>
                    <div class="col-sm-12">
                        <label for="">NOTA Eje Y</label>
                        <input type="number" name="posYNota" id="posYNota" class="form-control" value="0">
                    </div>
                    <hr/>
                    <div class="col-sm-12">
                        <label for="">CODIGO Eje X</label>
                        <input type="number" name="posXCodigo" id="posXCodigo" class="form-control" value="0">
                    </div>
                    <div class="col-sm-12">
                        <label for="">CODIGO Eje Y</label>
                        <input type="number" name="posYCodigo" id="posYCodigo" class="form-control" value="0">
                    </div>
                    
                    <div class="col-sm-12">
                        <label for="">IMAGEN</label>
                        <input class="form-control-file border col-sm-12" type="file" name="imgCertificado" id="imgCertificado" value="">
                        @if ($errors->has('imgCertificado'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('imgCertificado') }}</strong>
                            </span>
                        @endif
                    </div>
                    <hr>
                    <div class="col-sm-12 text-center">
                        <br>
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success float-right">Subir Formato</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>