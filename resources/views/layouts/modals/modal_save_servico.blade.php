<!-- Modal -->
<div class="modal fade" id="servicoModal" tabindex="-1" role="dialog" aria-labelledby="servicoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="servicoModalLabel">Editar Servico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_save">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label mt-3">Nome</label>
                            <input class="form-control" type="text" name="nomeModal" value="" required>
                            <div class="text-danger msg_erro"></div>
                        </div>
                        <div class="col-9">
                            <label class="form-label mt-3">Categoria</label>
                            <select class="form-control" name="categoriaModal" required>
                                <option value="">Selecione</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="form-label mt-4">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="statusModal" value="1">
                                <label class="form-check-label" for="status">Ativo</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idModal" value="">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" form="form_save" class="btn bg-gradient-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
