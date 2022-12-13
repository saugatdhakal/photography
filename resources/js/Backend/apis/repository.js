import api from '../apis/api';
const headerToken = {
    headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${localStorage.getItem('token')}`
    }
};
const repository = () => {
    /*
    ****************************
    ********LOGIN APIS********
    ****************************
    */
    const createSession = () => {

        return api().get("sanctum/csrf-cookie");
    }
    const login = (params) => {
        return api().post('api/login', params);
    }
    const logout = () => {
        return api({ requiresAtuh: true }).delete('api/logout');
    }
    const tokenExpired = (token) => {
        return api().get('api/tokenStatus/' + token);
    }

    /*
    ****************************
    ********WEBSITE APIS********
    ****************************
    */
    const homeImages = (page) => {
        return api().get('api/photo/all');
    }
    const nextPageHomeImages = (pageUrl) => {
        return api().get(pageUrl);
    }
    //
    const getImageDetails = (id) => {
        return api().get('api/photo/' + id);
    }
    /*********Paypal Payment APIS*********/
    const paypalPayment = (id) => {
        return api().get('api/handle-payment/' + id);
    }
    // Success Page After Payment
    const searchCustomerTransaction = ($id) => {
        return api().get('api/customer/transaction/' + $id);
    }



    /*
        ****************************
        ********DASHBOARD APIS********
        ****************************
        */
    // Albums
    const createAlbum = ({ params }) => {
        return api({ requiresAtuh: true }).post('api/album/create', params,headerToken);
    }
    const albumList = () => {
        return api({ requiresAtuh: true }).get('api/album/list');
    }

    //Image Upload
    const uploadImage = ({ params, config }) => {
        return api({ requiresAtuh: true }).post('api/image', params, config);
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
        searchCustomerTransaction,
        nextPageHomeImages

    }
}


export default repository;


