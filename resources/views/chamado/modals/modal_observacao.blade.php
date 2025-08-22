<div class="modal fade" id="modalObservacao" tabindex="-1" role="dialog" aria-labelledby="modalObservacaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="modalObservacaoLabel">Finalização</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('chamado.saveobs')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        @include('layouts.inputs.input_text', ['campo' => 'observacao', 'label' => 'Observação'])
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-gradient-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>