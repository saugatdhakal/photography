import axios from "axios";

export default (requiresAuth = false) => {
    const options = {};
    options.baseURL = 'http://127.0.0.1:8000/';
    options.withCredentials = true;
    const instance = axios.create(options);
    if (requiresAuth) {
        instance.defaults.headers.authorization = `Bearer ${localStorage.getItem('token')}`;

    }
    instance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    instance.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;

    instance.interceptors.response.use(response => {
        return response.data;
    }, error => {
        return Promise.reject(error);
    });
    return instance;
};

