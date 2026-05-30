{{-- resources/views/profile/my-properties.blade.php --}}
@extends('layouts.app')

@section('title', 'Мои объекты')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        {{-- Hero секция --}}
        <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r from-purple-600 to-indigo-600">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 py-8 px-8 text-white">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl md:text-4xl font-bold">Мои объекты</h1>
                </div>
                <p class="text-lg opacity-90">Управление созданными объявлениями</p>
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

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            {{-- Боковое меню --}}
            <div class="lg:col-span-1">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden sticky top-24 border border-white/50">
                    <div class="relative">
                        <div class="absolute top-0 left-0 right-0 h-24 gradient-bg"></div>
                        <div class="relative pt-16 pb-6 px-6 text-center">
                            <div class="w-24 h-24 mx-auto rounded-full border-4 border-white shadow-lg overflow-hidden bg-white flex items-center justify-center">
                                @php
                                    $avatarUrl = Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : null;
                                @endphp
                                @if($avatarUrl)
                                    <img src="{{ $avatarUrl }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full gradient-bg flex items-center justify-center text-white text-4xl font-bold">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 mt-4">{{ Auth::user()->name }}</h2>
                            <p class="text-gray-500 text-sm mt-1">{{ Auth::user()->email }}</p>
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
                        <a href="{{ route('profile.change-password') }}" class="flex items-center w-full px-4 py-3 text-left rounded-xl text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-all duration-300 group">
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-purple-100 transition">
                                <i class="fas fa-lock text-gray-500 group-hover:text-purple-600"></i>
                            </div>
                            <span class="font-medium">Сменить пароль</span>
                        </a>
                        <a href="{{ route('profile.saved') }}" class="flex items-center w-full px-4 py-3 text-left rounded-xl text-gray-600 hover:bg-gray-50 hover:text-purple-600 transition-all duration-300 group">
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center mr-3 group-hover:bg-purple-100 transition">
                                <i class="fas fa-heart text-gray-500 group-hover:text-purple-600"></i>
                            </div>
                            <span class="font-medium">Избранное</span>
                        </a>
                        <a href="{{ route('profile.my-properties') }}" class="flex items-center w-full px-4 py-3 text-left rounded-xl gradient-bg text-white shadow-md transition-all duration-300">
                            <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center mr-3">
                                <i class="fas fa-building text-white"></i>
                            </div>
                            <span class="font-medium">Мои объекты</span>
                            <span class="ml-auto text-xs bg-white/20 px-2 py-0.5 rounded-full">{{ $properties->total() }}</span>
                        </a>
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

            {{-- Список объектов (остается без изменений) --}}
            <div class="lg:col-span-3">
                @if($properties->count() > 0)
                    <div class="space-y-6">
                        @foreach($properties as $property)
                            <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 will-change-transform">
                                <div class="flex flex-col md:flex-row">
                                    {{-- Изображение --}}
                                    <div class="md:w-56 h-56 md:h-auto relative overflow-hidden rounded-t-2xl md:rounded-l-2xl md:rounded-tr-none">
                                        @php
                                            $images = $property->images;
                                            if (is_string($images)) {
                                                $images = json_decode($images, true);
                                            }
                                            if (!is_array($images)) {
                                                $images = [];
                                            }

                                            $image = !empty($images) && isset($images[0])
                                                ? asset('storage/' . $images[0])
                                                : 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                                        @endphp
                                        <img src="{{ $image }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                        <div class="absolute top-3 left-3">
                                            <span class="px-3 py-1.5 text-xs font-bold rounded-lg shadow-lg
                                                @if($property->type == 'apartment') bg-gradient-to-r from-purple-500 to-pink-500 text-white
                                                @elseif($property->type == 'house') bg-gradient-to-r from-green-500 to-emerald-500 text-white
                                                @elseif($property->type == 'plot') bg-gradient-to-r from-yellow-500 to-amber-500 text-white
                                                @else bg-gradient-to-r from-blue-500 to-cyan-500 text-white
                                                @endif">
                                                <i class="fas
                                                    @if($property->type == 'apartment') fa-building
                                                    @elseif($property->type == 'house') fa-home
                                                    @elseif($property->type == 'plot') fa-tree
                                                    @else fa-key
                                                    @endif mr-1 text-xs"></i>
                                                @if($property->type == 'apartment') Квартира
                                                @elseif($property->type == 'house') Дом
                                                @elseif($property->type == 'plot') Участок
                                                @else Аренда
                                                @endif
                                            </span>
                                        </div>

                                        <div class="absolute top-3 right-3">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-lg backdrop-blur-md {{ $property->is_active ? 'bg-green-500/80 text-white' : 'bg-red-500/80 text-white' }} shadow-lg">
                                                <i class="fas {{ $property->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1 text-xs"></i>
                                                {{ $property->is_active ? 'Активно' : 'Неактивно' }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Информация --}}
                                    <div class="flex-1 p-6">
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-3">
                                            <div class="flex-1">
                                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-1">{{ $property->title }}</h3>
                                                <div class="text-2xl font-bold gradient-text mb-2">{{ number_format($property->price, 0, '.', ' ') }} ₽</div>
                                                <div class="text-gray-500 text-sm mb-2 flex items-center">
                                                    <i class="fas fa-map-marker-alt text-purple-500 mr-1"></i>
                                                    <span class="line-clamp-1">{{ $property->address }}</span>
                                                </div>
                                                <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                                                    <span class="flex items-center"><i class="fas fa-vector-square text-purple-500 mr-1"></i> {{ $property->area }} {{ $property->type == 'plot' ? 'сот.' : 'м²' }}</span>
                                                    @if($property->rooms)
                                                        <span class="flex items-center"><i class="fas fa-door-open text-purple-500 mr-1"></i> {{ $property->rooms }} комн.</span>
                                                    @endif
                                                    @if($property->floor)
                                                        <span class="flex items-center"><i class="fas fa-layer-group text-purple-500 mr-1"></i> {{ $property->floor }} этаж</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="text-right flex-shrink-0">
                                                <p class="text-xs text-gray-400 flex items-center gap-1">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    {{ $property->created_at->format('d.m.Y') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex flex-wrap gap-3 mt-6 pt-4 border-t border-gray-100">
                                            <button onclick="openModal({{ $property->id }})"
                                                    class="flex-1 min-w-[100px] bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl hover:bg-gray-200 hover:shadow-md transition-all duration-300 font-medium flex items-center justify-center gap-2 group/btn">
                                                <i class="fas fa-eye text-gray-500 group-hover/btn:text-purple-600"></i>
                                                Просмотр
                                            </button>
                                            <a href="{{ route('properties.edit', $property->id) }}"
                                               class="flex-1 min-w-[100px] bg-blue-500 text-white px-4 py-2.5 rounded-xl hover:bg-blue-600 hover:shadow-md transition-all duration-300 font-medium flex items-center justify-center gap-2">
                                                <i class="fas fa-edit"></i>
                                                Редактировать
                                            </a>
                                            <button onclick="deleteProperty({{ $property->id }})"
                                                    class="flex-1 min-w-[100px] bg-red-500 text-white px-4 py-2.5 rounded-xl hover:bg-red-600 hover:shadow-md transition-all duration-300 font-medium flex items-center justify-center gap-2">
                                                <i class="fas fa-trash-alt"></i>
                                                Удалить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $properties->links() }}
                    </div>
                @else
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-12 text-center border border-white/50">
                        <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-building text-white text-4xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-700 mb-2">У вас нет созданных объектов</h3>
                        <p class="text-gray-400">Создайте свой первый объект недвижимости</p>
                        <a href="{{ route('properties.create') }}" class="inline-flex items-center gap-2 mt-6 gradient-bg text-white px-8 py-3 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-medium">
                            <i class="fas fa-plus"></i>
                            Создать объект
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Модальное окно для просмотра объекта --}}
<div id="modalOverlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
    <div class="relative bg-white rounded-2xl max-w-5xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <button onclick="closeModal()" class="absolute top-4 right-4 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-100 transition z-10">
            <i class="fas fa-times text-gray-600 text-xl"></i>
        </button>
        <div id="modalContent" class="p-6">
            <div class="flex justify-center items-center py-20">
                <div class="relative">
                    <div class="w-16 h-16 border-4 border-purple-200 rounded-full"></div>
                    <div class="w-16 h-16 border-4 border-purple-600 rounded-full border-t-transparent animate-spin absolute top-0"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
