import {createApp} from 'vue'

require('./bootstrap')
import App from './App.vue'
import axios from 'axios'
import router from './router'

const app = createApp(App)
app.config.globalProperties.$axios = axios;
// Vue.use(require('vue-resource'));
app.use(router)
app.mount('#app')
// Vue.component('pagination', require('laravel-vue-pagination'));
