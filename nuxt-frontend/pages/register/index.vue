<template>
    <div class="register-page">
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
<!--                                    <div class="text-muted text-center mb-3"><small>Sign up with</small></div>-->
<!--                                    <div class="text-center">-->
<!--                                        <a href="#" class="btn btn-neutral btn-icon mr-4">-->
<!--                                            <span class="btn-inner&#45;&#45;icon"><img src="/img/icons/common/github.svg"></span>-->
<!--                                            <span class="btn-inner&#45;&#45;text">Github</span>-->
<!--                                        </a>-->
<!--                                        <a href="#" class="btn btn-neutral btn-icon">-->
<!--                                            <span class="btn-inner&#45;&#45;icon"><img src="/img/icons/common/google.svg"></span>-->
<!--                                            <span class="btn-inner&#45;&#45;text">Google</span>-->
<!--                                        </a>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div v-if="mustVerifyEmail">
                                    <div class="alert alert-success" role="alert">
                                        {{ $t('Validation email sent!') }}
                                    </div>
                                </div>
                                <div v-else class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-muted mb-4">
                                        <small>Sign up with credentials</small>
                                    </div>
                                    <form role="form" @submit.prevent="register">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                                </div>
                                                <input v-model="form.name" class="form-control" placeholder="Name" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                </div>
                                                <input v-model="form.email" class="form-control" placeholder="Email" type="email">
                                            </div>
                                        </div>
                                        <div class="form-group focused">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input v-model="form.password" class="form-control" placeholder="Password" type="password">
                                            </div>
                                        </div>
                                        <div class="form-group focused">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input v-model="form.password_confirmation" class="form-control" placeholder="Password Confirmation" type="password">
                                            </div>
                                        </div>
                                        <div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div>
                                        <div class="row my-4">
                                            <div class="col-12">
                                                <div class="custom-control custom-control-alternative custom-checkbox">
                                                    <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                                    <label class="custom-control-label" for="customCheckRegister"><span>I agree with the <a href="#">Privacy Policy</a></span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mt-4">Create account</button>
                                        </div>
                                    </form>
                                </div>
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
    name: 'Register',
    // middleware: 'redirect',
    layout: 'GuestLayout',
    head: {
        title: 'Register',
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
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            mustVerifyEmail: false
        }
    },
    methods:{
        async register () {
            // Register the user.
            const { data } = await this.$axios.post('/register', this.form)

            // Must verify email fist.
            if (data.status) {
                this.mustVerifyEmail = true
            } else {
                // Log in the user.
                // const { data: { token } } = await this.$axios.post('/api/login')

                // // Save the token.
                // this.$store.dispatch('auth/saveToken', { token })
                //
                // // Update the user.
                // await this.$store.dispatch('auth/updateUser', { user: data })

                // Redirect home.
                // this.$router.push({ path: '/' })
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
