<template>
    <div>
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <NuxtLink to="/dashboard">
                                            <i class="fas fa-home"></i>
                                        </NuxtLink>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <NuxtLink to="/customers">{{$t("customers")}}</NuxtLink>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$t('create')}}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <NuxtLink :to="{name: 'customers'}" class="btn btn-sm btn-neutral">{{$t("list")}}</NuxtLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt--6">
        <div class="row justify-content-center">
            <div class=" col ">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h3 class="mb-0">{{$t("edit")+' '+$t("customer")}}</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="update" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="customer_firstname" class="form-control-label">{{ $t('customer') +' '+ $t('first_name') }} <span class="text-red">*</span></label>
                                        <input v-model="form.customer_firstname" class="form-control"
                                               type="text"
                                               id="customer_firstname"
                                               name="customer_firstname"
                                        >
                                        <has-error :errors="errors" :field="'customer_firstname'"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="customer_lastname" class="form-control-label">{{ $t('customer') +' '+ $t('last_name') }} <span class="text-red">*</span></label>
                                        <input v-model="form.customer_lastname" class="form-control"
                                               type="text"
                                               id="customer_lastname"
                                               name="customer_lastname"
                                        >
                                        <has-error :errors="errors" :field="'customer_lastname'"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="customer_email" class="form-control-label">{{ $t('customer') +' '+ $t('email') }} <span class="text-red">*</span></label>
                                        <input v-model="form.customer_email" class="form-control"
                                               type="text"
                                               id="customer_email"
                                               name="customer_email"
                                        >
                                        <has-error :errors="errors" :field="'customer_email'"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="customer_phone" class="form-control-label">{{ $t('customer') +' '+ $t('phone') }}</label>
                                        <input v-model="form.customer_phone" class="form-control"
                                               type="text"
                                               id="customer_phone"
                                               name="customer_phone"
                                        >
                                        <has-error :errors="errors" :field="'customer_phone'"></has-error>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <argon-button :loading="busy" type="outline-primary">
                                            {{ $t('Save') }}
                                        </argon-button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
    name:'customer_create',
    middleware: 'auth',
    layout: 'DashboardLayout',
    head: {
        title: 'Customer Edit',
    },

    data() {
        return {
            msg:'',
            form: {
                customer_firstname: '',
                customer_lastname: '',
                customer_email: '',
                customer_phone: ''
            },
            busy:false,
            errors :{},
        }
    },

    computed: mapGetters({
        customer: 'customer/editCustomer',
    }),

    created() {
        this.getCustomerById(this.$route.params.id);
    },
    watch: {
        customer() {
            this.setCustomerDataToForm()
        },
    },

    methods: {
        async update() {
            this.busy = true;
            const {data} = await this.$axios.put('customers/'+this.$route.params.id, this.form);

            if(data.status) {
                this.$global.alertSuccess(data.msg, '/customers', this.$router);
            }
            this.validationErrors(data);
            this.busy = false;
        },

        validationErrors(data){
            this.errors = {};
            if(data.data && data.data.errors && data.data.errors.validations) {
                this.errors = data.data.errors.validations;
            }
        },
        setCustomerDataToForm() {
            this.form.customer_firstname = this.customer.customer_firstname;
            this.form.customer_lastname = this.customer.customer_lastname;
            this.form.customer_email = this.customer.customer_email;
            this.form.customer_phone = this.customer.customer_phone
        },
        async getCustomerById(customerId) {
            await this.$store.dispatch('customer/getCustomerById', customerId)
        }
    }
}
</script>

