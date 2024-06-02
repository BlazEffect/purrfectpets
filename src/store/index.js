import { createStore } from 'vuex';

import preservescat1 from '@/assets/cat/preservescat1.jpg';
import preservescat2 from '@/assets/cat/preservescat2.jpg';
import preservescat3 from '@/assets/cat/preservescat3.jpg';
import couchcat1 from '@/assets/cat/couchcat1.jpg';
import couchcat2 from '@/assets/cat/couchcat2.jpg';
import couchcat3 from '@/assets/cat/couchcat3.jpg';
import hygienecat1 from '@/assets/cat/hygienecat1.jpg';
import hygienecat2 from '@/assets/cat/hygienecat2.jpg';
import hygienecat3 from '@/assets/cat/hygienecat3.jpg';
import fillercat1 from '@/assets/cat/fillercat1.jpg';

import preservesdog1 from '@/assets/dog/preservesdog1.jpg';
import preservesdog2 from '@/assets/dog/preservesdog2.jpg';
import preservesdog3 from '@/assets/dog/preservesdog3.jpg';
import couchdog1 from '@/assets/dog/couchdog1.jpg';
import couchdog2 from '@/assets/dog/couchdog2.jpg';
import couchdog3 from '@/assets/dog/couchdog3.jpg';
import bowlsdog1 from '@/assets/dog/bowlsdog1.jpg';
import bowlsdog2 from '@/assets/dog/bowlsdog2.jpg';
import bowlsdog3 from '@/assets/dog/bowlsdog3.jpg';
import hygienedog1 from '@/assets/dog/hygienedog1.jpg';

import fishfood1 from '@/assets/fishfood1.jpg';
import rodentfood1 from '@/assets/rodentfood1.jpg';
import birdfood1 from '@/assets/birdfood1.jpg';

