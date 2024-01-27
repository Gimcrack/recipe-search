// plugins/api.js

import axios from "axios";

export default defineNuxtPlugin(() => {
    const config = useRuntimeConfig();


    const api = {
        host() {
            return config.public.apiHost;
        },

        prefix: '/api/',

        get(url) {
            console.log({url: this.host() + this.prefix + url});
            return axios.get(this.host() + this.prefix + url);
        },

        getUrl(url) {
            return axios.get(url);
        }
    };

    return {provide: {api} };
});