const propertiesData = @json($properties->items());

function openModal(propertyId) {
    const modal = document.getElementById('modalOverlay');
    const modalContent = document.getElementById('modalContent');

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    const property = propertiesData.find(p => p.id === propertyId);

    if (property) {
        renderModalContent(property);
    } else {
        fetch(`/properties/${propertyId}`)
            .then(response => response.json())
            .then(data => renderModalContent(data))
            .catch(error => {
                modalContent.innerHTML = '<div class="text-center py-12 text-red-500">Ошибка загрузки данных</div>';
            });
    }
}

function renderModalContent(property) {
    const modalContent = document.getElementById('modalContent');

    let images = [];
    if (property.images) {
        if (typeof property.images === 'string') {
            try { images = JSON.parse(property.images); } catch(e) { images = []; }
        } else if (Array.isArray(property.images)) {
            images = property.images;
        }
    }

    if (images.length === 0) {
        images = ['https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'];
    }

    const imageUrls = images.map(img => img.startsWith('http') ? img : `/storage/${img}`);

    const agent = property.user;
    const agentName = agent?.name || 'Агентство Меридиан';
    const agentPhone = agent?.phone || '+7 (901) 150-08-79';
    const agentTelegram = agent?.telegram;
    const agentWhatsapp = agent?.whatsapp;
    const agentVk = agent?.vk;
    const agentAvatar = agent?.avatar_url;

    modalContent.innerHTML = `
        <div>
            <div class="mb-6">
                <div class="relative rounded-xl overflow-hidden">
                    <img id="mainImage" src="${imageUrls[0]}" alt="${property.title}" class="w-full h-96 object-cover">
                    ${imageUrls.length > 1 ? `
                        <button onclick="prevImage()" class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-white/90 backdrop-blur rounded-full shadow-lg flex items-center justify-center hover:bg-white transition">
                            <i class="fas fa-chevron-left text-gray-600"></i>
                        </button>
                        <button onclick="nextImage()" class="absolute right-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-white/90 backdrop-blur rounded-full shadow-lg flex items-center justify-center hover:bg-white transition">
                            <i class="fas fa-chevron-right text-gray-600"></i>
                        </button>
                        <div class="flex justify-center mt-4 gap-2">
                            ${imageUrls.map((url, idx) => `
                                <button onclick="setImage(${idx})" class="w-16 h-16 rounded-lg overflow-hidden border-2 ${idx === 0 ? 'border-purple-600' : 'border-transparent'} hover:border-purple-400 transition">
                                    <img src="${url}" class="w-full h-full object-cover">
                                </button>
                            `).join('')}
                        </div>
                    ` : ''}
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">${escapeHtml(property.title)}</h2>
                    <div class="text-3xl font-bold gradient-text mb-4">${new Intl.NumberFormat('ru-RU').format(property.price)} ₽</div>

                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <div class="flex items-center text-gray-700 bg-gray-50 p-3 rounded-xl">
                            <i class="fas fa-map-marker-alt text-purple-500 w-5"></i>
                            <span class="ml-2 text-sm">${escapeHtml(property.address)}</span>
                        </div>
                        <div class="flex items-center text-gray-700 bg-gray-50 p-3 rounded-xl">
                            <i class="fas fa-vector-square text-purple-500 w-5"></i>
                            <span class="ml-2 text-sm">${property.area} м²</span>
                        </div>
                        ${property.rooms ? `
                        <div class="flex items-center text-gray-700 bg-gray-50 p-3 rounded-xl">
                            <i class="fas fa-door-open text-purple-500 w-5"></i>
                            <span class="ml-2 text-sm">${property.rooms} комнат${property.rooms > 1 ? 'ы' : 'а'}</span>
                        </div>
                        ` : ''}
                        ${property.floor ? `
                        <div class="flex items-center text-gray-700 bg-gray-50 p-3 rounded-xl">
                            <i class="fas fa-layer-group text-purple-500 w-5"></i>
                            <span class="ml-2 text-sm">${property.floor} этаж</span>
                        </div>
                        ` : ''}
                        ${property.building_type ? `
                        <div class="flex items-center text-gray-700 bg-gray-50 p-3 rounded-xl">
                            <i class="fas fa-building text-purple-500 w-5"></i>
                            <span class="ml-2 text-sm">${escapeHtml(property.building_type)}</span>
                        </div>
                        ` : ''}
                    </div>

                    <h3 class="text-lg font-semibold mb-3 flex items-center">
                        <i class="fas fa-file-alt text-purple-500 mr-2"></i>
                        Описание
                    </h3>
                    <p class="text-gray-600 leading-relaxed">${escapeHtml(property.description || 'Описание отсутствует')}</p>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-6 sticky top-4 border border-gray-100 shadow-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-user-circle text-purple-500 mr-2"></i>
                            Контакты
                        </h3>

                        <div class="flex items-center mb-4">
                            ${agentAvatar ?
                                `<img src="${agentAvatar}" alt="${escapeHtml(agentName)}" class="w-14 h-14 rounded-full object-cover mr-3 border-2 border-purple-500">` :
                                `<div class="w-14 h-14 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl mr-3">
                                    ${escapeHtml(agentName.charAt(0).toUpperCase())}
                                </div>`
                            }
                            <div>
                                <p class="font-semibold text-gray-900">${escapeHtml(agentName)}</p>
                                <p class="text-sm text-gray-500">Агент по недвижимости</p>
                            </div>
                        </div>

                        ${agentPhone ? `
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-1">Телефон</p>
                            <a href="tel:${agentPhone}" class="text-gray-900 hover:text-purple-600 transition flex items-center">
                                <i class="fas fa-phone mr-2 text-purple-500"></i>
                                ${escapeHtml(agentPhone)}
                            </a>
                        </div>
                        ` : ''}

                        ${agentTelegram ? `
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-1">Telegram</p>
                            <a href="https://t.me/${agentTelegram.replace('@', '')}" target="_blank" class="text-gray-900 hover:text-blue-500 transition flex items-center">
                                <i class="fab fa-telegram mr-2 text-blue-500"></i>
                                @${escapeHtml(agentTelegram.replace('@', ''))}
                            </a>
                        </div>
                        ` : ''}

                        ${agentWhatsapp ? `
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-1">WhatsApp</p>
                            <a href="https://wa.me/${agentWhatsapp.replace(/[^0-9]/g, '')}" target="_blank" class="text-gray-900 hover:text-green-500 transition flex items-center">
                                <i class="fab fa-whatsapp mr-2 text-green-500"></i>
                                ${escapeHtml(agentWhatsapp)}
                            </a>
                        </div>
                        ` : ''}

                        ${agentVk ? `
                        <div class="mb-4">
                            <p class="text-xs text-gray-500 mb-1">ВКонтакте</p>
                            <a href="https://vk.com/${agentVk}" target="_blank" class="text-gray-900 hover:text-blue-600 transition flex items-center">
                                <i class="fab fa-vk mr-2 text-blue-600"></i>
                                ${escapeHtml(agentVk)}
                            </a>
                        </div>
                        ` : ''}
                    </div>
                </div>
            </div>
        </div>
    `;

    window.modalImages = imageUrls;
    window.currentImageIndex = 0;
}

