<template>
  <div id="checkout-page">
    <h1>Оформление заказа</h1>
    <form @submit.prevent="handleSubmitOrder">
      <div class="form-group">
        <label for="name">Имя:</label>
        <input type="text" id="name" v-model="order.name" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="order.email" required>
      </div>
      <div class="form-group">
        <label for="phone">Телефон:</label>
        <input type="tel" id="phone" v-model="order.phone" required>
      </div>
      <p>Оплата только наличными</p>
      <button type="submit" class="submit-button">Оформить заказ</button>
    </form>
    <p v-if="orderStatus">{{ orderStatusMessage }}</p>
    <router-link to="/" class="back-button">Вернуться на главную</router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      order: {
        name: '',
        email: '',
        phone: ''
      },
      orderStatus: null,
      orderStatusMessage: ''
    };
  },
  methods: {
    async handleSubmitOrder() {
      try {
        // Отправка данных заказа на сервер
        const response = await this.$http.post('/api/order', this.order);
        if (response.status === 200) {
          this.orderStatus = 'success';
          this.orderStatusMessage = 'Заказ успешно оформлен!';
          // Очистка данных заказа после успешного оформления
          this.order = {
            name: '',
            email: '',
            phone: ''
          };
        } else {
          this.orderStatus = 'error';
          this.orderStatusMessage = 'Произошла ошибка при оформлении заказа.';
        }
      } catch (error) {
        this.orderStatus = 'error';
        this.orderStatusMessage = 'Произошла ошибка при оформлении заказа.';
      }
    }
  }
};
</script>

<style scoped>
#checkout-page {
  max-width: 800px;
  margin: 50px auto;
  padding: 60px;
  border: 1px solid #eaeaea;
  border-radius: 5px;
  box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
  background-color: #ffffff;
  color: #000000;
  position: relative; /* Добавлено для позиционирования кнопки */
}

h1 {
  text-align: center;
  margin-bottom: 50px;
}

.form-group {
  margin-bottom: 20px;
}

label {
  font-weight: bold;
}

input {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.submit-button {
  background-color: #28a745;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 15px 30px;
  cursor: pointer;
  font-size: medium;
  float: right;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.submit-button:hover {
  background-color: #218838;
}

.back-button {
  display: block;
  position: absolute; /* Позиционирование абсолютное */
  bottom: 20px; /* Отступ от нижнего края */
  left: 60px; /* Отступ от левого края */
  background-color: #007bff;
  color: #fff;
  text-align: center;
  padding: 10px 20px; /* Уменьшаем отступы */
  border-radius: 5px;
  text-decoration: none;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.back-button:hover {
  background-color: #0056b3;
}
</style>
