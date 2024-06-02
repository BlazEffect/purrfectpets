<template>
  <div id="cart-page">
    <h1>Корзина</h1>
    <div class="cart-items-container">
      <div v-for="item in cart" :key="item.id" class="cart-item">
        <img :src="item.image" :alt="item.name">
        <h2>{{ item.name }}</h2>
        <p>{{ item.description }}</p>
        <p>{{ item.price }} руб.</p>
        <p>Количество: {{ item.quantity }}</p>
        <button @click="handleRemoveFromCart(item.id)">Удалить из корзины</button>
      </div>
    </div>
    <div class="cart-summary">
      <h2>Итого: {{ totalAmount }} руб.</h2>
      <router-link to="/checkout" class="checkout-button">Перейти к оформлению</router-link>
    </div>
    <router-link to="/" class="continue-shopping">Продолжить покупки</router-link>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  computed: {
    ...mapGetters(['cart']),
    totalAmount() {
      return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    }
  },
  methods: {
    ...mapActions(['removeFromCart']),
    handleRemoveFromCart(productId) {
      this.removeFromCart(productId);
      console.log(`Товар с id ${productId} удален из корзины.`);
    }
  }
};
</script>

<style scoped>
#cart-page {
  max-width: 800px;
  margin: 50px auto;
  padding: 40px;
  border: 1px solid #eaeaea;
  border-radius: 5px;
  box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
  background-color: #ffffff;
  color: #000000;
}

h1 {
  text-align: center;
  margin-bottom: 50px;
}

.cart-items-container {
  margin: 0 auto;
  max-width: 600px;
}

.cart-item {
  margin-bottom: 20px;
  border-bottom: 1px solid #eaeaea; /* Добавляем разделение */
  padding-bottom: 20px; /* Отступ между товарами */
}

.cart-item img {
  width: 100px;
  border-radius: 10px;
}

.cart-item h2 {
  margin-top: 10px;
}

.cart-item p {
  color: #666;
}

.cart-item button {
  background-color: #dc3545;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px;
  cursor: pointer;
  margin-top: 10px;
}

.cart-item button:hover {
  background-color: #c82333;
}

.cart-summary {
  text-align: center;
  margin-top: 30px;
}

.cart-summary h2 {
  margin-bottom: 20px;
}

.checkout-button {
  display: inline-block;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
  text-decoration: none;
}

.checkout-button:hover {
  background-color: #0056b3;
}

.continue-shopping {
  display: inline-block;
  margin-top: 20px;
  text-decoration: none;
  color: #007bff;
  border: 2px solid #007bff;
  padding: 5px 10px;
  border-radius: 7px;
}

.continue-shopping:hover {
  color: #0056b3;
}
</style>
