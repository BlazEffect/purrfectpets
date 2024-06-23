<template>
  <div id="registration-page">
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

    <transition name="fade">
      <div v-if="showAlert" :class="['alert', alertType]" @click="closeAlert">{{ alertMessage }}</div>
    </transition>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      loginForm: {
        email: '',
        password: ''
      },
      showAlert: false,
      alertMessage: '',
      alertType: '' 
    };
  },
  methods: {
    login() {
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('https://api.purrfectpets.ru/api/v1/auth/login', this.loginForm)
          .then(response => {
            this.alertMessage = 'Успешная авторизация';
            this.alertType = 'alert-success';
            this.showAlert = true;
            console.log('Успешная авторизация', response.data);

            setTimeout(() => {
              this.showAlert = false;
              this.$router.push('/');
            }, 2000);
          })
          .catch(error => {
            console.error('Ошибка при авторизации', error.response);
            if (error.response && error.response.status === 422) {
              this.alertMessage = 'Неверный логин или пароль';
              this.alertType = 'alert-error';
              this.showAlert = true;
              console.error('Ошибка валидации данных:', error.response.data);

              if (error.response.data.errors) {
                Object.keys(error.response.data.errors).forEach(field => {
                  console.error(`${field}: ${error.response.data.errors[field][0]}`);
                });
              }
            } else {
              this.alertMessage = 'Произошла ошибка. Пожалуйста, попробуйте снова позже.';
              this.alertType = 'alert-error';
              this.showAlert = true;
            }
          });
      });
    },
    closeAlert() {
      this.showAlert = false;
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

.alert {
  padding: 15px;
  border-radius: 5px;
  margin-top: 20px;
  text-align: center;
  cursor: pointer;
}

.alert-error {
  background-color: #f8d7da;
  color: #721c24;
}

.alert-success {
  background-color: #d4edda;
  color: #155724;
}


.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to{
  opacity: 0;
}
</style>