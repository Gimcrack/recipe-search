// plugins/api.js

export default defineNuxtPlugin(() => {
    const config = useRuntimeConfig();


    const api = {
        host() {
            // browser context
            if (!!window) {
                return config.public.apiHost;
            }

            // ssr context e.g. docker container
            return config.public.ssrHost;
        },

        prefix: '/api/',

        buildUrl(url) {
            return this.host() + this.prefix + url;
        },
    };

    return {provide: {api} };
});
