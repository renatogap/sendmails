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
                Novo Template de E-mail

                <span v-if="reloading" class="spinner-border spinner-border-lg" aria-hidden="true"></span>

                <a href="{{url('templates')}}" style="float: right;">
                    <i class="bi bi-arrow-left-circle-fill icone-dark"></i>
                </a>
            </h3>
            <span class="subtitulo">Formulário para cadastro de novo template de e-mail</span>
            <div class="card-text mt-4">
                <form action="" @submit.prevent="salvar">
                    @csrf

                    <div class="mb-3">
                        <label for="nomeInput" class="form-label">Nome do template</label>
                        <input 
                            v-model="form.nome"
                            class="form-control"
                            id="nomeInput"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="assuntoInput" class="form-label">Assunto</label>
                        <input 
                            v-model="form.assunto"
                            class="form-control" 
                            id="assuntoInput"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descricao</label>
                        <textarea
                            v-model="form.descricao"
                            class="form-control" 
                            id="descricao"
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
                        <a href="{{url('templates')}}" class="btn btn-lg btn-secondary m-1">Cancelar</a>
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
        selector: '#descricao', // Seleciona o textarea
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
                nome: '',
                assunto: '',
                descricao: ''
            });

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

                form.value.descricao = tinymce.get('descricao').getContent() // Captura o conteúdo do editor

                axios.post(`${baseUrl}/template`, form.value)
                    .then(response => {
                        showMessageSuccess(response.data.message)

                        setTimeout(() => {
                            window.location = `${baseUrl}/template/edit/${response.data.template.id}`
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


            return {
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