<!-- Modal -->
<div class="modal fade" id="categoriaModal" tabindex="-1" role="dialog" aria-labelledby="categoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoriaModalLabel">Editar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_save">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">
                            <label class="form-label mt-3">Nome</label>
                            <input class="form-control" type="text" name="nomeModal" value="" required>
                            <div id="msg_erro" class="text-danger"></div>
                        </div>
                        <div class="col-4">
                            <label class="form-label mt-3">Status</label>
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
