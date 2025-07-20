// ========VARIÁVEIS BASE=============
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ========VARIÁVEIS BASE=============
var url = window.location.href;
var baseUrl = $('#base_url').html();
var currentBaseUrl = baseUrl + 'usuario/';

$('.botao_quantidade').on('click', function(e){
    const id = e.target.id;
    console.log(id);
    $('.botao_quantidade').removeClass('btn-primary');
    $('#'+id).addClass('btn-primary');
    listar(id);
});

$('#btn_atualiza').on('click', function(e){
    $('#btn_atualiza').addClass('disabled');
    $('#btn_atualiza').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only"><i class="fas fa-sync-alt"></i></span>');
    $.ajax({
        url: currentBaseUrl+'atualiza',
        method: 'GET',
        dataType: 'html',
        success: function (result) {
            console.log(result);
            if(result == 'success'){
                toast('success', 'Usuários atualizados');
                $('#btn_atualiza').html('<i class="fas fa-sync-alt"></i>');
                $('#btn_atualiza').removeClass('disabled');
                listar();
            }
        }
    });
});

function listar(idButton='') {
    join = '';
    if(idButton == 'btn_tudo') join = 'left';
    $.ajax({
        url: currentBaseUrl+'tabela',
        method: 'POST',
        data: {join: join},
        dataType: 'html',
        success: function (result) {
            $('#tabela').html(result);
        }
    });
}

function toast(tipo, msg) {
    var head = '';
    if(tipo == 'success') head = 'Sucesso!';
    else if(tipo == 'error') head = 'Erro!';
    $.toast({
        text: msg, // Text that is to be shown in the toast
        heading: head, // Optional heading to be shown on the toast
        icon: tipo, // Type of toast icon
        showHideTransition: 'fade', // fade, slide or plain
        allowToastClose: true, // Boolean value true or false
        hideAfter: 1500, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
        position: 'bottom-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
    });
}
