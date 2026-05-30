{{-- resources/views/services/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Услуги')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Hero секция --}}
    <div class="relative rounded-2xl overflow-hidden mb-12 bg-gradient-to-r from-purple-600 to-indigo-600">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-10 py-10 px-8 text-white">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold">Наши услуги</h1>
                        <p class="text-lg opacity-90">Профессиональные услуги по доступным ценам</p>
                    </div>
                </div>

                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('services.create') }}"
                           class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold border border-white/30 hover:scale-105">
                            <i class="fas fa-plus"></i>
                            Добавить услугу
                        </a>
                    @endif
                @endauth
            </div>
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

    @if(session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-xl p-4 animate-fade-in-up">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Сетка услуг --}}
    @if($services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 will-change-transform">
                    {{-- Изображение услуги --}}
                    <div class="relative h-56 overflow-hidden">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full gradient-bg flex items-center justify-center group-hover:scale-110 transition duration-500">
                                <i class="fas fa-concierge-bell text-white text-6xl"></i>
                            </div>
                        @endif

                        {{-- Бейдж --}}
                        <div class="absolute top-3 left-3 gradient-bg text-white px-3 py-1 rounded-lg text-xs font-bold shadow-lg z-10">
                            <i class="fas fa-star mr-1"></i> Услуга
                        </div>

                        {{-- Статус активности --}}
                        @if(!$service->is_active)
                            <div class="absolute bottom-3 left-3 z-10">
                                <span class="px-2 py-1 bg-red-500 text-white text-xs rounded-lg shadow-md">
                                    <i class="fas fa-eye-slash mr-1"></i> Неактивно
                                </span>
                            </div>
                        @endif

                        {{-- Кнопки управления для администратора --}}
                        @auth
                            @if(Auth::user()->isAdmin())
                                <div class="absolute top-3 right-3 flex gap-2 z-10">
                                    <a href="{{ route('services.edit', $service->id) }}"
                                       class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-gray-100 hover:scale-110 transition-all duration-300">
                                        <i class="fas fa-edit text-purple-500 text-sm"></i>
                                    </a>
                                    <button onclick="deleteService({{ $service->id }})"
                                            class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-red-50 hover:scale-110 transition-all duration-300">
                                        <i class="fas fa-trash-alt text-red-500 text-sm"></i>
                                    </button>
                                </div>
                            @endif
                        @endauth
                    </div>

                    {{-- Информация --}}
                    <div class="p-6">
                        {{-- Иконка и название --}}
                        <div class="flex items-center mb-4">
                            <div class="w-14 h-14 gradient-bg rounded-xl flex items-center justify-center shadow-lg transform group-hover:rotate-6 transition duration-300">
                                <i class="fas {{ $service->icon ?? 'fa-star' }} text-white text-2xl"></i>
                            </div>
                            <h3 class="ml-4 text-xl font-bold text-gray-900 group-hover:text-purple-600 transition duration-300 line-clamp-1">
                                {{ $service->title }}
                            </h3>
                        </div>

                        {{-- Описание --}}
                        <p class="text-gray-600 mb-5 leading-relaxed line-clamp-3">
                            {{ $service->description }}
                        </p>

                        {{-- Цена --}}
                        <div class="pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-xs text-gray-400 uppercase tracking-wider">Стоимость</span>
                                    <div class="text-2xl font-bold gradient-text">
                                        {{ $service->formatted_price }}
                                    </div>
                                </div>
                                <div class="text-sm text-gray-400 flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    <span>По запросу</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Пагинация --}}
        <div class="mt-10">
            {{ $services->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50">
            <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-concierge-bell text-white text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-700 mb-2">Услуги не найдены</h3>
            <p class="text-gray-400">Список услуг будет добавлен позже</p>
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('services.create') }}" class="inline-flex items-center gap-2 mt-6 gradient-bg text-white px-8 py-3 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-medium">
                        <i class="fas fa-plus"></i>
                        Добавить первую услугу
                    </a>
                @endif
            @endauth
        </div>
    @endif
</div>

{{-- Форма для удаления --}}
@auth
@if(Auth::user()->isAdmin())
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endif
@endauth

@push('scripts')
<script>
@auth
@if(Auth::user()->isAdmin())
function deleteService(id) {
    if (confirm('Вы уверены, что хотите удалить эту услугу? Это действие нельзя отменить.')) {
        const form = document.getElementById('deleteForm');
        form.action = `/services/${id}`;
        form.submit();
    }
}
@endif
@endauth

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
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.will-change-transform {
    will-change: transform;
}
</style>
@endpush
@endsection
