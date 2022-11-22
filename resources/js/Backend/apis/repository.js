import api from '../apis/api';

export default{
    createSession(){
        return api.get("sanctum/csrf-cookie");
    },
    login(params){
        return api.post('api/login',params);
    },
    logout(){
        return api.delete('api/logout');
    },
    tokenExpired(token){

        return api.get('api/tokenStatus/'+token);
    },
    uploadImage({params}){

        return api.post('api/image',params);
    }
}
