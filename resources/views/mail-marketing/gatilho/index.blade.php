@extends('layouts.default')
@section('content')
<div id="app">
    <h3>Campanhas</h3>
    <form action="">
        <div class="mb-3">
            <label for="campanhaInput" class="form-label">Campanha</label>
            <select class="form-select" id="campanhaInput">
                <option value="">Selecione...</option>
                <option v-for="campanha in campanhas" :value="campanha.id">@{{campanha.versao}}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tagInput" class="form-label">Tag</label>
            <select class="form-select" id="tagInput">
                <option value="">Selecione...</option>
                <option v-for="campanha in campanhas" :value="campanha.id">@{{campanha.versao}}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tipoGatilhoInput" class="form-label">Tipo de gatilho</label>
            <select class="form-select" id="tipoGatilhoInput">
                <option value="">Selecione...</option>
                <option value="IMEDIATAMENTE">IMEDIATAMENTE</option>
                <option value="DATA">DATA</option>
                <option value="SEMANA(S)">SEMANA(S)</option>
                <option value="HORA(S)">HORA(S)</option>
                <option value="MINUTO(S)">MINUTO(S)</option>
                <option value="SEGUNDO(S)">SEGUNDO(S)</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tempoGatilhoInput" class="form-label">Tempo gatilho</label>
            <input type="text" class="form-control" id="tempoGatilhoInput">
        </div>
        <div class="mb-3">
            <label for="dataGatilhoInput" class="form-label">Data gatilho</label>
            <input type="date" class="form-control" id="dataGatilhoInput">
        </div>
        <div class="mb-3">
            <label for="repetirInput" class="form-label">Repetir</label>
            <input type="date" class="form-control" id="repetirInput">
        </div>
    </form>
</div>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const { createApp, ref, onMounted } = Vue

    createApp({
        setup() {

            const campanhas  = ref('')

            const getCampanhas = () => {
                campanhas.value = axios.get('<?= config('app.url') ?>/campanhas');
            }

            // Executa ao montar o componente
            onMounted(() => {
                getCampanhas();
            })


            return {
                campanhas,
                getCampanhas
            }
        }
    }).mount('#app')
</script>
@endsection