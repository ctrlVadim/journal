require('./bootstrap');

import Vue from "vue";
import App from "./App";
import router from "./router";
import loader from "vue-ui-preloader";

Vue.use(loader);
Vue.config.productionTip = false;


new Vue({
    el: "#app",
    router,
    template: "<App/>" ,
    components: { App }
});
