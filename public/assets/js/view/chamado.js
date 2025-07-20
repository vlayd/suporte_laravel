// ========VARIÁVEIS BASE=============
var url = window.location.href;
var baseUrl = $('#base_url').html();
var currentBaseUrl = baseUrl + 'chamado/';
var oldCategoria = $('#old_categoria').html();
var oldServico = $('#old_servico').html();


// ========INICIALIZAÇÃO=============
$(document).ready(function() {
    if(document.getElementById('tabela_chamado')) listar('30');
    if(oldCategoria != '') changeServico(oldCategoria);
});

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#form_save_chat').on("submit", function (e) {
    e.preventDefault();
    $.ajax({
        url: currentBaseUrl + 'sendmessage',
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            if(result.split('*')[0] == 'success'){
                toast('success', 'Mensagem enviada!');
                if(document.getElementById("div1")){
                    $('#div1').load(location.href + " #div1");
                    document.getElementsByClassName('ql-editor')[0].innerHTML = '';
                    document.getElementById('inputfile').value= '';
                }
            }
        },
        error: function (result) {
            toast('error', 'Erro ao enviar mensagem!');
        }
    });
});

// Capturar evento de submit do formulário
if(document.querySelector('#botoes')){
    document.querySelector('#botoes').addEventListener('click', function(e){
        const id = e.target.id;
        const idButtonsPeriodo = ['btn30_dias', 'btn_tudo'];
        const idButtonsStatus = ['status1', 'status2', 'status3', 'status4', 'status5'];
        if(idButtonsStatus.includes(id)){
            $('.botao_status').removeClass('btn-success');
            $('#'+id).addClass('btn-success');
            showTrStatus(id);
        } else if(idButtonsPeriodo.includes(id)){
            $('.botao_periodo').removeClass('btn-primary');
            $('.botao_status').removeClass('btn-success');
            $('#status1').addClass('btn-success');
            $('#'+id).addClass('btn-primary');
        }
    });
}

function listar(periodo = '') {
    $.ajax({
        url: url + '/listar'+periodo,
        method: 'GET',
        dataType: 'html',
        success: function (result) {
            $('#tabela_chamado').html(result);
        }
    });
}

function prepareCancel(idChamado) {
    $('#btnSim').attr('onclick', 'cancelarChamado('+idChamado+')');
}

function cancelarChamado(idChamado) {
    $.ajax({
        url: currentBaseUrl+'cancelachamado',
        method: 'POST',
        data: {idChamado: idChamado},
        success: function (result) {
            console.log(result);
            if(result == 'success') location.href = url;
            else toast('error', 'Erro ao cancelar chamado!');
        },
        error: function (result) {
            toast('error', 'Erro desconhecido!');
        }
    });
}

function showTrStatus(classStatus){
    $('.status1').addClass('d-none');
    $('.status2').addClass('d-none');
    $('.status3').addClass('d-none');
    $('.status4').addClass('d-none');
    $('.status5').addClass('d-none');
    $('.'+classStatus).removeClass('d-none');
}

function changeServico(categoria) {
    $.ajax({
        url: baseUrl + 'chamado/select_services',
        method: 'POST',
        dataType: 'html',
        data: {
            id_categoria: categoria,
            id_servico: oldServico,
        },
        success: function (result) {
            $('#select_servicos').html(result);
        }
    });
}

function updateStatus() {
    $.ajax({
        url: baseUrl + 'chamado/select_services',
        method: 'POST',
        dataType: 'html',
        data: {
            id_categoria: categoria,
            id_servico: servico,
        },
        success: function (result) {
            $('#select_servicos').html(result);
        }
    });
}

function excluirAnexo(idAnexo) {
    if (confirm("Deseja mesmo excluir este anexo?")) {
        $.ajax({
            url: baseUrl+'chamado/deleteanexo',
            method: 'POST',
            data: {
                id_anexo: idAnexo,
            },
            success: function (result) {
                if(result == 'success') $("#divAnexo").load(location.href + " #divAnexo");
            },
            error: function (result) {

            }
        });
    }
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
