@extends('bredicoloradmin::layouts.controle')

@section('content')
    <!-- begin breadcrumb -->
    @component('bredicoloradmin::components.migalha')
        <li class="breadcrumb-item"><a href="{{ route('menu::controle.pagina.index') }}">Páginas</a></li>
    @endcomponent

    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
        Páginas {{--<small>header small text goes here...</small> --}}
    </h1>
    <!-- end page-header -->

    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                    @can('controle.pagina.create')
                    <a href="{{ route('menu::controle.pagina.create') }}" class="btn btn-xs btn-circle2 btn-success"><i class="fa fa-plus"></i> Novo Registro</a>
                    @endcan
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            </div>
            <h4 class="panel-title">Páginas</h4>
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
                            <th>Ativo</th>
                            <th width="1%">Opções</th>
                        </tr>
                    </thead>
                    <tbody class="sortable">
                        @forelse($paginas as $pagina)
                        <tr id="{{ $pagina->id }}">
                            <td>{{ $pagina->order }}</td>
                            <td class="with-img">
                                @if(!empty($pagina->imagem))
                                <img src="{{ route('imagem.render', 'pagina/p/' . $pagina->imagem) }}" class="img-rounded height-30">
                                @endif
                            </td>
                            @if(isset($pagina->paginas) and count($pagina->paginas))
                                <td style="font-weight: bold;">
                                    {{(isset($pagina->titulo) and !empty($pagina->titulo)) ? $pagina->titulo : '-' }}
                                </td>
                            @else 
                                <td>
                                    » {{(isset($pagina->titulo) and !empty($pagina->titulo)) ? $pagina->titulo : '-' }}
                                </td>
                            @endif
                            <td>{{ (isset($pagina->link) and !empty($pagina->link)) ? $pagina->link : '-' }}</td>
                            <td>
                                <span class="fa fa-{{ ($pagina->ativo == 1) ? 'check-' : '' }}circle"></span>
                            </td>
                            <td class="with-btn" nowrap="">
                                @can('controle.pagina.edit')
                                    <a href="{{ route('menu::controle.pagina.edit', $pagina->id) }}" class="btn btn-sm btn-primary width-60 m-r-2">Editar</a>
                                @endcan
                                @can('controle.pagina.destroy')
                                <a href="javascript:void(0)" data-url="{{ route('menu::controle.pagina.destroy', $pagina->id) }}" class="btn btn-sm btn-white width-60 atencao">Delete</a>
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
    sortable('paginas')
</script>
@endsection
