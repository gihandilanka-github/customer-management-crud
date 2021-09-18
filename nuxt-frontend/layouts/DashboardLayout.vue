<template>
    <div class="wrapper">
        <DashboardLeftSideBar/>
        <div class="main-content" id="panel">
            <DashboardNavbar/>
            <child/>
            <DashboardFooter />
        </div>
    </div>
</template>

<script>

import DashboardNavbar from '~/components/DashboardNavbar'
import DashboardFooter from '~/components/DashboardFooter'
import DashboardLeftSideBar from "@/components/DashboardLeftSideBar";

export default {
    name: 'DashboardLayout',
    head: {
        script: [
            {
                hid: 'stripe',
                src:'/js/argon.min.js',
                defer: true,
            }
        ]
    },

    components: {
      DashboardLeftSideBar,
      DashboardNavbar,
      DashboardFooter
    },


}
</script>
<style scoped>
@import '@/assets/themes/argon/assets/css/argon.css';
</style>
