<script setup>
import { ref, inject } from "vue";
import http from "../services/http.js";
import NavSite from "../components/NavSite.vue";
import Footer from "../components/Footer.vue";
import router from "../router";

const swal = inject("$swal");

const user = ref({});

function createUser() {
    http
        .post('/user', user.value)
        .then((res) => {
            swal("Success", "Email ou senha incorreta", "success");
            router.push('/login')
        })
        .catch((e) => {
            swal("Erro!", e.message, "error");
        });
}

</script>
<template>
    <div>
        <NavSite />
        <div class="w-full flex items-center justify-center bg-gray">
            <div class="w-full max-w-7xl bg-white h-screen p-5">
                <form v-on:submit.prevent="createUser()">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="first_name"
                                class="block mb-2 text-sm font-medium text-principal">First name</label>
                            <input type="text" id="first_name" v-model="user.first_name"
                                class="border focus:border-principal text-principal text-sm rounded-lg block w-full p-2.5"
                                placeholder="John" required />
                        </div>
                        <div>
                            <label for="last_name" class="block mb-2 text-sm font-medium text-principal">Last
                                name</label>
                            <input type="text" id="last_name" v-model="user.last_name"
                                class="border  text-principal text-sm rounded-lg block w-full p-2.5 "
                                placeholder="Doe" required />
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-principal">Email
                                address</label>
                            <input type="email" id="email" v-model="user.email"
                                class="border  text-principal text-sm rounded-lg block w-full p-2.5 "
                                placeholder="john.doe@company.com" required />
                        </div>
                        <div class="mb-6">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-principal">Password</label>
                            <input type="password" id="password" v-model="user.password"
                                class="border  text-principal text-sm rounded-lg block w-full p-2.5 "
                                placeholder="•••••••••" required />
                        </div>
                        
                    </div>
                    <button type="submit"
                        class="text-white bg-dark focus:ring-4 hover:bg-principal duration-200 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                </form>

            </div>

        </div>
        <Footer />
    </div>
</template>

<style></style>