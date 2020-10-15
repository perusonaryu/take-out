import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'


Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    cartItems:[],
    storeId:'',
    selectedStore:[],
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
    changeSelectedStore(state,store){
      state.selectedStore = {
        storeName:store.name,
        storeAddress:store.address,
        storeIntroduction:store.introduction,
        storeImage:store.image,
      };
      
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
    },

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
      if( state.storeId === id || !state.storeId.length){
        commit('pushStoreId',id);
      }else if(state.storeId != id){
        commit('emptyItemCart');
        commit('pushStoreId',store);
      }else{
        // console.log('ダメだった');
      }
    },
    addSelectedStore({commit},id){
      axios.get('/storeGet/' + id)
      .then(response => {
        commit('changeSelectedStore', response.data);
        // console.log(response.data);
      })
      .catch(error => console.log(error))
    },
    
  },
  getters:{
    cartItems: function (state){
      return state.cartItems
    },
    selectedStore:function(state){
      return state.selectedStore
    },
    cartTotalPrice: function(state,getters){
      const totalPrice = getters.cartItems.reduce((total,item)=>{
        return total + item.price * item.quantity
      },0);

      return Math.ceil(totalPrice * 1.08);
    },
    storeId:function(state){
      return state.storeId;
    }

  },
  modules: {
  },
})