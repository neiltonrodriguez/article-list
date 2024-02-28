<script setup>
import { useAuth } from "../stores/auth.js";
// import router from "./../router/index.js";
import { ref, watch, onMounted } from 'vue'
import { useRouter, RouterLink } from 'vue-router'

const router = useRouter()

const auth = useAuth();
const props = defineProps(['isVisibleDrop'])
const isVisibleDrop = ref(props.isVisibleDrop)
const firstLetter = ref("")

function logout() {
    auth.clear();
    router.push({ name: 'home'});
}

function prepareName() {
    let name = auth.user.first_name
    let arr = name.split('');
    firstLetter.value = arr[0].toUpperCase()

}

watch(props, (newX) => {
    if (isVisibleDrop.value === true) {
        mostrarDrop()
    }
})

function mostrarDrop() {
    isVisibleDrop.value = !isVisibleDrop.value
}

onMounted(() => {
    prepareName();
});

</script>
<template>
    <div class="bg-principal w-full h-15 flex items-center" @blur="mostrarDrop">
        <div class="max-w-7xl p-3 w-full justify-between m-auto flex flex-row">
            <div class="text-white"><img src="../assets/img/logo.png"></div>
            <div class="hidden md:flex text-white">
                <div class="flex justify-center items-center m-auto gap-3">
                    
                    <div class="text-end flex justify-end">
                        <div @click="mostrarDrop"
                            class="hover:bg-orange-400 cursor-pointer rounded-full h-10 w-10 flex items-center justify-center bg-bar-orange">
                            {{ firstLetter }}
                        </div>
                        <div @click="logout()" class="bg-principal cursor-pointer  origin-top-right top-24 rounded-md text-white absolute h-10 m-auto w-40 flex gap-2 flex-col items-center justify-center"
                            v-if="isVisibleDrop">
                            <div class="hover:bg-teal-600 w-full h-full rounded-md flex items-center justify-center"><a
                                    class=""> Logout </a></div>
                            
                        </div>
                    </div>

                </div>

            </div>

            <div class="md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </div>

        </div>

    </div>
</template>
