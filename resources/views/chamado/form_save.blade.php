@extends('layouts.main_layout')

@section('css')
<link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('breadcrumb')
@endsection

@section('content')
<?php
$selectServico = $chamado->servico??old('servico');
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
                <form action="insert" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label mt-3">Categoria</label>
                            <select class="form-control" onchange="changeServico(this.value, <?=old('servico')??''?>)" name="categoria" id="choices-basic" data-trigger>
                                <option value="">Escolha</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}" @if(old('categoria')==$categoria->id) {{'selected'}} @endif>{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                                {{-- show error --}}
                                @error('categoria')
                                    <div class="text-danger mt-n4">{{$message}}</div>
                                @enderror
                        </div>
                        <div class="col-6">
                            <div id="select_servicos">
                                @if (!old('categoria'))
                                    @include('layouts.select.select_servicos', ['idServico' => $selectServico, 'servicos' => [] ])
                                @endif
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
                            <input class="form-control" type="text" name="titulo" id="titulo" value="{{$chamado->titulo??old('titulo')}}">
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
                                <option value="{{$servidor->id}}" @if(old('solicitante')==$servidor->id) {{'selected'}} @endif>{{$servidor->nome}}</option>
                                @endforeach
                                <option value="1000">Núcleo TI</option>
                            </select>
                        </div>
                        @endif

                    </div>

                    <div class="row mt-3">
                        <div id="descricao_hid-1" class="d-none"><?=old('descricao')?></div>
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

                    <div class="col-12 py-3 ms-2">
                        <div class="d-flex flex-wrap" id="divImage">
                            {{--foreach--}}
                            <div class="me-2">
                                <a href="" download="arquivo" target="_blank">
                                    <img src="{{asset(EXTENSION_IMG['pdf'])}}" alt="" height="30" class="my-3">
                                    <span>Arquivo</span>
                                </a>
                                <a href="javascript:;" onclick=""><i class="fas fa-times-circle fa-lg text-danger"></i></a>
                                <div class=" ms-3 vr"></div>
                            </div>
                            {{--endforeach--}}
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mt-4">
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
