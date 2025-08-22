// ========VARIÁVEIS BASE=============
var url = window.location.href;
var baseUrl = $('#base_url').html();
var currentBaseUrl = baseUrl + 'categoria/';

// csrf
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.categoria').on("click", function(e){
    classe = e.currentTarget.id;
    id = classe.replace('tr', '');
    if(id == '') emptyInputs();
    else valuesInputs(id);
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
            else $('#msg_erro').html(result);
        },
        error: function (result) {
        }
    });
});

function valuesInputs(id){
    console.log($('#setor'+id).html());
    
    status_ = $('#status'+id).html() == 1?true:false;
    $('[name="nomeModal"]').val($('#nome'+id).html());
    $('[name="idModal"]').val($('#id'+id).html());
    $('[name="statusModal"]').prop('checked', status_);
    $('[name="setorModal"]').val($('#setor'+id).html()).change();
    $('#categoriaModalLabel').html('Editar Categoria');
}

function emptyInputs(){
    $('[name="nomeModal"]').val('');
    $('[name="idModal"]').val('');
    $('[name="statusModal"]').prop('checked', true);
    $('[name="setorModal"]').val('').change();
    $('#categoriaModalLabel').html('Adicionar Categoria');
}
