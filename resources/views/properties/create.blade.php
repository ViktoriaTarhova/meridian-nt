@extends('layouts.app')

@section('title', 'Создание объекта')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        {{-- Hero секция --}}
        <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r from-purple-600 to-indigo-600">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 py-8 px-8 text-white">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl md:text-4xl font-bold">Создание объекта</h1>
                </div>
                <p class="text-lg opacity-90">Заполните информацию о новом объекте недвижимости</p>
            </div>
        </div>

        {{-- Форма --}}
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-white/50 relative">
            <div class="absolute top-0 left-8 right-8 h-1 gradient-bg rounded-full"></div>

            <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data" class="space-y-6" id="propertyForm">
                @csrf

                @php
                    $type = request()->query('type', 'apartment');
                @endphp
                <input type="hidden" name="type" value="{{ $type }}">

                {{-- Бейдж типа объекта --}}
                <div class="mb-6 p-4 rounded-xl
                    {{ $type == 'house' ? 'bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500' : '' }}
                    {{ $type == 'apartment' ? 'bg-gradient-to-r from-purple-50 to-pink-50 border-l-4 border-purple-500' : '' }}
                    {{ $type == 'plot' ? 'bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500' : '' }}
                    {{ $type == 'rent' ? 'bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500' : '' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center
                            {{ $type == 'house' ? 'bg-green-500' : '' }}
                            {{ $type == 'apartment' ? 'bg-purple-500' : '' }}
                            {{ $type == 'plot' ? 'bg-yellow-500' : '' }}
                            {{ $type == 'rent' ? 'bg-blue-500' : '' }}">
                            <i class="fas
                                {{ $type == 'house' ? 'fa-home' : '' }}
                                {{ $type == 'apartment' ? 'fa-building' : '' }}
                                {{ $type == 'plot' ? 'fa-tree' : '' }}
                                {{ $type == 'rent' ? 'fa-key' : '' }} text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Тип создаваемого объекта</p>
                            <p class="font-bold text-lg
                                {{ $type == 'house' ? 'text-green-700' : '' }}
                                {{ $type == 'apartment' ? 'text-purple-700' : '' }}
                                {{ $type == 'plot' ? 'text-yellow-700' : '' }}
                                {{ $type == 'rent' ? 'text-blue-700' : '' }}">
                                {{ $type == 'house' ? 'ДОМ' : ($type == 'apartment' ? 'КВАРТИРА' : ($type == 'plot' ? 'ЗЕМЕЛЬНЫЙ УЧАСТОК' : 'АРЕНДА')) }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Название --}}
                <div class="group">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-purple-500 mr-2"></i>
                        Название объекта <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input id="title"
                               type="text"
                               name="title"
                               value="{{ old('title') }}"
                               required
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="{{ $type == 'house' ? 'Например: Уютный дом с участком' : ($type == 'plot' ? 'Например: Участок в сосновом бору' : 'Например: Уютная квартира в центре') }}">
                    </div>
                    @error('title')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Адрес --}}
                <div class="group">
                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-purple-500 mr-2"></i>
                        Адрес <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-location-dot text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input id="address"
                               type="text"
                               name="address"
                               value="{{ old('address') }}"
                               required
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="г. Нижний Тагил, ул. Ленина, д. 1">
                    </div>
                    @error('address')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Цена, площадь, комнаты в сетке --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="group">
                        <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-ruble-sign text-purple-500 mr-2"></i>
                            Цена (₽) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-wallet text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                            </div>
                            <input id="price"
                                   type="number"
                                   name="price"
                                   value="{{ old('price') }}"
                                   required
                                   class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                                   placeholder="5000000">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="area" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-arrows-alt text-purple-500 mr-2"></i>
                            {{ $type == 'plot' ? 'Площадь (соток)' : 'Площадь (м²)' }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-expand text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                            </div>
                            <input id="area"
                                   type="number"
                                   name="area"
                                   value="{{ old('area') }}"
                                   required
                                   class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                                   placeholder="{{ $type == 'plot' ? '10' : '55' }}">
                        </div>
                        @error('area')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($type != 'plot')
                    <div class="group">
                        <label for="rooms" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-door-open text-purple-500 mr-2"></i>
                            Комнат <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-home text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                            </div>
                            <select id="rooms" name="rooms" required class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90 appearance-none">
                                <option value="">Выберите</option>
                                <option value="1" {{ old('rooms') == '1' ? 'selected' : '' }}>1 комната</option>
                                <option value="2" {{ old('rooms') == '2' ? 'selected' : '' }}>2 комнаты</option>
                                <option value="3" {{ old('rooms') == '3' ? 'selected' : '' }}>3 комнаты</option>
                                <option value="4" {{ old('rooms') == '4' ? 'selected' : '' }}>4+ комнат</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                        @error('rooms')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif
                </div>

                {{-- Площадь участка - только для домов --}}
                @if($type == 'house')
                <div class="group">
                    <label for="land_area" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-tree text-purple-500 mr-2"></i>
                        Площадь участка (соток)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-leaf text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input id="land_area"
                               type="number"
                               name="land_area"
                               value="{{ old('land_area') }}"
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="10">
                    </div>
                </div>
                @endif

                {{-- Этаж и тип дома --}}
                @if($type != 'plot')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="group">
                        <label for="floor" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-layer-group text-purple-500 mr-2"></i>
                            Этаж
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-stairs text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                            </div>
                            <input id="floor"
                                   type="number"
                                   name="floor"
                                   value="{{ old('floor') }}"
                                   class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                                   placeholder="5">
                        </div>
                    </div>

                    <div class="group">
                        <label for="building_type" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-building text-purple-500 mr-2"></i>
                            Тип дома
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-city text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                            </div>
                            <select id="building_type" name="building_type" class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90 appearance-none">
                                <option value="">Выберите</option>
                                <option value="Панельный" {{ old('building_type') == 'Панельный' ? 'selected' : '' }}>Панельный</option>
                                <option value="Кирпичный" {{ old('building_type') == 'Кирпичный' ? 'selected' : '' }}>Кирпичный</option>
                                <option value="Монолитный" {{ old('building_type') == 'Монолитный' ? 'selected' : '' }}>Монолитный</option>
                                <option value="Деревянный" {{ old('building_type') == 'Деревянный' ? 'selected' : '' }}>Деревянный</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Описание --}}
                <div class="group">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-purple-500 mr-2"></i>
                        Описание <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <i class="fas fa-quote-left text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <textarea id="description"
                                  name="description"
                                  rows="5"
                                  required
                                  class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90 resize-none"
                                  placeholder="Подробное описание объекта...">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Загрузка фотографий --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-images text-purple-500 mr-2"></i>
                        Фотографии (можно выбрать несколько)
                    </label>

                    <div id="dropZone"
                         class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-purple-500 transition-all duration-300 cursor-pointer group bg-gray-50/50 hover:bg-purple-50/30">
                        <input type="file" name="images[]" id="images" multiple accept="image/*" class="hidden">
                        <label for="images" class="cursor-pointer block">
                            <div class="w-20 h-20 mx-auto gradient-bg rounded-full flex items-center justify-center mb-4 shadow-lg transform group-hover:scale-110 transition duration-300">
                                <i class="fas fa-cloud-upload-alt text-white text-3xl"></i>
                            </div>
                            <p class="text-gray-600 font-medium">Нажмите для загрузки или перетащите файлы</p>
                            <p class="text-sm text-gray-400 mt-1">Можно выбрать несколько файлов (PNG, JPG до 2MB)</p>
                        </label>
                    </div>

                    <div id="imagePreviewContainer" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"></div>
                    <div id="fileListContainer" class="mt-3 space-y-2"></div>

                    @error('images')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    @error('images.*')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Кнопки --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" class="gradient-bg text-white px-8 py-3.5 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-semibold flex items-center justify-center gap-2 flex-1">

                        Создать
                        @if($type == 'house') дом
                        @elseif($type == 'plot') участок
                        @elseif($type == 'rent') объект аренды
                        @else объект
                        @endif
                    </button>
                    <a href="{{
                        $type == 'house' ? route('properties.houses') :
                        ($type == 'plot' ? route('properties.plots') :
                        ($type == 'rent' ? route('properties.rent') :
                        route('properties.apartments')))
                    }}" class="border-2 border-gray-300 text-gray-700 px-8 py-3.5 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 font-medium flex items-center justify-center gap-2">

                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const fileListContainer = document.getElementById('fileListContainer');
    const dropZone = document.getElementById('dropZone');

    let selectedFiles = [];

    function updatePreview() {
        previewContainer.innerHTML = '';
        fileListContainer.innerHTML = '';

        if (!selectedFiles || selectedFiles.length === 0) {
            previewContainer.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6 bg-gray-50 rounded-xl">Фотографии не выбраны</div>';
            return;
        }

        selectedFiles.forEach((file, index) => {
            if (file.type && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'relative group';
                    previewDiv.innerHTML = `
                        <div class="relative rounded-xl overflow-hidden aspect-square bg-gray-100 shadow-md">
                            <img src="${e.target.result}" alt="Предпросмотр" class="w-full h-full object-cover">
                            <button type="button" onclick="removeFile(${index})"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200 hover:bg-red-600 shadow-md">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-2 opacity-0 group-hover:opacity-100 transition">
                                <p class="text-white text-xs truncate">${file.name}</p>
                            </div>
                        </div>
                    `;
                    previewContainer.appendChild(previewDiv);
                };
                reader.readAsDataURL(file);
            }

            const fileItem = document.createElement('div');
            fileItem.className = 'flex items-center justify-between bg-gray-50 rounded-xl px-4 py-2.5 text-sm border border-gray-200 hover:shadow-md transition';
            fileItem.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                        <i class="fas fa-image text-white text-xs"></i>
                    </div>
                    <div>
                        <span class="text-gray-700 font-medium">${file.name}</span>
                        <span class="text-gray-400 text-xs ml-2">(${(file.size / 1024).toFixed(1)} KB)</span>
                    </div>
                </div>
                <button type="button" onclick="removeFile(${index})" class="text-red-500 hover:text-red-700 transition-colors p-1">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            fileListContainer.appendChild(fileItem);
        });
    }

    function addFiles(newFiles) {
        const filesArray = Array.from(newFiles);
        filesArray.forEach(file => {
            if (file.size > 2 * 1024 * 1024) {
                alert(`Файл "${file.name}" слишком большой! Максимальный размер 2MB.`);
                return;
            }
            if (!file.type.match('image.*')) {
                alert(`Файл "${file.name}" не является изображением!`);
                return;
            }
            const exists = selectedFiles.some(f => f.name === file.name && f.size === file.size);
            if (!exists) {
                selectedFiles.push(file);
            }
        });
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files;
        updatePreview();
    }

    window.removeFile = function(index) {
        selectedFiles.splice(index, 1);
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files;
        updatePreview();
    };

    imageInput.addEventListener('change', function(e) {
        if (this.files && this.files.length > 0) addFiles(this.files);
    });

    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('border-purple-500', 'bg-purple-50/50');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('border-purple-500', 'bg-purple-50/50');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('border-purple-500', 'bg-purple-50/50');
        if (e.dataTransfer.files.length > 0) addFiles(e.dataTransfer.files);
    });

    dropZone.addEventListener('click', function() {
        imageInput.click();
    });
</script>
@endpush
@endsection
