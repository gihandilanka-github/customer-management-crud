<template>
    <div class="row">
        <div class="col-lg-6">
            <div class="dataTables_info" v-if="showRecordsCountString">
                <span class="badge badge-default">{{ showingEntriesText }}</span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="dataTables_paginate paging_simple_numbers">
                <pagination :data="data"
                            :limit="limit"
                            :size="size"
                            :showDisabled="showDisabled"
                            :align="align"
                            @pagination-change-page="changePage">
                    <i v-if="customNextPrevButtons" slot="prev-nav" class="fa fa-angle-left"></i>
                    <i v-if="customNextPrevButtons" slot="next-nav" class="fa fa-angle-right"></i>
                </pagination>
            </div>
        </div>
    </div>


</template>
<script>
import pagination from 'laravel-vue-pagination';

export default {
    name: 'VuePagination',
    components: {
        pagination
    },
    props: {
        data: {
            type: Object,
            required: true
        },
        customNextPrevButtons: {
            type: Boolean,
            default: true
        },
        limit: {
            type: Number,
            default: 0
        },
        showDisabled: {
            type: Boolean,
            default: false
        },
        size: {
            type: String,
            default: 'default',
            validator: function validator(value) {
                return ['small', 'default', 'large'].indexOf(value) !== -1;
            }
        },
        align: {
            type: String,
            default: 'left',
            validator: function validator(value) {
                return ['left', 'center', 'right'].indexOf(value) !== -1;
            }
        },
        showRecordsCountString: {
            type: Boolean,
            default: true
        }
    },

    computed: {
        isApiResource: function isApiResource() {
            return !!this.data.api_resource;
        },
        showingEntriesText() {
            return this.generateShowingEntriesText();
        }
    },
    created() {
    },
    methods: {
        changePage(page) {
            this.$emit('function', page);
        },

        generateShowingEntriesText() {
            let showingEntriesText = '';
            let from = this.data.from ? this.data.from : 0;
            let to = this.data.to ? this.data.to : 0;
            let total = this.data.total ? this.data.total : 0;

            showingEntriesText = this.$t('Showing ') + from + this.$t(' to ') + to + this.$t(' of ') + total + this.$t(' entries');

            return showingEntriesText;
        }
    }
}
</script>
