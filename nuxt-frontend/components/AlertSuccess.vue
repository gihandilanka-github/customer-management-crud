<template>
    <div v-if="message" class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <slot>
            <div v-html="message"/>
        </slot>
    </div>
<!--    <div class="alert alert-success alert-dismissible" role="alert">-->
<!--        <button v-if="dismissible" type="button" class="close" aria-label="Close" @click="dismiss">-->
<!--            <span aria-hidden="true">&times;</span>-->
<!--        </button>-->

<!--        <slot>-->
<!--            <div v-html="message"/>-->
<!--        </slot>-->
<!--    </div>-->
</template>

<script>

export default {
  name: 'AlertSuccess',
    props: {
        message: { type: String, default: '' }
    },
    mounted() {
        this.$swal({
            position: 'top-end',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: true,
            // timer: 9500
        })
    }
}
</script>
