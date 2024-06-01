<template>
  <div id="contact-page">
    <h1>Контакты</h1>
    <div class="contact-info">
      <p><strong>Адрес:</strong> ул. Буденовский, д. 12/56, г. Ростов-на-Дону</p>
      <p><strong>Email:</strong> zooshop@gmail.com</p>
      <p><strong>Телефон:</strong> +7 (951) 505-14-91</p>
    </div>
    <div class="map-container">
      <div id="google-map"></div>
    </div>
    <p class="home-link"><router-link to="/">Вернуться на главную</router-link></p>
  </div>
</template>

<script>
export default {
  mounted() {
    window.initMap = this.initMap;
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap`;
    script.async = true;
    document.head.appendChild(script);
  },
  methods: {
    initMap() {
      const map = new google.maps.Map(document.getElementById("google-map"), {
        center: { lat: 55.7558, lng: 37.6176 }, // Пример координат для Москвы
        zoom: 10,
      });

      new google.maps.Marker({
        position: { lat: 55.7558, lng: 37.6176 },
        map,
        title: "Примерный адрес",
      });
    },
  },
};
</script>

<style scoped>
#contact-page {
  width: 100vw; /* Расширяем блок на всю ширину окна просмотра */
  max-width: 100%; /* Ограничиваем максимальную ширину */
  margin: 0; /* Убираем отступы по бокам */
  padding: 40px;
  border: 1px solid #eaeaea;
  border-radius: 5px;
  box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
  background-color: #ffffff;
  color: #000000;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
  color: #333;
  font-size: 24px;
}

.contact-info {
  margin-bottom: 20px;
}

.contact-info p {
  margin-bottom: 10px;
  font-size: 16px;
  color: #000000; /* Черный цвет текста */
}

.map-container {
  height: 400px;
  margin-bottom: 20px;
}

#google-map {
  width: 100%;
  height: 100%;
}

.home-link {
  text-align: center;
  font-size: 16px;
}

.home-link a {
  color: #007bff;
  text-decoration: none;
  border: 2px solid #007bff; /* Обводка синего цвета */
  padding: 8px 16px; /* Увеличение внутренних отступов */
  border-radius: 5px; /* Закругление углов */
}

.home-link a:hover {
  color: #0056b3;
  border-color: #0056b3; /* Изменение цвета обводки при наведении */
}
</style>
