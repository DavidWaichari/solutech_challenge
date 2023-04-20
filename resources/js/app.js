import './bootstrap';
import '../sass/app.scss'
import Router from '@/router'
import VueApexCharts from 'vue3-apexcharts';

import { createApp } from 'vue/dist/vue.esm-bundler';

const app = createApp({})
app.component('apexchart', VueApexCharts);

app.use(Router)
app.mount('#app')