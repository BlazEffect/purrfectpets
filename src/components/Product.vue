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
    addToCart(product) {
    this.$store.commit('addToCart', product.id); // Вызываем мутацию addToCart с передачей id товара
    console.log(`Товар "${product.name}" добавлен в корзину.`);
  }
}
};
  </script>
  
  <style scoped>
  /* Стили для компонента */
  </style>
