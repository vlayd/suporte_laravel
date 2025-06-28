<label class="form-label mt-3">Serviços</label>
<select class="form-control" name="servico" id="choices_servicos" data-trigger>
    <option value="">Escolha...</option>
    <?php foreach($servicos as $servico):
    $select = $idServico==$servico->id?'selected':'';?>
        <option value="<?=$servico->id?>" <?=$select?>><?=$servico->nome?></option>
    <?php endforeach?>
</select>
{{-- show error --}}
@error('servico')
    <div class="text-danger mt-n4">{{$message}}</div>
@enderror

<script>
    var element = document.getElementById('choices_servicos');
    new Choices(element, {
        searchEnabled: true,
        placeholder: true,
        searchPlaceholderValue: 'Digite aqui...',
        position: 'auto',
        shouldSort: false,
    });

    var oldServico = $('#old_servico').html();
    $("choices_servicos").val('4').change();
</script>
