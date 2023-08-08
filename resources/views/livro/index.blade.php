@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 d-none d-sm-block">
                            Livros
                        </div>
                        <div class="col-6">
                            <div class="float-sm-end">
                                <div class="d-flex justify-content-between">
                                    <a style="margin-right: 5px" href="{{route('livro.create')}}" class="btn btn-success mb-2 mb-sm-0">Novo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body table-responsive">

                    @if (session('success'))
                        <div id="mensagem-sucesso" class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div id="mensagem-error" class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- deixando mensagens por 5 segundos --}}
                    @push('scripts')
                        <script>
                            setTimeout(function() {
                                document.getElementById('mensagem-sucesso').style.opacity = '0';
                            }, 5000);
                            setTimeout(function() {
                                document.getElementById('mensagem-error').style.opacity = '0';
                            }, 5000);

                        </script>
                    @endpush

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Capa</th>
                                <th scope="col">Informações do Livro</th>
                                <th scope="col">Ações</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livros as $livro)
                            <tr>
                                <!-- Exibindo as informações do livro -->
                                <td scope="row">
                                    <img src="{{ $livro->nome_imagem }}" alt="Capa do Livro">
                                </td>
                                <td scope="row" >
                                    <div class="mt-md-4">
                                        <strong>Título:</strong> {{ $livro->titulo }}<br>
                                        <strong>Autor:</strong> {{ $livro->autor }}<br>
                                        <strong>Ano de Publicação:</strong> {{ $livro->ano_publicacao }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column align-items-center mt-3">
                                        <a class="btn bg-primary px-1 py-1 mb-2" href="{{ route('livro.edit', $livro->id)}}">
                                            <img style="width: 20px; height: 20px;" src="/img/lapis.png" alt="">
                                        </a>
                                        
                                        <a class=" btn bg-info px-1 py-1 mb-2" href="{{ route('livro.show', $livro->id)}}">
                                            <img style="width: 20px; height: 20px;" src="/img/view.png" alt="">
                                        </a>

                                        <div class="float-sm-end">
                                            <a id="novo" class="btn bg-danger px-1 p-1" data-bs-toggle="modal" data-bs-target="#myModal{{ $livro->id }}">
                                                <img style="width: 20px; height: 20px;" src="/img/lixeira.png" alt="">
                                            </a>
                                        </div>
                                        
                                        @foreach($livros as $livro)

                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal{{ $livro->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form id="form_{{ $livro->id }}" method="post" action="{{ route('livro.destroy', ['livro' => $livro->id]) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <div class="mb-3">
                                                                <h5 class="h5">Tem certeza que deseja excluir o livro "{{ $livro->titulo }}"?</h5>
                                                                <p class="text-muted">Essa ação é irreversível.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a class="btn btn-danger" href="#" onclick="document.getElementById('form_{{ $livro->id }}').submit()"> 
                                                                    Sim, Excluir
                                                                </a>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection