{{-- resources/views/profile/change-password.blade.php --}}
@extends('layouts.app')

@section('title', 'Смена пароля')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        {{-- Hero секция --}}
        <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r from-purple-600 to-indigo-600">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 py-8 px-8 text-white">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl md:text-4xl font-bold">Смена пароля</h1>
                </div>
                <p class="text-lg opacity-90">Измените ваш пароль для безопасности аккаунта</p>
            </div>
        </div>

        {{-- Уведомления --}}
        @if(session('success'))
            <div class="fixed top-20 right-4 z-50 animate-fade-in-up">
                <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-3 rounded-xl shadow-2xl flex items-center gap-2">
                    <i class="fas fa-check-circle text-xl"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-xl p-4 animate-fade-in-up">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Ошибка валидации</h3>
                        <div class="mt-1 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Сетка: боковое меню + форма --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- Боковое меню --}}
            <div class="lg:col-span-1">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden sticky top-24 border border-white/50">
                    <div class="relative">
                        <div class="absolute top-0 left-0 right-0 h-24 gradient-bg"></div>
                        <div class="relative pt-16 pb-6 px-6 text-center">
                            <div class="w-24 h-24 mx-auto rounded-full border-4 border-white shadow-lg overflow-hidden bg-white flex items-center justify-center">
                                @php
                                    $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : null;
                                @endphp
                                @if($avatarUrl)
                                    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full gradient-bg flex items-center justify-center text-white text-4xl font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 mt-4">{{ $user->name }}</h2>
                            <p class="text-gray-500 text-sm mt-1">{{ $user->email }}</p>
                            <div class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1 text-xs"></i> Активен
                            </div>
                        </div>
                    </div>

                    <nav class="p-4 space-y-1 border-t border-gray-100">
                        <a href="{{ route('profile.index') }}" class="flex items-center w-full px-4 py-3 text-left rounded-xl text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-all duration-300 group">
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-purple-100 transition">
                                <i class="fas fa-user text-gray-500 group-hover:text-purple-600"></i>
                            </div>
                            <span class="font-medium">Личные данные</span>
                        </a>
                        <a href="{{ route('profile.change-password') }}" class="flex items-center w-full px-4 py-3 text-left rounded-xl gradient-bg text-white shadow-md transition-all duration-300">
                            <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center mr-3">
                                <i class="fas fa-lock text-white"></i>
                            </div>
                            <span class="font-medium">Сменить пароль</span>
                        </a>
                        <a href="{{ route('profile.saved') }}" class="flex items-center w-full px-4 py-3 text-left rounded-xl text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-all duration-300 group">
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-purple-100 transition">
                                <i class="fas fa-heart text-gray-500 group-hover:text-purple-600"></i>
                            </div>
                            <span class="font-medium">Избранное</span>
                        </a>
                        @if(Auth::user()->isAdmin() || Auth::user()->isAgent())
                            <a href="{{ route('profile.my-properties') }}" class="flex items-center w-full px-4 py-3 text-left rounded-xl text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-all duration-300 group">
                                <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-purple-100 transition">
                                    <i class="fas fa-building text-gray-500 group-hover:text-purple-600"></i>
                                </div>
                                <span class="font-medium">Мои объекты</span>
                            </a>
                        @endif
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.agents.index') }}" class="flex items-center w-full px-4 py-3 text-left rounded-xl text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-all duration-300 group">
                                <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-purple-100 transition">
                                    <i class="fas fa-users text-gray-500 group-hover:text-purple-600"></i>
                                </div>
                                <span class="font-medium">Управление агентами</span>
                            </a>
                        @endif
                    </nav>
                </div>
            </div>

            {{-- Форма смены пароля --}}
            <div class="lg:col-span-3">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/50 relative">
                    <div class="absolute top-0 left-8 right-8 h-1 gradient-bg rounded-full"></div>

                    <form method="POST" action="{{ route('profile.update-password') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Текущий пароль --}}
                        <div class="group">
                            <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-shield-alt text-purple-500 mr-2"></i>
                                Текущий пароль <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                                </div>
                                <input type="password"
                                       id="current_password"
                                       name="current_password"
                                       required
                                       class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                                       placeholder="Введите текущий пароль">
                                <button type="button" onclick="togglePassword('current_password', 'toggle-current')"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-purple-500 transition">
                                    <i id="toggle-current" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Новый пароль --}}
                        <div class="group">
                            <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-plus-circle text-purple-500 mr-2"></i>
                                Новый пароль <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-key text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                                </div>
                                <input type="password"
                                       id="new_password"
                                       name="new_password"
                                       required
                                       class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                                       placeholder="Введите новый пароль">
                                <button type="button" onclick="togglePassword('new_password', 'toggle-new')"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-purple-500 transition">
                                    <i id="toggle-new" class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <i class="fas fa-info-circle text-purple-500 text-xs"></i>
                                <p class="text-xs text-gray-400">Минимум 8 символов, используйте буквы и цифры</p>
                            </div>
                        </div>

                        {{-- Подтверждение пароля --}}
                        <div class="group">
                            <label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-check-circle text-purple-500 mr-2"></i>
                                Подтвердите новый пароль <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-check text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                                </div>
                                <input type="password"
                                       id="new_password_confirmation"
                                       name="new_password_confirmation"
                                       required
                                       class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                                       placeholder="Повторите новый пароль">
                                <button type="button" onclick="togglePassword('new_password_confirmation', 'toggle-confirm')"
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

                        {{-- Кнопка сохранения --}}
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="gradient-bg text-white px-10 py-3.5 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-semibold flex items-center gap-2">
                                <i class="fas fa-save mr-2"></i> Сменить пароль
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Кнопка выхода --}}
<div class="container mx-auto px-4 py-4">
    <div class="max-w-6xl mx-auto text-right">
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-red-600 hover:text-red-800 transition">
                <i class="fas fa-sign-out-alt mr-2"></i> Выйти из аккаунта
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
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

    // Индикатор сложности пароля
    const newPasswordInput = document.getElementById('new_password');
    const strengthContainer = document.getElementById('passwordStrength');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');

    if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
            const password = this.value;

            if (password.length === 0) {
                strengthContainer.classList.add('hidden');
                return;
            }

            strengthContainer.classList.remove('hidden');

            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            let color = '';
            let text = '';
            let width = '0%';

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

    setTimeout(() => {
        const notification = document.querySelector('.animate-fade-in-up');
        if (notification) {
            setTimeout(() => notification.remove(), 3000);
        }
    }, 100);
</script>

<style>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.3s ease-out;
}
</style>
@endpush
@endsection
