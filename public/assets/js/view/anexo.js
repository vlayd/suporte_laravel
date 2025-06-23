// ========INICIALIZAÇÃO=============
$(document).ready(function() {
    listar();
});

// ========FUNÇÕES ÚTEIS=============
function listar() {
    urlLista = url.replace('anexo', 'anexo/listar');
    $.ajax({
        url: urlLista,
        method: 'GET',
        dataType: 'html',
        success: function (result) {
            $('#tabela_anexo').html(result);
        }
    });
}

function selectAnexo(item) {
    if(item == 'perfil'){
        $('.item1').removeClass('d-none');
        $('.item2').removeClass('d-none');
        $('.item3').removeClass('d-none');
        $('.item4').addClass('d-none');
        $('.item5').addClass('d-none');
        $('.item6').addClass('d-none');
        $('.item7').addClass('d-none');
        $('.item8').addClass('d-none');
        $('.item9').addClass('d-none');
        $('.item10').addClass('d-none');
    } else if(item == 'profissional'){
        $('.item1').addClass('d-none');
        $('.item2').addClass('d-none');
        $('.item3').addClass('d-none');
        $('.item4').addClass('d-none');
        $('.item5').removeClass('d-none');
        $('.item6').removeClass('d-none');
        $('.item7').removeClass('d-none');
        $('.item8').removeClass('d-none');
        $('.item9').removeClass('d-none');
        $('.item10').addClass('d-none');
    } else if(item == 'folha'){
        $('.item1').addClass('d-none');
        $('.item2').addClass('d-none');
        $('.item3').addClass('d-none');
        $('.item4').removeClass('d-none');
        $('.item5').addClass('d-none');
        $('.item6').addClass('d-none');
        $('.item7').addClass('d-none');
        $('.item8').addClass('d-none');
        $('.item9').addClass('d-none');
        $('.item10').addClass('d-none');
    } else if(item == 'funcao'){
        $('.item1').addClass('d-none');
        $('.item2').addClass('d-none');
        $('.item3').addClass('d-none');
        $('.item4').addClass('d-none');
        $('.item5').addClass('d-none');
        $('.item6').addClass('d-none');
        $('.item7').addClass('d-none');
        $('.item8').addClass('d-none');
        $('.item9').addClass('d-none');
        $('.item10').removeClass('d-none');
    } else {
        $('.item1').removeClass('d-none');
        $('.item2').removeClass('d-none');
        $('.item3').removeClass('d-none');
        $('.item4').removeClass('d-none');
        $('.item5').removeClass('d-none');
        $('.item6').removeClass('d-none');
        $('.item7').removeClass('d-none');
        $('.item8').removeClass('d-none');
        $('.item9').removeClass('d-none');
        $('.item10').removeClass('d-none');
    }
}

function resetInputs() {
    $('input[class="form-control"]').val('');
    $('select[class="form-control"]').val('0').change();
    $('input[name="idModal"]').val('');
    $('input[type="file"]').val('');
    $('input[type="text"]').val('');
    $('input[type="number"]').val('0');
}

function preparaEdit(id) {
    resetInputs();
    $('#nomeModal').val($('#nome'+id).html());
    $('#ordemModal').val($('#ordem'+id).html());
    $('#tipoModal').val($('#tipo'+id).html()).change();
    $('input[name="idModal"]').val(id);
}

$('#form-save').on('submit', function (e) {
    e.preventDefault();
    urlSave = url.replace('anexo', 'anexo/save');
    $.ajax({
        url: urlSave,
        method: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            resetInputs();
            toast(result);
            if(result == 'success'){
                listar();
            }
        },
        error: function (result) {
            console.log('Erros ' + result);            
        }
    });
});