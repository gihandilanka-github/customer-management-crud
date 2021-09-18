<template>
    <nav id="navbar-main"
         class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-2">
        <div class="container">
            <NuxtLink to="/" class="navbar-brand mr-lg-5">
                <img src="/img/brand/logo.png"/>
            </NuxtLink>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
                    aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <NuxtLink to="/">
                                <img src="/img/brand/logo.png"/>
                            </NuxtLink>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                    <li class="nav-item dropdown">
                        <a href="#" id="nav-app-link" class="nav-link" data-toggle="dropdown" role="button">
                            <i class="ni ni-ui-04 d-lg-none"></i>
                            <span class="nav-link-inner--text">{{$t('Apps')}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl">
                            <div class="dropdown-menu-inner">
                                <NuxtLink to="/generate-qr-code-online" class="media d-flex align-items-center">
                                    <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                                        <i class="fa fa-qrcode"></i>
                                    </div>
                                    <div class="media-body ml-3">
                                        <h6 class="heading text-primary mb-md-1">{{$t('QR Code Generator')}}</h6>
                                        <p class="description d-none d-md-inline-block mb-0">{{$t('You can generate personalized QR code for any purposes, then you can download or print as you wish.')}}</p>
                                    </div>
                                </NuxtLink>

                                <NuxtLink to="/download-libreoffice-cv-templates" class="media d-flex align-items-center">
                                    <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                                        <i class="fa fa-file"></i>
                                    </div>
                                    <div class="media-body ml-3">
                                        <h6 class="heading text-primary mb-md-1">{{$t('Download LibreOffice CV Templates')}}</h6>
                                        <p class="description d-none d-md-inline-block mb-0">{{$t('You can download preferred CV template and you can edit is without any limitations')}}</p>
                                    </div>
                                </NuxtLink>

<!--                                <a href="https://demos.creative-tim.com/argon-design-system/docs/foundation/colors.html"-->
<!--                                   class="media d-flex align-items-center">-->
<!--                                    <div class="icon icon-shape bg-gradient-success rounded-circle text-white">-->
<!--                                        <i class="ni ni-palette"></i>-->
<!--                                    </div>-->
<!--                                    <div class="media-body ml-3">-->
<!--                                        <h6 class="heading text-primary mb-md-1">Foundation</h6>-->
<!--                                        <p class="description d-none d-md-inline-block mb-0">Learn more about colors,-->
<!--                                            typography, icons and the grid system we used for .</p>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                                <a href="https://demos.creative-tim.com/argon-design-system/docs/components/alerts.html"-->
<!--                                   class="media d-flex align-items-center">-->
<!--                                    <div class="icon icon-shape bg-gradient-warning rounded-circle text-white">-->
<!--                                        <i class="ni ni-ui-04"></i>-->
<!--                                    </div>-->
<!--                                    <div class="media-body ml-3">-->
<!--                                        <h5 class="heading text-warning mb-md-1">Components</h5>-->
<!--                                        <p class="description d-none d-md-inline-block mb-0">Browse our 50 beautiful-->
<!--                                            handcrafted components offered in the Free version.</p>-->
<!--                                    </div>-->
<!--                                </a>-->
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <NuxtLink to="/contact-us" class="nav-link">
                            <i class="ni ni-collection d-lg-none"></i>
                            <span class="nav-link-inner--text">{{$t('Contact Us')}}</span>
                        </NuxtLink>
                    </li>
                    <li class="nav-item">
                        <a href="https://blog.gihandilanka.com" target="_blank" class="nav-link">
                            <i class="ni ni-collection d-lg-none"></i>
                            <span class="nav-link-inner--text">{{$t('Blog')}}</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://www.linkedin.com/in/gihan-dilanka/" target="_blank"
                           data-toggle="tooltip" title="Linkedin">
                            <i class="fa fa fa-linkedin"></i>
                            <span class="nav-link-inner--text d-lg-none">{{$t('Linkedin')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon"
                           href="https://github.com/gihandilanka-github" target="_blank"
                           data-toggle="tooltip" title="Github">
                            <i class="fa fa-github"></i>
                            <span class="nav-link-inner--text d-lg-none">{{$t('Github')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://www.facebook.com/gihan.somarathne" target="_blank"
                           data-toggle="tooltip" title="Facebook">
                            <i class="fa fa-facebook-square"></i>
                            <span class="nav-link-inner--text d-lg-none">{{$t('Facebook')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://www.instagram.com/gihandilanka"
                           target="_blank" data-toggle="tooltip" title="Instagram">
                            <i class="fa fa-instagram"></i>
                            <span class="nav-link-inner--text d-lg-none">{{$t('Instagram')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://twitter.com/gihan_dilanka" target="_blank"
                           data-toggle="tooltip" title="Twitter">
                            <i class="fa fa-twitter-square"></i>
                            <span class="nav-link-inner--text d-lg-none">{{$t('Twitter')}}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <NuxtLink v-if="!loggedIn" to="/login" class="nav-link">
                            <i class="ni ni-collection d-lg-none"></i>
                            <span class="nav-link-inner--text">{{$t('Login')}}</span>
                        </NuxtLink>
                        <a v-if="loggedIn" @click.prevent="logout" class="nav-link">
                            <i class="ni ni-collection d-lg-none"></i>
                            <span class="nav-link-inner--text">{{$t('Logout')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <NuxtLink to="/register" class="nav-link">
                            <i class="ni ni-collection d-lg-none"></i>
                            <span class="nav-link-inner--text">{{$t('Register')}}</span>
                        </NuxtLink>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
    name: 'GuestNavbar',
    components: {
    },

    data: () => ({

    }),

    computed: mapGetters({
        user: 'auth/user'
    }),

    mounted() {
        this.navAppAtagPrevent();
    },
    methods: {
        // async logout () {
        //     // Log out the user.
        //     await this.$store.dispatch('auth/logout')
        //
        //     // Redirect to login.
        //     this.$router.push({ name: 'login' })
        // },
        navAppAtagPrevent(){
            let el = document.getElementById("nav-app-link");
            el.addEventListener("click", function (e) {
                e.preventDefault();
            }, false);
        },
        logout() {
            this.$auth.logout();
        }
    }
}
</script>

<style scoped>
.profile-photo {
    width: 2rem;
    height: 2rem;
    margin: -.375rem 0;
}
</style>
