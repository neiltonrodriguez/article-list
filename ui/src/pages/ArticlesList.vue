<template>
    <div class="mt-3 max-w-7xl focus-visible: rounded-xl m-auto w-full h-full">


        <div class="mt-10">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-principal uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-3">Image</th>
                            <th scope="col" class="px-6 py-3">Title</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="t in articles" :key="t.id" class="odd:bg-white even:bg-gray-50 border-b-dark">
                            <td class="px-6 py-4"><img :src="t.image" width="150px" class="rounded-lg shadow-md"></td>
                            <td class="px-6 py-4 text-mediun">{{ t.title }}</td>
                            <td class="px-6 py-4 text-mediun">{{ convertDate(t.created_at) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex items-end justify-end gap-3 p-3">
            <button @click="showDrawer" class="bg-teal-600 items-end p-3 rounded-md text-white hover:bg-teal-700">
                New Article
            </button>
        </div>
    </div>

    <div v-if="isVisibleDrawer" class="left-0 top-0 w-full fixed h-screen">
        <!-- drawer component -->
        <Drawer @fechar="showDrawer" @payload="createArticles" />
        <div class="w-full h-screen bg-black opacity-70 " @click="showDrawer"></div>
    </div>
    <div>
        <div class="flex gap-2 items-center justify-center">
            <button class="bg-principal p-2 hover:bg-teal-800 duration-200 rounded-md gap-2 text-white" 
            :class="{'bg-teal-700': current == page }"
            v-for="(page, index) in pages" :key="page" @click="changePage(page)">
                {{ page }}
            </button>
            <span>total de registros: {{ total }}</span>
        </div>
        
    </div>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";
import http from "../services/http.js";
import router from "../router/index.js";
import Drawer from "../components/Drawer.vue";
import moment from "moment";

const swal = inject("$swal");
const isVisibleDrawer = ref();

const articles = ref([]);
const total = ref();
const current = ref();
const pages = ref([]);
var payload = ref({});

function convertDate(date) {
    return moment(date).format("DD/MM/YYYY");
}

function showDrawer() {
    console.log(isVisibleDrawer.value);
    isVisibleDrawer.value = !isVisibleDrawer.value;
}

function createArticles(payload) {
    http
        .post("/article", payload)
        .then((res) => {
            getArticles();
            showDrawer();
        })
        .catch((e) => {
            console.log(e)
            swal("Erro!", e.message, "error");
        });
}

function changePage(i){
    getArticles(i);
    
}

function getArticles(i = null) {
    let page = 1
    if (i != null){
        
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
            
            if(qty <= 1) return[1];
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
