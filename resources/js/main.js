import {createApp} from 'vue'
import VueProgressBar from "@aacassandra/vue3-progressbar"

import App from './App.vue'
import router from "./router";

import './styles/styles.scss'
import Header from "./components/sb-header/Header";


const vueProgressBarOption = {
    color: '#0061f2',
    thickness: "5px"
}

const app = createApp(App)
app.component('sb-header', Header)
app.use(router).use(VueProgressBar, vueProgressBarOption)


/**
 * Exporting vue app, so it can be use else ware in the application
 * where we might need to reload the app forcefully
 */
export default app.mount('#app')
