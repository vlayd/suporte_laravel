// ========VARIÁVEIS BASE=============
var url = window.location.href;
var baseUrl = $('#base_url').html();
var currentBaseUrl = baseUrl + 'servico/';

// csrf
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.servico').on("click", function(e){
    id = $(this).data('id');    
    if (id == '0') return emptyInputs();
    valuesInputs(id);
});

$('#form_save').on("submit", function (e) {
    e.preventDefault();
    $.ajax({
        url: url + '/save',
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            if(result == 'success') location.reload();
            else $('.msg_erro').html(result);
        },
        error: function (result) {
        }
    });
});

function validate(){
    $('#form_save').validate
}

function valuesInputs(id){
    status_ = $('#status'+id).html() == 1?true:false;
    $('[name="nomeModal"]').val($('#nome'+id).html());
    $('[name="idModal"]').val($('#id'+id).html());
    $('[name="categoriaModal"]').val($('#categoria'+id).html()).change();
    $('[name="statusModal"]').prop('checked', status_);
    $('#servicoModalLabel').html('Editar Serviço');
}

function emptyInputs(){
    $('[name="nomeModal"]').val('');
    $('[name="idModal"]').val('');
    $('[name="statusModal"]').prop('checked', true);
    $('#servicoModalLabel').html('Adicionar Serviço');
    $('[name="categoriaModal"]').val($('#categoria'+id).html()).change();
    resetErros();
}

function resetErros(){
    $('.msg_erro').html('');
    $('[name="nomeModal"]').removeClass('is-invalid');
}
