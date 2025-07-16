@php
    $activeNovo = 'active'
@endphp
@extends('layouts.main_layout')

@section('css')
@endsection

@section('breadcrumb')
    <?=$breadcrumb?>
@endsection

@section('content')
<?php
$optionCategoria = $chamado->idCategoria??old('categoria');
$optionServico = $chamado->servico??old('servico');
$optionSolicitante = $chamado->solicitante??old('solicitante');
$selectServico = $optionCategoria != ''?$servicos:[];
$inputTitulo = old('titulo')!=null?old('titulo'):$chamado->titulo??'';
$inputDescricao = old('descricao')!=null?old('descricao'):$chamado->descricao??'';
// dd($optionServico);
?>
<div class="d-none" id="old_categoria">{{old('categoria')??''}}</div>
<div class="d-none" id="old_servico">{{old('servico')??''}}</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <h5 class="mb-0">Novo chamado</h5>
                <p class="text-sm mb-0">Preencha os dados para criar um chamado</p>
                <hr class="horizontal dark my-3">
            </div>
            <div class="card-body p-3">
                <form action="{{route('chamado.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label mt-3">Categoria</label>
                            <select class="form-control" onchange="changeServico(this.value, <?=old('servico')??''?>)" name="categoria" id="choices-basic" data-trigger>
                                <option value="">Escolha</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}" @if($optionCategoria==$categoria->id) {{'selected'}} @endif>{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                                {{-- show error --}}
                                @error('categoria')
                                    <div class="text-danger mt-n4">{{$message}}</div>
                                @enderror
                        </div>
                        <div class="col-6">
                            <div id="select_servicos">
                                <label class="form-label mt-3">Serviços</label>
                                <select class="form-control" name="servico" id="choices_servicos" data-trigger>
                                    <option class="" value="">Escolha...</option>
                                    <?php foreach($selectServico as $servico):
                                    $select = $optionServico==$servico->id?'selected':'';?>
                                        <option value="<?=$servico->id?>" <?=$select?>><?=$servico->nome?></option>
                                    <?php endforeach?>
                                </select>
                            </div>
                            {{-- show error --}}
                            @error('servico')
                                <div class="text-danger mt-n4">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-{{session('user.nivel') == 2?'6':'12'}}">
                            <label class="form-label mt-3">Título</label>
                            <input class="form-control" type="text" name="titulo" id="titulo" value="{{$inputTitulo}}">
                            {{-- show error --}}
                            @error('titulo')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        @if (session('user.nivel') == 2)
                        <div class="col-6">
                            <label class="form-label mt-3">Solicitante</label>
                            <select class="form-control" name="solicitante" id="choices-basic-3" data-trigger>
                                <option value="">Escolha</option>
                                @foreach ($servidores as $servidor)
                                <option value="{{$servidor->id.'.'.$servidor->setor}}" @if($optionSolicitante==$servidor->id) {{'selected'}} @endif>{{$servidor->nome}}</option>
                                @endforeach
                                <option value="1000">Núcleo TI</option>
                            </select>
                        </div>
                        @endif

                    </div>

                    <div class="row mt-3">
                        <div id="descricao_hid-1" class="d-none"><?=$inputDescricao?></div>
                        <div class="col-12">
                            <label class="form-label">Descriçao</label>
                            <div id="descricao-1"></div>
                            <input type="hidden" name="descricao" id="hid_descricao-1" value="">
                            {{-- show error --}}
                            @error('descricao')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-7">
                        <div class="col-12 mt-3">
                            <label for="input_anexo" class="form-label">Anexos</label>
                            <input class="form-control" name="anexos[]" type="file" id="input_anexo" multiple>
                            {{-- show error --}}
                            @error('anexos')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    @if (isset($anexos))
                    <div class="col-12 py-3 ms-2">
                        <div class="d-flex flex-wrap" id="divAnexo">
                            <?php foreach($anexos as $anexo):
                                $tmp = explode('.', $anexo->arquivo);
                            ?>
                            <div class="me-2">
                                <a href="{{ asset(PATH_UPLOAD . $anexo->id_chamado . '/' . $anexo->arquivo)}}" download="{{$anexo->arquivo}}" target="_blank">
                                    <img src="{{asset(EXTENSION_IMG[end($tmp)] ?? EXTENSION_IMG['file'])}}" alt="" height="30" class="my-3">
                                    <span>{{$anexo->arquivo}}</span>
                                </a>
                                <a href="javascript:;" onclick="excluirAnexo(<?=$anexo->id?>)"><i class="fas fa-times-circle fa-lg text-danger"></i></a>
                                <div class=" ms-3 vr"></div>
                            </div>
                            <?php endforeach?>
                        </div>
                    </div>
                    @endif


                    <div class="d-flex justify-content-start mt-4">
                        @if (isset($chamado->idChamado))
                        <input name="idChamado" type="hidden" value="{{ Crypt::encrypt($chamado->idChamado)}}">
                        @endif
                        <button type="button" name="button" class="btn btn-light m-0">Cancel</button>
                        <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var item = 'Dashboard';
    var subItem = 'Home'
</script>
<script src="{{asset('assets/js/plugins/choices.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/select2.min.js')}}"></script>
<script src="{{asset('assets/js/init/choices.js')}}"></script>
<script src="{{asset('assets/js/plugins/quill.min.js')}}"></script>
<script src="{{asset('assets/js/init/quill.js')}}"></script>
<script src="{{asset('assets/js/view/chamado.js')}}" type="text/javascript"></script>

@endsection


@section('js2')
@endsection
