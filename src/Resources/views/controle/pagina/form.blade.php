@extends('bredicoloradmin::layouts.controle')

@section('content')
    <!-- begin breadcrumb -->
    @component('bredicoloradmin::components.migalha')
        <li class="breadcrumb-item"><a href="{{ route('menu::controle.pagina.index') }}">Páginas</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
    @endcomponent
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
        Páginas
        {{-- <small>header small text goes here...</small> --}}
    </h1>
    <!-- end page-header -->
    <div class="row">
        <div class="col-lg-6">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    </div>
                    <h4 class="panel-title">Páginas</h4>
                </div>
                <div class="panel-body">
                    {!! Form::model(isset($pagina) ? $pagina : null,['route' => (isset($pagina->id) ? ['menu::controle.pagina.update', $pagina->id] : 'menu::controle.pagina.store'), 'files' => true]) !!}
                        <fieldset>
                            <legend class="m-b-15">Página</legend>
                             <div class="form-group">
                            <label for="menu_id">
                                Menu
                            </label>
                            {!! Form::select('menu_id', ['' => 'Selecione']+$menus, null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                            <label for="menu_id">
                                Página
                            </label>
                            {!! Form::select('pagina_id', ['' => 'Selecione']+$paginas, null, ['class' => 'form-control']) !!}
                            </div>


                            <div class="form-group">
                            <label for="titulo">
                                Titulo*
                            </label>
                            {!! Form::text('titulo', null, ['class' => 'form-control', 'required']) !!}
                            </div>


                            <div class="form-group">
                            <label for="descricao">
                                Descrição
                            </label>
                            {!! Form::textarea('descricao',null, ['class' => 'form-control']) !!}
                            </div>


                            <div class="form-group">
                            <label for="texto">
                                Texto
                            </label>
                            {!! Form::textarea('texto',null, ['class' => 'form-control summernote']) !!}
                            </div>


                            <div class="form-group">
                            <label for="date">
                                Data
                            </label>
                            {!! Form::date('data', null, ['class' => 'form-control']) !!}
                            </div>


                            <div class="form-group">
                            <label for="link">
                                Link
                            </label>
                            {!! Form::text('link', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="imagem">Imagem</label>
                                @if(!empty($pagina->imagem))
                                    <div>
                                        <img src="{{ route('imagem.render', 'pagina/g/' . $pagina->imagem) }}" class="img-fluid">
                                    </div>
                                @endif
                                {!! Form::file('imagem', ['class' => 'form-control']) !!}
                            </div>
                            <div class="checkbox checkbox-css m-b-20">
                                <div class="form-check m-r-10">
                                    {!! Form::checkbox('ativo', 1, null, ['class' => 'form-check-input', 'id' => 'ativo']) !!}
                                    <label class="form-check-label" for="ativo">Publicar</label>
                                </div>
                            </div>
                            @can((isset($pagina->id)) ? 'controle.pagina.update' : 'controle.pagina.store')
                                <button type="submit" class="btn btn-sm btn-primary m-r-5">Salvar</button>
                            @endcan
                            <a href="{{ route('menu::controle.pagina.index') }}" class="btn btn-sm btn-default">Cancelar</a>
                        </fieldset>
                    {!! Form::close() !!}

                </div> <!-- panel-body -->
            </div>
            <!-- end panel -->

        </div>
    </div>

@stop
