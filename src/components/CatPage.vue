<template>
  <div id="cat-catalog-page">
    <h1>Каталог товаров для кошек</h1>
    <div class="products">
      <div v-for="product in products" :key="product.id" class="product">
        <img :src="catfood1" :alt="product.name">
        <h2>{{ product.name }}</h2>
        <p>{{ product.description }}</p>
        <p>{{ product.price }} руб.</p>
        <button @click="handleAddToCart(product.id)">Добавить в корзину</button>
      </div>
    </div>
    <router-link to="/cart" class="cart-link">Перейти в корзину</router-link>
    <router-link to="/" class="home-link">Вернуться на главную</router-link>
  </div>
</template>

<script>
import catfood1 from '@/assets/catfood1.jpg';
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      catfood1,
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
    };
  },
  methods: {
    ...mapActions(['addToCart']),
    handleAddToCart(productId) {
      this.addToCart(productId);
      console.log(`Товар с id ${productId} добавлен в корзину.`);
    }
  }
};
</script>

<style scoped>
#cat-catalog-page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px;
  box-sizing: border-box;
  text-align: center;
}

h1 {
  margin-bottom: 50px;
}

.products {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.product {
  width: 200px;
  margin: 0 20px 80px;
  text-align: center;
}

.product img {
  width: 100%;
  border-radius: 10px;
}

.product h2 {
  margin-top: 10px;
}

.product p {
  color: #666;
}

.product button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px;
  cursor: pointer;
  margin-top: 10px;
}

.product button:hover {
  background-color: #0056b3;
}

.cart-link, .home-link {
  display: inline-block;
  margin-top: 20px;
  text-decoration: none;
  color: #007bff;
  border: 2px solid #007bff;
  padding: 5px 10px;
  border-radius: 7px;
}

.cart-link:hover, .home-link:hover {
  color: #0056b3;
}
</style>
