<template>
  <div id="reviews-page">
    <h1>Отзывы</h1>
    <form @submit.prevent="submitReview">
      <div class="form-group">
        <label for="name">Имя:</label>
        <input type="text" id="name" v-model="reviewForm.name" required>
      </div>
      <div class="form-group">
        <label for="review">Отзыв:</label>
        <textarea id="review" v-model="reviewForm.review" required></textarea>
      </div>
      <div class="form-group">
        <label for="rating">Рейтинг:</label>
        <select id="rating" v-model="reviewForm.rating" required>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
        </select>
      </div>
      <button type="submit">Оставить отзыв</button>
    </form>
    <transition name="fade">
      <div v-if="showAlert" :class="['alert', alertType]" @click="closeAlert">{{ alertMessage }}</div>
    </transition>
    <div class="reviews-list">
      <h2>Список отзывов</h2>
      <div v-for="review in reviews" :key="review.id" class="review-item">
        <h3>{{ review.name }}</h3>
        <p>{{ review.review }}</p>
        <p>Рейтинг: {{ review.rating }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      reviewForm: {
        name: '',
        review: '',
        rating: 1
      },
      reviews: [],
      showAlert: false,
      alertMessage: '',
      alertType: '' // Для управления цветом алерта
    };
  },
  methods: {
    async submitReview() {
      try {
        await axios.get('/sanctum/csrf-cookie');
        const response = await axios.post('https://api.purrfectpets.ru/api/v1/review/create', this.reviewForm, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('authToken')}` // Используем токен из localStorage
          }
        });

        this.alertMessage = 'Отзыв успешно добавлен';
        this.alertType = 'alert-success';
        this.showAlert = true;
        console.log('Отзыв успешно добавлен', response.data);

        // Добавить новый отзыв в список отзывов
        this.reviews.push(response.data);
        this.reviewForm.name = '';
        this.reviewForm.review = '';
        this.reviewForm.rating = 1;

        // Скрыть алерт через 2 секунды
        setTimeout(() => {
          this.showAlert = false;
        }, 2000);
      } catch (error) {
        console.error('Ошибка при добавлении отзыва', error.response);
        this.alertMessage = 'Произошла ошибка. Пожалуйста, попробуйте снова позже.';
        this.alertType = 'alert-error';
        this.showAlert = true;
      }
    },
    closeAlert() {
      this.showAlert = false;
    }
  },
  async mounted() {
    try {
      const response = await axios.get('https://api.purrfectpets.ru/api/v1/reviews', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('authToken')}` // Используем токен из localStorage
        }
      });
      this.reviews = response.data;
    } catch (error) {
      console.error('Ошибка при загрузке отзывов', error.response);
    }
  }
};
</script>

<style scoped>
#reviews-page {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
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

input, textarea, select {
  width: 100%;
  padding: 12px;
  border-radius: 5px;
  border: 1px solid #eaeaea;
  transition: border-color 0.3s ease;
}

input:focus, textarea:focus, select:focus {
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

.reviews-list {
  margin-top: 40px;
}

.review-item {
  border-bottom: 1px solid #eaeaea;
  padding: 20px 0;
}

.review-item h3 {
  margin: 0;
  font-size: 1.2em;
}

.review-item p {
  margin: 10px 0 0;
}

/* Добавим стили для анимации */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0;
}
</style>
