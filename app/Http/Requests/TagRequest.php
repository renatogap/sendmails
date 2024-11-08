<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'exists:tag,id',
            'tag' => 'required',
            'nome' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O id da tag não foi informado.',
            'id.exists' => 'Esse id de identificação da tag não é válido.',
            'tag.required' => 'O campo tag é obrigatório.',
            'nome.required' => 'O campo nome é obrigatório.'
        ];
    }
}
