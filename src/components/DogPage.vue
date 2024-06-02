<template>
  <div id="dog-catalog-page">
    <h1>Каталог товаров для собак</h1>
    <div class="products">
      <div v-for="product in dogProducts" :key="product.id" class="product">
        <img :src="product.image" :alt="product.name">
        <h2>{{ product.name }}</h2>
        <p>{{ product.description }}</p>
        <p>{{ product.price }} руб.</p>
        <div class="button-container">
          <button @click="handleAddToCart(product.id)">Добавить в корзину</button>
        </div>
      </div>
    </div>
    <router-link to="/cart" class="cart-link">Перейти в корзину</router-link>
    <br>
    <router-link to="/" class="home-link">Вернуться на главную</router-link>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  computed: {
    ...mapGetters(['dogProducts'])
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
#dog-catalog-page {
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
  justify-content: space-between;
}

.product {
  width: calc(33.33% - 40px); /* Ширина 1/3 контейнера за вычетом маржинов */
  margin: 0 20px 40px; /* Вертикальный отступ между товарами */
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: relative; /* Для позиционирования кнопки */
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

.button-container {
  margin-top: 10px;
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
