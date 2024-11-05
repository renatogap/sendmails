@extends('layouts.default')
@section('content')
<style>
    .table {
        border-radius: 5px !important;
    }
    .botao-acao {
        color: orangered;
    }

    table tr td {
        font-size: 14px;
    }
</style>
<div id="app">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">
                <i class="bi bi-bullseye" style="font-size: 2rem; color: orangered;"></i>
                Gatilhos de envio
            </h3>
            <span class="subtitulo">Lista de gatilhos para envio de e-mails registrados</span>
            <div class="card-text mt-4">
                
                <a 
                    type="submit" 
                    class="btn btn-lg botao mb-2"
                    href="{{url('gatilho/create')}}"
                >
                    Novo Gatilho
                </a>

                <table class="table table-bordered table-responsive table-hover" width="100%">
                    <thead class="table-secondary">
                        <tr>
                            <th valign="middle">CAMPANHAS</th>
                            <th valign="middle">ASSUNTO DO E-MAIL</th>
                            <th valign="middle">TIPO GATILHO</th>
                            <th>TEMPO DE<br />ENVIO</th>
                            <th>DATA DO<br />ENVIO</th>
                            <th valign="middle">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="gatilho in gatilhos">
                            <td>
                                <strong>@{{ gatilho.campanha.nome }}</strong>
                                <div style="font-size: 13px; color: gray;">
                                    <strong>Tag:</strong> @{{ gatilho.tag }}
                                </div>
                            </td>
                            <td>@{{ gatilho.assunto }}</td>
                            <td class="text-center">@{{ gatilho.tipo_disparo }}</td>
                            <td class="text-center">@{{ gatilho.tempo_disparo }}</td>
                            <td class="text-center">@{{ gatilho.data_disparo }}</td>
                            <td>
                                <a :href="`${baseUrl}/gatilho/edit/${gatilho.id}`" class="botao-acao m-3">
                                    <i class="bi bi-pencil-square" style="font-size: 20px;"></i> 
                                </a>
                                <a href="#" class="botao-acao">
                                    <i class="bi bi-trash3-fill" style="font-size: 20px;"></i>
                                <a href="#">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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