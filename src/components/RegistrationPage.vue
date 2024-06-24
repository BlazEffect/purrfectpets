<template>
  <div id="registration-page">
    <h1>Регистрация</h1>
    <form @submit.prevent="register">
      <div class="form-group">
        <label for="FIO">ФИО:</label>
        <input type="text" id="FIO" v-model="registrationForm.FIO" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="registrationForm.email" required>
      </div>
      <div class="form-group">
        <label for="phone">Номер телефона:</label>
        <input type="tel" id="phone" v-model="registrationForm.phone" required>
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
      registrationForm: {
        FIO: '',
        email: '',
        phone: '',
        password: '',
        confirmPassword: ''
      },
      showAlert: false,
      alertMessage: '',
      alertType: '' 
    };
  },
  methods: {
    register() {
      if (this.registrationForm.password !== this.registrationForm.confirmPassword) {
        this.alertMessage = 'Пароли не совпадают';
        this.alertType = 'alert-error';
        this.showAlert = true;
        return;
      }

      const data = {
        FIO: this.registrationForm.FIO,
        email: this.registrationForm.email,
        phone: this.registrationForm.phone,
        password: this.registrationForm.password,
        confirm_password: this.registrationForm.confirmPassword
      };

      axios.post('https://api.purrfectpets.ru/api/v1/auth/register', data)
        .then(response => {
          console.log('Успешная регистрация', response.data);
          this.alertMessage = 'Регистрация прошла успешно!';
          this.alertType = 'alert-success';
          this.showAlert = true;
          this.$router.push('/');
        })
        .catch(error => {
          console.error('Ошибка при регистрации', error.response);
          if (error.response.status === 422) {
            console.error('Ошибка валидации данных:', error.response.data);

            if (error.response.data.data) {
              Object.keys(error.response.data.data).forEach(field => {
                console.error(`${field}: ${error.response.data.data[field][0]}`);
                if (field === 'email' && error.response.data.data[field][0].includes('уже существует')) {
                  this.alertMessage = 'Аккаунт с таким email уже существует';
                  this.alertType = 'alert-error';
                  this.showAlert = true;
                }
              });
            }
          }
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