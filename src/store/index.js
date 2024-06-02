import { createStore } from 'vuex';

import catfood1 from '@/assets/catfood1.jpg';
import dogfood1 from '@/assets/dogfood1.jpg';
import preservesdog1 from '@/assets/dog/preservesdog1.jpg';
import fishfood1 from '@/assets/fishfood1.jpg';
import rodentfood1 from '@/assets/rodentfood1.jpg';
import birdfood1 from '@/assets/birdfood1.jpg';

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
      
      { id: 21, name: 'Корм для рыб', description: 'Описание корма для рыб...', price: 50, image: fishfood1 },
      { id: 22, name: 'Аквариумы', description: 'Описание аквариумов...', price: 100, image: fishfood1 },
      { id: 23, name: 'Фильтры для аквариумов', description: 'Описание фильтров для аквариумов...', price: 150, image: fishfood1 },
      { id: 24, name: 'Декорации для аквариума', description: 'Описание декораций для аквариума...', price: 200, image: fishfood1 },
      { id: 25, name: 'Обогреватели для аквариумов', description: 'Описание обогревателей для аквариумов...', price: 250, image: fishfood1 },
      { id: 26, name: 'Освещение для аквариумов', description: 'Описание освещения для аквариумов...', price: 300, image: fishfood1 },
      { id: 27, name: 'Средства по уходу за водой', description: 'Описание средств по уходу за водой...', price: 350, image: fishfood1 },
      { id: 28, name: 'Тесты для воды', description: 'Описание тестов для воды...', price: 400, image: fishfood1 },
      { id: 29, name: 'Камни и ракушки', description: 'Описание камней и ракушек для аквариума...', price: 450, image: fishfood1 },
      { id: 30, name: 'Растения для аквариума', description: 'Описание растений для аквариума...', price: 500, image: fishfood1 },
      
      { id: 31, name: 'Корм для грызунов', description: 'Описание корма для грызунов...', price: 100, image: rodentfood1 },
      { id: 32, name: 'Игрушки для грызунов', description: 'Описание игрушек для грызунов...', price: 200, image: rodentfood1 },
      { id: 33, name: 'Клетки для грызунов', description: 'Описание клеток для грызунов...', price: 300, image: rodentfood1 },
      { id: 34, name: 'Наполнитель для грызунов', description: 'Описание наполнителя для грызунов...', price: 400, image: rodentfood1 },
      { id: 35, name: 'Домики для грызунов', description: 'Описание домиков для грызунов...', price: 500, image: rodentfood1 },
      { id: 36, name: 'Поилки для грызунов', description: 'Описание поилок для грызунов...', price: 600, image: rodentfood1 },
      { id: 37, name: 'Кормушки для грызунов', description: 'Описание кормушек для грызунов...', price: 700, image: rodentfood1 },
      { id: 38, name: 'Колеса для грызунов', description: 'Описание колес для грызунов...', price: 800, image: rodentfood1 },
      { id: 39, name: 'Витамины для грызунов', description: 'Описание витаминов для грызунов...', price: 900, image: rodentfood1 },
      { id: 40, name: 'Туалеты для грызунов', description: 'Описание туалетов для грызунов...', price: 1000, image: rodentfood1 },
      
      { id: 41, name: 'Корм для птиц', description: 'Описание корма для птиц...', price: 50, image: birdfood1 },
      { id: 42, name: 'Клетки для птиц', description: 'Описание клеток для птиц...', price: 100, image: birdfood1 },
      { id: 43, name: 'Игрушки для птиц', description: 'Описание игрушек для птиц...', price: 150, image: birdfood1 },
      { id: 44, name: 'Поилки для птиц', description: 'Описание поилок для птиц...', price: 200, image: birdfood1 },
      { id: 45, name: 'Кормушки для птиц', description: 'Описание кормушек для птиц...', price: 250, image: birdfood1 },
      { id: 46, name: 'Лакомства для птиц', description: 'Описание лакомств для птиц...', price: 300, image: birdfood1 },
      { id: 47, name: 'Витамины для птиц', description: 'Описание витаминов для птиц...', price: 350, image: birdfood1 },
      { id: 48, name: 'Зерносмесь для птиц', description: 'Описание зерносмеси для птиц...', price: 400, image: birdfood1 },
      { id: 49, name: 'Минеральные камни для птиц', description: 'Описание минеральных камней для птиц...', price: 450, image: birdfood1 },
      { id: 50, name: 'Средства для ухода за птицами', description: 'Описание средств для ухода за птицами...', price: 500, image: birdfood1 },
    ]
  },
  mutations: {
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
    }
  },
  actions: {
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
    }
  },
  getters: {
    products: state => state.products,
    catProducts: state => state.products.filter(product => product.id >= 1 && product.id <= 10),
    dogProducts: state => state.products.filter(product => product.id >= 11 && product.id <= 20),
    fishProducts: state => state.products.filter(product => product.id >= 21 && product.id <= 30),
    rodentProducts: state => state.products.filter(product => product.id >= 31 && product.id <= 40),
    birdProducts: state => state.products.filter(product => product.id >= 41 && product.id <= 50),
    cart: state => state.cart,
    cartTotal: state => {
      return state.cart.reduce((total, product) => total + product.price * product.quantity, 0);
    }
  },
  strict: process.env.NODE_ENV !== 'production'
});

export default store;
