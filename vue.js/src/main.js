// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import VueRouter from "vue-router";
import News from './components/news/index'
import NewNews from './components/news/create_news'

Vue.use(VueRouter);

Vue.config.productionTip = false
const routes = [
    { path: '/',component: News},
    { path: '/news/create', component: NewNews }
];
const router = new VueRouter({
    mode: 'history',
    routes: routes
});
/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    render: h => h(App)
})
