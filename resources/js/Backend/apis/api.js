import axios from "axios";

let instance = axios.create({
    baseURL: 'http://127.0.0.1:8000/',
    headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${localStorage.getItem('token')}`
    },
    withCredentials: true,
});
instance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
instance.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;

instance.interceptors.response.use(
    response => response.data,
    error => {
        if (error.response && 419 === error.response.status) {
            window.location.reload()
        }
        return Promise.reject(error)
    }
)
export default instance;
