<script setup>
import { RouterLink } from 'vue-router';

</script>
<template>
    <div class="bg-principal w-full h-20 flex items-center">
        <div class="max-w-7xl p-3 w-full justify-center items-center m-auto flex flex-row">
            <div class="flex-1 flex items-center justify-center"><router-link to="/"><img src="../assets/img/logo.png" class="flex-1 h-12 hover:scale-110 duration-200"></router-link></div>
            <span class="text-white hover:text-bar-orange duration-200 cursor-pointer mx-5"><router-link to="/login">Login</router-link></span>

        </div>

    </div>
</template>
