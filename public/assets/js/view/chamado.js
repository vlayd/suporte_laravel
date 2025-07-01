$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ========VARIÁVEIS BASE=============
var url = window.location.href;
var baseUrl = $('#base_url').html();
var oldCategoria = $('#old_categoria').html();
var oldServico = $('#old_servico').html();


// ========INICIALIZAÇÃO=============
$(document).ready(function() {
    if(document.getElementById('tabela_chamado')) listar('30');
    if(oldCategoria != '') changeServico(oldCategoria);
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
            console.log(result);
            $('#select_servicos').html(result);
            // $.each(result, function(key, value) {
            //     console.log(key + ' ' +value);
            //     $('#choicesservicos').append(`<option value="${key}">${value}</option>`);
            //   });
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
            console.log(result);
            $('#select_servicos').html(result);
            // $.each(result, function(key, value) {
            //     console.log(key + ' ' +value);
            //     $('#choicesservicos').append(`<option value="${key}">${value}</option>`);
            //   });
        }
    });
}
