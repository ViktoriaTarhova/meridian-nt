{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
    <div class="max-w-md w-full relative">
        {{-- Декоративные элементы --}}
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-purple-200 rounded-full blur-3xl opacity-30 animate-pulse"></div>
        <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-pink-200 rounded-full blur-3xl opacity-30 animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-100 rounded-full blur-3xl opacity-20"></div>

        {{-- Заголовок --}}
        <div class="text-center mb-8 relative">

            <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                Создать аккаунт
            </h2>
            <p class="text-gray-500 text-lg">Присоединяйтесь к нам и находите лучшие предложения</p>
        </div>

        {{-- Форма регистрации --}}
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 relative border border-white/50">
            <div class="absolute top-0 left-8 right-8 h-1 gradient-bg rounded-full"></div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Имя --}}
                <div class="group">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-purple-500"></i>
                        Ваше имя <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-circle text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               autofocus
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="Иван Иванов">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="group">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-purple-500"></i>
                        Электронная почта <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-at text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="example@mail.ru">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Пароль --}}
                <div class="group">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-purple-500"></i>
                        Пароль <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="Минимум 8 символов">
                        <button type="button"
                                onclick="togglePassword('password', 'toggle-icon-1')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-purple-500 transition">
                            <i id="toggle-icon-1" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="text-gray-400 text-xs mt-1 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>
                        Пароль должен содержать минимум 8 символов
                    </p>
                </div>

                {{-- Подтверждение пароля --}}
                <div class="group">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-check-circle mr-2 text-purple-500"></i>
                        Подтвердите пароль <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-shield-alt text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               required
                               class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="Введите пароль еще раз">
                        <button type="button"
                                onclick="togglePassword('password_confirmation', 'toggle-icon-2')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-purple-500 transition">
                            <i id="toggle-icon-2" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                {{-- Кнопка регистрации --}}
                <button type="submit"
                        class="relative w-full gradient-bg text-white py-3.5 px-4 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-semibold text-lg mt-6 overflow-hidden group">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <i class="fas fa-user-plus"></i>
                        Зарегистрироваться
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-700 to-pink-700 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </button>

                {{-- Ссылка на вход --}}
                <div class="text-center pt-4">
                    <span class="text-gray-500">Уже есть аккаунт?</span>
                    <a href="{{ route('login') }}"
                       class="ml-2 font-semibold gradient-text hover:opacity-80 transition-all duration-300 inline-flex items-center gap-1 group">
                        Войти
                        <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </form>
        </div>

        {{-- Дополнительная информация --}}
        <div class="text-center mt-6">
            <p class="text-xs text-gray-400 flex items-center justify-center gap-3">
                <span><i class="fas fa-lock mr-1"></i> Безопасность</span>
                <span><i class="fas fa-shield-alt mr-1"></i> Конфиденциальность</span>
            </p>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId, iconId) {
        const passwordInput = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(iconId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

<style>
    @keyframes pulse {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.6; }
    }
    .animate-pulse {
        animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>
@endsection
