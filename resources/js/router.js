import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import hello from './components/Hello.vue'
import world from './components/World.vue'
import storelist from './components/StoreList.vue'
import storeadd from './components/StoreAdd.vue'
import storeedit from './components/store/StoreEdit.vue'
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
            component: storelist
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
            component:storeadd
        },
        {
            path: '/storeedit',
            component: storeedit
        }

    ]
});