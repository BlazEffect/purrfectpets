<template>
  <div id="homepage">
    <div class="header">
      <ul class="menu">
        <li><router-link to="/about">О компании</router-link></li>
        <li><router-link to="/contactspage">Контакты</router-link></li>
        <li><router-link to="/brands">Бренды</router-link></li>
        <li><router-link to="/newspage">Новости</router-link></li>
        <li><router-link to="/whywe">Почему PurfectPets</router-link></li>
      </ul>
      <p class="phone">📞 +7 (951) 505-14-91</p>
      <img id="account_img" :src="account" alt="account">
      <router-link v-if="!isLoggedIn" to="/loginpage" class="login">Вход</router-link>
      <span v-if="isLoggedIn" class="username">{{ username }}</span>
    </div>

    <hr id="hr">

    <div class="catalog">
      <ul>
        <li><router-link to="/salepage">Акции</router-link></li>
        <li><router-link to="/catpage">Кошки</router-link></li>
        <li><router-link to="/dogpage">Собаки</router-link></li>
        <li><router-link to="/rodentspage">Грызуны</router-link></li>
        <li><router-link to="/birdpage">Птицы</router-link></li>
        <li><router-link to="/fishpage">Рыбы</router-link></li>
        <li class="cart-item">
          <router-link to="/cart" class="logo_trashbin">
            <img id="logo" :src="logo" alt="logo">
            <p id="trashbin">Корзина</p>
          </router-link>
        </li>
      </ul>
    </div>

    <div class="content">
      <img class="box1" id="purfect1" :src="purfect1" style="width: 100%; height: auto;">
      <div class="text-overlay1">Purfect Pets</div>
      
      <img class="box2" id="purfect2" :src="purfect2" style="width: 100%; height: auto;">
      <div class="text-overlay2">Питательные корма<br>для ваших животных</div>
      
      <img class="box3" id="purfect3" :src="purfect3" style="width: 100%; height: auto;">
    </div>

    <footer class="footer">
      <p>© 2024 PurfectPets. Все права защищены.</p>
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { RouterView } from 'vue-router'
import account from '/src/assets/account.png'
import purfect1 from '/src/assets/purfect1.jpg'
import purfect2 from '/src/assets/purfect2.jpg'
import purfect3 from '/src/assets/purfect3.jpg'
import logo from '/src/assets/shopping-cart_711897.png'
import '/src/assets/main.css'

const isLoggedIn = ref(false) // Переменная для отслеживания статуса входа пользователя
const username = ref('') // Переменная для хранения имени пользователя

const checkLoginStatus = () => {
  // Ваш код для проверки статуса авторизации пользователя
}

const login = (name) => {
  isLoggedIn.value = true
  username.value = name
}

checkLoginStatus() // Вызываем функцию при загрузке страницы
</script>

<style scoped>
/* Стили для ссылок в шапке */
.login, .username {
  text-decoration: none; /* Убираем подчеркивание */
  color: blue; /* Задаем синий цвет */
  font-weight: bold;
  font-size: large;
}

#homepage {
  height: 90vh; /* Фиксированная высота 90% от высоты экрана */
  overflow: hidden; /* Обрезаем контент, выходящий за пределы контейнера */
}

.content {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 1rem;
  width: 70vw;
  margin-left: 15%;
  position: relative;
}

.box1 {
  grid-row: 1 / 4;
  width: 100%;
}

.box2 {
  grid-row: 1 / 2;
  width: 100%;
}

.box3 {
  grid-row: 2 / 3;
  width: 100%;
}

.text-overlay1 {
  position: absolute;
  top: 55%;
  left: 21%;
  transform: translate(-50%, -50%);
  color: black;
  font-size: 54px;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Добавляем тень для текста */
  padding: 10px;
}

.text-overlay2 {
  position: absolute;
  top: 50%; /* Adjust vertical position */
  right: 10%; /* Adjust horizontal position */
  transform: translate(50%, -50%);
  color: black;
  font-size: 1.5rem; /* Adjust font size */
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  padding: 10px;
}

/* Стиль для шапки */
.header {
  display: flex;
  justify-content: space-around;
  align-items: center;
  height: 50px;
  background: linear-gradient(to bottom, white, #f5f5f5 50%, white),
  linear-gradient(to right, white, #f5f5f5 50%, white);
  background-blend-mode: multiply;
}

.phone {
  margin: 0 20px;
  font-weight: bold;
}

.menu {
  display: flex;
  align-items: center;
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu a {
  text-decoration: none; /* Убираем подчеркивание */
  color: gray; /* Задаем серый цвет */
}

.login {
  text-decoration: none;
  color: black;
  font-weight: bold;
  font-size: large;
}

/* Стили для ссылок в каталоге */
.catalog a {
  text-decoration: none; /* Убираем подчеркивание */
  color: black; /* Задаем черный цвет */
  font-size: 18px; /* Увеличиваем размер текста */
}

.menu li {
  display: flex;
  align-items: center;
  color: #777777;
  list-style-type: none;
  margin: 0 20px;
  font-size: 15px;
}

/* Стиль для формы поиска */
.content_search {
  position: static;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50px;
  margin-top: 2%;
}

#query {
  position: static;
  align-items: center;
  border: 1px solid #FFD000;
  background-color: #F5F5F5;
  border-radius: 5px;
  padding: 5px;
  width: 400px; /* Уменьшаем ширину поля ввода */
  height: 25px;
}

#search {
  position: static;
  border: 1px solid #FFD000;
  border-radius: 5px;
  padding: 5px;
  margin-left: 10px;
  background-color: #FFD000;
  color: black;
  font-size: large;
  width: 80px; /* Уменьшаем ширину кнопки */
  height: 30px; /* Уменьшаем высоту кнопки */
  transition: transform 700ms ease;
}

#search:hover {
  cursor: pointer;
  transform: scale(1.1) translateY(-1px);
  border: #d3ad07 solid 1px;
}

