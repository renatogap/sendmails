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
                <i class="bi bi-bullseye icone-orange"></i>
                Gatilhos de envio

                <a href="{{url('')}}" style="float: right;">
                    <i class="bi bi-arrow-left-circle-fill icone-dark"></i>
                </a>
            </h3>
            <span class="subtitulo">Lista de gatilhos para envio de e-mails registrados</span>
            <div class="card-text mt-4">
                
                <a 
                    type="submit" 
                    class="btn botao mb-2"
                    href="{{url('gatilho/create')}}"
                >
                    <i class="bi bi-plus"></i>
                    Novo Gatilho
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered table-responsived table-hover" width="100%">
                        <thead class="table-secondary">
                            <tr>
                                <th valign="middle">CAMPANHAS</th>
                                <th class="text-center" valign="middle">TAG</th>
                                <th valign="middle">ASSUNTO DO E-MAIL</th>
                                <th class="text-center" valign="middle">TIPO GATILHO</th>
                                <th class="text-center" valign="middle">TEMPO DE<br />ENVIO</th>
                                <th class="text-center" valign="middle">DATA DO<br />ENVIO</th>
                                <th class="text-center" valign="middle">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="gatilho in gatilhos">
                                <td>
                                    <strong>@{{ gatilho.campanha.nome }}</strong>
                                </td>
                                <td>@{{ gatilho.tag }}</td>
                                <td>@{{ gatilho.assunto }}</td>
                                <td class="text-center">@{{ gatilho.tipo_disparo }}</td>
                                <td class="text-center">@{{ gatilho.tempo_disparo }}</td>
                                <td class="text-center" width="15%">@{{ gatilho.data_disparo }}</td>
                                <td class="text-center" width="10%">
                                    <a :href="`${baseUrl}/gatilho/edit/${gatilho.id}`" class="btn botao-acao">
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
            const gatilhos  = ref('')

            const getGatilhos = () => {
                axios.get(`${baseUrl.value}/gatilhos/search`)
                .then(response => {
                    gatilhos.value = response.data
                });
            }

            // Executa ao montar o componente
            onMounted(() => {
                getGatilhos();
            })

            return {
                gatilhos,
                baseUrl
            }
        }
    }).mount('#app')
</script>
@endsection