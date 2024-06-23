<template>
  <div id="cat-catalog-page">
    <h1>Каталог товаров для кошек</h1>
    <div class="products">
      <div v-if="products.length === 0" class="loading-message">
        Загрузка...
      </div>
      <div v-else>
        <div v-for="product in products" :key="product.id" class="product">
          <img :src="getImageUrl(product.image)" :alt="product.name">
          <h2>{{ product.name }}</h2>
          <p>{{ product.price }} руб.</p>
          <div class="button-container">
            <button @click="handleAddToCart(product.id)">Добавить в корзину</button>
          </div>
        </div>
      </div>
    </div>
    <router-link to="/cart" class="cart-link">Перейти в корзину</router-link>
    <br>
    <router-link to="/" class="home-link">Вернуться на главную</router-link>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
  computed: {
    ...mapGetters(['products']),
  },
  methods: {
    ...mapActions(['addToCart', 'fetchProducts']),
    handleAddToCart(productId) {
      this.addToCart(productId);
      console.log(`Товар с id ${productId} добавлен в корзину.`);
    },
    getImageUrl(url) {
      return url.replace('http://', 'https://');
    }
  },
  created() {
    this.fetchProducts();
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
  font-family: 'Arial', sans-serif;
  color: #333;
}

h1 {
  margin-bottom: 30px;
  font-size: 2.5em;
  color: #333;
}

.products {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 20px;
}

.product {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
  box-sizing: border-box;
}

.product:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.product img {
  width: 100%;
  height: auto;
  display: block;
  margin-bottom: 15px;
  border-radius: 10px;
}

.product h2 {
  font-size: 1.5em;
  margin: 10px 0;
  color: #333;
}

.product p {
  color: #777;
  font-size: 1.2em;
  margin: 10px 0;
}

.button-container {
  margin-top: auto;
}

.product button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 1em;
  cursor: pointer;
  transition: background-color 0.3s;
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
  padding: 10px 20px;
  border-radius: 5px;
  transition: color 0.3s, border-color 0.3s;
}

.cart-link:hover, .home-link:hover {
  color: #0056b3;
  border-color: #0056b3;
}

.loading-message {
  font-size: 1.5em;
  color: #777;
  margin-top: 50px;
}
</style>
