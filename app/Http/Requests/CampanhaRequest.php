<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampanhaRequest extends FormRequest
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
            'id' => 'exists:campanha,id',
            'negocio' => 'required',
            'campanha' => 'required',
            'versao' => 'required',
            'dataInicioCampanha' => 'required',
            'dataTerminoCampanha' => 'required',
            'metaLeads' => 'required',
            'metaLeadsLive' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            // 'id.required' => 'O id do gatilho não foi informado.',
            // 'id.exists' => 'Esse id de identificação do gatilho não é válido.',
            // 'campanha.required' => 'O campo campanha é obrigatório.',
            // 'tag.required' => 'O campo tag é obrigatório.',
            // 'tipoGatilho.required' => 'O campo tipo de gatilho é obrigatório.',
            // 'dataGatilho.required_if' => 'O campo data é obrigatório quando o tipo de gatilho é "DATA".',
            // 'dataGatilho.date' => 'O campo data deve ser uma data válida.',
            // 'tempoGatilho.required_unless' => 'O campo tempo de envio é obrigatório quando o tipo de gatilho não é "IMEDIATAMENTE" nem "DATA".',
            // 'tempoGatilho.integer' => 'O campo tempo de envio deve ser um número inteiro.',
            // 'assunto.required' => 'O campo Assunto é obrigatório.',
            // 'mensagem.required' => 'O campo Mensagem é obrigatório.',
        ];
    }
}
