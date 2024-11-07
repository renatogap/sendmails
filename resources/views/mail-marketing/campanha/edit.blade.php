@extends('layouts.default')
@section('content')
<style>
    .tox-tinymce {
        border: 1px solid #ccc;
    }
</style>
<div id="app">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">
                Editar Campanha

                <span v-if="reloading" class="spinner-border spinner-border-lg" aria-hidden="true"></span>

                <a href="{{url('campanhas')}}" style="float: right;">
                    <i class="bi bi-arrow-left-circle-fill icone-dark"></i>
                </a>
            </h3>
            <span class="subtitulo">Formulário para editar uma campanha</span>
            <div class="card-text mt-4">
                <form action="" @submit.prevent="salvar">
                    @csrf

                    <div class="mb-3">
                        <label for="negocioInput" class="form-label">Negócio</label>
                        <select 
                            v-model="form.negocio"
                            class="form-select"
                            id="negocioInput"
                            required
                        >
                            <option value="">SELECIONE...</option>
                            <option v-for="negocio in negocios" :value="negocio.id">@{{negocio.nome_metodo}}</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="campanhaInput" class="form-label">Campanha</label>
                        <input 
                            type="text"
                            v-model="form.campanha"
                            class="form-control"
                            id="campanhaInput"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="versaoInput" class="form-label">Versão</label>
                        <input 
                            type="text"
                            v-model="form.versao"
                            class="form-control"
                            id="versaoInput"
                            required
                        />
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="dataInicioCampanha" class="form-label">Início da Campanha</label>
                            <input 
                                v-model="form.dataInicioCampanha"
                                type="datetime-local" 
                                class="form-control" 
                                id="dataInicioCampanha"
                            />
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="dataTerminoCampanha" class="form-label">Término da Campanha</label>
                            <input 
                                v-model="form.dataTerminoCampanha"
                                type="datetime-local" 
                                class="form-control" 
                                id="dataTerminoCampanha"
                            />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-md-4 mb-3">
                            <label for="metaLeadsInput" class="form-label">Meta de Leads</label>
                            <input 
                                v-model="form.metaLeads"
                                type="number" 
                                class="form-control" 
                                id="metaLeadsInput"
                            />
                        </div>
                        
                        <div class="col-6 col-md-4 mb-3">
                            <label for="metaLeadsLiveInput" class="form-label">Meta de Leads na Live</label>
                            <input
                                v-model="form.metaLeadsLive"
                                type="number" 
                                class="form-control" 
                                id="metaLeadsLiveInput"
                            />
                        </div>
                    </div>

                    <div class="mt-3">
                        <div v-if="messageError" class="alert alert-danger">@{{messageError}}</div>
                        <div v-if="messageSuccess" class="alert alert-success">@{{messageSuccess}}</div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-lg botao" :disabled="disableButton">
                            <span v-if="loading" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span v-if="loading" role="status"> Aguarde...</span>
                            <span v-if="!loading" role="status"> Salvar</span>
                        </button>
                        <a href="{{url('campanhas')}}" class="btn btn-lg btn-secondary m-1">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
<script src="{{asset('js/vue3.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script>

    const { createApp, ref, onMounted } = Vue
    const baseUrl = '<?= config('app.url') ?>'

    createApp({
        setup() {

            const form = ref({
                id: '{{ $campanha->id }}',
                negocio: '{{ $campanha->negocio_id }}',
                campanha: '{{ $campanha->nome }}',
                versao: '{{ $campanha->versao }}',
                dataInicioCampanha: '{{ $campanha->dt_inicio_campanha }}',
                dataTerminoCampanha: '{{ $campanha->dt_termino_campanha }}',
                metaLeads: '{{ $campanha->meta_captura_leads }}',
                metaLeadsLive: '{{ $campanha->meta_leads_na_live }}',
            });

            const negocios  = ref('')
            const messageError = ref('')
            const messageSuccess = ref('')
            const disableButton = ref(false)
            const loading = ref(false)
            const reloading = ref(false)

            const getInfo = () => {
                reloading.value = true

                axios.get(`${baseUrl}/campanha/info`)
                .then(response => {
                    negocios.value = response.data.negocios
                    reloading.value = false
                })
            }

            const salvar = () => {
                loading.value = true
                disableButton.value = true
                messageSuccess.value = ''
                messageError.value = ''

                axios.put(`${baseUrl}/campanha/${form.value.id}`, form.value)
                    .then(response => {
                        showMessageSuccess(response.data.message)
                    })
                    .catch(error => {
                        if (error.response) {
                            showMessageError(`${error.response.data.message}: ${error.response.data.error}`)
                        }
                    })
                    .finally(() => {
                        disableButton.value = false
                        loading.value = false
                    });
                    
            }

            const showMessageSuccess = (message) => {
                messageSuccess.value = message

                setTimeout(() => {
                    messageSuccess.value = ''
                }, 5000)
            }

            const showMessageError = (message) => {
                messageError.value = message

                setTimeout(() => {
                    messageError.value = ''
                }, 7000)
            }

            // Executa ao montar o componente
            onMounted(() => {
                getInfo();
            })


            return {
                negocios,
                messageError,
                messageSuccess,
                disableButton,
                form,
                salvar,
                loading,
                reloading
            }
        }
    }).mount('#app')
</script>
@endsection