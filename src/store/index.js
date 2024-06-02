import { createStore } from 'vuex';

const store = createStore({
  state: {
    cart: [],
    products: [
      { id: 1, name: 'Корм для кошек', description: 'Описание корма для кошек...', price: 100 },
      { id: 2, name: 'Игрушки для кошек', description: 'Описание игрушек для кошек...', price: 200 },
      { id: 3, name: 'Лежанка для кошек', description: 'Описание лежанки для кошек...', price: 300 },
      { id: 4, name: 'Когтеточка для кошек', description: 'Описание когтеточки для кошек...', price: 400 },
      { id: 5, name: 'Кормушка для кошек', description: 'Описание кормушки для кошек...', price: 500 },
      { id: 6, name: 'Ошейник для кошек', description: 'Описание ошейника для кошек...', price: 600 },
      { id: 7, name: 'Постель для кошек', description: 'Описание постели для кошек...', price: 700 },
      { id: 8, name: 'Коврик для кошек', description: 'Описание коврика для кошек...', price: 800 },
      { id: 9, name: 'Консервы для кошек', description: 'Описание консервов для кошек...', price: 900 },
      { id: 10, name: 'Ветеринарные препараты для кошек', description: 'Описание ветпрепаратов для кошек...', price: 1000 },
    ]
  },
  mutations: {
    // Добавление товара в корзину
    addToCart(state, productId) {
      const product = state.products.find(prod => prod.id === productId);
      if (product) {
        const existingItem = state.cart.find(item => item.id === productId);
        if (existingItem) {
          existingItem.quantity++;
        } else {
          state.cart.push({ ...product, quantity: 1 });
        }
      }
    },
    // Удаление товара из корзины
    removeFromCart(state, productId) {
      state.cart = state.cart.filter(product => product.id !== productId);
    }
  },
  actions: {
    addToCart({ commit }, productId) {
      commit('addToCart', productId);
    },
    removeFromCart({ commit }, productId) {
      commit('removeFromCart', productId);
    }
  },
  getters: {
    cart: state => state.cart,
    products: state => state.products
  }
});

export default store;
