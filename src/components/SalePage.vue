<template>
  <div id="sale-page">
    <h1>Акции</h1>
    <p>Акций на товары пока что нет...</p>
    <img id="salepage" :src="salepage" alt="Sale">
    <router-link to="/" class="home-link">Вернуться на главную</router-link>
  </div>
</template>

<script>
import salepage from '@/assets/salepage.jpg'; // Импорт изображения

export default {
  data() {
    return {
      salepage: salepage // Присваивание импортированного изображения переменной
    };
  }
};
</script>

<style scoped>
#sale-page {
  position: relative;
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 40px;
  box-sizing: border-box;
  text-align: center; /* Выравниваем содержимое по центру */
}

h1 {
  margin-bottom: 30px;
}

p {
  margin-top: 320px;
  text-align: center;
  font-size: 32px;
  color: #666;
}

.home-link {
  display: inline-block;
  margin-top: 20px; /* Отступ от верхнего края */
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

#salepage {
  width: 300px; /* Ширина изображения */
  position: fixed;
  bottom: 20px; /* Отступ от нижнего края */
  right: 20px; /* Отступ от правого края */
}
</style>
