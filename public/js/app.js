// resources/js/app.js
import { createApp } from 'vue';
import App from './app.vue';
import router from './router'; 
import '@fortawesome/fontawesome-free/css/all.min.css';
import store from './store';
import axios from 'axios';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

const app = createApp(App);
app.use(store);  // Use Vuex store

app.use(router); 
app.mount('#app');



