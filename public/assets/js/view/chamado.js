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
                    document.getElementById('anexo_chat').value= '';
                    // document.getElementById('inputfile').value= null;
                }
            }
        },
        error: function (result) {
            toast('error', 'Erro ao enviar mensagem!');
        }
    });
});

$('body').on("click", '.prepare_obs', function () {
    $('[name="observacao"]').val($('#observacao' + $(this).data('id')).html());
    $('[name="id"]').val($(this).data('id'));
});

// $('.prepare_obs').on("click", function () {
//     console.log('teste');
//     return;
//     console.log($(this).data('id'));
//     $('[name="observacao"]').val($('#observacao' + $(this).data('id')).html());
// });

// Capturar evento de submit do formulário
if(document.querySelector('#botoes')){
    document.querySelector('#botoes').addEventListener('click', function(e){
        const id = e.target.id;
        const idButtonsPeriodo = ['btn30_dias', 'btn_tudo'];
        const idButtonsStatus = ['statusr', 'status1', 'status2', 'status3', 'status4', 'status5'];
        if(idButtonsStatus.includes(id)){
            $('.botao_status').removeClass('btn-success');
            $('#'+id).addClass('btn-success');
            showTrStatus(id);
        } else if(idButtonsPeriodo.includes(id)){
            $('.botao_periodo').removeClass('btn-primary');
            $('.botao_status').removeClass('btn-success');
            $('#statusr').addClass('btn-success');
            $('#'+id).addClass('btn-primary');
        }
    });
}

function listar(intervalo = '') {
    $.ajax({
        url: currentBaseUrl + 'listar',
        method: 'POST',
        data: {lista: lista, intervalo: intervalo},
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
            if(result == 'success') toast(result, 'Chamado cancelado!');
            else if(result == 'error') sweetBotao(result, 'Este chamado já foi iniciado!');
            setTimeout(function() {
                location.href = url;
            }, 2000);
        },
        error: function (result) {
            toast(result, 'Erro desconhecido!');
            setTimeout(function() {
                location.href = url;
            }, 2000);
        }
    });
}

function showTrStatus(classStatus){
    $('.statusr').addClass('d-none');
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
                else if(result == 'error') sweetBotao(result, 'Este chamado já foi iniciado!');
                setTimeout(function() {
                    location.href = url;
                }, 2000);
            },
            error: function (result) {

            }
        });
    }
}


