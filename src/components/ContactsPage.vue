<template>
  <div id="contact-page">
    <h1>Контакты</h1>
    <div class="contact-info">
      <p><strong>Адрес:</strong> ул. Буденовский, д. 12/56, г. Ростов-на-Дону</p>
      <p><strong>Email:</strong> zooshop@gmail.com</p>
      <p><strong>Телефон:</strong> +7 (951) 505-14-91</p>
    </div>
    <div class="map-container">
      <div id="yandex-map"></div>
    </div>
    
    <form class="contact-form" @submit.prevent="handleSubmit">
      <h2>Обратная связь</h2>
      <div class="form-group">
        <label for="name">Имя</label>
        <input type="text" id="name" name="name" v-model="formData.name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" v-model="formData.email" required>
      </div>
      <div class="form-group">
        <label for="message">Сообщение</label>
        <textarea id="message" name="message" v-model="formData.message" rows="4" required></textarea>
      </div>
      <button type="submit">Отправить</button>
    </form>

    <p class="home-link"><router-link to="/">Вернуться на главную</router-link></p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        name: '',
        email: '',
        message: ''
      }
    };
  },
  mounted() {
    window.initMap = this.initMap;
    const script = document.createElement('script');
    script.src = `https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=4c82e533-4946-4bba-a448-273d81dc95e0`;
    script.async = true;
    script.onload = () => {
      ymaps.ready(this.initMap);
    };
    document.head.appendChild(script);
  },
  methods: {
    initMap() {
      const map = new ymaps.Map("yandex-map", {
        center: [47.216839, 39.709758],
        zoom: 16,
      });

      const placemark = new ymaps.Placemark([47.216839, 39.709758], {
        hintContent: "Наш адрес",
        balloonContent: "ул. Буденовский, д. 12/56, г. Ростов-на-Дону",
      });

      map.geoObjects.add(placemark);
    },
    handleSubmit() {
      // Обработка отправки формы (добавьте свой код здесь)
      console.log('Form submitted:', this.formData);
      // Дополнительная логика отправки данных
    }
  },
};
</script>

<style scoped>
#contact-page {
  max-width: 2000px; /* Уменьшенная максимальная ширина контейнера */
  margin: 40px auto; /* Центрирование контейнера по горизонтали */
  padding: 20px;
  border: 1px solid #eaeaea;
  border-radius: 5px;
  box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
  background-color: #ffffff;
  color: #333; /* Цвет текста контента */
}

h1 {
  text-align: center;
  margin-bottom: 30px;
  font-size: 32px; /* Увеличение размера заголовка */
}

.contact-info {
  margin-bottom: 20px;
  font-size: 18px; /* Увеличение размера текста контактной информации */
}

.map-container {
  max-width: 100%;
  height: 400px;
  margin-bottom: 20px;
  overflow: hidden; /* Опционально: чтобы предотвратить выход карты за пределы контейнера */
}

#yandex-map {
  width: 100%;
  height: 100%;
}

.contact-form {
  background-color: #f9f9f9;
  border: 1px solid #eaeaea;
  border-radius: 5px;
  padding: 20px;
}

.contact-form h2 {
  text-align: center;
  margin-bottom: 20px;
  font-size: 24px;
}

.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  font-size: 18px;
  margin-bottom: 8px;
  color: #333;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.form-group textarea {
  resize: vertical;
}

button[type="submit"] {
  background-color: #007bff;
  color: #ffffff;
  border: none;
  padding: 12px 24px;
  font-size: 18px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #0056b3;
}

.home-link {
  text-align: center;
  font-size: 16px;
}

.home-link a {
  color: #007bff;
  text-decoration: none;
  border: 2px solid #007bff;
  padding: 8px 16px;
  border-radius: 5px;
}

.home-link a:hover {
  color: #0056b3;
  border-color: #0056b3;
}
</style>
