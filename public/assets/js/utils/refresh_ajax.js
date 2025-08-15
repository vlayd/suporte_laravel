var baseUrl = $('#base_url').html();
var baseUrlChamados = baseUrl + 'chamado/';
    var audio = new Audio($('#base_url').html() + 'assets/audio/som_de_boi.mp3');

function loaddiv(){
    var naoVistoD = $('.nao_visto').html();
    var naoVistoE = $('#nao_visto_e').html();
    $.ajax({
        url: baseUrlChamados + 'retorna',
        method: 'GET',
        success: function (result) {
            console.log(result);            
            var arrayValores = JSON.parse(result);
            $.each(arrayValores, function(index, value) {
                $('.'+index).html(value);
                if(value > 0) $('.badge_'+index+'_nao_visto').removeClass('d-none');
                else $('.badge_'+index+'_nao_visto').add('d-none');
            });
        }
    });
    // var naoIniciadoDinamico = $('#total_nao_iniciado_nao_visto').html();
    // var emExecucaoDinamico = $('#total_em_execucao_nao_visto').html();
    // $('#total_nao_iniciado').load(location.href + " #total_nao_iniciado");
    // $('#total_nao_iniciado_nao_visto').load(location.href + " #total_nao_iniciado_nao_visto");
    // $('#total_em_execucao').load(location.href + " #total_em_execucao");
    // $('#badge_nao_iniciada_nao_visto').load(location.href + " #total_nao_iniciado_nao_visto");
    // $('#badge_em_execucao_nao_visto').load(location.href + " #total_em_execucao_nao_visto");
    // if(naoIniciadoDinamico != 0) $("#badge_nao_iniciado_nao_visto").removeClass("d-none");
    // if(emExecucaoDinamico != 0) $("#badge_em_execucao_nao_visto").removeClass("d-none");
    if(naoVistoD < 0) $(".badge_total").removeClass("d-none");
    else $(".badge_total").addClass("d-none");
    if(naoVistoD > naoVistoE){
        $('#nao_visto_e').html(naoVistoD);
        // var audio = new Audio('https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3');
        audio.play();
    }
}

setInterval(function(){
    loaddiv(); // this will run after every 5 seconds
}, 5000);

