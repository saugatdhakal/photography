import { createApp } from 'vue'
import root from '../js/frontend/layouts/app.vue';
import router from './Backend/router/router';
import { createPinia } from 'pinia';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css'
import './main';
const pinia = createPinia();
const app = createApp(root);
app.use(router);
app.use(pinia);
app.use(VueSweetalert2);
app.mount('#app');
