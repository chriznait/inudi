<div class="modal fade" id="modal-inscripcion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Inscripcion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="col-sm-12">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Bienvenido!</h4>
                    <p>Estimado participante, para poder inscribirse al curso, debe de verificar su DNI.</p>
                </div>
            </div>
            <hr>
            <form class="row g-12" method="GET" action="{{ route('certificados.verificar')}}">
                
                <div class="col-sm-6">
                  <label for="dniVerificar" class="visually-hidden">DNI</label>
                  <input type="text" class="form-control" name="dniVerificar" id="dniVerificar" placeholder="Ingrese Nro documento">
                  <input type="hidden" name="idCurso" id="idCurso" value="">
                </div>
                <div class="col-auto mx-auto">
                  <button type="submit" class="btn btn-success mb-3">Verificar</button>
                </div>
            </form>
            
            <hr>

        </div>
        <!--<div class="modal-footer">
            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Matricularse</button>
        </div>-->
      </div>
    </div>
  </div>
