<template>
    <div id="drawer-example" class="left-0 z-40 top-0 border-2 max-w-lg fixed h-screen p-4 bg-white w-full"
        aria-labelledby="drawer-label">
        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-2xl font-semibold text-teal-800">
            Nova Transaction
        </h5>
        <button @click="$emit('fechar')" type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>

        </button>

        <p class="mb-6 text-sm text-gray-500"></p>
        <form v-on:submit.prevent="createArticles(payload)">
            <div>
                <div class="mt-3">
                    <label>titulo</label>
                    <input v-model="payload.title" class="border bg-slate-100 w-full rounded-lg p-2">
                </div>
         
                <div class="mt-3">
                    <label>valor R$</label>
                    <input type="number" v-model="payload.value" class="border rounded-lg bg-slate-100 w-full p-2">
                </div>
                <div class="mt-3">
                    <label>descrição</label>
                    <input v-model="payload.description" class="border rounded-lg bg-slate-100 w-full p-2">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-10">
                <button @click="$emit('fechar')"
                    class="px-4 py-2 text-sm font-medium text-center text-white bg-gray-800 border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-200">Cancelar</button>
                <button @click="$emit('payload', payload)"
                    class="inline-flex items-center px-4 py-2 text-sm justify-center font-medium text-center text-white bg-teal-600 rounded-lg hover:bg-teal-700 focus:ring-4 focus:ring-blue-300">Cadastrar
                </button>
            </div>
        </form>

    </div>
</template>

<script setup>
import { ref, onMounted, inject } from 'vue'
import http from "../services/http";

const payload = ref({})

const articles = ref([]);

const swal = inject("$swal");


defineEmits(['payload', 'fechar']);


function getArticles() {
    http
        .get("/article")
        .then((res) => {
            articles.value = res.data.data;
        })
        .catch((e) => {
            swal("Erro!", "Email ou senha incorreta", "error");
        });
}

onMounted(() => {
    getArticles();
});
</script>