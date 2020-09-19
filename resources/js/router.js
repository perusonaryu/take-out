import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);


import topPage from './components/topPage.vue'
import storePage from './components/storePage.vue'
import storeadd from './components/StoreAdd.vue'
// import storeedit from './components/store/StoreEdit.vue'
import dashboard from './components/Dashboard.vue'
import login from './components/userAuth/Login.vue'
import register from './components/userAuth/Register.vue'
import storeLogin from './components/storeUsersAuth/Login.vue'
import storeRegister from './components/storeUsersAuth/Register'
// import StoreItem from './components/StoreItemComponent'


// import Axios from 'axios';
// Vue.component('store-edit', require('./components/store/StoreEdit.vue').default);

export default new VueRouter({
    // モードの設定
    mode: 'history',
    routes: [
        {
            path: '/',
            component: topPage,
        },
        {
            // routeのパス設定
            path: '/storepage',
            // 名前付きルートを設定したい場合付与
            // コンポーネントの指定
            component: storePage,
            name: 'storePage',
            beforeEnter: (to, from, next) => {
                axios.get('/storeusers/athenticated')
                .then(()=>{
                    next()
                })
                .catch(()=>{
                    return next({name:'login'})
                })
            }
        },

        {
            path: '/storeadd',
            component:storeadd,
            name: 'storeadd',
            beforeEnter: (to, from, next) => {
                axios.get('/athenticated')
                .then(()=>{
                    next()
                })
                .catch(()=>{
                    return next({name:'login'})
                })
            }
        },
        {
            path: '/register',
            component: register
        },
        {
            path: '/login',
            component: login,
            name: 'login'
        },
        {
            path: '/dashboard',
            component: dashboard,
            name: 'dashboard',
            beforeEnter: (to, from, next) => {
                axios.get('/athenticated')
                .then(()=>{
                    next()
                })
                .catch(()=>{
                    return next({name:'login'})
                })
            }
        },
        {
            path: '/storelogin',
            component: storeLogin,
            name: 'storeLogin'
        },
        {
            path: '/storeregister',
            component: storeRegister,
            name: 'storeRegister'
        },

        // {
        //     path: '/storeItem',
        //     component: StoreItem,
        //     // name: 'storeRegister'
        // },
    ]
});