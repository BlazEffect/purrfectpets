<template>
    <div id="bird-catalog-page">
      <h1>Каталог товаров для птиц</h1>
      <div class="products">
        <div v-for="product in products" :key="product.id" class="product">
          <img :src="birdfood1" :alt="product.name">
          <h2>{{ product.name }}</h2>
          <p>{{ product.description }}</p>
          <button @click="addToCart(product)">Добавить в корзину</button>
        </div>
      </div>
      <router-link to="/" class="home-link">Вернуться на главную</router-link>
    </div>
  </template>
  
  <script>
  import birdfood1 from '@/assets/birdfood1.jpg';
  
  export default {
    data() {
      return {
        birdfood1: birdfood1,
        products: [
          { id: 1, name: 'Корм для птиц', description: 'Описание корма для птиц...' },
          { id: 2, name: 'Игрушки для птиц', description: 'Описание игрушек для птиц...' },
          { id: 3, name: 'Гнезда для птиц', description: 'Описание гнезд для птиц...' },
          { id: 4, name: 'Птичьи домики', description: 'Описание птичьих домиков...' },
          { id: 5, name: 'Кормушки для птиц', description: 'Описание кормушек для птиц...' },
          { id: 6, name: 'Витамины для птиц', description: 'Описание витаминов для птиц...' },
          { id: 7, name: 'Птичьи ванны', description: 'Описание птичьих ванн...' },
          { id: 8, name: 'Семена для птиц', description: 'Описание семян для птиц...' },
          { id: 9, name: 'Ошейники для птиц', description: 'Описание ошейников для птиц...' },
          { id: 10, name: 'Деревянные игрушки', description: 'Описание деревянных игрушек для птиц...' },
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
  #bird-catalog-page {
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
  