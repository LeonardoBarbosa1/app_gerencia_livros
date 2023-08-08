<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Models\Livro;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $livros = Livro::all();
        return view('livro.index', ['livros' => $livros]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livro.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLivroRequest $request)
    {
        $apiKey = 'AIzaSyDRnWFu1lmo6HVYTAKI2fuyss7K3VBIi6A';
        $titulo = $request->titulo; // Título fornecido pelo usuário

        $livroInfo = $this->getLivroInfoFromGoogleBooks($apiKey, $titulo);

        try {
            if (isset($livroInfo['nome_imagem'])) {
                $imagem = file_get_contents($livroInfo['nome_imagem']);
                file_put_contents(storage_path('app/imagem.jpg'), $imagem);
        
                // Salvar informações do livro no banco de dados
                Livro::create([
                    'titulo' => $request->titulo,
                    'autor' => $request->autor,
                    'ano_publicacao' => $request->ano_publicacao,
                    'cep' => $request->cep,
                    'cidade' => $request->cidade,
                    'estado' => $request->estado,
                    'bairro' => $request->bairro,
                    'rua' => $request->rua,
                    'numero' => $request->numero,
                    'complemento' => $request->complemento,
                    'descricao' => $livroInfo['descricao'] ?? null,
                    'nome_imagem' => $livroInfo['nome_imagem'] ?? null,
                    'isbn' => $livroInfo['isbn'] ?? null,
                ]);
        
                // Salvar imagem no bucket do S3
                $tituloSlug = Str::slug($request->titulo, '-');
                Storage::disk('s3')->put($tituloSlug . '.png', $imagem);
            } else {
                // Caso a imagem não seja encontrada, salvar as informações do livro no banco de dados sem a imagem
                Livro::create([
                    'titulo' => $request->titulo,
                    'autor' => $request->autor,
                    'ano_publicacao' => $request->ano_publicacao,
                    'cep' => $request->cep,
                    'cidade' => $request->cidade,
                    'estado' => $request->estado,
                    'bairro' => $request->bairro,
                    'rua' => $request->rua,
                    'numero' => $request->numero,
                    'complemento' => $request->complemento,
                    'descricao' => $livroInfo['descricao'] ?? null,
                    'isbn' => $livroInfo['isbn'] ?? null,
                ]);
            }
        
            return redirect()->route('livro.index')->with('success', 'Livro cadastrado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('livro.index')->with('error', 'Erro ao cadastrar, Livro já cadastrado.');
        }
    }    

    private function getLivroInfoFromGoogleBooks($apiKey, $titulo)
    {
        $response = Http::get("https://www.googleapis.com/books/v1/volumes", [
            'q' => "intitle:{$titulo}",
            'key' => $apiKey,
        ]);

        $livroInfo = [];

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['items'][0]['volumeInfo'])) {
                $volumeInfo = $data['items'][0]['volumeInfo'];
                $livroInfo['descricao'] = $volumeInfo['description'] ?? null;
                $livroInfo['nome_imagem'] = $volumeInfo['imageLinks']['thumbnail'] ?? null;
                $livroInfo['isbn'] = $volumeInfo['industryIdentifiers'][0]['identifier'] ?? null;
            }
        }

        return $livroInfo;
    } 
    /**
     * Display the specified resource.
     */
    public function show(Livro $livro)
    {
        return view('livro.show', ['livro' => $livro ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livro $livro)
    {
        return view('livro.edit', ['livro' => $livro ]);
    }

    /**
     * Update the specified resource in storage.
     */
    

    public function update(UpdateLivroRequest $request, Livro $livro)
{
    $apiKey = 'AIzaSyDRnWFu1lmo6HVYTAKI2fuyss7K3VBIi6A';
    $titulo = $request->titulo; // Título fornecido pelo usuário

    $livroInfo = $this->getLivroInfoFromGoogleBooks($apiKey, $titulo);
    //nome_imagem antiga
    $imagemAntiga = Str::slug($livro->titulo) . '.png';
    
    
    try {
        if (isset($livroInfo['nome_imagem'])) {
            $imagem = file_get_contents($livroInfo['nome_imagem']);
            file_put_contents(storage_path('app/imagem.jpg'), $imagem);

            $novoNomeImagem = Str::slug($request->titulo) . '.png';
            // Atualizar informações do livro no banco de dados
            $livro->update([
                'titulo' => $request->titulo,
                'autor' => $request->autor,
                'ano_publicacao' => $request->ano_publicacao,
                'cep' => $request->cep,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'bairro' => $request->bairro,
                'rua' => $request->rua,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'descricao' => $request->descricao,
                'nome_imagem' => $livroInfo['nome_imagem'] ?? null,
                'isbn' => $livroInfo['isbn'] ?? null,
            ]);
            

            
            // Salvar imagem atualizada no bucket do S3
            $novaImagem = file_get_contents(storage_path('app/imagem.jpg'));
            Storage::disk('s3')->put($novoNomeImagem, $novaImagem);

            // Excluir imagem antiga, se necessário
            if (!empty($imagemAntiga)) {
                Storage::disk('s3')->delete($imagemAntiga);
            }
            
        } else {
            // Atualizar informações do livro no banco de dados sem a imagem
            $livro->update([
                'titulo' => $request->titulo,
                'autor' => $request->autor,
                'ano_publicacao' => $request->ano_publicacao,
                'cep' => $request->cep,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'bairro' => $request->bairro,
                'rua' => $request->rua,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'descricao' => $request->descricao,
                'isbn' => $livroInfo['isbn'] ?? null,
            ]);
        }

        return redirect()->route('livro.index')->with('success', 'Livro atualizado com sucesso.');
    } catch (\Exception $e) {
        return redirect()->route('livro.index')->with('error', 'Erro ao atualizar, Livro já cadastrado.');
    }

}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livro $livro)
    {
        $imagemAntiga = Str::slug($livro->titulo) . '.png';

        
        $livro->delete();

        //verifique se a exclusão do livro foi bem-sucedida antes de excluir a imagem
        if (!$livro->exists) {
            // Exclua a imagem antiga do armazenamento do S3
            Storage::disk('s3')->delete($imagemAntiga);
        }
        return redirect()->route('livro.index')->with('success', 'Livro excluído com sucesso.');
    }
}
