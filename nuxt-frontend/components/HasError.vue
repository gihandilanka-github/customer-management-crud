<template>
    <div class="help-block text-danger">
        <span v-if="errors[field]">{{ errors[field][0] }}</span>
    </div>
</template>

<script>
export default {
  name: 'HasError',

  props: {
    errors: {
      type: Object,
      default: {}
    },

    field: {
      type: String,
      default: ''
    },
  },

    mounted() {

    },
    methods: {

    }
}
</script>
