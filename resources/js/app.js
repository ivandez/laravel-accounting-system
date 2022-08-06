require("./bootstrap");

import Vue from "vue";

window.Vue = require("vue");

Vue.component("add-products", require("./components/AddProducts.vue").default);

Vue.component(
    "added-products-table",
    require("./components/AddedProductsTable.vue").default
);

Vue.component("alert", require("./components/Alert.vue").default);

Vue.component(
    "expense-create",
    require("./components/ExpenseCreate.vue").default
);

Vue.component(
    "add-products-with-noregister-client",
    require("./components/AddProductsWithNoregisterClient.vue").default
);

const app = new Vue({
    el: "#app",
});
