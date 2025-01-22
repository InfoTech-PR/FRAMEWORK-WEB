import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import { BootstrapVue3 } from 'bootstrap-vue-3';    

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

const app = createApp(App);
app.use(router);
app.use(BootstrapVue3);
app.mount('#app');
