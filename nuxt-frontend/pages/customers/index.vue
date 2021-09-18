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
                                    <li class="breadcrumb-item active" aria-current="page">{{$t("customers")}}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <NuxtLink :to="{name: 'customers-create'}" class="btn btn-sm btn-neutral">{{$t('new')}}</NuxtLink>
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
                            <h3 class="mb-0">{{ $t('customers') }}</h3>
                        </div>
                        <div class="card-body">
                            <CustomerSearch :searchFilters="searchFilters"></CustomerSearch>
                            <br><br>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">{{ $t('first_name') }}</th>
                                            <th scope="col" class="sort" data-sort="status">{{ $t('last_name') }}</th>
                                            <th scope="col" class="sort" data-sort="status">{{ $t('email') }}</th>
                                            <th scope="col" class="sort" data-sort="status">{{ $t('phone') }}</th>
                                            <th scope="col" class="sort" data-sort="status">{{ $t('edit') }}</th>
                                            <th scope="col" class="sort" data-sort="status">{{ $t('delete') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list" v-if="customers.length > 0">
                                            <tr v-for="customer in customers">
                                                <td>
                                                    {{ $global.printText(customer.customer_firstname) }}
                                                </td>
                                                <td>
                                                    {{ $global.printText(customer.customer_lastname) }}
                                                </td>
                                                <td>
                                                    {{ $global.printText(customer.customer_email) }}
                                                </td>
                                                <td>
                                                    {{ $global.printText(customer.customer_phone) }}
                                                </td>
                                                <td>
                                                    <NuxtLink
                                                        :to="{name: 'customers-id-edit', params: { id:customer.customer_id } }">
                                                        <argon-button type="outline-primary" :small="true">
                                                            {{ $t('edit') }}
                                                        </argon-button>
                                                    </NuxtLink>
                                                </td>
                                            <td>
                                                <argon-button nativeType="button" type="danger" :small="true"
                                                              @click="deleteCustomer(customer.customer_id)">
                                                    {{ $t('delete') }}
                                                </argon-button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tbody v-else>
                                            <td colspan="6">{{ $t("no results found") }}</td>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <vue-pagination :align="'right'"
                                            :limit="table.limit"
                                            :data="customerListPaginate"
                                            :show-disabled="true"
                                            :showRecordsCountString="true"
                                            @function="getCustomers">
                            </vue-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
import CustomerSearch from "@/components/Customer/CustomerSearch";

export default {
    name: "category_list",
    middleware: 'auth',
    layout: 'DashboardLayout',
    head: {
        title: 'Customer List',
    },
    data() {
        return {
            table: {
                limit: 1,
                countPerPage: 10,
                currentPage:1
            },
            searchFilters:{
                first_name:'',
                last_name:'',
                email:'',
                phone:'',
            },
        }
    },
    computed: mapGetters({
        customers: 'customer/customers',
        customerListPaginate: 'customer/customerListPaginate',
    }),

    created() {
        this.getCustomers();
    },
    methods: {
        async getCustomers(page = 1, loading = true) {
            this.$store.dispatch('customer/customersList', {pageNumber:page, countPerPage: this.table.countPerPage, filters:this.searchFilters});
        },
        deleteCustomer(customerId) {
            this.$global.alertConfirmation(
                this.$t("Are you sure!"),
                "You won\'t be able to revert this!",
                "error",
                true,
                "Done",
                this.deleteRequest,
                customerId
            );
        },
        deleteRequest(customerId) {
            this.$store.dispatch('customer/deleteCustomerById', customerId);
        }
    }
}
</script>
<style scoped>

</style>
