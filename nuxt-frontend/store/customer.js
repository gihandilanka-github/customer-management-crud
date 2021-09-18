export const state = () => ({
    customers:[],
    customersAsArray:[],
    editCustomer:{},
    customerListPaginate:{},
    totalCustomersCount:''
})
export const getters = {
    customers: state => state.customers,
    customersAsArray: state => state.customersAsArray,
    editCustomer: state => state.editCustomer,
    customerListPaginate: state => state.customerListPaginate,
    totalCustomersCount: state => state.totalCustomersCount,
}

export const mutations = {
    setCustomerList(state, customers) {
        state.customers = customers;
    },
    setCustomersAsArray(state, customersAsArray) {
        state.customersAsArray = customersAsArray;
    },
    setCustomerListPaginate(state, customersPaginate) {
        state.customerListPaginate = customersPaginate;
    },
    setEditCustomer(state, customer) {
        state.editCustomer = customer;
    },
    setTotalCustomersCount(state, customersTotal) {
        state.totalCustomersCount = customersTotal;
    }

};

export const actions = {
    async customersList ({ commit }, {pageNumber, countPerPage, filters}) {
        try {
            let pageDetails = {
                page: pageNumber,
                countPerPage: countPerPage,
            };
            let params = {
                ...pageDetails,
                ...filters
            };
            const { data } = await this.$axios.get('/customers', {
                params : params
            });
            commit('setCustomerList', data.data.data );
            commit('setCustomerListPaginate', data.data);
            commit('setTotalCustomersCount', data.data.total);
        } catch (e) {
            console.log(e.error);
        }
    },
    async customersAsArray ({ commit }, searchText) {
        try {
            const { data } = await this.$axios.get('/customers-as-array', {
                params : {
                    searchText: searchText,
                }
            });
            commit('setCustomersAsArray', data.data );
        } catch (e) {
            console.log(e.error);
        }
    },
    async getCustomerById ({ commit }, editCustomerId) {
        try {
            const { data } = await this.$axios.get('/customers/'+editCustomerId+'/edit');
            commit('setEditCustomer', data.data );
        } catch (e) {
            console.log(e.error);
        }
    },
    async deleteCustomerById ({ commit , state}, id) {
        try {
            const { data } = await this.$axios.delete('/customers/'+id);
            if(data.status) {
                let customers = state.customers.filter(function(customer){
                    return customer.customer_id != id;
                });
                commit('setCustomerList', customers);
                this.$global.alertSuccess(data.msg);
            }else {
                this.$global.alertFailed(data.msg);
            }

        } catch (e) {
            console.log(e.error);
        }
    },

    async customersImport ({ commit }, {csvFile}) {

    }
}


