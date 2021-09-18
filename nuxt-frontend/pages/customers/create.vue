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
                                        <NuxtLink to="/customers">{{ $t("customers") }}</NuxtLink>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $t('create') }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <NuxtLink :to="{name: 'customers'}" class="btn btn-sm btn-neutral">{{ $t("list") }}
                            </NuxtLink>
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
                            <h3 class="mb-0">{{ $t("create") + " " + $t("new") + " " + $t("customer") }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab"
                                           data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                                           aria-controls="tabs-icons-text-1" aria-selected="true"><i
                                            class="fa fa-user-plus  mr-2"></i>Create New Customer</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                           href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                           aria-selected="false"><i class="ni ni-cloud-upload-96 mr-2"></i>Import
                                            Customers (CSV)</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                             aria-labelledby="tabs-icons-text-1-tab">
                                            <form @submit.prevent="create" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="customer_firstname" class="form-control-label">{{
                                                                    $t('customer') + ' ' + $t('first_name')
                                                                }} <span class="text-red">*</span></label>
                                                            <input v-model="form.customer_firstname"
                                                                   class="form-control"
                                                                   type="text"
                                                                   id="customer_firstname"
                                                                   name="customer_firstname"
                                                            >
                                                            <has-error :errors="errors"
                                                                       :field="'customer_firstname'"></has-error>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="customer_lastname" class="form-control-label">{{
                                                                    $t('customer') + ' ' + $t('last_name')
                                                                }} <span class="text-red">*</span></label>
                                                            <input v-model="form.customer_lastname" class="form-control"
                                                                   type="text"
                                                                   id="customer_lastname"
                                                                   name="customer_lastname"
                                                            >
                                                            <has-error :errors="errors"
                                                                       :field="'customer_lastname'"></has-error>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="customer_email" class="form-control-label">{{
                                                                    $t('customer') + ' ' + $t('email')
                                                                }} <span class="text-red">*</span></label>
                                                            <input v-model="form.customer_email" class="form-control"
                                                                   type="text"
                                                                   id="customer_email"
                                                                   name="customer_email"
                                                            >
                                                            <has-error :errors="errors"
                                                                       :field="'customer_email'"></has-error>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="customer_phone" class="form-control-label">{{
                                                                    $t('customer') + ' ' + $t('phone')
                                                                }}</label>
                                                            <input v-model="form.customer_phone" class="form-control"
                                                                   type="text"
                                                                   id="customer_phone"
                                                                   name="customer_phone"
                                                            >
                                                            <has-error :errors="errors"
                                                                       :field="'customer_phone'"></has-error>
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
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                             aria-labelledby="tabs-icons-text-2-tab">
                                            <CustomersUpload :csvFile="csvFile"></CustomersUpload>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';
import CustomersUpload from "@/components/Customer/CustomersUpload";

export default {
    name: 'customer_create',
    components: {CustomersUpload},
    middleware: 'auth',
    layout: 'DashboardLayout',
    head: {
        title: 'Customer Create',
    },
    data() {
        return {
            msg: '',
            form: {
                customer_firstname: '',
                customer_lastname: '',
                customer_email: '',
                customer_phone: ''
            },
            csvFile: '',
            busy: false,
            errors: {},
        }
    },

    computed: mapGetters({
        parentCategories: 'category/parentCategories',
    }),

    methods: {
        async create() {
            this.busy = true;
            const {data} = await this.$axios.post('customers', this.form);

            if (data.status) {
                this.$global.alertSuccess(data.msg, '/customers', this.$router);
            }
            this.validationErrors(data);
            this.busy = false;
        },

        validationErrors(data) {
            this.errors = {};
            if (data.data && data.data.errors && data.data.errors.validations) {
                this.errors = data.data.errors.validations;
            }
        },
    }
}
</script>

