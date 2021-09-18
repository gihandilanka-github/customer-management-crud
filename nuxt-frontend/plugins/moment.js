import Vue from 'vue'

export default () => {
    Vue.filter('currency', function (value) {
        if (!value) return ''
        return `$${value}`
    })
}
