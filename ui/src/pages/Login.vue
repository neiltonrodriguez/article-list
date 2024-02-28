<script setup>
import { ref, inject } from 'vue'
import http from "../services/http.js";
import { useAuth } from "../stores/auth.js";
// import router from "../router/index";
import { useRouter, RouterLink } from 'vue-router'

const router = useRouter()
const auth = useAuth();
const swal = inject('$swal')

const user = ref({});
function login() {
    http
        .post("/login", user.value)
        .then((res) => {
            auth.setToken(res.data.access_token);
            auth.setUser(res.data.user);
            router.push({ path: '/dashboard'});
        })
        .catch((e) => {
            swal("Erro!", "Email ou senha incorreta", "error");
        });
}


</script>
<template>
    <section class="bg-gray dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-dark">
            </a>
            <div
                class="w-full bg-dark rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Log in to your Simera account
                    </h1>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="login">
                        <div>
                            <label for="username"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User</label>
                            <input type="text" v-model="user.email"
                                class="bg-gray-50  text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="your-user@mail.com" required="" />
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" v-model="user.password" placeholder="••••••••"
                                class="bg-gray-50  text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="" />
                        </div>

                        <div>
                            <span class="text-white text-sm">Don't have an account? </span><span class="text-bar-orange hover:text-orange-500 duration-200 text-sm"><router-link to="/register">Sign up</router-link></span>
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-principal hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Sign in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

