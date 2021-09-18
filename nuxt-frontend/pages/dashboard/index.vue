<template>
    <div>
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">

                    </div>
                    <!-- Card stats -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">{{$t('customers')}}</h5>
                                            <span class="h2 font-weight-bold mb-0">{{customersCount}}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                                <i class="fa fa-users"></i>
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

    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "index.vue",
    middleware: 'auth',
    layout: 'DashboardLayout',
    head: {
        title: 'Dashboard',
    },
    computed: mapGetters({
        customersCount: 'customer/totalCustomersCount',
    }),
    created() {
        this.getCustomersCount();
    },
    methods:{
        async getCustomersCount(page = 1, loading = true) {
            this.$store.dispatch('customer/customersList', {pageNumber:page, countPerPage: 10, filters:{}});
        },
    }
}
</script>

<style scoped>

</style>