function escapeHtml(str) {
    if (!str) return '';
    return str
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

function setImage(index) {
    if (!window.modalImages) return;
    window.currentImageIndex = index;
    const mainImage = document.getElementById('mainImage');
    if (mainImage) mainImage.src = window.modalImages[index];

    const thumbnails = document.querySelectorAll('.flex.justify-center.mt-4 button');
    thumbnails.forEach((btn, i) => {
        if (i === index) {
            btn.classList.add('border-purple-600');
            btn.classList.remove('border-transparent');
        } else {
            btn.classList.remove('border-purple-600');
            btn.classList.add('border-transparent');
        }
    });
}

function prevImage() {
    if (!window.modalImages) return;
    window.currentImageIndex = (window.currentImageIndex - 1 + window.modalImages.length) % window.modalImages.length;
    setImage(window.currentImageIndex);
}

function nextImage() {
    if (!window.modalImages) return;
    window.currentImageIndex = (window.currentImageIndex + 1) % window.modalImages.length;
    setImage(window.currentImageIndex);
}

function closeModal() {
    const modal = document.getElementById('modalOverlay');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

document.getElementById('modalOverlay')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('modalOverlay');
        if (modal && !modal.classList.contains('hidden')) closeModal();
    }
});

function deleteProperty(id) {
    if (confirm('Вы уверены, что хотите удалить этот объект? Это действие нельзя отменить.')) {
        const form = document.getElementById('deleteForm');
        form.action = `/properties/${id}`;
        form.submit();
    }
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
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.will-change-transform {
    will-change: transform;
}
</style>
@endpush
@endsection
