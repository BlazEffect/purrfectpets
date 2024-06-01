<template>
    <div id="fish-catalog-page">
      <h1>Каталог товаров для рыб</h1>
      <div class="products">
        <div v-for="product in products" :key="product.id" class="product">
          <img :src="fishfood1" :alt="product.name">
          <h2>{{ product.name }}</h2>
          <p>{{ product.description }}</p>
          <button @click="addToCart(product)">Добавить в корзину</button>
        </div>
      </div>
      <router-link to="/" class="home-link">Вернуться на главную</router-link>
    </div>
  </template>
  
  <script>
  import fishfood1 from '@/assets/fishfood1.jpg';
  
  export default {
    data() {
      return {
        fishfood1: fishfood1,
        products: [
          { id: 1, name: 'Корм для рыб', description: 'Описание корма для рыб...' },
          { id: 2, name: 'Аквариумы', description: 'Описание аквариумов...' },
          { id: 3, name: 'Фильтры для аквариумов', description: 'Описание фильтров для аквариумов...' },
          { id: 4, name: 'Декорации для аквариума', description: 'Описание декораций для аквариума...' },
          { id: 5, name: 'Обогреватели для аквариумов', description: 'Описание обогревателей для аквариумов...' },
          { id: 6, name: 'Освещение для аквариумов', description: 'Описание освещения для аквариумов...' },
          { id: 7, name: 'Средства по уходу за водой', description: 'Описание средств по уходу за водой...' },
          { id: 8, name: 'Тесты для воды', description: 'Описание тестов для воды...' },
          { id: 9, name: 'Камни и ракушки', description: 'Описание камней и ракушек для аквариума...' },
          { id: 10, name: 'Растения для аквариума', description: 'Описание растений для аквариума...' },
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
  #fish-catalog-page {
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
  