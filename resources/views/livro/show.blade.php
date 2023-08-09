@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Visualização</div>

                <div class="card-body">
                    <fieldset disabled>
                            <div class="">
                                <div class="text-center">
                                    @if ($livro->nome_imagem)
                                    <img src="{{ $livro->nome_imagem }}" alt="Capa do Livro">
                                @else
                                    <p class="mt-4 text-muted">Nenhuma <br> imagem <br>disponível</p>
                                @endif
                                </div>
                            </div>
                
                        <div class="mb-3">
                            <label class="form-label ">Titulo</label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror"
                             name="titulo" required
                             value="{{ $livro->titulo ?? old('titulo') }}">
                              @error('titulo')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                        </div>
                        
                        
                        <div class="mb-3">
                            <label class="form-label ">Autor</label>
                            <input type="text" class="form-control @error('autor') is-invalid @enderror"
                             name="autor" required
                             value="{{ $livro->autor ?? old("autor") }}">
                              @error('autor')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label ">Ano de Publicação</label>
                            <input type="text" class="form-control @error('ano_publicacao') is-invalid @enderror" 
                            name="ano_publicacao" required
                            value="{{ $livro->ano_publicacao ?? old("ano_publicacao") }}">
                              @error('ano_publicacao')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                      name="descricao" required>{{ $livro->descricao ?? old("descricao") }}</textarea>
                            @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Endereço Autor --}}
                        <div class="row justify-content-center">
                            <div class="col-md">
                                <div class="card">
                                    <div class="card-header">Endereço do autor</div>
                        
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Cep</label>
                                                    <input type="text" class="form-control @error('cep') is-invalid @enderror"
                                                     name="cep" id="cep" 
                                                     value="{{ $livro->cep ?? old("cep") }}">
                                                    @error('cep')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                        
                                                <div class="mb-3">
                                                    <label class="form-label">Cidade</label>
                                                    <input type="text" class="form-control @error('cidade') is-invalid @enderror"
                                                     name="cidade" id="cidade" 
                                                     value="{{ $livro->cidade ?? old("cidade") }}">
                                                    @error('cidade')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                        
                                                <div class="mb-3">
                                                    <label class="form-label">Estado</label>
                                                    <input type="text" class="form-control @error('estado') is-invalid @enderror"
                                                     name="estado" id="estado" 
                                                     value="{{ $livro->estado ?? old("estado") }}">
                                                    @error('estado')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                        
                                                <div class="mb-3">
                                                    <label class="form-label">Bairro</label>
                                                    <input type="text" class="form-control @error('bairro') is-invalid @enderror"
                                                     name="bairro" id="bairro" 
                                                     value="{{ $livro->bairro ?? old("bairro") }}">
                                                    @error('bairro')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                        
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Rua</label>
                                                    <input type="text" class="form-control @error('rua') is-invalid @enderror" 
                                                    name="rua" id="rua"
                                                    value="{{ $livro->rua ?? old("rua") }}">
                                                    @error('rua')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                        
                                                <div class="mb-3">
                                                    <label class="form-label">Número</label>
                                                    <input type="text" class="form-control @error('numero') is-invalid @enderror"
                                                     name="numero" 
                                                     value="{{ $livro->numero ?? old("numero") }}">
                                                    @error('numero')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                        
                                                <div class="mb-3">
                                                    <label class="form-label">Complemento</label>
                                                    <input type="text" class="form-control @error('complemento') is-invalid @enderror"
                                                     name="complemento"
                                                     value="{{ $livro->complemento ?? old("complemento") }}">
                                                    @error('complemento')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>  
                    <a href="{{ route('livro.index') }}" class="btn btn-primary mt-2">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection