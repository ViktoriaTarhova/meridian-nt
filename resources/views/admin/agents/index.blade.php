@extends('layouts.app')

@section('title', 'Управление агентами')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Hero секция --}}
    <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r from-purple-600 to-indigo-600">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-10 py-8 px-8 text-white">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold">Агенты</h1>
                        <p class="text-lg opacity-90">Управление агентами недвижимости</p>
                    </div>
                </div>
                <a href="{{ route('admin.agents.create') }}"
                   class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold border border-white/30 hover:scale-105">
                    <i class="fas fa-plus"></i>
                    Добавить агента
                </a>
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

    {{-- Статистика --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Всего агентов</p>
                    <p class="text-3xl font-bold mt-1">{{ $agents->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Активных</p>
                    <p class="text-3xl font-bold mt-1">{{ $agents->where('is_active', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-check text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Объектов</p>
                    <p class="text-3xl font-bold mt-1">{{ $agents->sum(function($a) { return $a->properties()->count(); }) }}</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-building text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm">Новых (месяц)</p>
                    <p class="text-3xl font-bold mt-1">{{ $agents->filter(function($a) { return $a->created_at->diffInMonths(now()) < 1; })->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Таблица агентов --}}
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/50">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Агент</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Контакты</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Телефон</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Статус</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Дата</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($agents as $agent)
                    <tr class="hover:bg-purple-50/30 transition-all duration-200 group">
                        <td class="px-6 py-4 text-sm font-mono text-gray-500">#{{ $agent->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center text-white font-bold shadow-md">
                                    {{ strtoupper(substr($agent->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $agent->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $agent->role }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope text-gray-400 text-xs"></i>
                                <span class="text-gray-600">{{ $agent->email }}</span>
                            </div>
                            @if($agent->telegram || $agent->whatsapp || $agent->vk)
                                <div class="flex gap-2 mt-1">
                                    @if($agent->telegram)
                                        <i class="fab fa-telegram text-blue-400 text-xs" title="Telegram"></i>
                                    @endif
                                    @if($agent->whatsapp)
                                        <i class="fab fa-whatsapp text-green-500 text-xs" title="WhatsApp"></i>
                                    @endif
                                    @if($agent->vk)
                                        <i class="fab fa-vk text-blue-600 text-xs" title="ВКонтакте"></i>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if($agent->phone)
                                <a href="tel:{{ $agent->phone }}" class="text-gray-600 hover:text-purple-600 transition flex items-center gap-1">
                                    <i class="fas fa-phone text-xs text-gray-400"></i>
                                    {{ $agent->phone }}
                                </a>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                {{ $agent->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <i class="fas {{ $agent->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1 text-xs"></i>
                                {{ $agent->is_active ? 'Активен' : 'Неактивен' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div class="flex flex-col">
                                <span>{{ $agent->created_at->format('d.m.Y') }}</span>
                                <span class="text-xs text-gray-400">{{ $agent->created_at->format('H:i') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center gap-2">
                               
                                <form action="{{ route('admin.agents.destroy', $agent->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 hover:scale-110 transition-all duration-200 flex items-center justify-center"
                                            onclick="return confirm('Вы уверены, что хотите удалить агента {{ $agent->name }}?')"
                                            title="Удалить">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Пагинация --}}
    <div class="mt-8">
        {{ $agents->links() }}
    </div>

    {{-- Пустое состояние --}}
    @if($agents->count() == 0)
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-12 text-center border border-white/50">
            <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-users text-white text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-700 mb-2">Нет агентов</h3>
            <p class="text-gray-400">Добавьте первого агента недвижимости</p>
            <a href="{{ route('admin.agents.create') }}" class="inline-flex items-center gap-2 mt-6 gradient-bg text-white px-8 py-3 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-medium">
                <i class="fas fa-plus"></i>
                Добавить агента
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
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
