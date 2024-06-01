<template>
  <div id="cat-catalog-page">
    <h1>Каталог товаров для кошек</h1>
    <div class="products">
      <div v-for="product in products" :key="product.id" class="product">
        <img :src="catfood1" :alt="product.name">
        <h2>{{ product.name }}</h2>
        <p>{{ product.description }}</p>
        <p>{{ product.price }} руб.</p>
        <button @click="addToCart(product)">Добавить в корзину</button>
      </div>
    </div>
    <router-link to="/cartpage" class="cart-link">Перейти в корзину</router-link>
    <br>
    <router-link to="/" class="home-link">Вернуться на главную</router-link>
  </div>
</template>

  
  <script>
  import catfood1 from '@/assets/catfood1.jpg';
  
  export default {
    data() {
      return {
        catfood1: catfood1,
        products: [
          { id: 1, name: 'Корм для кошек', description: 'Описание корма для кошек...' },
          { id: 2, name: 'Игрушки для кошек', description: 'Описание игрушек для кошек...' },
          { id: 3, name: 'Лежанка для кошек', description: 'Описание лежанки для кошек...' },
          { id: 4, name: 'Когтеточка для кошек', description: 'Описание когтеточки для кошек...' },
          { id: 5, name: 'Кормушка для кошек', description: 'Описание кормушки для кошек...' },
          { id: 6, name: 'Ошейник для кошек', description: 'Описание ошейника для кошек...' },
          { id: 7, name: 'Постель для кошек', description: 'Описание постели для кошек...' },
          { id: 8, name: 'Коврик для кошек', description: 'Описание коврика для кошек...' },
          { id: 9, name: 'Консервы для кошек', description: 'Описание консервов для кошек...' },
          { id: 10, name: 'Ветеринарные препараты для кошек', description: 'Описание ветпрепаратов для кошек...' },
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
  #cat-catalog-page {
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

  .cart-link {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    color: #007bff;
    border: 2px solid #007bff;
    border-radius: 5px;
    padding: 8px 16px;
  }
  
  .cart-link:hover {
    background-color: #007bff;
    color: #ffffff;
  }
  </style>