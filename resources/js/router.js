import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import hello from './components/Hello.vue'
import world from './components/World.vue'
import storelist from './components/StoreList.vue'
import storeadd from './components/StoreAdd.vue'
import storeedit from './components/store/StoreEdit.vue'
import dashboard from './components/Dashboard.vue'
import login from './components/auth/Login.vue'
import register from './components/auth/Register.vue'
import Axios from 'axios';
// Vue.component('store-edit', require('./components/store/StoreEdit.vue').default);

export default new VueRouter({
    // モードの設定
    mode: 'history',
    routes: [
        {
            // routeのパス設定
            path: '/',
            // 名前付きルートを設定したい場合付与
            // コンポーネントの指定
            component: storelist,
            name: 'storeList',
            beforeEnter: (to, from, next) => {
                axios.get('/api/athenticated')
                .then(()=>{
                    next()
                })
                .catch(()=>{
                    return next({name:'login'})
                })
            }
        },
        {
            // routeのパス設定
            path: '/world',
            // 名前付きルートを設定したい場合付与
            // コンポーネントの指定
            component: world
        },
        {
            // routeのパス設定
            path: '/hello',
            // 名前付きルートを設定したい場合付与
            // コンポーネントの指定
            component: hello
        },
        {
            path: '/storeadd',
            component:storeadd,
            name: 'storeadd',
            beforeEnter: (to, from, next) => {
                axios.get('/api/athenticated')
                .then(()=>{
                    next()
                })
                .catch(()=>{
                    return next({name:'login'})
                })
            }
        },
        // {
        //     path: '/storeedit',
        //     component: storeedit
        // },
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
                axios.get('/api/athenticated')
                .then(()=>{
                    next()
                })
                .catch(()=>{
                    return next({name:'login'})
                })
            }
        }

    ]
});