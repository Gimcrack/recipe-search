// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    css: ['~/assets/css/tailwind.css'],
    devtools: {enabled: true},
    postcss: {
        plugins: {
            tailwindcss: {},
            autoprefixer: {},
        },
    },
    runtimeConfig: {
        public: {
            apiHost: process.env.API_HOST || 'http://localhost:8888',
            ssrHost: process.env.SSR_HOST || process.env.API_HOST || 'http://localhost:80'
        }
    },
    plugins: [
        '~/plugins/api.js'
    ],
});
