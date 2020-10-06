import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'


Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    cartItems:[],
    storeId:'',
  },
  plugins: [createPersistedState()],
  mutations: {
    pushItemCart(state,item){
      state.cartItems.push({
        itemName:item.item_name,
        price:item.price,
        quantity: 1,
        id:item.id
      }
      )
    },

    incrementItemQuantity(state,{id}){
      const cart = state.cartItems.find(cartItem => cartItem.id === id);
      cart.quantity++;
    },

    deleteItemCart(state,item){
      state.cartItems = state.cartItems.filter(cartItem => cartItem !== item )
    },
    emptyItemCart(state){
      state.cartItems = []
    },
    pushStoreId(state,id){
      state.storeId = id;
    }
  },
  actions: {
    addItemCart({state,commit},item){
      const cart = state.cartItems.find(cartItem => cartItem.id === item.id)
      if(!cart){
        commit('pushItemCart',item);
      }else{
        commit('incrementItemQuantity',cart);
      }
    },
    addStoreId({state,commit},id){
      if(!state.storeId.length){
        commit('pushStoreId',id);
      }else if(state.storeId != id){
        commit('emptyItemCart');
        commit('pushStoreId',store);
      }else{
        console.log('ダメだった');
      }
    }
    
  },
  getters:{
    cartItems: function (state){
      return state.cartItems
    },
    cartTotalPrice: function(state,getters){
      const totalPrice = getters.cartItems.reduce((total,item)=>{
        return total + item.price * item.quantity
      },0);

      return Math.ceil(totalPrice * 1.08);

    }
  },
  modules: {
  },
})