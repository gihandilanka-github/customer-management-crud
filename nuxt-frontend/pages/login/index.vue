<template>
    <div class="login-page">
        <div class="wrapper">
            <section class="section section-shaped section-lg">
                <div class="shape shape-style-1 bg-gradient-default">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="container pt-lg-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card bg-secondary shadow border-0">
<!--                                <div class="card-header bg-white pb-5">-->
<!--                                    <div class="text-muted text-center mb-3"><small>Sign in with</small></div>-->
<!--                                    <div class="btn-wrapper text-center">-->
<!--                                        <a href="#" class="btn btn-neutral btn-icon">-->
<!--                                            <span class="btn-inner&#45;&#45;icon"><img-->
<!--                                                src="/img/icons/common/github.svg"></span>-->
<!--                                            <span class="btn-inner&#45;&#45;text">Github</span>-->
<!--                                        </a>-->
<!--                                        <a href="#" class="btn btn-neutral btn-icon">-->
<!--                                            <span class="btn-inner&#45;&#45;icon"><img-->
<!--                                                src="/img/icons/common/google.svg"></span>-->
<!--                                            <span class="btn-inner&#45;&#45;text">Google</span>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-muted mb-4">
                                        <small>Sign in with credentials</small>
                                    </div>
                                    <form role="form" @submit.prevent="login">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                </div>
                                                <input v-model="form.email" class="form-control" placeholder="Email" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group focused">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                        class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input v-model="form.password" class="form-control" placeholder="Password" type="password">
                                            </div>
                                            <has-error :errors="errors" :field="'email'"></has-error>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                            <label class="custom-control-label" for=" customCheckLogin"><span>Remember me</span></label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary my-4">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-3">
<!--                                <div class="col-6">-->
<!--                                    <a href="#" class="text-light"><small>Forgot password?</small></a>-->
<!--                                </div>-->
<!--                                <div class="col-6 text-right">-->
<!--                                    <a href="#" class="text-light"><small>Create new account</small></a>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Login',
    middleware: 'guest',
    layout: 'GuestLayout',
    head: {
        title: 'Login',
        meta: [
            {name: 'description', content: 'Your privacy is important to us. Privacy Policy in GihanDilanka.com'},
            {
                property: 'robots',
                content: 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1'
            },
            {property: 'og:locale', content: 'en_US'},
            {property: 'og:type', content: 'article'},
            {property: 'og:title', content: 'Privacy Policy'},
            {
                property: 'og:description',
                content: "Your privacy is important to us. Privacy Policy in GihanDilanka.com"
            },
            {property: 'og:url', content: 'https://gihandilanka.com/privacy-policy'},
            // { property: 'article:modified_time', content: '2020-11-14T19:09:55+00:00'},
            {property: 'og:image', content: 'https://gihandilanka.com/img/pages/privacy-policy.png'},
            {property: 'og:image:width', content: '1200'},
            {property: 'og:image:height', content: '627'}
        ]
    },
    data(){
        return {
            form: {
                email: '',
                password: '',
            },
            mustVerifyEmail: false,
            errors:{}
        }
    },
    methods: {
        async login() {
            const {data} = await this.$auth.loginWith("local", {
                data: this.form
            });
            this.validationErrors(data);
            // this.$router.push({
            //     path: '/'
            // });
        },
        validationErrors(data){
            this.errors = {};
            if(data.data && data.data.errors && data.data.errors.validations) {
                this.errors = data.data.errors.validations;
            }
        }
    }
}
</script>
<style scoped>
.card-profile {
    z-index: 1;
}
</style>
