{{-- resources/views/properties/apartments.blade.php --}}
@extends('layouts.app')

@section('title', 'Квартиры')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Hero секция --}}
    <div class="relative rounded-2xl overflow-hidden mb-10 bg-gradient-to-r from-purple-600 to-indigo-600">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative z-10 py-10 px-8 text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-3">Квартиры</h1>
            <p class="text-lg md:text-xl opacity-90">Найдите квартиру своей мечты в лучших районах города</p>
        </div>
    </div>

    {{-- Фильтрация --}}
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 border border-gray-100">
        <form method="GET" action="{{ route('properties.apartments') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2 flex items-center">
                    <i class="fas fa-building mr-2 text-purple-500"></i>
                    Тип
                </label>
                <div class="relative">
                    <select disabled class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50 cursor-not-allowed text-gray-600">
                        <option selected>Квартиры</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2 flex items-center">
                    <i class="fas fa-door-open mr-2 text-purple-500"></i>
                    Комнат
                </label>
                <select name="rooms" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">
                    <option value="">Все</option>
                    <option value="1" {{ request('rooms') == '1' ? 'selected' : '' }}>1 комната</option>
                    <option value="2" {{ request('rooms') == '2' ? 'selected' : '' }}>2 комнаты</option>
                    <option value="3" {{ request('rooms') == '3' ? 'selected' : '' }}>3 комнаты</option>
                    <option value="4+" {{ request('rooms') == '4+' ? 'selected' : '' }}>4+ комнаты</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2 flex items-center">
                    <i class="fas fa-arrows-alt mr-2 text-purple-500"></i>
                    Площадь, м²
                </label>
                <div class="flex gap-2">
                    <input type="number" name="area_from" value="{{ request('area_from') }}" placeholder="От" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2 flex items-center">
                    <i class="fas fa-ruble-sign mr-2 text-purple-500"></i>
                    Стоимость
                </label>
                <input type="number" name="price_to" value="{{ request('price_to') }}" placeholder="До" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full gradient-bg text-white px-6 py-3 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-semibold flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i>
                    Найти
                </button>
            </div>
        </form>
    </div>

    {{-- Кнопка создания объекта (для админов/агентов) --}}
    @auth
        @if(Auth::user()->isAdmin() || Auth::user()->isAgent())
            <div class="mb-6 flex justify-end">
                <a href="{{ route('properties.create', ['type' => 'apartment']) }}"
                   class="gradient-bg text-white px-6 py-3 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-medium flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Создать объект
                </a>
            </div>
        @endif
    @endauth

    {{-- Сетка с объектами --}}
    @if(isset($properties) && $properties->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($properties as $property)
                <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 will-change-transform">
                    <div class="relative h-56 overflow-hidden rounded-t-2xl">
                        @php
                            $images = $property->images ? (is_array($property->images) ? $property->images : json_decode($property->images, true)) : [];
                            $image = !empty($images) && isset($images[0])
                                ? asset('storage/' . $images[0])
                                : 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                        @endphp
                        <img src="{{ $image }}"
                             alt="{{ $property->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                        {{-- Бейдж с ценой --}}
                        <div class="absolute top-3 left-3 gradient-bg text-white px-3 py-1 rounded-lg text-sm font-bold shadow-lg z-10">
                            {{ number_format($property->price, 0, '.', ' ') }} ₽
                        </div>

                        @auth
                            <button onclick="toggleFavorite({{ $property->id }}, this)"
                                    class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:scale-110 transition-all duration-300 z-10">
                                <i class="fas fa-heart {{ isset($favoriteIds) && in_array($property->id, $favoriteIds) ? 'text-red-500' : 'text-gray-400' }} text-xl"></i>
                            </button>
                        @endauth

                        {{-- Бейдж с типом --}}
                        <div class="absolute bottom-3 left-3 bg-black/50 backdrop-blur-sm text-white px-3 py-1 rounded-lg text-xs z-10">
                            <i class="fas fa-building mr-1"></i> Квартира
                        </div>
                    </div>

                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-1">{{ $property->title }}</h3>

                        <div class="flex items-center gap-3 text-gray-500 text-sm mb-3">
                            <div class="flex items-center">
                                <i class="fas fa-vector-square text-purple-500 mr-1"></i>
                                <span>{{ $property->area }} м²</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-door-open text-purple-500 mr-1"></i>
                                <span>{{ $property->rooms }} комн.</span>
                            </div>
                        </div>

                        <div class="text-gray-500 text-sm mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt text-purple-500 mr-1"></i>
                            <span class="line-clamp-1">{{ $property->address }}</span>
                        </div>

                        <button onclick="openModal({{ $property->id }})"
                                class="w-full gradient-bg text-white px-4 py-2.5 rounded-xl hover:shadow-lg transition-all duration-300 font-medium flex items-center justify-center gap-2">
                            <i class="fas fa-eye"></i>
                            Подробнее
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $properties->withQueryString()->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
            <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-building text-white text-4xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-700 mb-2">Квартиры не найдены</h3>
            <p class="text-gray-400">Попробуйте изменить параметры поиска</p>
        </div>
    @endif
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
            {{-- Галерея --}}
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

function toggleFavorite(propertyId, button) {
    if (button.disabled) return;
    button.disabled = true;

    const heartIcon = button.querySelector('i');
    const currentColor = heartIcon.classList.contains('text-red-500') ? 'red' : 'gray';

    heartIcon.className = 'fas fa-spinner fa-pulse text-gray-400 text-xl';

    fetch(`/properties/${propertyId}/favorite`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            heartIcon.className = data.is_favorite ? 'fas fa-heart text-red-500 text-xl' : 'fas fa-heart text-gray-400 text-xl';
            showNotification(data.is_favorite ? 'Добавлено в избранное ❤️' : 'Удалено из избранного 💔');
        } else {
            heartIcon.className = `fas fa-heart ${currentColor === 'red' ? 'text-red-500' : 'text-gray-400'} text-xl`;
            alert('Ошибка: ' + data.message);
        }
    })
    .catch(error => {
        heartIcon.className = `fas fa-heart ${currentColor === 'red' ? 'text-red-500' : 'text-gray-400'} text-xl`;
        alert('Ошибка при добавлении в избранное');
    })
    .finally(() => button.disabled = false);
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed bottom-4 right-4 bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-3 rounded-xl shadow-2xl z-50 animate-fade-in-up flex items-center gap-2';
    notification.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 2000);
}
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
/* Плавная анимация для карточек без артефактов */
.will-change-transform {
    will-change: transform;
}
.rounded-t-2xl {
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
}
</style>
@endpush
@endsection
