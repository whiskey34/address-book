import './bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

import { createApp } from 'vue/dist/vue.esm-bundler';
// import VueRouter from 'vue-router';

import router  from './routes';

import Home from "./components/Home.vue";



createApp(Home)
    .use(router)
    .mount("#app");
// const app = createApp({});

// app.mount("#app");
