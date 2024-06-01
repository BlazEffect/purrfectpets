<template>
    <div id="rodent-catalog-page">
      <h1>Каталог товаров для грызунов</h1>
      <div class="products">
        <div v-for="product in products" :key="product.id" class="product">
          <img :src="rodentfood1" :alt="product.name">
          <h2>{{ product.name }}</h2>
          <p>{{ product.description }}</p>
          <button @click="addToCart(product)">Добавить в корзину</button>
        </div>
      </div>
      <router-link to="/" class="home-link">Вернуться на главную</router-link>
    </div>
  </template>
  
  <script>
  import rodentfood1 from '@/assets/rodentfood1.jpg';
  
  export default {
    data() {
      return {
        rodentfood1: rodentfood1,
        products: [
          { id: 1, name: 'Корм для грызунов', description: 'Описание корма для грызунов...' },
          { id: 2, name: 'Игрушки для грызунов', description: 'Описание игрушек для грызунов...' },
          { id: 3, name: 'Домик для грызунов', description: 'Описание домика для грызунов...' },
          { id: 4, name: 'Колесо для грызунов', description: 'Описание колеса для грызунов...' },
          { id: 5, name: 'Песок для грызунов', description: 'Описание песка для грызунов...' },
          { id: 6, name: 'Наполнитель для клетки', description: 'Описание наполнителя для клетки...' },
          { id: 7, name: 'Кормушка для грызунов', description: 'Описание кормушки для грызунов...' },
          { id: 8, name: 'Деревянные игрушки', description: 'Описание деревянных игрушек для грызунов...' },
          { id: 9, name: 'Витамины для грызунов', description: 'Описание витаминов для грызунов...' },
          { id: 10, name: 'Туннели для грызунов', description: 'Описание туннелей для грызунов...' },
        ]
      };
    },
    methods: {
      addToCart(product) {
        // Логика добавления товара в корзину
        console.log(`Товар "${product.name}" добавлен в корзину.`);
      }
    }
  };
  </script>
  
  <style scoped>
  #rodent-catalog-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px;
    box-sizing: border-box;
    text-align: center;
  }
  
  h1 {
    margin-bottom: 50px; /* Увеличенный отступ между заголовком и товарами */
  }
  
  .products {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .product {
    width: 200px;
    margin: 0 20px 80px; /* Увеличенный отступ между каждым товаром и кнопкой */
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
  </style>
  