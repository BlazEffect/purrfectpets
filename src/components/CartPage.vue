<template>
  <div id="cart-page">
    <h1>Корзина</h1>
    <div class="cart-items-container">
      <div v-for="item in cart" :key="item.id" class="cart-item">
        <img :src="item.image" :alt="item.name" class="cart-item-image">
        <div class="cart-item-details">
          <h2>{{ item.name }}</h2>
          <p>{{ item.description }}</p>
          <p>{{ item.price }} руб.</p>
          <p>Количество: {{ item.quantity }}</p>
          <button @click="handleRemoveFromCart(item.id)">Удалить из корзины</button>
        </div>
      </div>
    </div>
    <div class="cart-summary">
      <h2>Итого: {{ totalAmount }} руб.</h2>
    </div>
    <div class="cart-actions">
      <router-link to="/" class="continue-shopping">Продолжить покупки</router-link>
      <router-link to="/checkout" class="checkout-button">Перейти к оформлению</router-link>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  computed: {
    ...mapGetters(['cart', 'cartTotal']),
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
  },
  created() {
    this.$store.dispatch('initializeCart');
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
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  border-bottom: 1px solid #eaeaea;
  padding-bottom: 20px;
}

.cart-item img {
  width: 100px;
  border-radius: 10px;
}

.cart-item-details {
  margin-left: 20px;
  flex: 1;
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

.cart-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
}

.continue-shopping,
.checkout-button {
  display: inline-block;
  text-decoration: none;
  padding: 10px 20px;
  border-radius: 7px;
}

.continue-shopping {
  background-color: #007bff;
  color: #fff;
  border: 2px solid #007bff;
}

.continue-shopping:hover {
  background-color: #0056b3;
  border-color: #0056b3;
}

.checkout-button {
  background-color: #28a745;
  color: #fff;
  border: 2px solid #28a745;
}

.checkout-button:hover {
  background-color: #218838;
  border-color: #218838;
}
</style>
