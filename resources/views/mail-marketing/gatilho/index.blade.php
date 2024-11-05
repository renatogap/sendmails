@extends('layouts.default')
@section('content')
<style>
    .table {
        border-radius: 5px !important;
    }
    .botao-acao {
        color: orangered;
    }
</style>
<div id="app">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">Gatilhos de envio</h3>
            <span class="subtitulo">Lista de gatilhos para envio de e-mails registrados</span>
            <div class="card-text mt-4">
                <table class="table table-bordered table-responsive table-hover" width="100%">
                    <tr>
                        <th>CAMPANHAS</th>
                        <th>ASSUNTO</th>
                        <th>TIPO GATILHO</th>
                        <th>TEMPO DE<br />ENVIO</th>
                        <th>DATA DO<br />ENVIO</th>
                        <th>AÇÕES</th>
                    </tr>
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
                            <a href="#" class="botao-acao m-3">
                                <i class="bi bi-pencil-square" style="font-size: 20px;"></i> 
                            </a>
                            <a href="#" class="botao-acao">
                                <i class="bi bi-trash3-fill" style="font-size: 20px;"></i>
                            <a href="#">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
</div>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

    const { createApp, ref, onMounted } = Vue
    const baseUrl = '<?= config('app.url') ?>'

    createApp({
        setup() {

            const gatilhos  = ref('')

            const getGatilhos = () => {
                axios.get(`${baseUrl}/gatilhos/search`)
                .then(response => {
                    gatilhos.value = response.data
                });
            }


            

            // Executa ao montar o componente
            onMounted(() => {
                getGatilhos();
            })


            return {
                gatilhos
            }
        }
    }).mount('#app')
</script>
@endsection