@if ($value != 0)
<span id="badge_{{$id}}_nao_visto" class="position-absolute top-0 start-100 translate-middle badge badge-lg badge-circle bg-danger">
    <span id="total_{{$id}}_nao_visto"><?= $value ?></span>
</span>
@endif
