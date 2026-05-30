<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Меридиан - @yield('title', 'Агентство недвижимости')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Кастомные градиенты */
        .gradient-text {
            background: linear-gradient(135deg, #d528de 0%, #8727e7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #d528de 0%, #8727e7 100%);
        }
        .gradient-bg-hover {
            background: linear-gradient(135deg, #c01bc9 0%, #6e1bc4 100%);
        }
        .gradient-border {
            position: relative;
            background: linear-gradient(135deg, #d528de, #8727e7);
            border-radius: 1rem;
        }
        .gradient-border::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1rem;
            padding: 1px;
            background: linear-gradient(135deg, #d528de, #8727e7);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        /* Стеклянная шапка */
        .glass-header {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(216, 40, 222, 0.15);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
        }

        /* Анимации */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        /* Кастомный скроллбар */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #d528de, #8727e7);
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #c01bc9, #6e1bc4);
        }

        /* Hover эффекты для карточек */
        .hover-glow {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(213, 40, 222, 0.15);
        }

        /* Кнопки с ripple эффектом */
        .btn-ripple {
            position: relative;
            overflow: hidden;
        }
        .btn-ripple::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.4s, height 0.4s;
        }
        .btn-ripple:active::after {
            width: 200%;
            height: 200%;
        }

        /* Адаптивные улучшения */
        @media (max-width: 768px) {
            .glass-header {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
            }
        }

        @media (hover: none) and (pointer: coarse) {
            button, a {
                min-height: 44px;
                min-width: 44px;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100">

    {{-- Header с эффектом стекла --}}
    <header class="glass-header fixed top-0 z-50 w-full transition-all duration-300">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between min-h-[64px] md:min-h-[72px]">
                {{-- Логотип с анимацией --}}
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group flex-shrink-0">
                    <div class="relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full blur opacity-40 group-hover:opacity-70 transition duration-300"></div>
                        <img src="{{ asset('images/logo.png') }}"
                             width="40"
                             height="40"
                             class="relative h-8 w-auto sm:h-9 md:h-10 object-contain"
                             alt="Меридиан логотип">
                    </div>
                    <span class="text-xl sm:text-2xl md:text-3xl font-bold">
                        <span class="gradient-text">еридиан</span>
                    </span>
                </a>

                {{-- Мобильное меню (бургер) --}}
                <div class="md:hidden">
                    <button id="mobile-menu-button"
                            class="relative w-10 h-10 rounded-full bg-white shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center text-gray-700 hover:text-purple-600 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>

                {{-- Desktop Navigation с анимацией --}}
                <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    @php
                        $navItems = [
                            ['route' => 'properties.apartments', 'name' => 'Квартиры' ],
                            ['route' => 'properties.houses', 'name' => 'Дома' ],
                            ['route' => 'properties.plots', 'name' => 'Участки'],
                            ['route' => 'properties.rent', 'name' => 'Аренда'],
                            ['route' => 'services', 'name' => 'Услуги'],
                        ];
                    @endphp
                    @foreach($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="group relative px-4 py-2 rounded-xl text-gray-700 hover:text-purple-600 transition-all duration-300 font-semibold text-sm lg:text-base">
                            {{ $item['name'] }}
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-gradient-to-r from-purple-500 to-pink-500 group-hover:w-1/2 group-hover:left-1/4 transition-all duration-300"></span>
                        </a>
                    @endforeach
                </div>

                {{-- Auth buttons / Profile --}}
                <div class="hidden md:flex items-center space-x-3">
                    @auth
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('profile.index') }}"
                               class="group flex items-center space-x-2 gradient-bg hover:gradient-bg-hover text-white px-4 py-2 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <i class="fas fa-user text-sm"></i>
                                <span class="font-medium">Профиль</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                        class="relative overflow-hidden border-2 border-purple-500 text-purple-600 px-4 py-2 rounded-xl hover:bg-purple-50 transition-all duration-300 font-medium group">
                                    <span class="relative z-10">Выйти</span>
                                    <i class="fas fa-sign-out-alt ml-2 relative z-10"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}"
                               class="gradient-bg hover:gradient-bg-hover text-white px-5 py-2 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 font-medium">
                                Войти
                            </a>
                            <a href="{{ route('register') }}"
                               class="relative overflow-hidden border-2 border-purple-500 text-purple-600 px-5 py-2 rounded-xl hover:bg-purple-50 transition-all duration-300 font-medium">
                                Регистрация
                            </a>
                        </div>
                    @endauth
                </div>

                {{-- Mobile auth buttons --}}
                <div class="md:hidden flex items-center space-x-2">
                    @auth
                        <a href="{{ route('profile.index') }}"
                           class="gradient-bg text-white p-2.5 rounded-xl shadow-md">
                            <i class="fas fa-user text-sm"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="gradient-bg text-white px-4 py-2 rounded-xl text-sm font-medium shadow-md">
                            Войти
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Mobile Navigation Menu --}}
            <div id="mobile-menu" class="hidden md:hidden py-4 mt-2 border-t border-gray-100 animate-fadeIn">
                <div class="flex flex-col space-y-2">
                    @foreach($navItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center space-x-3 text-gray-700 hover:text-purple-600 transition font-semibold py-3 px-3 rounded-xl hover:bg-purple-50">
                            <span>{{ $item['name'] }}</span>
                        </a>
                    @endforeach
                    @guest
                        <div class="pt-3 space-y-2">
                            <a href="{{ route('register') }}"
                               class="gradient-bg text-white block text-center px-4 py-3 rounded-xl font-medium">
                                Регистрация
                            </a>
                        </div>
                    @endguest
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="pt-3">
                            @csrf
                            <button type="submit"
                                    class="border-2 border-purple-500 text-purple-600 w-full px-4 py-3 rounded-xl font-medium hover:bg-purple-50 transition">
                                Выйти
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    {{-- Main content --}}
    <main class="pt-[64px] md:pt-[72px]">
        @yield('content')
    </main>

    {{-- Footer с современным дизайном --}}
    <footer class="relative bg-gray-900 text-white pt-12 pb-8 overflow-hidden">
        {{-- Декоративные элементы --}}
        <div class="absolute top-0 left-0 w-64 h-64 bg-purple-500 rounded-full blur-3xl opacity-10"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-pink-500 rounded-full blur-3xl opacity-10"></div>

        <div class="container mx-auto px-4 relative z-10">
    {{-- 3 колонки равномерно по всей ширине --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12">
        {{-- Column 1: О компании --}}
        <div>
            <div class="flex items-center space-x-2 mb-4">
                <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                    <i class="fas fa-compass text-white text-sm"></i>
                </div>
                <span class="text-xl font-bold gradient-text">Меридиан</span>
            </div>
            <p class="text-gray-400 text-sm leading-relaxed">
                Ваш надёжный партнёр в мире недвижимости. Профессиональный подход и забота о каждом клиенте.
            </p>
        </div>

        {{-- Column 2: Navigation --}}
        <div>
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-sitemap text-purple-400 mr-2 text-sm"></i>
                Навигация
            </h3>
            <div class="grid grid-cols-2 gap-2">
                <ul class="space-y-2">
                    <li><a href="{{ route('properties.apartments') }}" class="text-gray-400 hover:text-white transition flex items-center group"><i class="fas fa-chevron-right text-purple-500 text-xs mr-2 group-hover:translate-x-1 transition"></i>Квартиры</a></li>
                    <li><a href="{{ route('properties.houses') }}" class="text-gray-400 hover:text-white transition flex items-center group"><i class="fas fa-chevron-right text-purple-500 text-xs mr-2 group-hover:translate-x-1 transition"></i>Дома</a></li>
                    <li><a href="{{ route('properties.plots') }}" class="text-gray-400 hover:text-white transition flex items-center group"><i class="fas fa-chevron-right text-purple-500 text-xs mr-2 group-hover:translate-x-1 transition"></i>Участки</a></li>
                </ul>
                <ul class="space-y-2">
                    <li><a href="{{ route('properties.rent') }}" class="text-gray-400 hover:text-white transition flex items-center group"><i class="fas fa-chevron-right text-purple-500 text-xs mr-2 group-hover:translate-x-1 transition"></i>Аренда</a></li>
                    <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-white transition flex items-center group"><i class="fas fa-chevron-right text-purple-500 text-xs mr-2 group-hover:translate-x-1 transition"></i>Услуги</a></li>

                </ul>
            </div>
        </div>

        {{-- Column 3: Контакты и соцсети --}}
        <div>
            <h3 class="text-lg font-semibold mb-4 flex items-center">
                <i class="fas fa-address-card text-purple-400 mr-2 text-sm"></i>
                Контакты
            </h3>
            <div class="space-y-3 text-gray-400">
                <p class="flex items-start space-x-3 text-sm">
                    <i class="fas fa-map-marker-alt text-purple-400 mt-0.5 flex-shrink-0"></i>
                    <span>г. Нижний Тагил, ул. Окунева д. 42, офис №11</span>
                </p>
                <p class="flex items-center space-x-3 text-sm">
                    <i class="fas fa-phone text-purple-400 flex-shrink-0"></i>
                    <a href="tel:+79011500879" class="hover:text-white transition">+7 (901) 150-08-79</a>
                </p>
            </div>

            {{-- Социальные сети --}}
            <div class="mt-6">
                <h4 class="text-sm font-semibold text-gray-300 mb-3">Мы в соцсетях</h4>
                <div class="flex space-x-3">
                    <a href="https://vk.com/an_meridian_nt_ekb?ysclid=mm0pst6mj8351692345"
                       target="_blank"
                       class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center hover:scale-110 transition-transform duration-300 shadow-lg">
                        <i class="fab fa-vk text-white text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-gray-800 mt-8 pt-6 text-center">
        <p class="text-gray-500 text-sm">
            &copy; {{ date('Y') }} Агентство недвижимости «Меридиан». Все права защищены.
        </p>
    </div>
</div>
    </footer>

    {{-- Mobile menu script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    const icon = mobileMenuButton.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('fa-bars');
                        icon.classList.toggle('fa-times');
                    }
                });

                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.add('hidden');
                        const icon = mobileMenuButton.querySelector('i');
                        if (icon) {
                            icon.classList.add('fa-bars');
                            icon.classList.remove('fa-times');
                        }
                    });
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
