import { createStore } from 'vuex';

// import preservescat1 from '@/assets/cat/preservescat1.jpg';
// import preservescat2 from '@/assets/cat/preservescat2.jpg';
// import preservescat3 from '@/assets/cat/preservescat3.jpg';
// import couchcat1 from '@/assets/cat/couchcat1.jpg';
// import couchcat2 from '@/assets/cat/couchcat2.jpg';
// import couchcat3 from '@/assets/cat/couchcat3.jpg';
// import hygienecat1 from '@/assets/cat/hygienecat1.jpg';
// import hygienecat2 from '@/assets/cat/hygienecat2.jpg';
// import hygienecat3 from '@/assets/cat/hygienecat3.jpg';
// import fillercat1 from '@/assets/cat/fillercat1.jpg';

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

import aquariumfish1 from '@/assets/fish/aquariumfish1.jpg';
import aquariumfish2 from '@/assets/fish/aquariumfish2.jpg';
import aquariumfish3 from '@/assets/fish/aquariumfish3.jpg';
import grottofish1 from '@/assets/fish/grottofish1.jpg';
import grottofish2 from '@/assets/fish/grottofish2.jpg';
import grottofish3 from '@/assets/fish/grottofish3.jpg';
import plantfish1 from '@/assets/fish/plantfish1.jpg';
import plantfish2 from '@/assets/fish/plantfish2.jpg';
import plantfish3 from '@/assets/fish/plantfish3.jpg';
import groundfish1 from '@/assets/fish/groundfish1.jpg';

import foodrodent1 from '@/assets/rodent/foodrodent1.jpg';
import foodrodent2 from '@/assets/rodent/foodrodent2.jpg';
import foodrodent3 from '@/assets/rodent/foodrodent3.jpg';
import cellrodent1 from '@/assets/rodent/cellrodent1.jpg';
import cellrodent2 from '@/assets/rodent/cellrodent2.jpg';
import cellrodent3 from '@/assets/rodent/cellrodent3.jpg';
import hygienerodent1 from '@/assets/rodent/hygienerodent1.jpg';
import hygienerodent2 from '@/assets/rodent/hygienerodent2.jpg';
import hygienerodent3 from '@/assets/rodent/hygienerodent3.jpg';
import fillerrodent1 from '@/assets/rodent/fillerrodent1.jpg';

import nestbird1 from '@/assets/bird/nestbird1.jpg';
import nestbird2 from '@/assets/bird/nestbird2.jpg';
import nestbird3 from '@/assets/bird/nestbird3.jpg';
import cellbird1 from '@/assets/bird/cellbird1.jpg';
import cellbird2 from '@/assets/bird/cellbird2.jpg';
import cellbird3 from '@/assets/bird/cellbird3.jpg';
import foodbird1 from '@/assets/bird/foodbird1.jpg';
import foodbird2 from '@/assets/bird/foodbird2.jpg';
import foodbird3 from '@/assets/bird/foodbird3.jpg';
import toybird1 from '@/assets/bird/toybird1.jpg';

