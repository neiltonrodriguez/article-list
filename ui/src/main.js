import { createApp } from 'vue'
import App from './App.vue'
import { createPinia } from 'pinia'
import router from './router/index.js'
import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';
import './assets/css/index.css'

createApp(App)
    .use(createPinia())
    .use(router)
    .use(VueSweetalert2)
    .mount('#app')
