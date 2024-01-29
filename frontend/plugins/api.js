// plugins/api.js

export default defineNuxtPlugin(() => {
    const config = useRuntimeConfig();


    const api = {
        host() {
            return config.public.apiHost;
        },

        prefix: '/api/',

        buildUrl(url) {
            return this.host() + this.prefix + url;
        },
    };

    return {provide: {api} };
});
