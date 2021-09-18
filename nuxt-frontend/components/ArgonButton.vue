<template>
    <button :type="nativeType" :disabled="loading" :class="{
    [`btn-${type}`]: true,
    'btn-block': block,
    'btn-lg': large,
    'btn-sm': small,
  }" class="btn"
            @click="handleClick"
    >
        <slot/>
        <span v-if="loading" class="spinner-grow spinner-grow-sm mb-1" role="status" aria-hidden="true"></span>
    </button>
</template>

<script>
export default {
    name: 'ArgonButton',

    props: {
        type: {
            type: String,
            default: 'primary'
        },

        nativeType: {
            type: String,
            default: 'submit'
        },

        loading: {
            type: Boolean,
            default: false
        },

        block: {
            type: Boolean,
            default: false
        },

        large: {
            type: Boolean,
            default: false
        },
        small: {
            type: Boolean,
            default: false
        }
    },

    methods: {
        handleClick(e) {
            this.$emit('click', e)
        }
    }
}
</script>
