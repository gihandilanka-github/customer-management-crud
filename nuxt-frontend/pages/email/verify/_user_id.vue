<template>
    <div class="register-verify-page">
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
                                <div class="card-header bg-white pb-5">
                                    <div class="text-muted text-center mb-3"><small>Sign up with</small></div>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-neutral btn-icon mr-4">
                                            <span class="btn-inner--icon"><img src="/img/icons/common/github.svg"></span>
                                            <span class="btn-inner--text">Github</span>
                                        </a>
                                        <a href="#" class="btn btn-neutral btn-icon">
                                            <span class="btn-inner--icon"><img src="/img/icons/common/google.svg"></span>
                                            <span class="btn-inner--text">Google</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="card-body px-lg-5 py-lg-5">
                                    <div v-if="success">
                                        <div class="alert alert-success" role="alert">
                                            {{ success }}
                                        </div>

                                        <NuxtLink to="/login" class="btn btn-primary">
                                            {{ $t('login') }}
                                        </NuxtLink>
                                    </div>
                                    <div v-else>
                                        <div class="alert alert-danger" role="alert">
                                            {{ error || $t('failed_to_verify_email') }}
                                        </div>

                                        <router-link :to="{ name: 'verification.resend' }" class="small float-right">
                                            {{ $t('resend_verification_link') }}
                                        </router-link>
                                    </div>
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
const qs = (params) => Object.keys(params).map(key => `${key}=${params[key]}`).join('&')
export default {
    name: "UserEmailVerify",
    layout: 'GuestLayout',
    data(){
        return {
            error: '',
            success: ''
        }
    },
    created() {
        this.verify();
    },

    methods :{
        async verify(){
            try {
                let url = 'email/verify/'+this.$route.params.user_id+'?'+qs(this.$route.query)+'';
                const {data} = await this.$axios.post(url);
                this.success = data.status;
            }catch (e) {
                this.error = e.response.data.status;
            }
        }

    }
}
</script>

<style scoped>

</style>
