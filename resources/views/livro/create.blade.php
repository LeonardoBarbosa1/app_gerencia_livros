@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Livro</div>

                <div class="card-body">
                    <form method="POST" action="{{ route("livro.store") }}">
                        @csrf
                         @component("livro._components.form_create_edit")
                        @endcomponent
                        <button type="submit" class="btn btn-success mt-2">Salvar</button>
                        <a href="{{ route('livro.index') }}" class="btn btn-primary mt-2 float-sm-end">Voltar</a>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
