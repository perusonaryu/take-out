import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    message: 'Hello Vuex',
    cartItems:[],
  },
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
    }
  },
  getters:{
    cartItems: function (state){
      return state.cartItems
    }
  },
  modules: {
  }
})