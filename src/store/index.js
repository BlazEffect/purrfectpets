import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
  state: {
    cart: [],
    products: []
  },
  getters: {
    products: state => state.products,
    cart: state => state.cart,
    cartTotal: state => {
      return state.cart.reduce((total, product) => total + product.price * product.quantity, 0);
    }
  },
  mutations: {
    setProducts(state, products) {
      state.products = products;
    },
    addToCart(state, product) {
      const existingItem = state.cart.find(item => item.id === product.id);
      if (existingItem) {
        existingItem.quantity++;
      } else {
        state.cart.push({ ...product, quantity: 1 });
      }
      localStorage.setItem('cart', JSON.stringify(state.cart));
    },
    removeFromCart(state, productId) {
      state.cart = state.cart.filter(product => product.id !== productId);
      localStorage.setItem('cart', JSON.stringify(state.cart));
    },
    initializeCart(state) {
      const cart = localStorage.getItem('cart');
      if (cart) {
        state.cart = JSON.parse(cart);
      }
    },
    UPDATE_QUANTITY(state, { productId, quantity }) {
      const item = state.cart.find(item => item.id === productId);
      if (item) {
        item.quantity = quantity;
      }
      localStorage.setItem('cart', JSON.stringify(state.cart));
    }
  },
  actions: {
    async fetchProducts({ commit }) {
      try {
        const response = await axios.get('https://api.purrfectpets.ru/api/v1/section/222/products');
        console.log('Fetched products:', response.data.data);
        commit('setProducts', response.data.data);
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    addToCart({ commit, state }, productId) {
      const product = state.products.find(product => product.id === productId);
      if (product) {
        commit('addToCart', product);
      }
    },
    removeFromCart({ commit }, productId) {
      commit('removeFromCart', productId);
    },
    initializeCart({ commit }) {
      commit('initializeCart');
    },
    updateQuantity({ commit }, { productId, quantity }) {
      commit('UPDATE_QUANTITY', { productId, quantity });
    }
  },
  strict: process.env.NODE_ENV !== 'production'
});

export default store;