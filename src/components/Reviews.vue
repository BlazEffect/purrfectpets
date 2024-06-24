<template>
  <div id="reviews-page">
    <h1>Отзывы</h1>
    <form @submit.prevent="submitReview">
      <div class="form-group">
        <label for="name">Название:</label>
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
        <p>{{ review.text }}</p>
        <p>Рейтинг: {{ review.rating_value }}</p>
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
      alertType: ''
    };
  },
  methods: {
    async submitReview() {
      try {
        const token = localStorage.getItem('authToken');
        if (!token) {
          throw new Error('Authorization token is missing');
        }

        const response = await axios.post('https://api.purrfectpets.ru/api/v1/review/create', {
          name: this.reviewForm.name,
          text: this.reviewForm.review,
          rating_value: this.reviewForm.rating
        }, {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });

        this.alertMessage = 'Отзыв успешно добавлен';
        this.alertType = 'alert-success';
        this.showAlert = true;
        console.log('Отзыв успешно добавлен', response.data);

        this.reviews.push(response.data.data);
        localStorage.setItem('reviews', JSON.stringify(this.reviews));
        this.reviewForm.name = '';
        this.reviewForm.review = '';
        this.reviewForm.rating = 1;

        setTimeout(() => {
          this.showAlert = false;
        }, 2000);
      } catch (error) {
        console.error('Ошибка при добавлении отзыва', error);
        if (error.response && error.response.status === 422) {
          const errors = error.response.data.errors;
          this.alertMessage = Object.values(errors).flat().join(', ');
        } else {
          this.alertMessage = 'Произошла ошибка. Пожалуйста, попробуйте снова позже.';
        }
        this.alertType = 'alert-error';
        this.showAlert = true;
      }
    },
    closeAlert() {
      this.showAlert = false;
    },
    loadReviews() {
      const storedReviews = localStorage.getItem('reviews');
      if (storedReviews) {
        this.reviews = JSON.parse(storedReviews);
      }
    }
  },
  async mounted() {
    try {
      const token = localStorage.getItem('authToken');
      if (!token) {
        throw new Error('Authorization token is missing');
      }

      const response = await axios.get('https://api.purrfectpets.ru/api/v1/reviews', {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      });
      this.reviews = response.data.data;
      localStorage.setItem('reviews', JSON.stringify(this.reviews));
    } catch (error) {
      console.error('Ошибка при загрузке отзывов', error);
    }

    this.loadReviews();
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

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>