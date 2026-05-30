@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    {{-- Hero Section с параллакс эффектом --}}
    <section class="relative h-screen min-h-[900px] overflow-hidden">
        {{-- Фоновое изображение с затемнением --}}
        <div class="absolute inset-0">
            <img src="images/fon.png"
                 alt="Недвижимость"
                 class="w-full h-full object-cover scale-105 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30"></div>
        </div>

        {{-- Контент поверх изображения --}}
        <div class="relative container mx-auto px-5 h-full flex flex-col justify-center">
            {{-- Текст с анимацией --}}
            <div class="text-white max-w-4xl mb-12 ml-auto text-right animate-fadeInUp">
                <p class="text-5xl md:text-7xl lg:text-8xl font-light leading-tight tracking-tight">
                    Ваши приоритеты —
                </p>
                <p class="text-5xl md:text-7xl lg:text-8xl font-bold leading-tight bg-clip-text text-transparent bg-gradient-to-r from-white via-white to-gray-300">
                    наш главный ориентир.
                </p>
            </div>

            {{-- Поисковый блок со стекломорфизмом --}}
            <div class="backdrop-blur-md bg-white/20 rounded-2xl p-6 shadow-2xl max-w-4xl mx-auto w-full border border-white/30 animate-fadeInUp animation-delay-200">
                <form method="GET" action="{{ route('properties.apartments') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Тип недвижимости --}}
                    <div class="relative">
                        <label class="block text-white text-xs font-semibold mb-2 tracking-wider">ТИП</label>
                        <div class="relative">
                            <i class="fas fa-building absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-300 text-sm"></i>
                            <select name="type" class="w-full pl-10 pr-3 py-3 bg-white/95 backdrop-blur-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-800 text-sm shadow-sm">
                                <option value="apartment">Квартиры</option>
                                <option value="house">Дома</option>
                                <option value="plot">Участки</option>
                                <option value="rent">Аренда</option>
                            </select>
                        </div>
                    </div>

                    {{-- Комнаты --}}
                    <div class="relative">
                        <label class="block text-white text-xs font-semibold mb-2 tracking-wider">КОМНАТЫ</label>
                        <div class="relative">
                            <i class="fas fa-door-open absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-300 text-sm"></i>
                            <select name="rooms" class="w-full pl-10 pr-3 py-3 bg-white/95 backdrop-blur-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-800 text-sm shadow-sm">
                                <option value="">Любое</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4+">4+</option>
                            </select>
                        </div>
                    </div>

                    {{-- Площадь --}}
                    <div class="relative">
                        <label class="block text-white text-xs font-semibold mb-2 tracking-wider">ПЛОЩАДЬ, м²</label>
                        <div class="relative">
                            <i class="fas fa-arrows-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-300 text-sm"></i>
                            <input type="number" name="area_from" placeholder="От"
                                   class="w-full pl-10 pr-3 py-3 bg-white/95 backdrop-blur-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-800 text-sm shadow-sm">
                        </div>
                    </div>

                    {{-- Стоимость --}}
                    <div class="relative">
                        <label class="block text-white text-xs font-semibold mb-2 tracking-wider">СТОИМОСТЬ</label>
                        <div class="relative">
                            <i class="fas fa-ruble-sign absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-300 text-sm"></i>
                            <input type="number" name="price_to" placeholder="До"
                                   class="w-full pl-10 pr-3 py-3 bg-white/95 backdrop-blur-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-800 text-sm shadow-sm">
                        </div>
                    </div>

                    {{-- Кнопка поиска --}}
                    <div class="lg:col-span-4 flex justify-center pt-2">
                        <button type="submit"
                                class="group relative overflow-hidden bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-10 py-3 rounded-xl font-bold text-base shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <span class="relative z-10 flex items-center gap-2">
                                <i class="fas fa-search"></i>
                                Найти недвижимость
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-700 to-indigo-700 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Блок с основателем --}}
    <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                {{-- Текст с анимацией --}}
                <div class="space-y-6 animate-slideInLeft">
                    <div class="relative">
                        <div class="absolute -top-10 left-0 w-24 h-24 bg-purple-100 rounded-full blur-3xl opacity-50"></div>
                        <h2 class="text-4xl md:text-5xl font-bold mb-2 bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                            Бызова Ксения Юрьевна
                        </h2>
                        <p class="text-gray-500 text-lg mb-6 font-light">Основатель и руководитель компании «Меридиан»</p>
                    </div>

                    <div class="relative pl-8 border-l-4 border-purple-500">
                        <p class="text-gray-700 text-xl leading-relaxed italic">
                            "Я горжусь не оборотами компании, а людьми, которые здесь работают.
                            Мы занимаемся не просто сотрудником, а будущим партнёром для наших клиентов.
                            Их профессионализм — это и есть наша главная гарантия."
                        </p>
                    </div>

                    <p class="text-gray-600 leading-relaxed">
                        В нашем агентстве работают <span class="font-bold text-purple-600">6 профессиональных агентов</span> по недвижимости с опытом от 1 года,
                        каждый из которых лично отвечает за ваш результат: они глубоко анализируют рынок,
                        сопровождают сделку от первой консультации до передачи ключей, всегда на связи и
                        действуют так, как если бы решали свою собственную задачу — с максимальной ответственностью,
                        проактивностью и искренним желанием найти вам лучшее решение.
                    </p>

                    {{-- Статистика --}}
                    <div class="grid grid-cols-3 gap-4 pt-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-600">6</div>
                            <div class="text-xs text-gray-500 uppercase tracking-wider">Агентов</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-600">100+</div>
                            <div class="text-xs text-gray-500 uppercase tracking-wider">Сделок</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-600">100%</div>
                            <div class="text-xs text-gray-500 uppercase tracking-wider">Доверие</div>
                        </div>
                    </div>
                </div>

                {{-- Фото с эффектом --}}
                <div class="relative group animate-slideInRight">
                    <div class="absolute -inset-4 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl blur-xl opacity-40 group-hover:opacity-70 transition duration-500"></div>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl transform group-hover:scale-[1.02] transition duration-500">
                        <img src="{{ asset('images/director.jpg') }}"
                             alt="Ксения Бызова"
                             class="w-full h-[600px] object-cover object-top">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Отзывы с улучшенной каруселью --}}
    <section class="py-20 bg-gradient-to-br from-purple-900 via-indigo-900 to-purple-900 relative overflow-hidden">
        {{-- Декоративные элементы --}}
        <div class="absolute top-0 left-0 w-96 h-96 bg-purple-500 rounded-full blur-3xl opacity-10 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-500 rounded-full blur-3xl opacity-10 animate-pulse"></div>

        <div class="container mx-auto px-4 relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white text-center mb-6">
                Отзывы наших клиентов
            </h2>
            <p class="text-purple-200 text-center mb-16 text-lg">Что говорят о нас те, кто уже доверил нам своё будущее</p>

            <div class="relative">
                {{-- Контейнер с отзывами (карусель) --}}
                <div class="reviews-carousel overflow-hidden px-4">
                    <div class="reviews-track flex transition-all duration-700 ease-out gap-6">
                        {{-- Отзыв 1 --}}
                        <div class="review-card flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 hover:bg-white/15 transition-all duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4 shadow-lg">
                                        АП
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Анна П.</h4>
                                        <div class="flex text-yellow-400 mt-1">
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-200 leading-relaxed">
                                    "Отличное агентство! Помогли найти квартиру мечты.
                                    Особенно хочется отметить профессионализм и внимательное отношение к деталям."
                                </p>
                            </div>
                        </div>

                        {{-- Отзыв 2 --}}
                        <div class="review-card flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 hover:bg-white/15 transition-all duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4 shadow-lg">
                                        СИ
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Сергей И.</h4>
                                        <div class="flex text-yellow-400 mt-1">
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-200 leading-relaxed">
                                    "Продавал квартиру через Меридиан. Все прошло быстро и без проблем.
                                    Рекомендую!"
                                </p>
                            </div>
                        </div>

                        {{-- Отзыв 3 --}}
                        <div class="review-card flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 hover:bg-white/15 transition-all duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4 shadow-lg">
                                        ЕС
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Елена С.</h4>
                                        <div class="flex text-yellow-400 mt-1">
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-200 leading-relaxed">
                                    "Спасибо большое за помощь в аренде квартиры!
                                    Все документы оформили быстро, нашла вариант уже через неделю."
                                </p>
                            </div>
                        </div>

                        {{-- Отзыв 4 --}}
                        <div class="review-card flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 hover:bg-white/15 transition-all duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4 shadow-lg">
                                        ДК
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Дмитрий К.</h4>
                                        <div class="flex text-yellow-400 mt-1">
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-200 leading-relaxed">
                                    "Покупал дом за городом. Агент помог с проверкой документов и торгом.
                                    Очень доволен результатом!"
                                </p>
                            </div>
                        </div>

                        {{-- Отзыв 5 --}}
                        <div class="review-card flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 hover:bg-white/15 transition-all duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4 shadow-lg">
                                        ОН
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Ольга Н.</h4>
                                        <div class="flex text-yellow-400 mt-1">
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-200 leading-relaxed">
                                    "Сдавала квартиру в аренду. Подобрали ответственных жильцов за 3 дня.
                                    Спасибо за оперативность!"
                                </p>
                            </div>
                        </div>

                        {{-- Отзыв 6 --}}
                        <div class="review-card flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 hover:bg-white/15 transition-all duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4 shadow-lg">
                                        АМ
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Алексей М.</h4>
                                        <div class="flex text-yellow-400 mt-1">
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-200 leading-relaxed">
                                    "Помогли с оформлением ипотеки и подобрали квартиру в новостройке.
                                    Всё на высшем уровне!"
                                </p>
                            </div>
                        </div>

                        {{-- Отзыв 7 --}}
                        <div class="review-card flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 hover:bg-white/15 transition-all duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4 shadow-lg">
                                        ОН
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Оксана Н.</h4>
                                        <div class="flex text-yellow-400 mt-1">
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-200 leading-relaxed">
                                    "Ольга сопровождала две сделки по продаже квартир в Нижнем Тагиле.
                                    В апреле и сентябре 2023 года. Я в это время находилась в Санкт-Петербурге.
                                    Могу рекомендовать её, как честного и ответственного человека."
                                </p>
                            </div>
                        </div>

                        {{-- Отзыв 8 --}}
                        <div class="review-card flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 hover:bg-white/15 transition-all duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4 shadow-lg">
                                        ЕМ
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Егор М.</h4>
                                        <div class="flex text-yellow-400 mt-1">
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-200 leading-relaxed">
                                    "Ксения очень приятный, вежливый и отзывчивый человек.
                                    Ответила на все интересующие вопросы, все документы были подготовлены вовремя.
                                    Сделка прошла быстро и гладко. Риэлтора советую и рекомендую."
                                </p>
                            </div>
                        </div>

                        {{-- Отзыв 9 --}}
                        <div class="review-card flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)]">
                            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 shadow-xl border border-white/20 hover:bg-white/15 transition-all duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4 shadow-lg">
                                        ЕШ
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Елена Ш.</h4>
                                        <div class="flex text-yellow-400 mt-1">
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                            <i class="fas fa-star text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-200 leading-relaxed">
                                    "Максим мастер своего дела, с ним сделка прошла
                                    легко и успешно, без всяких заморочек и подводных
                                    камней, только чистота сделки!!!"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Стрелки для перелистывания --}}
                <button class="carousel-prev absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-2 lg:-translate-x-6 bg-white/20 backdrop-blur-md rounded-full p-3 shadow-lg hover:bg-white/40 transition-all duration-300 z-20">
                    <i class="fas fa-chevron-left text-white text-xl"></i>
                </button>
                <button class="carousel-next absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-2 lg:translate-x-6 bg-white/20 backdrop-blur-md rounded-full p-3 shadow-lg hover:bg-white/40 transition-all duration-300 z-20">
                    <i class="fas fa-chevron-right text-white text-xl"></i>
                </button>
            </div>

            {{-- Индикаторы текущей позиции --}}
            <div class="flex justify-center mt-10 space-x-3 carousel-dots">
                <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white/75 transition-all duration-300 dot active" data-index="0"></button>
                <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white/75 transition-all duration-300 dot" data-index="1"></button>
                <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white/75 transition-all duration-300 dot" data-index="2"></button>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-slideInLeft {
        animation: slideInLeft 0.8s ease-out forwards;
    }

    .animate-slideInRight {
        animation: slideInRight 0.8s ease-out forwards;
    }

    .animation-delay-200 {
        animation-delay: 0.2s;
        opacity: 0;
        animation-fill-mode: forwards;
    }

    /* Кастомный скроллбар */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #8b5cf6, #6366f1);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #7c3aed, #4f46e5);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Карусель для отзывов
        const track = document.querySelector('.reviews-track');
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');
        const dots = document.querySelectorAll('.dot');
        const cards = document.querySelectorAll('.review-card');

        if (!track || !prevBtn || !nextBtn || cards.length === 0) return;

        let currentIndex = 0;
        let cardsPerView = window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
        const totalSlides = Math.ceil(cards.length / cardsPerView);
        let autoScrollInterval;

        // Обновление количества карточек при ресайзе
        function updateCardsPerView() {
            const newCardsPerView = window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
            if (newCardsPerView !== cardsPerView) {
                cardsPerView = newCardsPerView;
                const newTotalSlides = Math.ceil(cards.length / cardsPerView);
                if (currentIndex >= newTotalSlides) {
                    currentIndex = newTotalSlides - 1;
                }
                updateCarousel(currentIndex);
                updateDotsCount(newTotalSlides);
            }
        }

        function updateDotsCount(slideCount) {
            const dotsContainer = document.querySelector('.carousel-dots');
            if (dotsContainer.children.length !== slideCount) {
                dotsContainer.innerHTML = '';
                for (let i = 0; i < slideCount; i++) {
                    const dot = document.createElement('button');
                    dot.className = `w-2 h-2 rounded-full bg-white/50 hover:bg-white/75 transition-all duration-300 dot ${i === currentIndex ? 'active' : ''}`;
                    dot.setAttribute('data-index', i);
                    dot.addEventListener('click', () => {
                        stopAutoScroll();
                        updateCarousel(i);
                        startAutoScroll();
                    });
                    dotsContainer.appendChild(dot);
                }
            }
        }

        // Обновление позиции карусели
        function updateCarousel(index) {
            const total = Math.ceil(cards.length / cardsPerView);
            if (index < 0) index = 0;
            if (index >= total) index = total - 1;

            currentIndex = index;

            const cardWidth = cards[0].offsetWidth + 24; // ширина карточки + gap
            const translateX = currentIndex * cardWidth * cardsPerView;
            track.style.transform = `translateX(-${translateX}px)`;

            // Обновление dots
            const newDots = document.querySelectorAll('.dot');
            newDots.forEach((dot, i) => {
                if (i === currentIndex) {
                    dot.classList.add('active');
                    dot.style.opacity = '1';
                    dot.style.width = '1.5rem';
                } else {
                    dot.classList.remove('active');
                    dot.style.opacity = '0.5';
                    dot.style.width = '0.5rem';
                }
            });
        }

        // Следующий слайд
        function nextSlide() {
            const total = Math.ceil(cards.length / cardsPerView);
            if (currentIndex < total - 1) {
                updateCarousel(currentIndex + 1);
            } else {
                updateCarousel(0);
            }
        }

        // Предыдущий слайд
        function prevSlide() {
            const total = Math.ceil(cards.length / cardsPerView);
            if (currentIndex > 0) {
                updateCarousel(currentIndex - 1);
            } else {
                updateCarousel(Math.ceil(cards.length / cardsPerView) - 1);
            }
        }

        // Запуск автопрокрутки
        function startAutoScroll() {
            if (autoScrollInterval) clearInterval(autoScrollInterval);
            autoScrollInterval = setInterval(nextSlide, 5000);
        }

        // Остановка автопрокрутки
        function stopAutoScroll() {
            if (autoScrollInterval) {
                clearInterval(autoScrollInterval);
                autoScrollInterval = null;
            }
        }

        // Инициализация
        updateCarousel(0);
        startAutoScroll();

        // События для кнопок
        prevBtn.addEventListener('click', function() {
            stopAutoScroll();
            prevSlide();
            startAutoScroll();
        });

        nextBtn.addEventListener('click', function() {
            stopAutoScroll();
            nextSlide();
            startAutoScroll();
        });

        // Остановка автопрокрутки при наведении
        const carouselContainer = document.querySelector('.reviews-carousel');
        if (carouselContainer) {
            carouselContainer.addEventListener('mouseenter', stopAutoScroll);
            carouselContainer.addEventListener('mouseleave', startAutoScroll);
        }

        // Адаптация при изменении размера окна
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                updateCardsPerView();
                updateCarousel(currentIndex);
            }, 250);
        });
    });

    // Обработчик отправки формы
    document.querySelector('form[action="{{ route("properties.apartments") }}"]')?.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const type = formData.get('type');
        const rooms = formData.get('rooms');
        const areaFrom = formData.get('area_from');
        const priceTo = formData.get('price_to');

        let url = '';
        switch(type) {
            case 'house':
                url = '{{ route("properties.houses") }}';
                break;
            case 'plot':
                url = '{{ route("properties.plots") }}';
                break;
            case 'rent':
                url = '{{ route("properties.rent") }}';
                break;
            default:
                url = '{{ route("properties.apartments") }}';
        }

        const params = new URLSearchParams();
        if (rooms) params.append('rooms', rooms);
        if (areaFrom) params.append('area_from', areaFrom);
        if (priceTo) params.append('price_to', priceTo);

        window.location.href = url + (params.toString() ? '?' + params.toString() : '');
    });
</script>
@endpush
