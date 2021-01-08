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
import userinfotop from './components/UserPage/UserInfoTop.vue'
import userpaymentform from './components/UserPage/UserPaymentForm.vue'
import userpaymentinfo from './components/UserPage/UserPaymentInfo.vue'
import userorderhistory from './components/UserPage/UserOrderHistory.vue'
import userinfodetail from './components/UserPage/UserInfoDetail.vue'
import shop from './components/Shop.vue'
import shopAdressSerch from './components/shop/shopAdressSerch'
import ShopList from './components/ShopList.vue'
import ShopConfirm from './components/ShopConfirm.vue'
import ShopSettle from './components/ShopSettle.vue'
import ShopComplete from './components/ShopComplete.vue'
import OrderHistory from './components/store/OrderHistory.vue'
import OrderComplete from './components/store/OrderComplete.vue'

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
            // name:topPage,
        },
        {
            path: '/top',
            component: topPage,
            name:topPage,
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
                    return next({name:'storeLogin'})
                })
            }
        },

        // {
        //     path: '/storeadd',
        //     component:storeadd,
        //     name: 'storeadd',
        //     beforeEnter: (to, from, next) => {
        //         axios.get('/athenticated')
        //         .then(()=>{
        //             next()
        //         })
        //         .catch(()=>{
        //             return next({name:'login'})
        //         })
        //     }
        // },
        {
            path: '/OrderHistory',
            component:OrderHistory,
            name: 'OrderHistory',
            beforeEnter: (to, from, next) => {
                axios.get('/storeusers/athenticated')
                .then(()=>{
                    next()
                })
                .catch(()=>{
                    return next({name:'storeLogin'})
                })
            }
        },
        {
            path: '/OrderComplete',
            component:OrderComplete,
            name: 'OrderComplete',
            beforeEnter: (to, from, next) => {
                axios.get('/storeusers/athenticated')
                .then(()=>{
                    next()
                })
                .catch(()=>{
                    return next({name:'storeLogin'})
                })
            }
        },
        {
            path: '/register',
            component: register,
            name:'register'
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
        {
            path: '/userinfotop',
            component: userinfotop,
            name: 'userinfotop',
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
            path: '/userinfodetail',
            component: userinfodetail,
            name: 'userinfodetail',
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
            path: '/userpaymentinfo',
            component: userpaymentinfo,
            name: 'userpaymentinfo',
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
            path: '/userinfodetail',
            component: userinfodetail,
            name: 'userinfodetail',
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
            path: '/userpaymentform',
            component: userpaymentform,
            name: 'userpaymentform',
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
            path: '/userorderhistory',
            component: userorderhistory,
            name: 'userorderhistory',
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
            path: '/shop:id',
            component: shop,
            name: 'shop'
        },
        {
            path: '/serch:address',
            component: shopAdressSerch,
            name: 'shopAdressSerch'
        },
        {
            path: '/ShopList/:id',
            component: ShopList,
            name: 'ShopList',
            props:true,
        },
        {
            path: '/Confirm',
            component: ShopConfirm,
            name: 'Confirm',
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
            path: '/Settle',
            component: ShopSettle,
            name: 'Settle',
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
            path: '/SettleComplete',
            component: ShopComplete,
            name: 'SettleComplete',
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
    
    ]
});

