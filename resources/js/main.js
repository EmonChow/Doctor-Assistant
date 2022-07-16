import {createApp} from 'vue'
import VueProgressBar from "@aacassandra/vue3-progressbar"
import SbForm from "sb-form";

import App from './App.vue'

import './styles/styles.scss'
import 'sb-form/dist/style.css'
import Header from "./components/sb-header/Header";
import store from "./store";
import router from "./router";


const vueProgressBarOption = {
    color: '#0061f2',
    thickness: "5px"
}

console.log(import.meta.env)

const app = createApp(App)

app.component('sb-header', Header)
app.component('sb-form', SbForm)

app.use(router).use(VueProgressBar, vueProgressBarOption).use(store)


/**
 * Exporting vue app, so it can be use else ware in the application
 * where we might need to reload the app forcefully
 */
export default app.mount('#app')
