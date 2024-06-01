<template>
    <div id="login-page">
      <h1>Вход</h1>
      <form @submit.prevent="login">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="loginForm.email" required>
        </div>
        <div class="form-group">
          <label for="password">Пароль:</label>
          <input type="password" id="password" v-model="loginForm.password" required>
        </div>
        <button type="submit">Войти</button>
      </form>
      <p class="home-link"><router-link to="/">Вернуться на главную</router-link></p>
      <p>Нет аккаунта? <router-link to="/registration">Зарегистрируйтесь</router-link></p>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        loginForm: {
          email: '',
          password: ''
        }
      };
    },
    methods: {
      login() {
        // Здесь можно добавить логику для отправки данных на сервер и выполнения входа
        console.log('Вход выполнен');
        // После успешного входа перенаправляем пользователя на главную страницу
        this.$router.push('/');
      }
    }
  };
  </script>
  
  <style scoped>
  #login-page {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 400px;
    width: 100%;
    padding: 40px;
    border: 1px solid #eaeaea;
    border-radius: 5px;
    box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  
  input {
    width: 100%;
    padding: 12px;
    border-radius: 5px;
    border: 1px solid #eaeaea;
    transition: border-color 0.3s ease;
  }
  
  input:focus {
    border-color: #007bff;
  }
  
  button {
    width: 100%;
    padding: 15px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  
  p {
    margin-top: 20px;
    text-align: center;
  }
  
  a {
    text-decoration: none;
    color: #007bff;
  }
  
  a:hover {
    color: #0056b3;
  }
  
  .home-link {
    text-align: center;
  }
  </style>
  