import { createStore } from 'vuex';

const store = createStore({
  state: {
    cart: [], // Массив товаров в корзине
    products: [ /* Здесь должен быть массив всех доступных товаров */ ]
  },
  mutations: {
    // Добавление товара в корзину
    addToCart(state, productId) {
      const product = state.products.find(prod => prod.id === productId);
      if (product) {
        state.cart.push(product);
      }
    },
    // Удаление товара из корзины
    removeFromCart(state, productId) {
      state.cart = state.cart.filter(product => product.id !== productId);
    }
  },
  actions: {
    // Может содержать асинхронные действия, например, запросы к серверу
  },
  getters: {
    // Получение данных из хранилища
    cart: state => state.cart
  }
});

export default store;
