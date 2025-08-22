var baseUrl = $('#base_url').html();
var baseUrlChamados = baseUrl + 'chamado/';
    var audio = new Audio($('#base_url').html() + 'assets/audio/som_de_boi.mp3');

function loaddiv(){
    var naoVistoD = $('.nao_visto_setor').html();
    var naoVistoE = $('#nao_visto_e').html();
    $.ajax({
        url: baseUrlChamados + 'retorna',
        method: 'GET',
        success: function (result) {
            var arrayValores = JSON.parse(result);
            $.each(arrayValores, function(index, value) {
                $('.'+index).html(value);
                if(value > 0) $('.badge_'+index).removeClass('d-none');
                else $('.badge_'+index+'_nao_visto').add('d-none');
            });
        }
    });

    $('#tabela_controle').load(location.href + " #tabela_controle2");
    if(naoVistoD < 0) $(".badge_total").removeClass("d-none");
    else $(".badge_total").addClass("d-none");
    if(naoVistoD > naoVistoE){
        // var audio = new Audio('https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3');
        audio.play();
        $('#nao_visto_e').html(naoVistoD);
    }
    
}

setInterval(function(){
    loaddiv(); // this will run after every 5 seconds
}, 5000);

