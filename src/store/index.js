import { createStore } from 'vuex';
import catfood1 from '@/assets/catfood1.jpg';
import dogfood1 from '@/assets/dogfood1.jpg';

const store = createStore({
  state: {
    cart: [],
    products: [
      { id: 1, name: 'Корм для кошек', description: 'Описание корма для кошек...', price: 100, image: catfood1 },
      { id: 2, name: 'Игрушки для кошек', description: 'Описание игрушек для кошек...', price: 200, image: catfood1 },
      { id: 3, name: 'Лежанка для кошек', description: 'Описание лежанки для кошек...', price: 300, image: catfood1 },
      { id: 4, name: 'Когтеточка для кошек', description: 'Описание когтеточки для кошек...', price: 400, image: catfood1 },
      { id: 5, name: 'Кормушка для кошек', description: 'Описание кормушки для кошек...', price: 500, image: catfood1 },
      { id: 6, name: 'Ошейник для кошек', description: 'Описание ошейника для кошек...', price: 600, image: catfood1 },
      { id: 7, name: 'Постель для кошек', description: 'Описание постели для кошек...', price: 700, image: catfood1 },
      { id: 8, name: 'Коврик для кошек', description: 'Описание коврика для кошек...', price: 800, image: catfood1 },
      { id: 9, name: 'Консервы для кошек', description: 'Описание консервов для кошек...', price: 900, image: catfood1 },
      { id: 10, name: 'Ветеринарные препараты для кошек', description: 'Описание ветпрепаратов для кошек...', price: 1000, image: catfood1 },
      { id: 11, name: 'Корм для собак', description: 'Описание корма для собак...', price: 150, image: dogfood1 },
      { id: 12, name: 'Игрушки для собак', description: 'Описание игрушек для собак...', price: 250, image: dogfood1 },
      { id: 13, name: 'Лежак для собак', description: 'Описание лежака для собак...', price: 350, image: dogfood1 },
      { id: 14, name: 'Ошейник для собак', description: 'Описание ошейника для собак...', price: 450, image: dogfood1 },
      { id: 15, name: 'Костюм для собак', description: 'Описание костюма для собак...', price: 550, image: dogfood1 },
      { id: 16, name: 'Миска для собак', description: 'Описание миски для собак...', price: 650, image: dogfood1 },
      { id: 17, name: 'Сухой корм для собак', description: 'Описание сухого корма для собак...', price: 750, image: dogfood1 },
      { id: 18, name: 'Коврик для собак', description: 'Описание коврика для собак...', price: 850, image: dogfood1 },
      { id: 19, name: 'Шампунь для собак', description: 'Описание шампуня для собак...', price: 950, image: dogfood1 },
      { id: 20, name: 'Поводок для собак', description: 'Описание поводка для собак...', price: 1050, image: dogfood1 },
    ]
  },
  mutations: {
    // Добавление товара в корзину
    addToCart(state, product) {
      const existingItem = state.cart.find(item => item.id === product.id);
      if (existingItem) {
        existingItem.quantity++;
      } else {
        state.cart.push({ ...product, quantity: 1 });
      }
    },
    // Удаление товара из корзины
    removeFromCart(state, productId) {
      state.cart = state.cart.filter(product => product.id !== productId);
    }
  },
  actions: {
    addToCart({ commit, state }, productId) {
      const product = state.products.find(prod => prod.id === productId);
      if (product) {
        commit('addToCart', product);
      }
    },
    removeFromCart({ commit }, productId) {
      commit('removeFromCart', productId);
    }
  },
  getters: {
    cart: state => state.cart,
    products: state => state.products,
    dogProducts: state => state.products.filter(product => product.name.includes('собак'))
  }
});

export default store;
