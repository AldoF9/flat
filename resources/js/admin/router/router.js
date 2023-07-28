import Vue from 'vue';
import VueRouter from 'vue-router';
import IndexClient from "../pages/client/IndexClient";
import IndexUser from "../pages/user/IndexUser";
import IndexCategory from "../pages/category/IndexCategory";
import IndexIncome from "../pages/income/IndexIncome";
import IndexProduct from "../pages/product/IndexProduct";
import IndexProvider from "../pages/provider/IndexProvider";
import IndexSale from "../pages/sale/IndexSale";

Vue.use(VueRouter);

let routes = [
    {
        path: '/client',
        name: 'client',
        component: IndexClient,
    },
    {
        path: '/user',
        name: 'user',
        component: IndexUser,
    },
    {
        path: '/category',
        name: 'category',
        component: IndexCategory,
    },
    {
        path: '/income',
        name: 'income',
        component: IndexIncome,
    },
    {
        path: '/product',
        name: 'product',
        component: IndexProduct,
    },
    {
        path: '/provider',
        name: 'provider',
        component: IndexProvider,
    },
    {
        path: '/sale',
        name: 'sale',
        component: IndexSale,
    },
];

export default new VueRouter({
    mode: 'history',
    routes: routes
});
