window.axios = require('axios');
import("../bootstrap");

import Vue from "vue";
import App from "./pages/App.vue";
import router from "./router/router";
import vuetify from "./vuetify/vuetify";

export const bust = new Vue();


const admin = new Vue({
    el: "#admin",
    router,
    vuetify,
    render: (h) => h(App),
});
