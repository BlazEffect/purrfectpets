<template>
  <div id="newspage" class="news-page">
    <h1 class="news-header">Последние новости</h1>
    <div class="news-blocks">
      <!-- Блоки с новостями -->
      <div class="news-block" v-for="newsItem in news" :key="newsItem.id">
        <h2>{{ newsItem.title }}</h2>
        <p>{{ newsItem.content }}</p>
        <router-link to="/" class="back-link">Вернуться на главную</router-link>
      </div>
    </div>
    <footer class="footer">
      <p>© 2024 PurfectPets. Все права защищены.</p>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'NewsPage',
  data() {
    return {
      news: [
        {
          id: 1,
          title: 'Питательные корма для собак',
          content: 'Статья о питательных кормах для собак и их влиянии на здоровье',
        },
        {
          id: 2,
          title: 'Знаете ли вы...',
          content: 'Статья о правильном уходе за кошками: советы и рекомендации',
        },
        {
          id: 3,
          title: 'Почему чистая вода важна для птиц',
          content: 'Описание влияния чистой воды на здоровье и благополучие птиц',
        },
        {
          id: 4,
          title: 'Топ-5 игрушек для грызунов',
          content: 'Рекомендации по выбору игрушек для активного времяпрепровождения грызунов',
        },
        {
          id: 5,
          title: 'Правильное содержание и уход за рептилиями',
          content: 'Статья о том, как обеспечить оптимальные условия жизни для рептилий в домашних условиях',
        },
        {
          id: 6,
          title: 'Как правильно выбрать аквариум для рыбок',
          content: 'Советы по выбору аквариума и обустройству дома для ваших рыбок',
        },
      ],
    };
  },
};
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
}

#newspage {
  height: 90vh;
  overflow: hidden;
}


html, body {
  height: 100%;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

/* Стили для страницы новостей */
.news-page {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 50px 20px 0; /* Убираем padding-bottom */
  background-image: url(/src/assets/newsfon.jpg);
  background-size: cover;
  background-position: center;
  color: #fff; /* Цвет текста на фоне */
  min-height: 90vh;
  overflow: hidden;
}



.news-header {
  font-size: 36px;
  font-weight: bold;
  color: #ffffff;
  margin: 0; /* Добавим эту строку */
  text-shadow: #333 2px 2px;
  margin-bottom: 30px;
}


.news-blocks {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.news-block {
  background-color: #ffffff;
  border-radius: 10px;
  padding: 30px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 20px;
  flex: 1 0 300px;
  max-width: 400px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.news-block:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.news-block h2 {
  margin-bottom: 20px;
  font-size: 24px;
  color: #333;
}

.news-block p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 20px;
}

.back-link {
  color: #ff6347;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s;
}

.back-link:hover {
  color: #c61c00;
}


/* Стили для футера */
.footer {
  position: fixed; /* Футер будет прижат к нижней части окна браузера */
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #333;
  color: #fff;
  text-align: center;
  padding: 20px 0; /* Добавляем внутренние отступы для контента футера */
}
</style>
