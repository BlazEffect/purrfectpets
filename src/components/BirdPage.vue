<template>
  <div id="bird-catalog-page">
    <h1>Каталог товаров для птиц</h1>
    <div class="products">
      <div v-for="product in birdProducts" :key="product.id" class="product">
        <img :src="product.image" :alt="product.name">
        <h2>{{ product.name }}</h2>
        <p>{{ product.description }}</p>
        <p>{{ product.price }} руб.</p>
        <button @click="handleAddToCart(product.id)">Добавить в корзину</button>
      </div>
    </div>
    <router-link to="/cart" class="cart-link">Перейти в корзину</router-link>
    <br>
    <router-link to="/" class="home-link">Вернуться на главную</router-link>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import birdfood1 from '@/assets/birdfood1.jpg';

export default {
  computed: {
    ...mapGetters(['birdProducts'])
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
#bird-catalog-page {
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
  padding: 8px 16px;
  cursor: pointer;
}

.product button:hover {
  background-color: #0056b3;
}

.home-link {
  display: inline-block;
  margin-top: 20px;
  text-decoration: none;
  color: #007bff;
  border: 2px solid #007bff;
  border-radius: 5px;
  padding: 8px 16px;
}

.home-link:hover {
  background-color: #007bff;
  color: #ffffff;
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

.cart-link:hover {
  background-color: #007bff;
  color: #ffffff;
}
</style>
