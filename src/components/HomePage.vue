<template>
    <div id="homepage">
      <div class="header">
        <ul class="menu">
          <li><a href="#">О компании</a></li>
          <li><router-link to="/contactspage">Контакты</router-link></li>
          <li><a href="#">Бренды</a></li>
          <li><router-link to="/newspage">Новости</router-link></li>
          <li><router-link to="/whywe">Почему PurfectPets</router-link></li>
        </ul>
        <p class="phone">📞 +7 (951) 505-14-91</p>
        <img id="account_img" :src="account" alt="account">
        <!-- Изменили ссылку на вход -->
        <router-link v-if="!isLoggedIn" to="/loginpage" class="login">Вход</router-link>
        <!-- Добавили имя пользователя, если он авторизован -->
        <span v-if="isLoggedIn" class="username">{{ username }}</span>
      </div>

      <div class="content_search">
        <form id="searchForm">
          <input type="text" id="query" placeholder="Введите запрос">
          <button type="submit" id="search">Поиск</button>
        </form>
        <div class="logo_trashbin">
            <router-link to="/cart">
            <img id="logo" :src="logo" alt="logo">
            </router-link>
            <router-link to="/cart" id="trashbin1"><p id="trashbin">Корзина</p></router-link>
        </div>
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
        </ul>
      </div>
  
      <div class="content">
        <img id="purfect1" :src="purfect1">
        <div class="text-overlay1">Purfect Pets</div>
        <img id="purfect2" :src="purfect2">
        <div class="text-overlay2">Питательные корма<br>для ваших животных</div>
        <img id="purfect3" :src="purfect3">
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
  
  // Метод для проверки статуса авторизации пользователя
  const checkLoginStatus = () => {
    // Ваш код для проверки статуса авторизации пользователя
  }
  
  // Функция для успешного входа пользователя
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
  
  #account_img {
    position: relative;
    left: 200px;
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
    padding-top: 10px; /* Уменьшаем верхний отступ */
    padding-left: 50px; /* Уменьшаем левый отступ */
    text-decoration: none;
  }
  
  #logo {
    width: 30px; /* Уменьшаем размер логотипа */
    height: 30px; /* Уменьшаем размер логотипа */
  }
  
  #trashbin {
    position: relative;
    left: 8px;
    bottom: 5px;
    margin-left: 10px;
    font-weight: bold;
    color: #9b800a;
  }
  #trashbin1 {
    text-decoration: none;
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
  
/* Стиль для картинки purfect1 */
#purfect1 {
    width: 50%;
    padding-left: 8%;
    padding-top: 1.3%;
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

/* Стиль для картинки purfect2 */
#purfect2 {
    position: relative;
    width: 25%;
    padding-left: 59%;
    bottom: 553px;
}

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

/* Стиль для картинки purfect3 */
#purfect3 {
    position: relative;
    width: 25%;
    padding-left: 59%;
    bottom: 536px;
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
</style>
