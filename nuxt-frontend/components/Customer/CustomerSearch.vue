<template>
    <form @submit.prevent="searchCustomers">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="first-name" class="form-control-label">{{$t('first_name')}}</label>
                    <input class="form-control" type="text"  id="first-name"
                           v-model="searchFilters.first_name"
                    >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="last-name" class="form-control-label">{{$t('last_name')}}</label>
                    <input class="form-control" type="text"  id="last-name"
                           v-model="searchFilters.last_name"
                    >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="email" class="form-control-label">{{$t('email')}}</label>
                    <input class="form-control" type="text"  id="email"
                           v-model="searchFilters.email"
                    >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="phone" class="form-control-label">{{$t('phone')}}</label>
                    <input class="form-control" type="text"  id="phone"
                           v-model="searchFilters.phone"
                    >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <button type="button" class="btn btn-outline-default" @click="resetFilters">{{$t('Reset')}}</button>
                <button type="submit" class="btn btn-outline-primary">{{$t('Search')}}</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    name: "CustomerSearch",
    props:{
        searchFilters: {
            type: Object,
        },
        tableDetails: {
            type: Object,
        }
    },
    methods:{
        searchCustomers(){
            this.$parent.getCustomers();
        },
        async resetFilters(){
            await this.setDefaultForFilters();
            this.$parent.getCustomers();
        },
        setDefaultForFilters(){
            this.searchFilters.first_name = '';
            this.searchFilters.last_name = '';
            this.searchFilters.email = '';
            this.searchFilters.phone = '';
        }
    }
}
</script>

<style scoped>

</style>
