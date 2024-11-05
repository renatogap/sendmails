@extends('layouts.default')
@section('content')
<div id="app">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">Novo Gatilho</h3>
            <span class="subtitulo">Configure um gatilho para disparar um e-mail</span>
            <div class="card-text mt-4">
                <form action="" @submit.prevent="salvar">
                    @csrf

                    <div class="mb-3">
                        <label for="campanhaInput" class="form-label">Campanha</label>
                        <select 
                            v-model="form.campanha"
                            class="form-select form-select-lg"
                            id="campanhaInput"
                            required
                        >
                            <option value="">SELECIONE...</option>
                            <option v-for="campanha in campanhas" :value="campanha.id">@{{campanha.nome}} @{{campanha.versao}}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tagInput" class="form-label">Tag</label>
                        <select 
                            v-model="form.tag"
                            class="form-select form-select-lg" 
                            id="tagInput"
                            required
                        >
                            <option value="">SELECIONE...</option>
                            <option v-for="tag in tags" :value="tag.tag">@{{tag.tag}}</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="tipoGatilhoInput" class="form-label">Tipo de gatilho</label>
                            <select 
                                v-model="form.tipoGatilho"
                                class="form-select form-select-lg" 
                                id="tipoGatilhoInput" 
                                @change="mudancaDoTipoDeGatilho"
                                required
                            >
                                <option v-for="tipo in tiposGatilho" :value="tipo.nome">@{{tipo.nome}}</option>
                            </select>
                        </div>

                        <div v-if="form.tipoGatilho == 'DATA'" class="col-md-4 mb-3">
                            <label for="dataGatilhoInput" class="form-label">Data do envio</label>
                            <input 
                                v-model="form.dataGatilho"
                                type="date" 
                                class="form-control form-control-lg" 
                                id="dataGatilhoInput"
                            />
                        </div>

                        <div v-if="form.tipoGatilho != 'IMEDIATAMENTE' && form.tipoGatilho != 'DATA'" class="col-6 col-md-4 mb-3">
                            <label for="tempoGatilhoInput" class="form-label">Tempo de envio</label>
                            <input 
                                v-model="form.tempoGatilho"
                                type="number" 
                                class="form-control form-control-lg" 
                                id="tempoGatilhoInput"
                            />
                        </div>
                        
                        <div v-if="form.tipoGatilho != 'IMEDIATAMENTE' && form.tipoGatilho != 'DATA'" class="col-6 col-md-4 mb-3">
                            <label for="repetirInput" class="form-label">Repetir</label>
                            <input
                                v-model="form.repetir"
                                type="number" 
                                class="form-control form-control-lg" 
                                id="repetirInput"
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="assuntoInput" class="form-label">Assunto</label>
                        <input
                            v-model="form.assunto"
                            type="text" 
                            class="form-control form-control-lg" 
                            id="assuntoInput"
                            required
                        />
                    </div>

                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem</label>
                        <textarea
                            v-model="form.mensagem"
                            class="form-control form-control-lg" 
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
                            <span class="spinner-border spinner-border-lg" aria-hidden="true"></span>
                            <span class="visually-hidden" role="status">Loading...</span>
                            <span role="status"> Salvar</span>
                        </button>
                        <button type="button" class="btn btn-lg btn-secondary m-1">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://cdn.tiny.cloud/1/l4z4tbu4inx01lyqjzzbybivnylb4upgyrgp8vhelykmmbz4/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>



<script>
    tinymce.init({
        selector: '#mensagem', // Seleciona o textarea
        plugins: 'lists link image preview',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link image | bullist numlist',
        height: 200,
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
                assunto: '',
                mensagem: ''
            });

            const campanhas  = ref('')
            const tags = ref('')
            const tiposGatilho = ref('')
            const messageError = ref('')
            const messageSuccess = ref('')
            const disableButton = ref(false)

            const getCampanhas = () => {
                axios.get(`${baseUrl}/campanhas/list`)
                .then(response => {
                    campanhas.value = response.data
                });
            }

            const getTags = () => {
                axios.get(`${baseUrl}/tags/list`)
                .then(response => {
                    tags.value = response.data
                });
            }

            const getTiposGatilho = () => {
                axios.get(`${baseUrl}/tipos-gatilho/list`)
                .then(response => {
                    tiposGatilho.value = response.data
                });
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

            const getEditorContent = () => {
                return quill.root.innerHTML; // Captura o conteúdo do editor
            }

            const salvar = () => {
                disableButton.value = true
                messageSuccess.value = ''
                messageError.value = ''

                form.value.mensagem = tinymce.get('mensagem').getContent() // Captura o conteúdo do editor

                axios.post(`${baseUrl}/gatilho`, form.value)
                    .then(response => {
                        messageSuccess.value = response.data.message
                        console.log(response.data)
                    })
                    .catch(error => {
                        if (error.response) {
                            // A solicitação foi feita e o servidor respondeu com um status fora do alcance de 2xx
                            messageError.value = `${error.response.data.message}: ${error.response.data.error}`;
                            console.log(error.response.data)
                            // Aqui você pode tratar os erros de validação e exibir mensagens
                        }
                    })
                    .finally(() => {
                        disableButton.value = false
                    });
                    
            }

            

            // Executa ao montar o componente
            onMounted(() => {
                getCampanhas();
                getTags();
                getTiposGatilho();
            })


            return {
                campanhas,
                tags,
                tiposGatilho,
                messageError,
                messageSuccess,
                disableButton,
                form,
                mudancaDoTipoDeGatilho,
                salvar
            }
        }
    }).mount('#app')
</script>
@endsection