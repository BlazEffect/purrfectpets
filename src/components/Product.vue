<template>
    <div class="product">
      <h3>{{ product.name }}</h3>
      <p>{{ product.description }}</p>
      <p>{{ product.price }} рублей</p>
      <button @click="addToCart(product.id)">Добавить в корзину</button>
    </div>
  </template>
  
  <script>
  import { mapActions } from 'vuex';
  
  export default {
    props: ['product'],
    methods: {
      ...mapActions(['addToCart']),
      addToCart(productId) {
        this.addToCart(productId);
        console.log(`Товар с id ${productId} добавлен в корзину.`);
      }
    }
  };
  </script>
  
  <style scoped>
  .product {
    border: 1px solid #eaeaea;
    padding: 20px;
    margin-bottom: 20px;
  }
  
  h3 {
    margin-top: 0;
  }
  
  p {
    margin-bottom: 10px;
  }
  
  button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
  }
  </style>
  