@extends('layouts.app')

@section('title', 'Добавить агента')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        {{-- Hero секция --}}
        <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r from-purple-600 to-indigo-600">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 py-8 px-8 text-white">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl md:text-4xl font-bold">Добавить агента</h1>
                </div>
                <p class="text-lg opacity-90">Создание нового агента недвижимости</p>
            </div>
        </div>

        {{-- Форма --}}
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-white/50 relative">
            <div class="absolute top-0 left-8 right-8 h-1 gradient-bg rounded-full"></div>

            

            <form method="POST" action="{{ route('admin.agents.store') }}" class="space-y-6">
                @csrf

                {{-- ФИО --}}
                <div class="group">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-purple-500 mr-2"></i>
                        ФИО <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-circle text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               required
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="Иванов Иван Иванович">
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
                        <i class="fas fa-envelope text-purple-500 mr-2"></i>
                        Email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-at text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               required
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="agent@example.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Телефон --}}
                <div class="group">
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-phone text-purple-500 mr-2"></i>
                        Телефон
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-mobile-alt text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input type="tel"
                               name="phone"
                               id="phone"
                               value="{{ old('phone') }}"
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="+7 (999) 999-99-99">
                    </div>
                    @error('phone')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Пароль --}}
                <div class="group">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-purple-500 mr-2"></i>
                        Пароль <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input type="password"
                               name="password"
                               id="password"
                               required
                               class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="Минимум 8 символов">
                        <button type="button"
                                onclick="togglePassword('password', 'toggle-password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-purple-500 transition">
                            <i id="toggle-password" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <i class="fas fa-info-circle text-purple-500 text-xs"></i>
                        <p class="text-xs text-gray-400">Минимум 8 символов, используйте буквы и цифры</p>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Подтверждение пароля --}}
                <div class="group">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-check-circle text-purple-500 mr-2"></i>
                        Подтверждение пароля <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-shield-alt text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               required
                               class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="Повторите пароль">
                        <button type="button"
                                onclick="togglePassword('password_confirmation', 'toggle-confirm')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-purple-500 transition">
                            <i id="toggle-confirm" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                {{-- Индикатор сложности пароля --}}
                <div id="passwordStrength" class="hidden">
                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div id="strengthBar" class="h-full w-0 transition-all duration-300 rounded-full"></div>
                        </div>
                        <span id="strengthText" class="text-xs font-medium"></span>
                    </div>
                </div>

                {{-- Кнопки --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" class="gradient-bg text-white px-8 py-3.5 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-semibold flex items-center justify-center gap-2 flex-1">

                        Создать агента
                    </button>
                    <a href="{{ route('admin.agents.index') }}" class="border-2 border-gray-300 text-gray-700 px-8 py-3.5 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 font-medium flex items-center justify-center gap-2">

                        Отмена
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    // Toggle password visibility
    function togglePassword(fieldId, iconId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Маска для телефона
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);
            if (value.length >= 11) {
                value = value.replace(/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/, '+$1 ($2) $3-$4-$5');
            }
            this.value = value;
        });
    }

    // Индикатор сложности пароля
    const passwordInput = document.getElementById('password');
    const strengthContainer = document.getElementById('passwordStrength');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');

    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;

            if (password.length === 0) {
                strengthContainer.classList.add('hidden');
                return;
            }

            strengthContainer.classList.remove('hidden');

            let strength = 0;

            // Длина
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;

            // Заглавные буквы
            if (/[A-Z]/.test(password)) strength++;

            // Цифры
            if (/[0-9]/.test(password)) strength++;

            // Спецсимволы
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            let color = '';
            let text = '';
            let width = '';

            if (strength <= 2) {
                color = 'bg-red-500';
                text = 'Слабый';
                width = '25%';
            } else if (strength <= 4) {
                color = 'bg-yellow-500';
                text = 'Средний';
                width = '50%';
            } else if (strength <= 6) {
                color = 'bg-blue-500';
                text = 'Хороший';
                width = '75%';
            } else {
                color = 'bg-green-500';
                text = 'Сильный';
                width = '100%';
            }

            strengthBar.className = `h-full transition-all duration-300 rounded-full ${color}`;
            strengthBar.style.width = width;
            strengthText.textContent = text;
            strengthText.className = `text-xs font-medium ${color.replace('bg-', 'text-')}`;
        });
    }
</script>
@endpush
@endsection
