@extends('layouts.default')
@section('content')
<style>
    .table {
        border-radius: 5px !important;
    }
    .botao-acao {
        color: orangered;
    }

    table tr td, table tr th {
        font-size: 14px;
    }
</style>
<div id="app">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">
                <i class="bi bi-card-heading icone-orange"></i>
                Templates de E-mail

                <a href="{{url('')}}" style="float: right;">
                    <i class="bi bi-arrow-left-circle-fill icone-dark"></i>
                </a>
            </h3>
            <span class="subtitulo">Lista de templates para envio de e-mails registrados</span>
            <div class="card-text mt-4">
                
                <a 
                    type="submit" 
                    class="btn botao mb-2"
                    href="{{url('template/create')}}"
                >
                    <i class="bi bi-plus"></i>
                    Novo Template
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered table-responsived table-hover" width="100%">
                        <thead class="table-secondary">
                            <tr>
                                <th width="25%" valign="middle">NOME TEMPLATE</th>
                                <th width="30%" valign="middle">ASSUNTO DO E-MAIL</th>
                                <th width="30%" class="text-center" valign="middle">DESCRIÇÃO</th>
                                <th width="15%" class="text-center" valign="middle">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="template in templates">
                                <td>@{{ template.nome_template }}</td>
                                <td>@{{ template.assunto }}</td>
                                <td v-html="template.descricao"></td>
                                <td class="text-center" width="10%">
                                    <a :href="`${baseUrl}/template/edit/${template.id}`" class="btn botao-acao">
                                        <i class="bi bi-pencil-square icone-orange-md"></i> 
                                    </a>
                                    <a href="#" class="botao-acao btn">
                                        <i class="bi bi-trash3-fill icone-orange-md"></i>
                                    <a href="#">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script src="{{asset('js/vue3.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script>

    const { createApp, ref, onMounted } = Vue
    
    createApp({
        setup() {
            const baseUrl = ref('<?= config('app.url') ?>')
            const templates  = ref('')

            const getTemplates = () => {
                axios.get(`${baseUrl.value}/templates/search`)
                .then(response => {
                    templates.value = response.data
                });
            }

            // Executa ao montar o componente
            onMounted(() => {
                getTemplates();
            })

            return {
                templates,
                baseUrl
            }
        }
    }).mount('#app')
</script>
@endsection