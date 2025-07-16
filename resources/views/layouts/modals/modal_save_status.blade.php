<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Editar Status</h5>
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
                            <div id="msg_erro" class="text-danger"></div>
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
