{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Вход в аккаунт')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
    <div class="max-w-md w-full relative">
        {{-- Декоративные элементы --}}
        <div class="absolute -top-20 -right-20 w-64 h-64 bg-purple-200 rounded-full blur-3xl opacity-30 animate-pulse"></div>
        <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-pink-200 rounded-full blur-3xl opacity-30 animate-pulse" style="animation-delay: 1s;"></div>

        <div class="text-center mb-8 relative">
            <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                Добро пожаловать!
            </h2>
            <p class="text-gray-500 text-lg">Войдите в свой аккаунт чтобы продолжить</p>
        </div>

        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 relative border border-white/50">
            {{-- Декоративная линия сверху --}}
            <div class="absolute top-0 left-8 right-8 h-1 gradient-bg rounded-full"></div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Поле Email --}}
                <div class="group">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-purple-500"></i>
                        Электронная почта
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
                               autofocus
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="your@email.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Поле Пароль --}}
                <div class="group">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-purple-500"></i>
                        Пароль
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
                               placeholder="••••••••">
                        <button type="button"
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-purple-500 transition">
                            <i id="password-toggle-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Запомнить меня и Забыли пароль - в одну строку --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember"
                               type="checkbox"
                               name="remember"
                               class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Запомнить меня
                        </label>
                    </div>
                </div>

                {{-- Кнопка входа --}}
                <button type="submit"
                        class="relative w-full gradient-bg text-white py-3.5 px-4 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-semibold text-lg overflow-hidden group">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        <i class="fas fa-arrow-right-to-bracket"></i>
                        Войти
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-700 to-pink-700 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </button>

                {{-- Ссылка на регистрацию --}}
                <div class="text-center pt-4">
                    <span class="text-gray-500">Нет аккаунта?</span>
                    <a href="{{ route('register') }}"
                       class="ml-2 font-semibold gradient-text hover:opacity-80 transition-all duration-300 inline-flex items-center gap-1 group">
                        Зарегистрироваться
                        <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </form>
        </div>

        {{-- Дополнительная информация --}}
        <div class="text-center mt-6">
            <p class="text-xs text-gray-400">
                <i class="fas fa-shield-alt mr-1"></i>
                Ваши данные защищены
            </p>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('password-toggle-icon');

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
