import './bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

import { createApp } from 'vue/dist/vue.esm-bundler';

import Home from "./components/Home.vue";


createApp(Home).mount("#app");
// const app = createApp({});

// app.mount("#app");
