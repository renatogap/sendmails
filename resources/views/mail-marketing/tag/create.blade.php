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
                Nova Tag

                <span v-if="reloading" class="spinner-border spinner-border-lg" aria-hidden="true"></span>

                <a href="{{url('tags')}}" style="float: right;">
                    <i class="bi bi-tags-fill icone-dark"></i>
                </a>
            </h3>
            <span class="subtitulo">Formulário de cadastro de tag</span>
            <div class="card-text mt-4">
                <form action="" @submit.prevent="salvar">
                    @csrf

                    <div class="mb-3">
                        <label for="nomeTagInput" class="form-label">Nome</label>
                        <input 
                            type="text"
                            v-model="form.nome"
                            class="form-control"
                            id="nomeTagInput"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="tagInput" class="form-label">Tag</label>
                        <input 
                            type="text"
                            v-model="form.tag"
                            class="form-control" 
                            id="tagInput"
                            required
                        >
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
<script>

    const { createApp, ref, onMounted } = Vue
    const baseUrl = '<?= config('app.url') ?>'

    createApp({
        setup() {

            const form = ref({
                nome: '',
                tag: ''
            });

            const nome  = ref('')
            const tags = ref('')
            const messageError = ref('')
            const messageSuccess = ref('')
            const disableButton = ref(false)
            const loading = ref(false)
            const reloading = ref(false)

            const salvar = () => {
                loading.value = true
                disableButton.value = true
                messageSuccess.value = ''
                messageError.value = ''

                axios.post(`${baseUrl}/tag`, form.value)
                    .then(response => {
                        showMessageSuccess(response.data.message)

                        setTimeout(() => {
                            window.location = `${baseUrl}/tag/edit/${response.data.tag.id}`
                        }, 3000)
                    })
                    .catch(error => {
                        if (error.response) {
                            showMessageError(`${error.response.data.message}: ${error.response.data.error}`);
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

            return {
                nome,
                tags,
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