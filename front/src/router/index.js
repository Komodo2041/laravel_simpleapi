// src/router/index.js
import Vue from 'vue'
import VueRouter from 'vue-router'

// Twoje komponenty (strony)

import CompanyApp from '../components/CompanyApp.vue'  // Twój komponent z formularzem

import AboutView from '../components/About.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: CompanyApp
    },
    {
        path: '/about',
        name: 'About',
        component: AboutView
    },
    // 404 – na końcu!
    {
        path: '*',
        redirect: '/'
    }
]

const router = new VueRouter({
    mode: 'history',     // ładne URL bez #
    routes
})

export default router