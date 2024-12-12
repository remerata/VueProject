// resources/js/app.js
import { createApp } from 'vue';
import App from './app.vue';
import router from './router'; 
import '@fortawesome/fontawesome-free/css/all.min.css';
import store from './store';
import axios from 'axios';

// Make sure to include the CSRF token in the headers
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


const app = createApp(App);
app.use(store);  // Use Vuex store

app.use(router); 
app.mount('#app');

window.axios = axios;

// Set base URL for all Axios requests
axios.defaults.baseURL = '/api';



