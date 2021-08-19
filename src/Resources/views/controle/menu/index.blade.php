@extends('bredicoloradmin::layouts.controle')

@section('content')
    <!-- begin breadcrumb -->
    @component('bredicoloradmin::components.migalha')
        <li class="breadcrumb-item"><a href="{{ route('menu::controle.menu.index') }}">Menus</a></li>
    @endcomponent

    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
        Menus {{--<small>header small text goes here...</small> --}}
    </h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                    @can('controle.menu.create')
                    <a href="{{ route('menu::controle.menu.create') }}" class="btn btn-xs btn-circle2 btn-success"><i class="fa fa-plus"></i> Novo Registro</a>
                    @endcan
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Menus</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped m-b-0">
                    <thead>
                        <tr>
                            <th>Ordem</th>
                            <th>Imagem</th>
                            <th>Titulo</th>
                            <th>Link</th>
                            <th>Publicado</th>
                            <th width="1%">Opções</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @forelse($menus as $menu)
                        <tr id="{{ $menu->id }}">
                            <td>{{ $menu->order }}</td>
                            <td class="with-img">
                                @if(!empty($menu->imagem))
                                <img src="{{ route('imagem.render', 'menu/p/' . $menu->imagem) }}" class="img-rounded height-30">
                                @endif
                            </td>
                            <td>{{ (isset($menu->titulo) and !empty($menu->titulo)) ? $menu->titulo : '-' }}</td>
                            <td>{{ (isset($menu->link) and !empty($menu->link)) ? $menu->link : '-' }}</td>
                            <td>
                                <span class="fa fa-{{ ($menu->ativo == 1) ? 'check-' : '' }}circle"></span>
                            </td>
                            <td class="with-btn" nowrap="">
                                @can('controle.menu.edit')
                                    <a href="{{ route('menu::controle.menu.edit', $menu->id) }}" class="btn btn-sm btn-primary width-60 m-r-2">Editar</a>
                                @endcan
                                @can('controle.menu.destroy')
                                <a href="javascript:void(0)" data-url="{{ route('menu::controle.menu.destroy', $menu->id) }}" class="btn btn-sm btn-white width-60 atencao">Delete</a>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                Nenhum registro foi encontrado.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end panel -->
@stop

@section('scripts')
<script>
    sortable('menus')
</script>
@endsection
