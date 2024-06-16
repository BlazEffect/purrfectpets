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
    <p class="home-link"><router-link to="/">Вернуться на главную</router-link></p>
  </div>
</template>

<script>
export default {
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
  },
};
</script>

<style scoped>
#contact-page {
  width: 100vw;
  max-width: 100%;
  margin: 0;
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
  color: #000000;
}

.map-container {
  height: 400px;
  margin-bottom: 20px;
}

#yandex-map {
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
  border: 2px solid #007bff;
  padding: 8px 16px;
  border-radius: 5px;
}

.home-link a:hover {
  color: #0056b3;
  border-color: #0056b3;
}
</style>
