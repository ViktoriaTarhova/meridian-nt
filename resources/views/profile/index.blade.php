{{-- resources/views/profile/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Мой профиль')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        {{-- Hero секция --}}
        <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r from-purple-600 to-indigo-600">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 py-8 px-8 text-white">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl md:text-4xl font-bold">Мой профиль</h1>
                </div>
                <p class="text-lg opacity-90">Управление личными данными и настройками</p>
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

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            {{-- Боковое меню --}}
            <div class="lg:col-span-1">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden sticky top-24 border border-white/50">
                    <div class="relative">
                        <div class="absolute top-0 left-0 right-0 h-24 gradient-bg"></div>
                        <div class="relative pt-16 pb-6 px-6 text-center">
                            {{-- Аватар --}}
                            <div class="relative inline-block group">
                                @if($user->avatar_url)
                                    <div class="relative">
                                        <img src="{{ $user->avatar_url }}"
                                             alt="{{ $user->name }}"
                                             class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                                        <div class="absolute inset-0 bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center cursor-pointer">
                                            <i class="fas fa-camera text-white text-xl"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-24 h-24 gradient-bg rounded-full mx-auto flex items-center justify-center text-white text-4xl font-bold mb-4">
    @if($user->avatar_url)
        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover">
    @else
        {{ strtoupper(substr($user->name, 0, 1)) }}
    @endif
</div>
                                @endif
                            </div>

                            <h2 class="text-xl font-bold text-gray-900 mt-4">{{ $user->name }}</h2>
                            <p class="text-gray-500 text-sm mt-1">{{ $user->email }}</p>
                            <div class="mt-2">
                                @if($user->isAgent())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800">
                                        <i class="fas fa-user-tie mr-1 text-xs"></i> Агент
                                    </span>
                                @elseif($user->isAdmin())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-red-100 to-red-200 text-red-800">
                                        <i class="fas fa-shield-alt mr-1 text-xs"></i> Администратор
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        <i class="fas fa-user mr-1 text-xs"></i> Пользователь
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <nav class="p-4 space-y-1 border-t border-gray-100">
                        <a href="{{ route('profile.index') }}"
                           class="flex items-center w-full px-4 py-3 text-left rounded-xl gradient-bg text-white shadow-md transition-all duration-300">
                            <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <span class="font-medium">Личные данные</span>
                        </a>

                        <a href="{{ route('profile.change-password') }}"
                           class="flex items-center w-full px-4 py-3 text-left rounded-xl text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-all duration-300 group">
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-purple-100 transition">
                                <i class="fas fa-lock text-gray-500 group-hover:text-purple-600"></i>
                            </div>
                            <span class="font-medium">Сменить пароль</span>
                        </a>

                        <a href="{{ route('profile.saved') }}"
                           class="flex items-center w-full px-4 py-3 text-left rounded-xl text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-all duration-300 group">
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-purple-100 transition">
                                <i class="fas fa-heart text-gray-500 group-hover:text-purple-600"></i>
                            </div>
                            <span class="font-medium">Избранное</span>
                            <span class="ml-auto text-xs bg-gray-200 text-gray-600 px-2 py-0.5 rounded-full">{{ $user->savedProperties()->count() }}</span>
                        </a>

                        @if($user->isAdmin() || $user->isAgent())
                            <a href="{{ route('profile.my-properties') }}"
                               class="flex items-center w-full px-4 py-3 text-left rounded-xl text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-all duration-300 group">
                                <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-purple-100 transition">
                                    <i class="fas fa-building text-gray-500 group-hover:text-purple-600"></i>
                                </div>
                                <span class="font-medium">Мои объекты</span>
                            </a>
                        @endif

                        @if($user->isAdmin())
                            <a href="{{ route('admin.agents.index') }}"
                               class="flex items-center w-full px-4 py-3 text-left rounded-xl text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-all duration-300 group">
                                <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-purple-100 transition">
                                    <i class="fas fa-users text-gray-500 group-hover:text-purple-600"></i>
                                </div>
                                <span class="font-medium">Управление агентами</span>
                            </a>
                        @endif
                    </nav>
                </div>
            </div>

            {{-- Основной контент --}}
            <div class="lg:col-span-3">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/50 relative">
                    <div class="absolute top-0 left-8 right-8 h-1 gradient-bg rounded-full"></div>



                    {{-- Форма загрузки аватарки --}}
                    <div class="mb-8 p-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                        <h4 class="font-semibold text-gray-700 mb-4 flex items-center">
                            Фото профиля
                        </h4>
                        <div class="flex flex-col sm:flex-row items-center gap-6">
                            <div class="flex-shrink-0">
                                @if($user->avatar_url)
                                    <img src="{{ $user->avatar_url }}" alt="Аватар" class="w-24 h-24 rounded-full object-cover border-4 border-purple-200 shadow-lg">
                                @else
                                    <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 text-center sm:text-left">
                                <div class="flex flex-wrap gap-3 justify-center sm:justify-start">
                                    <form method="POST" action="{{ url('/profile/avatar') }}" enctype="multipart/form-data" class="inline-block">
                                        @csrf
                                        <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden" onchange="this.form.submit()">
                                        <label for="avatarInput" class="cursor-pointer inline-flex items-center gap-2 px-5 py-2.5 bg-gray-700 text-white rounded-xl hover:bg-gray-800 transition-all duration-300 font-medium">
                                            <i class="fas fa-upload"></i>
                                            Загрузить фото
                                        </label>
                                    </form>

                                    @if($user->avatar_url)
                                        <form method="POST" action="{{ url('/profile/avatar') }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-red-500 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all duration-300 font-medium" onclick="return confirm('Удалить аватарку?')">
                                                <i class="fas fa-trash-alt"></i>
                                                Удалить
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-400 mt-3">
                                    <i class="fas fa-info-circle"></i> Рекомендуемый размер: 200x200px. JPG, PNG до 2MB
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Форма редактирования данных --}}
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="group">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-purple-500 mr-2"></i>
                                Имя <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-circle text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                                </div>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       required
                                       class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                                       placeholder="Ваше имя">
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

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
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       required
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
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone', $user->phone ?? '') }}"
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

                        @if($user->isAgent() || $user->isAdmin())
                            <div class="border-t-2 border-gray-100 pt-6 mt-2">
                                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                    Социальные сети для связи
                                </h4>

                                <div class="space-y-4">
                                    <div class="group">
                                        <label for="telegram" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fab fa-telegram text-blue-500 mr-2"></i> Telegram
                                        </label>
                                        <div class="flex">
                                            <span class="inline-flex items-center px-4 bg-gray-100 border-2 border-r-0 border-gray-200 rounded-l-xl text-gray-500 font-medium">t.me/</span>
                                            <input type="text"
                                                   id="telegram"
                                                   name="telegram"
                                                   value="{{ old('telegram', $user->telegram ?? '') }}"
                                                   class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-r-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                                                   placeholder="username">
                                        </div>
                                    </div>

                                    <div class="group">
                                        <label for="whatsapp" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fab fa-whatsapp text-green-500 mr-2"></i> WhatsApp
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fab fa-whatsapp text-gray-400 group-focus-within:text-green-500 transition-colors"></i>
                                            </div>
                                            <input type="tel"
                                                   id="whatsapp"
                                                   name="whatsapp"
                                                   value="{{ old('whatsapp', $user->whatsapp ?? '') }}"
                                                   class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                                                   placeholder="+7 (999) 999-99-99">
                                        </div>
                                    </div>

                                    <div class="group">
                                        <label for="vk" class="block text-sm font-semibold text-gray-700 mb-2">
                                            <i class="fab fa-vk text-blue-600 mr-2"></i> ВКонтакте
                                        </label>
                                        <div class="flex">
                                            <span class="inline-flex items-center px-4 bg-gray-100 border-2 border-r-0 border-gray-200 rounded-l-xl text-gray-500 font-medium">vk.com/</span>
                                            <input type="text"
                                                   id="vk"
                                                   name="vk"
                                                   value="{{ old('vk', $user->vk ?? '') }}"
                                                   class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-r-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                                                   placeholder="id или username">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="flex justify-end pt-6">
                            <button type="submit" class="gradient-bg text-white px-10 py-3.5 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-semibold flex items-center gap-2">
                                Сохранить изменения
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Маска для телефона
    const phoneInput = document.getElementById('phone');
    const whatsappInput = document.getElementById('whatsapp');

    function formatPhone(input) {
        if (!input) return;
        let value = input.value.replace(/\D/g, '');
        if (value.length > 11) value = value.slice(0, 11);
        if (value.length >= 11) {
            value = value.replace(/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/, '+$1 ($2) $3-$4-$5');
        }
        input.value = value;
    }

    if (phoneInput) {
        phoneInput.addEventListener('input', () => formatPhone(phoneInput));
        formatPhone(phoneInput);
    }

    if (whatsappInput) {
        whatsappInput.addEventListener('input', () => formatPhone(whatsappInput));
        formatPhone(whatsappInput);
    }

    // Автоматическое скрытие уведомления
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