const store = createStore({
  state: {
    cart: [],
    products: [
      { id: 1, name: 'BioMenu ADULT Консервы д/кошек мясной паштет с Индейкой 95%-МЯСО 100гр*24', description: 'Мясные консервы для кошек BioMenu Изготовлено из натурального российского сырья. Не содержит сои, ароматизаторов, искусственных красителей, ГМИ.', price: 370, image: preservescat1 },
      { id: 2, name: 'BioMenu ADULT Консервы д/кошек мясной паштет с Кроликом 95%-МЯСО 100гр*24', description: 'Мясные консервы для кошек BioMenu Изготовлено из натурального российского сырья. Не содержит сои, ароматизаторов, искусственных красителей, ГМИ.', price: 370, image: preservescat2 },
      { id: 3, name: 'BioMenu KITTEN Консервы д/КОТЯТ мясной паштет с Говядиной 95%-МЯСО 100гр*24', description: 'Мясные консервы для котят BioMenu Изготовлено из натурального российского сырья. Не содержит сои, ароматизаторов, искусственных красителей, ГМИ.', price: 350, image: preservescat3 },
      { id: 4, name: 'Игровой комплекс для кошек квадратный "Витязь", 400*400*730мм', description: 'Данный комплекс представляет собой квадратный домик с просторным входом, обитый тканью рогожка внутри и снаружи. На крыше домика установлена вертикальная когтеточка с плотной джутовой обмоткой, которая заканчивается твердой квадратной площадкой, на которой ваш любимец сможет с комфортом отдохнуть или понаблюдать за окружающими.', price: 1400, image: couchcat1 },
      { id: 5, name: 'Игровой комплекс для кошек с двумя площадками "Витязь", 580*360*870мм', description: 'Этот функциональный игровой комплекс для кошек станет любимым местом ваших питомцев. Комплекс состоит из двух джутовых столбиков, каждый диаметром 100мм, с двумя разноуровневыми платформами. Дополняет изделие уютный домик с просторным входом.', price: 1700, image: couchcat2 },
      { id: 6, name: 'Игровой комплекс для кошек "Студия", 520*580*780мм, Triol', description: 'Многоярусный игровой комплекс для кошек с платформой, уютным домиком и 3 столбиками-когтеточками - идеальное решение для обеспечения досуга вашего питомца. Комплекс выполнен из ламинированного МДФ - практичного, надежного, изящного и экологичного материала. Горизонтальные платформы обиты оригинальным утапливаемым ковролином.', price: 3200, image: couchcat3 },
      { id: 7, name: 'Cовок с подставкой для кошачьего туалета, серый, 275*170*95мм, серия HYGIENE, Triol', description: 'Универсальный совок для кошачьих туалетов с круглыми ячейками и подставкой подойдет для всех типов наполнителей. Изделие не впитывает запахи и легко чистится под водой при помощи моющих средств. Совок укомплектован напольной подставкой, которая не занимает много места.', price: 520, image: hygienecat1 },
      { id: 8, name: 'БиоВакс шамп. д/кош. короткошерстных 355мл (1/15)', description: 'Добавленные в шампунь натуральные экстракты шиповника и зверобоя оказывают ранозаживляющее и тонизирующее действия, а масло чайного дерева обладает мощным противомикробным эффектом. Продукт не содержит красителей и щелочного мыла.', price: 800, image: hygienecat2 },
      { id: 9, name: 'БИОКАПЛИ для кошек от внешних паразитов, 1 пипетка по 1мл., Gamma', description: 'Это безопасное и эффективное средство для бережной защиты кошек от эктопаразитов: блох, вшей, комаров, клещей. Применяются как профилактическое средство обработки от паразитов не чаще 1-го раза в месяц, наносятся на кожу животного в местах, недоступных для слизывания. Изготовлено на основе растительных масел.', price: 860, image: hygienecat3 },
      { id: 10, name: 'Наполнитель впитывающий кукурузный Gamma, 5 л', description: 'Наполнитель Gamma изготовлен из высушенных стержней кукурузных початков без использования химических добавок и примесей. Воздушные гранулы отлично впитывают влагу, эффективно поглощают запахи и не прилипают к лапам кошки. Наполнитель полностью растительный и абсолютно безопасен для здоровья людей и животных.', price: 1050, image: fillercat1 },
      
      { id: 11, name: 'BioMenu ADULT Консервы д/собак Говядина 95%-МЯСО 100гр*24', description: 'Мясные консервы для собак BioMenu Изготовлено из натурального российского сырья. Не содержит сои, ароматизаторов, искусственных красителей, ГМИ.', price: 350, image: preservesdog1 },
      { id: 12, name: 'BioMenu ADULT Консервы д/собак Говядина/Ягненок 95%-МЯСО 100гр*24', description: 'Мясные консервы для собак BioMenu Изготовлено из натурального российского сырья. Не содержит сои, ароматизаторов, искусственных красителей, ГМИ.', price: 350, image: preservesdog2 },
      { id: 13, name: 'BioMenu ADULT Консервы д/собак Говядина/Ягненок 95%-МЯСО 410гр*12', description: 'Мясные консервы для собак BioMenu Изготовлено из натурального российского сырья. Не содержит сои, ароматизаторов, искусственных красителей, ГМИ.', price: 300, image: preservesdog3 },
      { id: 14, name: 'Домик для небольших собак Сова 38x38x40см, серия PET PLACE', description: 'Домик для животных GiGwi "Сова" непременно станет любимым местом отдыха домашних животных. Изделие выполнено из искусственного меха, внутри лежит мягкая подушка. Такой домик подарит вашему питомцу комфорт и тепло, а также возможность уединиться.', price: 2450, image: couchdog1 },
      { id: 15, name: 'Лежанка для небольших собак Собака 57см, серия SNOOZY FRIENDZ', description: 'Лежанка для собак выполнена из 100% полиэстера, верхняя часть изделия дополнена искусственным мехом, основание противоскользящее. В качестве наполнителя используется мягкий синтепон. По размеру лежанка рассчитана на кошек и собак мелких пород. Эта лежанка понравится вашему питомцу и станет прекрасным местом для отдыха, а также послужит украшением интерьера комнаты.', price: 1550, image: couchdog2 },
      { id: 16, name: 'Диван "Элегант" M, 1000*650*80мм, Gamma', description: 'Велюровый диван высотой 8 см по переднему краю и удобной спинкой (20 см). Поролоновая основа делает изделие легким и удобным в эксплуатации. Съемный чехол на молнии удобно снимается и легко стирается, а мягкая боковая подушка фиксируется на шнурках. Размер изделия: 1000*650*80мм. Цвета в ассортименте.', price: 1450, image: couchdog3 },
      { id: 17, name: 'Комплект стойка с мисками "Универсал", 2*1,9л, Triol', description: 'Комплект стойка с мисками "Универсал" с возможностью регулировки высоты мисок 18-50см. Стойка отличается повышенной устойчивостью за счет продуманных габаритов основания. Прорезиненные края металлических мисок поглощают звуки. Детали изделия выполнены с заботой об окружающей среде из экологически чистого переработанного материала - пластмассы.', price: 1050, image: bowlsdog1 },
      { id: 18, name: 'Миска двойная керамическая на подставке Marvel Мстители, 2*0,25л, Triol-Disney', description: 'Этот функциональный комплект из двух универсальных круглых мисок на подставке с рисунком "Мстители" выполнен из керамики высокого качества и отлично подходит для кошек и собак мелких пород. Такие миски идеальны как для воды, так и для корма разной консистенции. Изделие комфортно для питомца и легко моется под струей проточной воды с использованием моющих бытовых средств.', price: 850, image: bowlsdog2 },
      { id: 19, name: 'Миска из бамбука двойная, 0,18*2л, серия NATURAL, Triol', description: 'Миски для животных,изготовленные из бамбука,являются прекрасной заменой пластиковым и керамическим аналогам. Они экологичны,прочны,имеют антискользящие резиновые ножки. В таких мисках еда и вода дольше остаются свежими.', price: 450, image: bowlsdog3 },
      { id: 20, name: 'Пакеты биоразлагаемые для выгула собак (4 рулона по 15шт), серия PET CARE', description: 'Мешочки для отходов животных, 4 рулона по 15шт каждый рулон в упаковке. Необходимый аксессуар на прогулке для владельцев собак. Благодаря плотному материалу они не подведут и не порвутся в самый неподходящий момент, а компактные габариты позволят взять их с собой, куда бы вы не отправились.', price: 350, image: hygienedog1 },
      
      { id: 21, name: 'Корм для рыб', description: 'Описание корма для рыб...', price: 50, image: fishfood1 },
      { id: 22, name: 'Аквариумы', description: 'Описание аквариумов...', price: 100, image: fishfood1 },
      { id: 23, name: 'Фильтры для аквариумов', description: 'Описание фильтров для аквариумов...', price: 150, image: fishfood1 },
      { id: 24, name: 'Декорации для аквариума', description: 'Описание декораций для аквариума...', price: 200, image: fishfood1 },
      { id: 25, name: 'Обогреватели для аквариумов', description: 'Описание обогревателей для аквариумов...', price: 250, image: fishfood1 },
      { id: 26, name: 'Освещение для аквариумов', description: 'Описание освещения для аквариумов...', price: 300, image: fishfood1 },
      { id: 27, name: 'Средства по уходу за водой', description: 'Описание средств по уходу за водой...', price: 350, image: fishfood1 },
      { id: 28, name: 'Тесты для воды', description: 'Описание тестов для воды...', price: 400, image: fishfood1 },
      { id: 29, name: 'Камни и ракушки', description: 'Описание камней и ракушек для аквариума...', price: 450, image: fishfood1 },
      { id: 30, name: 'Растения для аквариума', description: 'Описание растений для аквариума...', price: 500, image: fishfood1 },
      
      { id: 31, name: 'Корм для грызунов', description: 'Описание корма для грызунов...', price: 100, image: rodentfood1 },
      { id: 32, name: 'Игрушки для грызунов', description: 'Описание игрушек для грызунов...', price: 200, image: rodentfood1 },
      { id: 33, name: 'Клетки для грызунов', description: 'Описание клеток для грызунов...', price: 300, image: rodentfood1 },
      { id: 34, name: 'Наполнитель для грызунов', description: 'Описание наполнителя для грызунов...', price: 400, image: rodentfood1 },
      { id: 35, name: 'Домики для грызунов', description: 'Описание домиков для грызунов...', price: 500, image: rodentfood1 },
      { id: 36, name: 'Поилки для грызунов', description: 'Описание поилок для грызунов...', price: 600, image: rodentfood1 },
      { id: 37, name: 'Кормушки для грызунов', description: 'Описание кормушек для грызунов...', price: 700, image: rodentfood1 },
      { id: 38, name: 'Колеса для грызунов', description: 'Описание колес для грызунов...', price: 800, image: rodentfood1 },
      { id: 39, name: 'Витамины для грызунов', description: 'Описание витаминов для грызунов...', price: 900, image: rodentfood1 },
      { id: 40, name: 'Туалеты для грызунов', description: 'Описание туалетов для грызунов...', price: 1000, image: rodentfood1 },
      
      { id: 41, name: 'Корм для птиц', description: 'Описание корма для птиц...', price: 50, image: birdfood1 },
      { id: 42, name: 'Клетки для птиц', description: 'Описание клеток для птиц...', price: 100, image: birdfood1 },
      { id: 43, name: 'Игрушки для птиц', description: 'Описание игрушек для птиц...', price: 150, image: birdfood1 },
      { id: 44, name: 'Поилки для птиц', description: 'Описание поилок для птиц...', price: 200, image: birdfood1 },
      { id: 45, name: 'Кормушки для птиц', description: 'Описание кормушек для птиц...', price: 250, image: birdfood1 },
      { id: 46, name: 'Лакомства для птиц', description: 'Описание лакомств для птиц...', price: 300, image: birdfood1 },
      { id: 47, name: 'Витамины для птиц', description: 'Описание витаминов для птиц...', price: 350, image: birdfood1 },
      { id: 48, name: 'Зерносмесь для птиц', description: 'Описание зерносмеси для птиц...', price: 400, image: birdfood1 },
      { id: 49, name: 'Минеральные камни для птиц', description: 'Описание минеральных камней для птиц...', price: 450, image: birdfood1 },
      { id: 50, name: 'Средства для ухода за птицами', description: 'Описание средств для ухода за птицами...', price: 500, image: birdfood1 },
    ]
  },
  mutations: {
    addToCart(state, product) {
      const existingItem = state.cart.find(item => item.id === product.id);
      if (existingItem) {
        existingItem.quantity++;
      } else {
        state.cart.push({ ...product, quantity: 1 });
      }
      localStorage.setItem('cart', JSON.stringify(state.cart));
    },
    removeFromCart(state, productId) {
      state.cart = state.cart.filter(product => product.id !== productId);
      localStorage.setItem('cart', JSON.stringify(state.cart));
    },
    initializeCart(state) {
      const cart = localStorage.getItem('cart');
      if (cart) {
        state.cart = JSON.parse(cart);
      }
    }
  },
  actions: {
    addToCart({ commit, state }, productId) {
      const product = state.products.find(product => product.id === productId);
      if (product) {
        commit('addToCart', product);
      }
    },
    removeFromCart({ commit }, productId) {
      commit('removeFromCart', productId);
    },
    initializeCart({ commit }) {
      commit('initializeCart');
    }
  },
  getters: {
    products: state => state.products,
    catProducts: state => state.products.filter(product => product.id >= 1 && product.id <= 10),
    dogProducts: state => state.products.filter(product => product.id >= 11 && product.id <= 20),
    fishProducts: state => state.products.filter(product => product.id >= 21 && product.id <= 30),
    rodentProducts: state => state.products.filter(product => product.id >= 31 && product.id <= 40),
    birdProducts: state => state.products.filter(product => product.id >= 41 && product.id <= 50),
    cart: state => state.cart,
    cartTotal: state => {
      return state.cart.reduce((total, product) => total + product.price * product.quantity, 0);
    }
  },
  strict: process.env.NODE_ENV !== 'production'
});

export default store;
