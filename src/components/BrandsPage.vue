<template>
    <div class="brands-page">
      <h1>Наши бренды</h1>
      <div class="brands-list">
        <div v-for="brand in brands" :key="brand.id" class="brand">
          <img :src="brand.image" :alt="brand.name" class="brand-logo">
          <div class="brand-details">
            <h2>{{ brand.name }}</h2>
            <p>{{ brand.description }}</p>
          </div>
        </div>
      </div>
      <router-link to="/" class="home-link">Вернуться на главную</router-link>
    </div>
  </template>
  
  <script>
  import triol from '@/assets/brands/triol.jpg';
  import catstep from '@/assets/brands/catstep.jpg';
  import gamma from '@/assets/brands/gamma.jpg';
  import jebo from '@/assets/brands/jebo.jpg';
  import lagunaaqua from '@/assets/brands/lagunaaqua.png';
  import lagunaterra from '@/assets/brands/lagunaterra.jpg';
  
  export default {
    data() {
      return {
        brands: [
          { id: 1, name: 'Triol', image: triol, description: 'TRIOL - один из ведущих брендов компании, которая вот уже много лет успешно производит и поставляет на территорию страны товары для самых разных домашних животных. Собаки, кошки, птицы и грызуны - зоотовары TRIOL охватывают все основные категории питомцев и помогают ежедневно заботиться об их здоровье, разнообразном досуге и хорошем настроении.' },
          { id: 2, name: 'CAT STEP', image: catstep, description: 'У вас есть кошка? Позаботьтесь о ней вместе с наполнителями для кошачьего туалета CAT STEP. Комфорт для животного, удобство и простота в использовании для владельцев, большой выбор видов и объемов - это то, что вам нужно.' },
          { id: 3, name: 'Gamma', image: gamma, description: 'Торговая марка Gamma родом из России. Вот уже более 15 лет большая и дружная команда специалистов самого разного профиля вдохновляется бескрайними просторами страны, уникальными пейзажами и особым русским менталитетом.' },
          { id: 4, name: 'Jebo', image: jebo, description: 'Эта торговая марка качественно выделяется на фоне конкурентов. Продукцию бренда JEBO отличает функциональность и оптимальное соотношение цены и качества.' },
          { id: 5, name: 'Laguna Aqua', image: lagunaaqua, description: 'На сегодняшний день торговая марка Laguna AQUA уже хорошо известна в среде любителей аквариумистики. Продукция бренда на рынке представлена широким ассортиментом товаров для грамотного содержания, оригинального украшения и комфортного ухода за аквариумом. Просвещенные аквапрофи и неравнодушные к аквамиру новички - благодаря богатому выбору товаров, здесь каждый найдет свое.' },
          { id: 6, name: 'Laguna Terra', image: lagunaterra, description: 'Торговая марка Laguna TERRA создана для любителей террариумных животных. Ассортимент торговой марки представлен необходимым оборудованием и декорациями для рептилий. Благодаря скрупулёзному подходу к созданию каждой детали, террариумное оборудование бренда становится настоящим помощником в профессиональном уходе за рептилиями и достойным дополнением любого террариума.' },
        ]
      };
    }
  };
  </script>
  
  <style scoped>
  .brands-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px;
  }
  
  h1 {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .brands-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  
  .brand {
    width: calc(50% - 20px); /* To ensure two items per row with spacing */
    margin-bottom: 40px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    text-align: center;
    box-sizing: border-box;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .brand:hover {
    transform: translateY(-10px);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
  }
  
  .brand-logo {
    width: 150px;
    border-radius: 50%;
    margin: 0 auto 20px;
    display: block;
  }
  
  .brand-details h2 {
    margin-bottom: 10px;
  }
  
  .brand-details p {
    color: #666;
  }
  
  .home-link {
    display: block;
    width: fit-content;
    margin: 20px auto 0;
    padding: 10px 20px;
    text-decoration: none;
    color: #fff;
    background-color: #007bff;
    border-radius: 5px;
    text-align: center;
  }
  
  .home-link:hover {
    background-color: #0056b3;
  }
  </style>
  