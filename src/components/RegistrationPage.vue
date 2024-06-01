<template>
    <div id="registration-page">
      <h1>Регистрация</h1>
      <form @submit.prevent="register">
        <div class="form-group">
          <label for="firstname">Имя:</label>
          <input type="text" id="firstname" v-model="registrationForm.firstname" required>
        </div>
        <div class="form-group">
          <label for="lastname">Фамилия:</label>
          <input type="text" id="lastname" v-model="registrationForm.lastname" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="registrationForm.email" required>
        </div>
        <div class="form-group">
          <label for="password">Пароль:</label>
          <input type="password" id="password" v-model="registrationForm.password" required>
        </div>
        <div class="form-group">
          <label for="confirm-password">Подтвердите пароль:</label>
          <input type="password" id="confirm-password" v-model="registrationForm.confirmPassword" required>
        </div>
        <button type="submit">Зарегистрироваться</button>
      </form>
      <p class="home-link"><router-link to="/">Вернуться на главную</router-link></p>
      <p>Уже есть аккаунт? <router-link to="/loginpage">Войдите</router-link></p>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        registrationForm: {
          firstname: '',
          lastname: '',
          email: '',
          password: '',
          confirmPassword: ''
        }
      };
    },
    methods: {
      register() {
        // Здесь можно добавить логику для отправки данных на сервер и выполнения регистрации
        console.log('Регистрация выполнена');
        // После успешной регистрации перенаправляем пользователя на страницу входа
        this.$router.push('/login');
      }
    }
  };
  </script>
  
  <style scoped>
  #registration-page {
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
  