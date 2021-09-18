<template>
    <div class="main-layout">
<!--        <GuestNavbar/>-->
        <div class="">
            <child/>
        </div>
<!--        <Footer/>-->
    </div>
</template>

<script>

import GuestNavbar from '~/components/GuestNavbar'
import Footer from '~/components/Footer'

export default {
  name: 'GuestLayout',

  components: {
      // GuestNavbar,
      // Footer
  }
}
</script>
