import axios from 'axios';

export default {
    data() {
        return {}
    },
    methods : {
        api(url, params) {
            return {
                setAuth(token) {
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                    return this;
                },
                post(callbackSuccess, callbackError) {
                    axios
                        .post(url, params)
                        .then(callbackSuccess)
                        .catch(callbackError);    
                },
                get(callbackSuccess, callbackError) {
                    axios
                        .get(url, {
                            params: params
                        })
                        .then(callbackSuccess)
                        .catch(callbackError); 
                }
            }   
        }
    }
}