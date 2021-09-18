<template>
    <div class="main-layout">
        <GuestNavbar/>
        <div class="">
            <child/>
        </div>
        <HomeFooter/>
    </div>
</template>

<script>

import GuestNavbar from '~/components/GuestNavbar'
import HomeFooter from '../components/HomeFooter'

export default {
  name: 'HomeLayout',

  components: {
      HomeFooter,
      GuestNavbar,
  }
}
</script>
<style scoped>
/*@import '@/assets/themes/argon/assets/css/argon-design-system.min.css';*/
</style>
