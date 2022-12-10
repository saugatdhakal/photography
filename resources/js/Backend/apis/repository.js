import api from '../apis/api';

const repository = () => {
    /*
    ****************************
    ********LOGIN APIS********
    ****************************
    */
    const createSession = () => {
        return api.get("sanctum/csrf-cookie");
    }
    const login = (params) => {
        return api.post('api/login', params);
    }
    const logout = () => {
        return api.delete('api/logout');
    }
    const tokenExpired = (token) => {
        return api.get('api/tokenStatus/' + token);
    }

    /*
    ****************************
    ********WEBSITE APIS********
    ****************************
    */
    const homeImages = () => {
        return api.get('api/photo/all');
    }
    //
    const getImageDetails = (id) => {
        return api.get('api/photo/' + id);
    }
    /*********Paypal Payment APIS*********/
    const paypalPayment = (id) => {
        return api.get('api/handle-payment/'+id);
    }
    // Success Page After Payment
    const searchCustomerTransaction = ($id)=>{
        return api.get('api/customer/transaction/'+$id);
    }







    /*
        ****************************
        ********DASHBOARD APIS********
        ****************************
        */
    // Albums
    const createAlbum = ({ params }) => {
        return api.post('api/album/create', params);
    }
    const albumList = () => {
        return api.get('api/album/list');
    }

    //Image Upload
    const uploadImage = ({ params,config }) => {
        return api.post('api/image', params,config);
    }
    return {
        createSession,
        login,
        logout,
        tokenExpired,
        uploadImage,
        createAlbum,
        albumList,
        homeImages,
        getImageDetails,
        paypalPayment,
        searchCustomerTransaction

    }
}


export default repository;


