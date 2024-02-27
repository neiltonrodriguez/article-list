<template>
    <NavSite />
    <div class="mt-3 max-w-7xl focus-visible: rounded-xl m-auto w-full h-full">


        <div class="mt-10">
           <div class="flex flex-col items-center justify-center">
            <h1 class="font-bold text-4xl text-dark">{{ article.title }}</h1>
             <div class="border-b-4 border-bar-orange w-56 mt-5"></div>
            <img :src="article.image" class=" mt-10 w-full max-w-4xl rounded-lg">
           <div class="text-mediun mt-10 text-center max-w-7xl justify-center"><pre>{{article.text}}</pre></div>
            
            </div>
        </div>
      
    </div>

 
    <div>
       

    </div>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";
import http from "../services/http.js";
import router from "../router/index.js";
import moment from "moment";
import { useRoute } from 'vue-router'
import NavSite from "../components/NavSite.vue";

const route = useRoute()
const swal = inject("$swal");

const article = ref([]);


function convertDate(date) {
    return moment(date).format("DD/MM/YYYY");
}


function getArticle() {
    const url = `/article/${route.params.id}`

    http
        .get(url)
        .then((res) => {
            article.value = res.data.data;
        })
        .catch((e) => {
            swal("Erro!", e.message, "error");
        });
}

onMounted(() => {
    getArticle();
});
</script>
