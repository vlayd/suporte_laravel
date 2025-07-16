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

$('.status').on("click", function(e){
    classe = e.currentTarget.id;
    id = classe.replace('tr', '');
    $('[name="nomeModal"]').val($('#nome'+id).html());
    $('[name="idModal"]').val($('#id'+id).html());
    $('[name="nomeModal"]').attr('class', 'form-control '+$('#cor'+id).html());
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
        },
        error: function (result) {
        }
    });
});
