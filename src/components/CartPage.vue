<template>
    <div id="cart-page">
      <h1>Корзина</h1>
      <div class="cart-items">
        <!-- Здесь будет список товаров в корзине -->
        <div class="cart-item">
          <p>Название: Корм для кошек</p>
          <p>Цена: 100 рублей</p>
          <button @click="removeFromCart">Удалить</button>
        </div>
      </div>
      <p v-if="cartItems.length === 0">Корзина пуста</p>
      <p v-else>Всего товаров в корзине: {{ cartItems.length }}</p>
      <router-link to="/" class="continue-shopping">Продолжить покупки</router-link>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        cartItems: [
          // Здесь будут товары в корзине
        ]
      };
    },
    methods: {
      removeFromCart() {
        // Логика удаления товара из корзины
      }
    }
  };
  </script>
  
  <style scoped>
  #cart-page {
    max-width: 600px;
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
    margin-bottom: 30px;
    color: #333;
    font-size: 24px;
  }
  
  .cart-items {
    margin-bottom: 20px;
  }
  
  .cart-item {
    border-bottom: 1px solid #eaeaea;
    padding: 10px 0;
  }
  
  .cart-item p {
    margin: 5px 0;
  }
  
  button {
    background-color: #ff3b30;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #cc2e23;
  }
  
  p {
    font-size: 16px;
  }
  
  .continue-shopping {
    display: block;
    text-align: center;
    color: #007bff;
    text-decoration: none;
    margin-top: 20px;
    border: 2px solid #007bff; /* Добавляем синюю обводку */
    padding: 5px 10px;
    border-radius: 7px;
  }
  
  .continue-shopping:hover {
    color: #0056b3;
  }
  </style>
  