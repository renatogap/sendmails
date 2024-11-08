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
                Novo Gatilho

                <span v-if="reloading" class="spinner-border spinner-border-lg" aria-hidden="true"></span>

                <a href="{{url('gatilhos')}}" style="float: right;">
                    <i class="bi bi-arrow-left-circle-fill icone-dark"></i>
                </a>
            </h3>
            <span class="subtitulo">Configure um gatilho para disparar um e-mail</span>
            <div class="card-text mt-4">
                <form action="" @submit.prevent="salvar">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="campanhaInput" class="form-label">Campanha</label>
                            <select 
                                v-model="form.campanha"
                                class="form-select"
                                id="campanhaInput"
                                required
                            >
                                <option value="">SELECIONE...</option>
                                <option v-for="campanha in campanhas" :value="campanha.id">@{{campanha.nome}} @{{campanha.versao}}</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tagInput" class="form-label">Tag</label>
                            <select 
                                v-model="form.tag"
                                class="form-select" 
                                id="tagInput"
                                required
                            >
                                <option value="">SELECIONE...</option>
                                <option v-for="tag in tags" :value="tag.tag">@{{tag.tag}}</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tipoGatilhoInput" class="form-label">Tipo de gatilho</label>
                            <select 
                                v-model="form.tipoGatilho"
                                class="form-select" 
                                id="tipoGatilhoInput" 
                                @change="mudancaDoTipoDeGatilho"
                                required
                            >
                                <option v-for="tipo in tiposGatilho" :value="tipo.nome">@{{tipo.nome}}</option>
                            </select>
                        </div>

                        <div v-if="form.tipoGatilho == 'DATA'" class="col-md-6 mb-3">
                            <label for="dataGatilhoInput" class="form-label">Data do envio</label>
                            <input 
                                v-model="form.dataGatilho"
                                type="date" 
                                class="form-control" 
                                id="dataGatilhoInput"
                            />
                        </div>

                        <div v-if="form.tipoGatilho != 'IMEDIATAMENTE' && form.tipoGatilho != 'DATA'" class="col-6 col-md-6 mb-3">
                            <label for="tempoGatilhoInput" class="form-label">Tempo de envio</label>
                            <input 
                                v-model="form.tempoGatilho"
                                type="number" 
                                class="form-control" 
                                id="tempoGatilhoInput"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="templateInput" class="form-label">Template</label>
                        <select 
                            v-model="form.template"
                            class="form-select" 
                            id="templateInput"
                            @change="getTemplate"
                            required
                        >
                            <option value="">SELECIONE...</option>
                            <option v-for="template in templates" :value="template.id">@{{template.nome_template}}</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="assuntoInput" class="form-label">Assunto</label>
                        <input
                            v-model="form.assunto"
                            type="text" 
                            class="form-control" 
                            id="assuntoInput"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem</label>
                        <textarea
                            v-model="form.mensagem"
                            class="form-control" 
                            id="mensagem"
                            placeholder="Escreva aqui a mensagem do e-mail..."
                            required
                        ></textarea>
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
                        <a href="{{url('gatilhos')}}" class="btn btn-lg btn-secondary m-1">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
<script src="{{asset('js/vue3.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/l4z4tbu4inx01lyqjzzbybivnylb4upgyrgp8vhelykmmbz4/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mensagem', // Seleciona o textarea
        plugins: 'lists link image preview',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link image | bullist numlist',
        height: 300,
        setup: function(editor) {
            editor.on('change', function() {
                editor.save(); // Salva a edição do conteúdo
            });
        }
    });


    const { createApp, ref, onMounted } = Vue
    const baseUrl = '<?= config('app.url') ?>'

    createApp({
        setup() {

            const form = ref({
                campanha: '',
                tag: '',
                tipoGatilho: 'IMEDIATAMENTE',
                tempoGatilho: '',
                dataGatilho: '',
                repetir: '',
                template: '',
                assunto: '',
                mensagem: ''
            });

            const campanhas  = ref('')
            const tags = ref('')
            const tiposGatilho = ref('')
            const templates  = ref('')
            const messageError = ref('')
            const messageSuccess = ref('')
            const disableButton = ref(false)
            const loading = ref(false)
            const reloading = ref(false)

            const getInfo = () => {
                reloading.value = true

                axios.get(`${baseUrl}/gatilho/info`)
                .then(response => {
                    campanhas.value = response.data.campanhas
                    tags.value = response.data.tags
                    tiposGatilho.value = response.data.tiposGatilho
                    templates.value = response.data.templates
                    reloading.value = false
                })
            }

            const getTemplate = () => {
                form.value.assunto = ''
                form.value.mensagem = ''

                axios.get(`${baseUrl}/template/${form.value.template}`)
                .then(response => {
                    form.value.assunto = response.data.assunto
                    tinymce.get('mensagem').setContent(response.data.descricao)
                })
            }

            const mudancaDoTipoDeGatilho = () => {
                if(form.value.tipoGatilho === 'IMEDIATAMENTE'){
                    form.value.tempoGatilho = '';
                    form.value.dataGatilho = '';
                }
                else if(form.value.tipoGatilho === 'DATA'){
                    form.value.tempoGatilho = '';
                }
                else {
                    form.value.dataGatilho = '';
                }
            }


            const salvar = () => {
                loading.value = true
                disableButton.value = true
                messageSuccess.value = ''
                messageError.value = ''

                form.value.mensagem = tinymce.get('mensagem').getContent() // Captura o conteúdo do editor

                axios.post(`${baseUrl}/gatilho`, form.value)
                    .then(response => {
                        showMessageSuccess(response.data.message)

                        setTimeout(() => {
                            window.location = `${baseUrl}/gatilho/edit/${response.data.gatilho.id}`
                        }, 3000)
                    })
                    .catch(error => {
                        if (error.response) {
                            showMessageError(`${error.response.data.message}: ${error.response.data.error}`);
                            loading.value = false
                            disableButton.value = false
                        }
                    })
                    .finally(() => {
                        //disableButton.value = false
                        //loading.value = false
                    });
                    
            }

            const showMessageSuccess = (message) => {
                messageSuccess.value = message
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
                campanhas,
                tags,
                tiposGatilho,
                templates,
                messageError,
                messageSuccess,
                disableButton,
                form,
                mudancaDoTipoDeGatilho,
                getTemplate,
                salvar,
                loading,
                reloading
            }
        }
    }).mount('#app')
</script>
@endsection