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
                Tags

                <a href="{{url('')}}" style="float: right;">
                    <i class="bi bi-arrow-left-circle-fill icone-dark"></i>
                </a>
            </h3>
            <span class="subtitulo">Lista de tags registradas</span>
            <div class="card-text mt-4">
                
                <a 
                    type="submit" 
                    class="btn botao mb-2"
                    href="{{url('tag/create')}}"
                >
                    <i class="bi bi-plus"></i>
                    Nova Tag
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered table-responsived table-hover" width="100%">
                        <thead class="table-secondary">
                            <tr>
                                <th valign="middle">NOME</th>
                                <th class="text-center" valign="middle">TAG</th>
                                <th class="text-center" valign="middle">CRIADA EM</th>
                                <th width="15%" class="text-center" valign="middle">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="tag in tags">
                                <td>
                                    <strong>@{{ tag.nome }}</strong>
                                </td>
                                <td>@{{ tag.tag }}</td>
                                <td class="text-center" width="15%">@{{ tag.created_at }}</td>
                                <td class="text-center" width="10%">
                                    <a :href="`${baseUrl}/tag/edit/${tag.id}`" class="btn botao-acao">
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
            const tags  = ref('')

            const getTags = () => {
                axios.get(`${baseUrl.value}/tags/search`)
                .then(response => {
                    tags.value = response.data
                });
            }

            // Executa ao montar o componente
            onMounted(() => {
                getTags();
            })

            return {
                tags,
                baseUrl
            }
        }
    }).mount('#app')
</script>
@endsection