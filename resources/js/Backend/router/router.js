import { createRouter, createWebHashHistory } from 'vue-router';
// Website
import WebNavBar from "../../frontend/website/nav/nav-bar.vue";//
import Home from '../../frontend/website/home/home.vue';
import About from '../../frontend/website/about/about.vue';
import Service from '../../frontend/website/services/service.vue';
import Contact from '../../frontend/website/contact/contact.vue';
import adminNav from "../../frontend/dashboard/nav/admin-nav.vue";
import { authState } from "../store/auth";
const routes = [
    //Website
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            requiresAuth: false,
            pageLayout: WebNavBar
        }
    },
    {
        path: '/photo/photoDetails/:id',
        name: 'photoDetails',
        component: () => import('../../frontend/website/imageContant/singleImageCotent.vue'),
        meta: {
            requiresAuth: false,
            pageLayout: WebNavBar
        },
        props: true
    },
    {
        path: '/photo/payment/status/:id',
        name: 'paymentStatus',
        component: () => import('../../frontend/website/payment/transaction-status.vue'),
        meta: {
            requiresAuth: false,
        },
        props: true

    },
    {
        path: '/about',
        name: 'about',
        component: About,
        meta: {
            requiresAuth: false,
            pageLayout: WebNavBar
        }
    },
    {
        path: '/contact',
        name: 'contact',
        component: Contact,
        meta: {
            requiresAuth: false,
            pageLayout: WebNavBar
        }
    },
    {
        path: '/service',
        name: 'service',
        component: Service,
        meta: {
            requiresAuth: false,
            pageLayout: WebNavBar
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
