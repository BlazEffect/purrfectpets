<template>
  <div id="homepage">
    <div class="header">
      <ul class="menu">
        <li><router-link to="/about">О компании</router-link></li>
        <li><router-link to="/contactspage">Контакты</router-link></li>
        <li><router-link to="/brands">Бренды</router-link></li>
        <li><router-link to="/reviews">Отзывы</router-link></li>
        <li><router-link to="/whywe">Почему PurfectPets</router-link></li>
      </ul>
      <p class="phone">📞 +7 (951) 505-14-91</p>
      
      <router-link v-if="!isLoggedIn" to="/loginpage" class="login">Вход</router-link>
      <button v-if="isLoggedIn" @click="logout" class="logout">Выход</button>
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
      
      <img class="box2" id="purfect2" style="width: 100%; height: auto;" :src="purfect2">
      <div class="text-overlay2">Питательные корма<br>для ваших животных</div>
      
      <img class="box3" id="purfect3" :src="purfect3" style="width: 100%; height: auto;">
    </div>

    <footer class="footer">
      <div class="container">
        <p>© 2024 PurfectPets. Все права защищены.</p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import account from '/src/assets/account.png'
import purfect1 from '/src/assets/purfect1.jpg'
import purfect2 from '/src/assets/purfect2.jpg'
import purfect3 from '/src/assets/purfect3.jpg'
import logo from '/src/assets/shopping-cart_711897.png'
import '/src/assets/main.css'
import axios from 'axios'

const isLoggedIn = ref(false)
const username = ref('')
const router = useRouter()

const checkLoginStatus = () => {
  const token = localStorage.getItem('authToken')
  if (token) {
    isLoggedIn.value = true
    // Here you can set the username if you have it stored somewhere
    // username.value = 'StoredUsername'
  } else {
    isLoggedIn.value = false
  }
}

const logout = () => {
  const token = localStorage.getItem('authToken')
  if (!token) return

  axios.post('https://api.purrfectpets.ru/api/v1/auth/logout', {}, {
    headers: {
      'Authorization': `Bearer ${token}`
    }
  })
  .then(response => {
    localStorage.removeItem('authToken')
    isLoggedIn.value = false
    router.push('/')
  })
  .catch(error => {
    console.error('Ошибка при выходе из системы', error)
  })
}

checkLoginStatus()
</script>

<style scoped>
.login, .username {
  text-decoration: none;
  color: blue;
  font-weight: bold;
  font-size: large;
}

.logout {
  text-decoration: none;
  color: white;
  font-weight: bold;
  font-size: large;
  background-color: #007bff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.logout:hover {
  background-color: #0056b3;
  transform: scale(1.05);
}

#homepage {
  height: 90vh;
  overflow: hidden;
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
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  padding: 10px;
}

.text-overlay2 {
  position: absolute;
  margin: auto;
  left: 10%;
  transform: translate(50%, -50%);
  color: black;
  font-size: 1.5rem;
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
  text-decoration: none;
  color: gray;
}

.login {
  text-decoration: none;
  color: black;
  font-weight: bold;
  font-size: large;
}

.catalog a {
  text-decoration: none;
  color: black;
  font-size: 18px;
}

.menu li {
  display: flex;
  align-items: center;
  color: #777777;
  list-style-type: none;
  margin: 0 20px;
  font-size: 15px;
}

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
  width: 400px;
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
  width: 80px;
  height: 30px;
  transition: transform 700ms ease;
}

#search:hover {
  cursor: pointer;
  transform: scale(1.1) translateY(-1px);
  border: #d3ad07 solid 1px;
}

.logo_trashbin {
  display: flex;
  align-items: center;
  text-decoration: none;
}

#logo {
  width: 30px;
  height: 30px;
  margin-right: 5px;
}
#trashbin {
  font-weight: bold;
  color: #9b800a;
}

.account {
  text-decoration: none;
  color: black;
  margin-left: 20px;
  font-size: large;
}

#hr {
  border: 0;
  height: 4px;
  margin: 30px 0;
  background-image: linear-gradient(to right, #71bb4f 50%, #4d8bc2 50%, #549ad6 60%, #ff9100 60%, #ff9100 70%, #05b5e6 70%, #05b5e6 80%, #b959bd 80%, #c96acc 90%, #71bb4f 90%, #71bb4f 100%);
}

.catalog {
  text-align: center;
  padding: 10px;
}

.catalog li {
  display: inline-block;
  margin-right: 100px;
  list-style-type: none;
  font-weight: bold;
}

.catalog .cart-item {
  display: inline-flex;
  align-items: center;
  margin-right: 0;
}

.catalog .cart-item img {
  margin-right: 5px;
}

.text-overlay1 {
  position: absolute;
  top: 55%;
  left: 21%;
  transform: translate(-50%, -50%);
  color: black;
  font-size: 54px;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  padding: 10px;
}

.text-overlay2 {
  position: absolute;
  top: 47%;
  left: 77%;
  transform: translate(-50%, -50%);
  color: black;
  font-size: 20px;
  font-weight: bold;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  padding: 10px;
}

.footer {
  background-color: #333;
  color: white;
  padding: 20px 0;
  text-align: center;
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
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
    left: 5px;
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

@media (max-width: 375px) {
  .header {
    flex-direction: column;
    align-items: flex-start;
    padding: 10px;
  }

  .menu {
    flex-direction: column;
    width: 40%;
  }
.header{
  width:100%;
}
  .menu li {
    width: 100%;
    text-align: left;
    margin: 5px 0;
  }

  .phone, .account, .login, .logout, .username {

    text-align: left;
    margin: 5px 0;
  }
.logout{
  margin-left:-27%;
  margin-top:20%;
}
  .catalog ul {
      display:grid;
      grid-template-columns:repeat(2,1fr);
  }

  .catalog li {
    width: 100%;
  }
  .content {
    display: block;

    padding: 10px;
  }

  .box1, .box2, .box3 {

    margin: 0;
  }

  .text-overlay1 {
    top: 20%;
    left: 10px;
    font-size: 16px;
  }

  .text-overlay2 {
    top: 60%;
    left: 60%;
    font-size: 13px;
    padding:0;
  }

  .footer {
    position: static;
    padding: 10px;
    height:5%;
  }

  .container {
    width: 100%;
  }
#hr{
  margin-top:35%;
}
}
</style>