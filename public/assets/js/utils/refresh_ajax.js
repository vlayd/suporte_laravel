function loaddiv(){
    var audio = new Audio($('#base_url').html() + 'assets/audio/som_de_boi.mp3');
    var naoVistoD = $('#no_view_d2').html();
    var naoVistoE = $('#no_view_e').html();
    var naoIniciadoDinamico = $('#total_nao_iniciado_nao_visto').html();
    var emExecucaoDinamico = $('#total_em_execucao_nao_visto').html();
    $('#total_nao_iniciado').load(location.href + " #total_nao_iniciado");
    $('#total_nao_iniciado_nao_visto').load(location.href + " #total_nao_iniciado_nao_visto");
    $('#total_em_execucao').load(location.href + " #total_em_execucao");
    $('#badge_nao_iniciada_nao_visto').load(location.href + " #total_nao_iniciado_nao_visto");
    $('#badge_em_execucao_nao_visto').load(location.href + " #total_em_execucao_nao_visto");
    if(naoIniciadoDinamico != 0) $("#badge_nao_iniciado_nao_visto").removeClass("d-none");
    if(emExecucaoDinamico != 0) $("#badge_em_execucao_nao_visto").removeClass("d-none");
    $('#no_view_d').load(location.href + " #no_view_d2");
    if(naoVistoD != 0) $("#no_view_d").removeClass("d-none");
    else $("#no_view_d").addClass("d-none");
    if(naoVistoD > naoVistoE){
        $('#no_view_e').html(naoVistoD);
        // var audio = new Audio('https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3');
        audio.play();
    }
}

setInterval(function(){
    loaddiv(); // this will run after every 5 seconds
}, 5000);

