<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateEmailRequest extends FormRequest
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
            'id' => 'exists:template_email,id',
            'nome' => 'required',
            'assunto' => 'required',
            'descricao' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'O id do template não foi informado.',
            'id.exists' => 'Esse id de identificação do gatilho não é válido.',
            'nome.required' => 'O campo Nome do Template é obrigatório.',
            'assunto.required' => 'O campo Assunto é obrigatório.',
            'descricao.required' => 'O campo Descrição é obrigatório.',
        ];
    }
}