/* Стиль для корзины */
.logo_trashbin {
  display: flex;
  align-items: center; /* Выравнивание элементов по вертикали */
  text-decoration: none;
}

#logo {
  width: 30px; /* Размер изображения корзины */
  height: 30px; /* Размер изображения корзины */
  margin-right: 5px; /* Отступ между изображением и текстом "Кор*/
}
#trashbin {
  font-weight: bold;
  color: #9b800a;
}

/* Стиль для личного кабинета */
.account {
  text-decoration: none;
  color: black;
  margin-left: 20px;
  font-size: large;
}

/* Стиль для линии */
#hr {
  border: 0;
  height: 4px;
  margin: 20px 0; /* Уменьшаем вертикальные отступы */
  background-image: linear-gradient(to right, #71bb4f 50%, #4d8bc2 50%, #549ad6 60%, #ff9100 60%, #ff9100 70%, #05b5e6 70%, #05b5e6 80%, #b959bd 80%, #c96acc 90%, #71bb4f 90%, #71bb4f 100%);
}

/* Стиль для каталога */
.catalog {
  text-align: center; /* Центрируем элементы списка */
  padding: 10px;
}

.catalog li {
  display: inline-block; /* Располагаем элементы списка в одну линию */
  margin-right: 100px; /* Уменьшаем отступ между элементами списка */
  list-style-type: none; /* Убираем маркеры списка */
  font-weight: bold;
}

.catalog .cart-item {
  display: inline-flex;
  align-items: center;
  margin-right: 0;
}

.catalog .cart-item img {
  margin-right: 5px; /* Отступ между изображением и текстом "Корзина" */
}

/* Стиль для картинки purfect1 */
.text-overlay1 {
  position: absolute;
  top: 55%;
  left: 21%;
  transform: translate(-50%, -50%);
  color: black;
  font-size: 54px;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Добавляем тень для текста */
  padding: 10px;
}

/* Стиль для картинки purfect2 */
.text-overlay2 {
  position: absolute;
  top: 47%;
  left: 77%;
  transform: translate(-50%, -50%);
  color: black;
  font-size: 20px;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Добавляем тень для текста */
  padding: 10px;
}

/* Стиль для футера */
.footer {
  background-color: #333; /* Темно-серый цвет футера */
  color: white; /* Цвет текста в футере */
  padding: 30px 0; /* Увеличенные вертикальные отступы внутри футера */
  text-align: center; /* Выравнивание текста по центру */
  position: fixed; /* Фиксированное позиционирование */
  bottom: 0; /* Помещаем футер внизу экрана */
  width: 100%; /* Ширина футера равна ширине экрана */
}

@media (max-width: 885px) {
  .header {
    flex-wrap: wrap;
  }

  .phone, .account, .login {
    flex: 1 0 1;
    margin: 0 5px;
  }

  .content_search {
    flex-direction: row;
    align-items: center;
    justify-content: center;
    margin-top: 2%;
  }

  #query {
    width: auto;
    margin-right: 10px;
  }

  #search {
    width: auto;
    margin-top: 0;
  }

  .catalog ul {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around; 
    padding: 0;
    margin: 0; 
  }

  .catalog li {
    flex: 1 0 auto;
    text-align: center;
    margin: 0;
    padding: 10px;
  }
   
  .content {
    display: block;
    position: relative; 
  }

  .box1 {
    width: 100%;
  }

  .text-overlay1 {
    position: absolute;
    top: 25%;
    left: 5px; /* Отступ слева */
    transform: translateY(-50%); 
    color: black;
    font-size: 20px;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    padding: 10px;
    background-color: rgba(255, 255, 255, 0.8);
  }

  .text-overlay2 {
    position: absolute;
    top: 55%;
    left: 58%;
    transform: translateY(-50%);
    color: black;
    font-size: 16px;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    padding: 10px;
  }

  .box2, .box3 {
    width: 50%;
    margin: 20px auto;
    display: block;
  }

  .footer {
    height: 40px;
    padding: 0;
    margin-left: -1.5%;
  }

  .footer > p {
    margin-top: 2.5%;
  }

  #homepage {
    height: 100vh;
  }
}
</style>
