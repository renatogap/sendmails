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
                <i class="bi bi-boxes icone-orange"></i>
                Campanhas

                <a href="{{url('')}}" style="float: right;">
                    <i class="bi bi-arrow-left-circle-fill icone-dark"></i>
                </a>
            </h3>
            <span class="subtitulo">Lista de campanhas registradas</span>
            <div class="card-text mt-4">
                
                <a 
                    type="submit" 
                    class="btn botao mb-2"
                    href="{{url('campanha/create')}}"
                >
                    <i class="bi bi-plus"></i>
                    Nova Campanha
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered table-responsived table-hover" width="100%">
                        <thead class="table-secondary">
                            <tr>
                                <th valign="middle">CAMPANHAS</th>
                                <th valign="middle">VERSÃO</th>
                                <th valign="middle">INÍCIO</th>
                                <th valign="middle">TÉRMINO</th>
                                <th valign="middle">META LEAD</th>
                                <th valign="middle">META LIVE</th>
                                <th valign="middle">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="campanha in campanhas">
                                <td>
                                    <strong>@{{ campanha.nome }}</strong>
                                </td>
                                <td>@{{ campanha.versao }}</td>
                                <td>@{{ campanha.dt_inicio_campanha }}</td>
                                <td class="text-center">@{{ campanha.dt_termino_campanha }}</td>
                                <td class="text-center">@{{ campanha.meta_captura_leads }}</td>
                                <td class="text-center" width="15%">@{{ campanha.meta_leads_na_live }}</td>
                                <td class="text-center" width="10%">
                                    <a :href="`${baseUrl}/campanha/edit/${campanha.id}`" class="btn botao-acao">
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
            const campanhas  = ref('')

            const getCampanhas = () => {
                axios.get(`${baseUrl.value}/campanhas/search`)
                .then(response => {
                    campanhas.value = response.data
                });
            }

            // Executa ao montar o componente
            onMounted(() => {
                getCampanhas();
            })

            return {
                campanhas,
                baseUrl
            }
        }
    }).mount('#app')
</script>
@endsection