import { createRouter, createWebHistory } from 'vue-router';

import Home from "./components/Home.vue";
import AboutMe from "./components/AboutMe.vue";
import EditContact from "./components/EditContact.vue";



const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: AboutMe
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditContact
    }
];

//create router
const router = createRouter({
    history: createWebHistory(),
    routes // <-- routes,
})

export default router