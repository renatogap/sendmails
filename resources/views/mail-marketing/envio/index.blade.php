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
                <i class="bi bi-send-fill icone-orange"></i>
                Envios

                <a href="{{url('')}}" style="float: right;">
                    <i class="bi bi-arrow-left-circle-fill icone-dark"></i>
                </a>
            </h3>
            <span class="subtitulo">Lista de e-mails programadodos e enviados para os Leads</span>
            <div class="card-text mt-4">

                <div class="table-responsive">
                    <table class="table table-bordered table-responsived table-hover" width="100%">
                        <thead class="table-secondary">
                            <tr>
                                <th valign="middle">CAMPANHA</th>
                                <th class="text-center" valign="middle">TAG</th>
                                <th valign="middle">LEAD</th>
                                <th class="text-center" valign="middle">GATILHO</th>
                                <th class="text-center" valign="middle">DATA DE ENVIO</th>
                                <th class="text-center" valign="middle">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="envio in envios">
                                <td valign="middle">
                                    <strong>@{{ envio.campanha }}</strong>
                                    <br>
                                    <span style="font-size: 12px; color: #444;">@{{ envio.negocio }}</span>
                                </td>
                                <td class="text-center" valign="middle">@{{ envio.tag }}</td>
                                <td valign="middle">
                                    <div v-if="envio.nome_lead"><strong>@{{ envio.nome_lead }}</strong></div>
                                    <div style="font-size: 12px; color: #444;">@{{ envio.email }}</div>
                                </td>
                                <td class="text-center" valign="middle">@{{ envio.descricao_gatilho }}</td>
                                <td class="text-center" valign="middle">@{{ envio.data_envio }}</td>
                                <td class="text-center" valign="middle" v-html="envio.status_envio"></td>
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
            const envios  = ref('')

            const getEnvios = () => {
                axios.get(`${baseUrl.value}/envios/search`)
                .then(response => {
                    envios.value = response.data
                });
            }

            // Executa ao montar o componente
            onMounted(() => {
                getEnvios();
            })

            return {
                envios,
                baseUrl
            }
        }
    }).mount('#app')
</script>
@endsection