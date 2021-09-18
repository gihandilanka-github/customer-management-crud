export default {

    target: 'server',
    server: {
        port: 3002 // default: 3000
    },
    // Global page headers: https://go.nuxtjs.dev/config-head
    head: {
        title: process.env.SITE_NAME,
        titleTemplate: '%s | '+process.env.SITE_NAME,
        htmlAttrs: {
            lang: 'en'
        },
        meta: [
            {charset: 'utf-8'},
            {name: 'viewport', content: 'width=device-width, initial-scale=1'},
            {hid: 'description', name: 'description', content: process.env.SITE_NAME}
        ],
        link: [
            {rel: 'icon', type: 'image/png', href: '/favicon.png'},
            {rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'},
            {rel: 'stylesheet', href: 'https://use.fontawesome.com/releases/v5.0.6/css/all.css'},
        ],
        script: [
            {
                // src:'/js/jquery-3.4.1.slim.min.js',
                src:'/js/jquery.min.js',
            },
            {
                src:'/js/popper.min.js',
            },
            {
                src:'/js/bootstrap.min.js',
            },
            {
                src:'/js/jquery.scrollbar.min.js',
            },
            {
                src:'/js/js.cookie.js',
            },
            {
                src:'/js/chart/Chart.min.js',
            },
            {
                src:'/js/chart/Chart.extension.js',
            }
        ]
    },

    // Global CSS: https://go.nuxtjs.dev/config-css
    css: [
        '@/assets/themes/argon/assets/css/font-awesome.css',
        '@/assets/themes/argon/assets/css/nucleo.css',
        '@/assets/themes/argon/assets/css/argon.css',
        // '@/assets/css/theme-custom.css',
    ],

    js: [
        '@/assets/themes/argon/assets/js/argon-design-system.min.js',
        '@/assets/themes/argon/assets/js/core/jquery.min.js',
    ],

    // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
    plugins: [
        '~/plugins/global-component.js',
        '~/plugins/gfunc.js',
        '~/plugins/vform.js',
        '~/plugins/vue-plugins.js',
        '~/plugins/mixins/user.js',
        '~/plugins/mixins/constants.js',
        {src: '~plugins/vue-upload-multiple-image', ssr: false}
    ],

    // Auto import components: https://go.nuxtjs.dev/config-components
    components: true,

    // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
    buildModules: [],

    // Modules: https://go.nuxtjs.dev/config-modules

    modules: [
        'nuxt-i18n',
        '@nuxtjs/moment',
        '@nuxtjs/axios',
        '@nuxtjs/proxy',
        // '@nuxtjs/google-analytics',
        '@nuxtjs/auth-next',
        'nuxt-lazy-load'
    ],

    loading: {
        color: '#77b6ff',
        height: '3px'
    },
    i18n: {
        strategy: 'no_prefix',
        vueI18nLoader: true,
        locales: [
            {
                code: 'en',
                file: 'en-US.js'
            },
            {
                code: 'es',
                file: 'es-ES.js'
            },
            {
                code: 'fr',
                file: 'fr-FR.js'
            }
        ],
        defaultLocale: 'en',
        lazy: true,
        langDir: 'lang/',
        vueI18n: {
            fallbackLocale: 'en',
            // messages: {
            //     en: {
            //         welcome: 'Welcome'
            //     },
            //     fr: {
            //         welcome: 'Bienvenue'
            //     },
            //     es: {
            //         welcome: 'Bienvenido'
            //     }
            // }

        }
    },
    axios: {
        proxy: true,
        // credentials: true,
        prefix: '/api/',
        // proxyHeaders: true,
        // credentials: false
    },

    proxy: {
        '/api': {
            target: process.env.API_URL,
            // pathRewrite: { '^/api/': '' },
        },
    },
    // googleAnalytics: {
    //     id: 'UA-104845529-1'
    // },
    // Build Configuration: https://go.nuxtjs.dev/config-build
    build: {
        splitChunks: {
            layouts: true
        }
    },
    generate: {
        dir: 'my-dist'
    },
    auth: {
        strategies: {
            'local': {
                // provider: 'laravel/jwt',
                url:process.env.API_URL+'/api',
                endpoints: {
                    login: { url: '/login', method: 'post', propertyName: 'token' },
                    user: { url: '/user', method: 'get', propertyName: 'user' },
                    logout: { url: '/logout', method: 'post'}
                },
                watchLoggedIn: true,
            }
        },
        redirect: {
            // login: '/login',
            register:'login',
            logout: '/login',
            // callback: '/login',
            home: '/dashboard',
        }
    },
    publicRuntimeConfig: {
        siteName: process.env.SITE_NAME || 'Site Name',
    }

}
