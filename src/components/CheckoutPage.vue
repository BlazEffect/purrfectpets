<template>
    <div id="checkout-page">
      <h1>Оформление заказа</h1>
      <form @submit.prevent="handleCheckout">
        <div class="form-group">
          <label for="name">Имя:</label>
          <input type="text" id="name" v-model="name" required>
        </div>
        <div class="form-group">
          <label for="address">Адрес:</label>
          <input type="text" id="address" v-model="address" required>
        </div>
        <div class="form-group">
          <label for="phone">Телефон:</label>
          <input type="text" id="phone" v-model="phone" required>
        </div>
        <button type="submit" class="submit-button">Оформить заказ</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        name: '',
        address: '',
        phone: ''
      };
    },
    methods: {
      handleCheckout() {
        console.log('Заказ оформлен', { name: this.name, address: this.address, phone: this.phone });
        // Здесь вы можете добавить логику для обработки заказа
        alert('Ваш заказ успешно оформлен!');
        this.$router.push('/');
      }
    }
  };
  </script>
  
  <style scoped>
  #checkout-page {
    max-width: 600px;
    margin: 50px auto;
    padding: 40px;
    border: 1px solid #eaeaea;
    border-radius: 5px;
    box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    color: #000000;
  }
  
  h1 {
    text-align: center;
    margin-bottom: 50px;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input[type="text"] {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
  }
  
  .submit-button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
  }
  
  .submit-button:hover {
    background-color: #0056b3;
  }
  </style>
  