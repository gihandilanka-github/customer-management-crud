import Vue from 'vue'
import Card from '~/components/Card'
import Child from '~/components/Child'
import Button from '~/components/Button'
import ArgonButton from '~/components/ArgonButton'
import Checkbox from '~/components/Checkbox'
import HasError from "@/components/HasError";
import AlertSuccess from "@/components/AlertSuccess";
import VuePagination from "@/components/VuePagination";
import 'vue-search-select/dist/VueSearchSelect.css'

// Components that are registered globaly.
[
    Card,
    Child,
    Button,
    ArgonButton,
    Checkbox,
    HasError,
    AlertSuccess,
].forEach(Component => {
    Vue.component(Component.name, Component)
})
