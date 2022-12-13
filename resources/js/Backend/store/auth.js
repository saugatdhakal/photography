import { defineStore } from 'pinia';
import repository from '../apis/repository';
import router from '../router/router';
const {createSession,login,tokenExpired} = repository();
export const authState = defineStore('authication', {
    state: () => ({
        user: null,
        tokenExpired: true,
        isAuth: false,
    }),
    actions: {
        async login(user) {
            //Creating CSRF Session
            console.log('login start',user)
            await createSession();
            this.user = await login(user);//Login Request
            localStorage.setItem('token', this.user.authorisation.token); // token in localstorage
            this.isAuth = true;
            router.push({ name: 'adminHome' });//Navigating into the admin home page
        },
        async checkTokenExpired() {
            console.log("auth token check start token:-",localStorage.getItem('token'))
            const res = await tokenExpired(localStorage.getItem('token'));
            console.log("🚀 ~ file: auth.js:24 ~ checkTokenExpired ~ res", res)
            console.log(res);
            this.tokenExpired = res;
            return res;
        },
        checkLogin() {
            if (localStorage.getItem('token')) {
                this.isAuth = true;
                router.push({ name: 'adminHome' })
            }
            else {
                router.push('/login')
                this.isAuth = false;
            }
        },
        async logout() {
            await axios.post('api/logout', '', {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`,
                    Accept: 'application/json',
                }
            }).then(
                (responde) => {
                    if (localStorage.getItem('token')) {
                        localStorage.setItem('token', '');
                        this.isAuth = false;
                        router.push('/login')
                    }
                }
            );
        }
    }
}

);



