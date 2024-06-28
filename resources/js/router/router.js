import { createRouter, createWebHistory } from 'vue-router';
import Home from '../pages/Home.vue';
import Login from '../pages/auth/Login.vue';
import Logout from '../pages/auth/Logout.vue';
import { useAuthStore } from '../stores/auth/authStore.js';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/user/auth/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/user/auth/logout',
        name: 'logout',
        component: Logout,
    },
];

export const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to) => {
    const authStore = useAuthStore();

    const guestPages = ['/user/auth/login'];
    if (authStore.loggedIn && guestPages.includes(to.path)) {
        return '/';
    }

    const publicPages = ['/'].concat(guestPages);
    if (!authStore.loggedIn && !publicPages.includes(to.path)) {
        return '/';
    }
});
