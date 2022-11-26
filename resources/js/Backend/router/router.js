import { createRouter, createWebHashHistory } from 'vue-router';
import Home from '../../frontend/website/home/home.vue';
import navBar from "../../frontend/website/nav/nav-bar.vue";//
import adminNav from "../../frontend/dashboard/nav/admin-nav.vue";
import { authState } from "../store/auth";
const routes = [
    //Home
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            requiresAuth: false,
            pageLayout: navBar
        }
    },
    {
        path: '/about',
        name: 'about',
        component: () => import('../../frontend/website/about/about.vue'),
        meta: {
            requiresAuth: false,
            pageLayout: navBar
        }
    },
    {
        path: '/contact',
        name: 'contact',
        component: () => import('../../frontend/website/contact/contact.vue'),
        meta: {
            requiresAuth: false,
            pageLayout: navBar
        }
    },
    {
        path: '/service',
        name: 'service',
        component: () => import('../../frontend/website/services/service.vue'),
        meta: {
            requiresAuth: false,
            pageLayout: navBar
        }
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../../frontend/dashboard/login/login.vue'),
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/admin/home',
        name: 'adminHome',
        component: () => import('../../frontend/dashboard/home/home.vue'),
        meta: {
            requiresAuth: true,
            adminLayout: adminNav
        }

    },
    {
        path: '/admin/imageupload',
        name: 'imageupload',
        component: () => import('../../frontend/dashboard/image_upload/image_upload.vue'),
        meta: {
            requiresAuth: true,
            adminLayout: adminNav
        }

    }

];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

router.beforeEach(async (to, from, next) => {
    if (!to.meta.requiresAuth) next(); // if auth is false means website and adimn login page
    else if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        // this route requires auth and token check if logged in
        // if not, redirect to login page.
        next({
            path: '/login',
            // save the location we were at to come back later
            query: { redirect: to.fullPath },
        });
    }
    else { // Login and has token in localStorage
        const auths = authState();
        // Checking if token is expired or not if expire delete token and
        // redirect to login page
        const expireStatus = await auths.checkTokenExpired();
        if (expireStatus) {
            localStorage.removeItem('token');
            next({
                path: '/login',
                // save the location we were at to come back later
                query: { redirect: to.fullPath },
            });
        }
        else { // if not expire send to location where user want
            next();
        }
    }
})

export default router;
