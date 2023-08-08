<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:100',
            'ano_publicacao' => 'required|numeric|min:1900|max:' . (date('Y')+1),
            'autor' => 'required|string|max:100',
            'cep' => 'nullable|string|max:10',
            'cidade' => 'nullable|string|max:100',
            'estado' => 'nullable|string|max:50',
            'bairro' => 'nullable|string|max:100',
            'rua' => 'nullable|string|max:100',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'descricao' => 'nullable|string',
            'nome_imagem' => 'nullable|string|max:255',
        ];
        
    }
    public function messages(): array
    {
        return [
            'required' =>  'O campo :Attribute é obrigatório.',
            'max' => 'O campo :Attribute deve ter no máximo :max caracteres.',
            'string' => 'O campo :Attribute deve ser uma string.',
            'ano_publicacao.numeric' => 'O campo ano de publicação deve ser um número.',
            'ano_publicacao.min' => 'O campo ano de publicação deve ser no mínimo :min.',
        ];
    }
    
}
