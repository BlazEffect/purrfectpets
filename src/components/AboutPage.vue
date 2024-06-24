<template>
  <div class="about-page">
    <h1>О нашей компании</h1>
    <Carousel ref="carousel" class="custom-carousel" :itemsToShow="1" :wrapAround="true">
      <Slide v-for="(slide, index) in slides" :key="index">
        <img :src="slide.image" :alt="slide.alt" class="carousel-image">
      </Slide>
    </Carousel>
    <div class="about-content">
      <p>
        Добро пожаловать в нашу компанию! Мы занимаемся продажей товаров для домашних животных уже более 10 лет. Наша миссия - предоставлять нашим клиентам только самые качественные товары для их питомцев.
      </p>
      <p>
        Мы гордимся нашим широким ассортиментом продукции, включающим все, что может понадобиться для ухода за вашими любимцами. Наша команда состоит из профессионалов, которые всегда готовы помочь вам с выбором и ответить на любые ваши вопросы.
      </p>
      <p>
        Наша компания была основана с целью обеспечить владельцев домашних животных всем необходимым для заботы о своих питомцах. С момента основания мы добились значительных успехов и продолжаем развиваться.
      </p>
      <h2>Наши достижения</h2>
      <ul>
        <li>Более 1 миллиона довольных клиентов по всей стране</li>
        <li>Широкая сеть магазинов в более чем 50 городах</li>
        <li>Собственный бренд качественных товаров для животных</li>
        <li>Партнерства с ведущими мировыми производителями</li>
      </ul>
      <h2>Наша команда</h2>
      <p>
        В нашей команде работают опытные ветеринары, зоологи и специалисты по уходу за животными. Мы стремимся к тому, чтобы каждый клиент получил исчерпывающую информацию и квалифицированную помощь.
      </p>
      <h2>Наши ценности</h2>
      <p>
        Мы придерживаемся высоких стандартов качества и постоянно улучшаем наш сервис. Наши основные ценности:
      </p>
      <ul>
        <li>Качество: Мы предлагаем только проверенные и надежные товары</li>
        <li>Ответственность: Мы заботимся о ваших питомцах так же, как вы</li>
        <li>Инновации: Мы постоянно ищем новые решения и технологии</li>
        <li>Клиентоориентированность: Мы всегда на связи и готовы помочь</li>
      </ul>
      <p>
        Благодарим вас за доверие и выбор нашей компании! Мы надеемся, что наше сотрудничество будет долгим и плодотворным.
      </p>
    </div>
    <router-link to="/" class="home-link">Вернуться на главную</router-link>
  </div>
</template>

<script>
import { Carousel, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import slider1 from '@/assets/slider/slider1.jpg';
import slider2 from '@/assets/slider/slider2.jpg';
import slider3 from '@/assets/slider/slider3.jpg';

export default {
  components: {
    Carousel,
    Slide
  },
  data() {
    return {
      slides: [
        { image: slider1, alt: 'Слайд 1' },
        { image: slider2, alt: 'Слайд 2' },
        { image: slider3, alt: 'Слайд 3' },
      ],
      autoplayInterval: null
    };
  },
  mounted() {
    this.startAutoplay();
  },
  beforeDestroy() {
    this.stopAutoplay();
  },
  methods: {
    startAutoplay() {
      this.autoplayInterval = setInterval(() => {
        this.$refs.carousel.next();
      }, 5000); // 5 секунд
    },
    stopAutoplay() {
      if (this.autoplayInterval) {
        clearInterval(this.autoplayInterval);
      }
    }
  }
};
</script>

<style scoped>
.about-page {
  max-width: 800px;
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
  margin-bottom: 30px;
}

.custom-carousel {
  width: 100%;
  height: 200px; /* Уменьшенная высота слайдера */
  margin-bottom: 30px;
}

.carousel-image {
  width: 100%;
  height: 200px; /* Уменьшенная высота изображений */
  object-fit: cover; /* Это сохранит соотношение сторон */
  border-radius: 5px;
}

.about-content {
  font-size: 16px;
  line-height: 1.6;
  color: #333333;
}

.about-content p, .about-content ul {
  margin-bottom: 20px;
}

.about-content ul {
  padding-left: 20px;
}

.about-content h2 {
  margin-top: 30px;
  margin-bottom: 15px;
}

.home-link {
  display: block;
  width: fit-content;
  margin: 20px auto 0;
  padding: 10px 20px;
  text-decoration: none;
  color: #fff;
  background-color: #007bff;
  border-radius: 5px;
  text-align: center;
}

.home-link:hover {
  background-color: #0056b3;
}
</style>