const store = createStore({
  state: {
    cart: [],
    products: [
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
      
      { id: 21, name: 'Аквариум 3100R, серебристый, 208л, 1000*480*620мм, Jebo', description: 'Классический аквариум объемом 208 литров из силикатного стекла может быть легко вписан в любой интерьер. Аквариум имеет скругленные передние углы, что визуально придает глубину внутреннему пространству и не разделяет его швами.', price: 2000, image: aquariumfish1 },
      { id: 22, name: 'Аквариум 390R, серебристый, 193л, 900*480*615мм, Jebo', description: 'Классический аквариум объемом 193 литра из силикатного стекла может быть легко вписан в любой интерьер. Аквариум имеет скругленные передние углы, что визуально придает глубину внутреннему пространству и не разделяет его швами.', price: 1950, image: aquariumfish2 },
      { id: 23, name: 'Аквариум Breeze, черный, 75,7л, 612*320*431мм, Laguna', description: 'Аквариум из прозрачного стекла 75,7л со встроенным в крышку светильником 1,5Вт. Цвет светодиодов - белый. Включение и выключение освещения производится с помощью выключателя, расположенного на сетевом шнуре.', price: 2500, image: aquariumfish3 },
      { id: 24, name: 'Грот 2208LD "Портик", 85*20*60мм, Laguna', description: 'Этот реалистичный грот в виде разрушенного античного здания - незаменимый элемент для оригинального оформления очень маленьких пресноводных аквариумов ("нано-аквариумов"). С помощью маленьких гротов можно оформить небольшой объем так же интересно и оригинально, как и большой аквариум.', price: 530, image: grottofish1 },
      { id: 25, name: 'Грот "Арка из камней", S, 135*65*95мм, Laguna', description: 'Этот функциональный и максимально реалистичный грот в виде арки из серых камней - незаменимый элемент для оригинального оформления любых пресноводных аквариумов, в особенности для аквауримов с цихловыми рыбами. В сочетании с другими арками из похожих камней дает возможность оформить аквариум в виде каменного лабиринта.', price: 550, image: grottofish2 },
      { id: 26, name: 'Грот "Винная бочка", 80*65*65мм, Laguna', description: 'Такой грот может быть использован как самостоятельный элемент декора - для оформления небольшого аквариума, так и в комплекте с другими гротами, объемными фонами и искусственными растениями - для оформления аквариума большого объема.', price: 600, image: grottofish3 },
      { id: 27, name: 'Бонсай красный, 190*140*250мм, Laguna', description: 'Растения - это не только завершающий штрих в оформлении, но и необходимый атрибут любого аквариума.Изготовленное из нетоксичного пластика, эта привлекательная декорация в виде дерева подойдет для оформления любых типов пресноводных аквариумов.', price: 350, image: plantfish1 },
      { id: 28, name: 'Растение "Альтернантера", зеленое, 80мм, Laguna', description: 'Изготовленное из нетоксичного пластика, растение "Альтернантера" для аквариума с тяжелой керамической подставкой подойдет для оформления переднего плана любых типов пресноводных аквариумов.', price: 400, image: plantfish2 },
      { id: 29, name: 'Растение "Амбулия", красное, 100мм, Laguna', description: 'Растения - это не только завершающий штрих в оформлении, но и необходимый атрибут любого аквариума. Они придают трехмерность внутреннему пространству аквариума, а также служат дополнительным укрытием для небольших рыб, отвечая тем самым не только за эстетику, но и принося обитателям аквариума реальную пользу.', price: 550, image: plantfish3 },
      { id: 30, name: 'Галька S/GB, серая, 50-80мм, 1кг, Laguna', description: 'Грунт аквариумный натуральная речная галька 1кг в сетке, фракция 50-80мм. Безвреден для обитателей аквариума, подходит для пресной и морской воды, может применяться в ландшафтном, флористическом, террариумном и аквариумном дизайне.', price: 320, image: groundfish1 },
      
      { id: 31, name: 'Корм для грызунов "Травяные гранулы", 500г, Тriol Standard', description: 'Эта универсальная смесь натуральных природных компонентов содержит все питательные вещества, витамины и минералы, необходимые для роста и развития вашего питомца. Оптимальная комбинация измельченных и спрессованных луговых трав обеспечивает превосходное пищеварение, гигиену полости рта, сияющую шерсть и великолепное здоровье грызунам.', price: 365, image: foodrodent1 },
      { id: 32, name: 'Корм для кроликов, 450г, Triol Original', description: 'Полнорационный корм, разработанный специально для кроликов. Изготовлен исключительно из натуральных ингредиентов, упакован в четырехшовный пакет с плоским дном.', price: 650, image: foodrodent2 },
      { id: 33, name: 'Корм для морских свинок, 450г, Triol Original', description: 'Полнорационный корм, разработанный специально для морских свинок. Изготовлен исключительно из натуральных ингредиентов, упакован в четырехшовный пакет с плоским дном.', price: 370, image: foodrodent3 },
      { id: 34, name: 'Клетка для мелких животных, эмаль, 580*320*320мм, Triol', description: 'В комплектацию изделия входят: пластиковая миска, уютный домик и беговое колесо. Кроме того, клетка оборудована удобной ручкой на крыше, облегчающей процесс переноски изделия, и специальным пластиковым наружным поддоном, облегчающим процесс уборки.', price: 1400, image: cellrodent1 },
      { id: 35, name: 'Клетка для мелких животных с переходами, эмаль, 400*260*400мм, Triol', description: 'В комплектацию изделия входят: пластиковая миска, поилка с носиком, уютный домик, труба-тоннель и беговое колесо. Кроме того, клетка оборудована удобной ручкой на крыше, облегчающей процесс переноски изделия.', price: 1670, image: cellrodent2 },
      { id: 36, name: 'Клетка C2-2 для мелких животных, черный металлик, 640*435*925мм, Triol', description: 'На фасаде клетки имеются две большие удобные дверцы с надежными запирающими механизмами. Комплектация: 3 полки, 3 лесенки, автопоилка объемом 250 мл и миска. Расстояние между прутьями 2,4 см. Бесшумное и аккуратное передвижение по комнате обеспечивают съемные шарообразные колеса', price: 2200, image: cellrodent3 },
      { id: 37, name: 'Купалка для мелких животных "Чистюля" M, 260*190*200мм, серия LITTLE TOWN, Triol', description: 'Большая купалка для мелких животных от TRIOL – это незаменимый аксессуар для шиншилл. Для здоровья и хорошего настроения шиншиллам необходимо регулярно принимать песчаные ванны. Такая процедура не только поддерживает гигиену, но и отлично разнообразит досуг любимца.', price: 723, image: hygienerodent1 },
      { id: 38, name: 'Туалет угловой для кроликов и хорьков "Амели" (сетка в комплекте), 270*270*160мм, серия HYGIENE, Triol', description: 'Съемная сетка максимально упрощает уборку, а компактные габариты изделия позволят разместить его с комфортом для любимца. Туалет изготовлен из высококачественного пластика и легко чистится под струей воды при помощи моющих бытовых средств..', price: 350, image: hygienerodent2 },
      { id: 39, name: 'Песок для шиншилл "Чистюля" Люкс 1,6л/1/8/', description: 'Песок для шиншил.', price: 400, image: hygienerodent3 },
      { id: 40, name: 'Наполнитель для мелких животных древесный 6мм, 3л, серия LITTLE VILLAGE, Triol', description: 'Впитывающий наполнитель TRIOL LITTLE VILLAGE изготовлен из высококачественной древесины. Спрессованные древесные гранулы диаметром 6мм прекрасно поглощают запахи, не пылят и не прилипают к лапам вашего питомца, сохраняя ваш дом в чистоте.', price: 1100, image: fillerrodent1 },
      
      { id: 41, name: 'Гнездо для птиц из луговых трав, d170*70мм, серия NATURAL, Triol', description: 'Изделие выполнено из сухих стеблей луговых трав. Оно компактно, уютно для питомцев и долго сохраняет тепло. Плотный каркас и обмотка препятствуют разрушению и растаскиванию гнезда птицами. А универсальная форма и габариты изделия оптимально подойдут для семейной пары пернатых питомцев и способствуют быстрому выведению их потомства.', price: 900, image: nestbird1 },
      { id: 42, name: 'Домик для птиц из кокоса "Баунти", d105-120/300мм, серия NATURAL, Triol', description: 'Кокос - прекрасный натуральный материал, отличающийся прочностью и простотой в исполнении любых задумок производителей. Натуральный природный материал - это залог здоровья и гарантия хорошего настроения вашего питомца.', price: 1100, image: nestbird2 },
      { id: 43, name: 'Гнездо-домик для птиц из луговых трав "Капля", d90*200мм, серия NATURAL, Triol', description: 'Изделие предназначено для птиц малых и средних размеров: канареек, кеноров, волнистых попугаев, амазонов, карелл, розелл и неразлучников. Оно компактно, уютно для питомцев и долго сохраняет тепло. Плотный каркас и обмотка препятствуют разрушению и растаскиванию гнезда птицами.', price: 1500, image: nestbird3 },
      { id: 44, name: 'Клетка для птиц, эмаль, темно-зеленая, 300*230*390мм, Triol', description: 'В комплектацию изделия входят 2 внешние кормушки-поилки, жердочка и качели. Эмалированная клетка также оборудована удобной ручкой для переноски и специальным пластиковым наружным поддоном, облегчающим процесс уборки.', price: 2000, image: cellbird1 },
      { id: 45, name: 'Клетка для птиц, золото, 300*230*390мм, Triol', description: 'В комплектацию изделия входят внешние кормушки, 2 жердочки и качели. Клетка оборудована удобной ручкой для переноски и специальным пластиковым наружным поддоном, облегчающим процесс уборки.', price: 2350, image: cellbird2 },
      { id: 46, name: 'Клетка 6007 для птиц, эмаль, черная, 470*360*680мм, Triol', description: 'В комплектацию изделия входят 2 кормушки-поилки, 2 жердочки. Клетка также оборудована удобной ручкой для переноски и специальным пластиковым наружным поддоном, облегчающим процесс уборки.', price: 3000, image: cellbird3 },
      { id: 47, name: 'Песок-минеральная подкормка для птиц, 70г, Triol Standard', description: 'Минеральная подкормка обеспечивает максимальную усваиваемость корма в желудке птицы и служит эффективным профилактическим средством от болезней желудочно-кишечного тракта, слизистой оболочки глаз, рахита и других заболеваний.', price: 750, image: foodbird1 },
      { id: 48, name: 'Корм для волнистых попугаев с фруктами, 450г, Triol Original', description: 'Полнорационный корм, разработанный специально для волнистых попугаев. Изготовлен исключительно из натуральных ингредиентов, упакован в четырехшовный пакет с плоским дном.', price: 470, image: foodbird2 },
      { id: 49, name: 'Лакомство для волнистых попугаев "Ассорти" (уп.3шт.), 80г, Triol Original', description: 'Лакомство для волнистых попугаев АССОРТИ (с фруктами, с овощами и хитином, с мёдом), три палочки разных лакомств запаяны в полиэтиленовый пакет и уложены в картонную коробочку.', price: 450, image: foodbird3 },
      { id: 50, name: 'Домик для птиц из кокоса "Чудо-кокос", 425/455*d110мм, серия NATURAL, Triol', description: 'Игрушка для птиц, выполненная из кокоса, наполненного кокосовым волокном. Верхняя часть состоит из плетеного шара, завернутого в кукурузные листья.', price: 500, image: toybird1 },
    ]
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
    },
    UPDATE_QUANTITY(state, { productId, quantity }) {
      const item = state.cart.find(item => item.id === productId);
      if (item) {
        item.quantity = quantity;
      }
      localStorage.setItem('cart', JSON.stringify(state.cart));
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
    },
    updateQuantity({ commit }, { productId, quantity }) {
      commit('UPDATE_QUANTITY', { productId, quantity });
    }
  },
  strict: process.env.NODE_ENV !== 'production'
});

export default store;
