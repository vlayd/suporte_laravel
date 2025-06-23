@extends('layouts.main_layout')

@section('breadcrumb')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <h5 class="mb-0">Novo chamado</h5>
                <p class="text-sm mb-0">Preencha os dados para criar um chamado</p>
                <hr class="horizontal dark my-3">
            </div>
            <div class="card-body p-3">
                <form action="" id="form-save">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label mt-3">Serviços</label>
                            <select class="form-control" name="" id="choices-basic" data-trigger>
                                <option value="0">Escolha</option>
                                <option value="1">Serviço</option>
                                <option value="2">Manutenção</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label mt-3">Serviços</label>
                            <select class="form-control" name="" id="choices-basic" data-trigger>
                                <option value="0">Escolha</option>
                                <option value="1">Serviço</option>
                                <option value="2">Manutenção</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label class="form-label mt-3">Título</label>
                            <input class="form-control" type="text" name="titulo" id="titulo">
                        </div>
                        <div class="col-6">
                            <label class="form-label mt-3">Solicitante</label>
                            <select class="form-control" name="" id="choices-basic-2" data-trigger>
                                <option value="0">Escolha</option>
                                <option value="1">Serviço</option>
                                <option value="2">Manutenção</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div id="descricao_hid-1" class="d-none">Descrição hidden</div>
                        <div class="col-12">
                            <label class="form-label">Descriçao</label>
                            <div id="descricao-1"></div>
                            <input type="hidden" name="descricao" id="hid_descricao-1" value="">
                        </div>
                    </div>

                    <div class="row mt-6">
                        <div class="col-12 mt-3">
                            <label for="input_anexo" class="form-label">Anexos</label>
                            <input class="form-control" name="anexos[]" type="file" id="input_anexo" multiple>
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

                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" name="button" class="btn btn-light m-0">Cancel</button>
                        <button type="submit" form="form-save" id="btnSave" class="btn bg-gradient-primary m-0 ms-2">Salvar</button>
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
<script src="{{asset('assets/js/init/choices.js')}}"></script>
<script src="{{asset('assets/js/plugins/quill.min.js')}}"></script>
<script src="{{asset('assets/js/init/quill.js')}}"></script>
@endsection
