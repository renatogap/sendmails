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
                <i class="bi bi-tags-fill icone-orange"></i>
                Leads

                <a href="{{url('')}}" style="float: right;">
                    <i class="bi bi-arrow-left-circle-fill icone-dark"></i>
                </a>
            </h3>
            <span class="subtitulo">Lista de leads registrados na inscrição</span>
            <div class="card-text mt-4">
                
                <div>
                    <strong>TOTAL: </strong> @{{ leads.length }} lead(s) inscritos
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-responsived table-hover" width="100%">
                        <thead class="table-secondary">
                            <tr>
                                <th valign="middle">#</th>
                                <th valign="middle">CAMPANHA</th>
                                <th valign="middle">LEAD</th>
                                <th class="text-center" valign="middle">TAG</th>
                                <th class="text-center" valign="middle">CRIADO EM</th>
                                <th width="15%" class="text-center" valign="middle">STATUS DA INSCRIÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(lead, i) in leads" key="lead.id">
                                <td valign="middle">@{{i+1}}</td>
                                <td valign="middle">
                                    <strong>@{{ lead.campanha.nome }}</strong>
                                </td>
                                <td valign="middle">
                                    <div v-if="lead.nome">@{{ lead.nome }}</div>
                                    <div>@{{ lead.email }}</div>
                                    <div v-if="lead.telefone">@{{ lead.telefone }}</div>
                                </td>
                                <td 
                                    valign="middle"
                                    class="text-center" 
                                    v-for="item in lead.lead_tags"
                                >
                                    <span class="badge text-bg-warning"><i class="bi bi-tags-fill"></i> @{{ item.tag }}</span>
                                </td>
                                <td 
                                    valign="middle" 
                                    class="text-center" 
                                    width="15%"
                                >
                                    @{{ lead.created_at }}
                                </td>
                                <td 
                                    valign="middle" 
                                    class="text-center" 
                                    width="10%" 
                                    v-html="lead.status == 1 ? '<span class=\'badge text-bg-success\'>ATIVO</span>' : '<span class=\'badge text-bg-danger\'>CANCELADO</span>'"
                                >
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
            const leads  = ref('')

            const getLeads = () => {
                axios.get(`${baseUrl.value}/leads/search`)
                .then(response => {
                    leads.value = response.data
                });
            }

            // Executa ao montar o componente
            onMounted(() => {
                getLeads();
            })

            return {
                leads,
                baseUrl
            }
        }
    }).mount('#app')
</script>
@endsection