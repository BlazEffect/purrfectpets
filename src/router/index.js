import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../components/HomePage.vue';
import WhyWe from '../components/WhyWe.vue';
import NewsPage from '../components/NewsPage.vue'; // Импортируем компонент страницы новостей
import LoginPage from '../components/LoginPage.vue';
import RegistrationPage from '../components/RegistrationPage.vue';
import ContactsPage from '../components/ContactsPage.vue';
import CartPage from '../components/CartPage.vue';
import SalePage from '../components/SalePage.vue';
import CatPage from '../components/CatPage.vue';
import DogPage from '../components/DogPage.vue';
import RodentsPage from '../components/RodentsPage.vue';
import BirdPage from '../components/BirdPage.vue';
import FishPage from '../components/FishPage.vue';
import CheckoutPage from '@/components/CheckoutPage.vue';
import BrandsPage from '@/components/BrandsPage.vue';
import AboutPage from '@/components/AboutPage.vue';


const routes = [
  { path: '/', component: HomePage },
  { path: '/WhyWe', component: WhyWe },
  { path: '/news', component: NewsPage }, // Добавляем маршрут для страницы новостей
  { path: '/newspage', component: NewsPage }, // Добавляем маршрут для пути "/newspage"
  { path: '/loginpage', component: LoginPage },
  { path: '/registration', component: RegistrationPage},
  { path: '/contactspage', component: ContactsPage},
  { path: '/cart', component: CartPage},
  { path: '/salepage', component: SalePage},
  { path: '/catpage', component: CatPage},
  { path: '/dogpage', component: DogPage},
  { path: '/rodentspage', component: RodentsPage},
  { path: '/birdpage', component: BirdPage},
  { path: '/fishpage', component: FishPage},
  { path: '/checkout', component: CheckoutPage},
  { path: '/brands', component: BrandsPage},
  { path: '/about', component: AboutPage},
];

const router = createRouter({
  history: createWebHistory(''),
  routes
});

export default router;
