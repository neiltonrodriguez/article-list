<script setup>
import { ref, onMounted } from "vue";
import http from "../services/http.js";
import moment from "moment";
import NavSite from "../components/NavSite.vue";
import router from "../router";


const articles = ref([]);
const total = ref();
const current = ref();
const pages = ref([]);

function convertDate(date) {
    return moment(date).format("DD/MM/YYYY");
}

function changePage(i) {
    getArticles(i);

}

function details(id){
    router.push('/' + id)
}

function getArticles(i = null) {
    let page = 1
    if (i != null) {

        page = i
    }
    current.value = page
    const url = `/article?page=${page}`

    http
        .get(url)
        .then((res) => {
            articles.value = res.data.data;
            total.value = res.data.total
            const qty = Math.ceil(total.value / 2)

            if (qty <= 1) return [1];
            pages.value = Array.from(Array(qty).keys(), (i) => i + 1)

        })
        .catch((e) => {
            swal("Erro!", e.message, "error");
        });
}

onMounted(() => {
    getArticles();
});
</script>
<template>
    <div>
        <NavSite />
        <div class="w-full flex items-center justify-center bg-gray">
            <div class="w-full max-w-7xl bg-white h-screen p-5">
                <div class="">
                    <h1 class="text-4xl font-bold text-dark mt-10">Blog</h1>
                    <div class="border-b-4 border-bar-orange max-w-7"></div>
                </div>
                <div class="w-full">
                    <ul>
                        <li v-for="a in articles" :key="a.id" @click="details(a.id)" >
                            <div class="shadow-lg w-full h-full cursor-pointer hover:bg-slate-50 duration-200 flex rounded-lg mt-10">
                                <div class="">
                                    <img :src="a.image" class="md:w-80 w-72 rounded-md">
                                    
                                </div>
                                <div class="p-2 w-full">
                                    <h3 class="font-semibold md:text-2xl text-principal text-lg">{{  a.title }}</h3> 
                                    <p class="text-slate-400 line-clamp-2">{{ a.description }}</p>
                                    <p class="text-end text-principal text-sm">ler mais</p>
        
                                </div>
                            </div>

                        </li>
                    </ul>
                   
                </div>
                 <div class="flex gap-2 items-center justify-center mt-10">
                <button class="bg-principal p-2 hover:bg-teal-800 duration-200 rounded-md gap-2 text-white" 
                :class="{ 'bg-teal-700': current == page }"
                v-for="(page, index) in pages" :key="page" @click="changePage(page)">
                    {{ page }}
                </button>
                <span>total de registros: {{ total }}</span>
            </div>
            </div>

        </div>
    </div>
</template>

<style></style>