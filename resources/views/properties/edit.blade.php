{{-- resources/views/properties/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Редактирование объекта')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        {{-- Hero секция --}}
        <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r from-purple-600 to-indigo-600">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 py-8 px-8 text-white">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl md:text-4xl font-bold">Редактирование объекта</h1>
                </div>
                <p class="text-lg opacity-90">Измените информацию об объекте недвижимости</p>
            </div>
        </div>

        {{-- Форма --}}
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-white/50 relative">
            <div class="absolute top-0 left-8 right-8 h-1 gradient-bg rounded-full"></div>

            <form method="POST" action="{{ route('properties.update', $property->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Тип объекта --}}
                <div class="p-4 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center
                            @if($property->type == 'house') bg-green-500
                            @elseif($property->type == 'apartment') bg-purple-500
                            @elseif($property->type == 'plot') bg-yellow-500
                            @else bg-blue-500 @endif">
                            <i class="fas
                                @if($property->type == 'house') fa-home
                                @elseif($property->type == 'apartment') fa-building
                                @elseif($property->type == 'plot') fa-tree
                                @else fa-key @endif text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Тип объекта</p>
                            <p class="font-bold text-lg
                                @if($property->type == 'house') text-green-700
                                @elseif($property->type == 'apartment') text-purple-700
                                @elseif($property->type == 'plot') text-yellow-700
                                @else text-blue-700 @endif">
                                @if($property->type == 'apartment') КВАРТИРА
                                @elseif($property->type == 'house') ДОМ
                                @elseif($property->type == 'plot') ЗЕМЕЛЬНЫЙ УЧАСТОК
                                @else АРЕНДА
                                @endif
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
                               value="{{ old('title', $property->title) }}"
                               required
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90">
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
                               value="{{ old('address', $property->address) }}"
                               required
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90">
                    </div>
                    @error('address')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Цена, площадь, комнаты --}}
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
                                   value="{{ old('price', $property->price) }}"
                                   required
                                   class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90">
                        </div>
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="area" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-arrows-alt text-purple-500 mr-2"></i>
                            {{ $property->type == 'plot' ? 'Площадь (соток)' : 'Площадь (м²)' }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-expand text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                            </div>
                            <input id="area"
                                   type="number"
                                   name="area"
                                   value="{{ old('area', $property->area) }}"
                                   required
                                   class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90">
                        </div>
                        @error('area')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if(in_array($property->type, ['apartment', 'house', 'rent']))
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
                                <option value="1" {{ old('rooms', $property->rooms) == '1' ? 'selected' : '' }}>1 комната</option>
                                <option value="2" {{ old('rooms', $property->rooms) == '2' ? 'selected' : '' }}>2 комнаты</option>
                                <option value="3" {{ old('rooms', $property->rooms) == '3' ? 'selected' : '' }}>3 комнаты</option>
                                <option value="4" {{ old('rooms', $property->rooms) == '4' ? 'selected' : '' }}>4+ комнат</option>
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

                {{-- Дополнительные поля --}}
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
                                   value="{{ old('floor', $property->floor) }}"
                                   class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90">
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
                                <option value="Панельный" {{ old('building_type', $property->building_type) == 'Панельный' ? 'selected' : '' }}>Панельный</option>
                                <option value="Кирпичный" {{ old('building_type', $property->building_type) == 'Кирпичный' ? 'selected' : '' }}>Кирпичный</option>
                                <option value="Монолитный" {{ old('building_type', $property->building_type) == 'Монолитный' ? 'selected' : '' }}>Монолитный</option>
                                <option value="Деревянный" {{ old('building_type', $property->building_type) == 'Деревянный' ? 'selected' : '' }}>Деревянный</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

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
                                  class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90 resize-none">{{ old('description', $property->description) }}</textarea>
                    </div>
                    @error('description')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Фотографии --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-images text-purple-500 mr-2"></i>
                        Фотографии
                    </label>

                    {{-- Существующие фотографии --}}
                    @php
                        $images = $property->images;
                        if (is_string($images)) {
                            $images = json_decode($images, true);
                        }
                        if (!is_array($images)) {
                            $images = [];
                        }
                    @endphp

                    @if(count($images) > 0)
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-600 mb-3 flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                Текущие фотографии:
                            </h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @foreach($images as $index => $img)
                                    <div class="relative group">
                                        <div class="relative rounded-xl overflow-hidden aspect-square bg-gray-100 shadow-md">
                                            <img src="{{ asset('storage/' . $img) }}" alt="Фото {{ $index+1 }}" class="w-full h-full object-cover">
                                            <button type="button" onclick="markImageForDeletion({{ $index }}, this)"
                                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-7 h-7 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200 hover:bg-red-600 shadow-md">
                                                <i class="fas fa-times text-xs"></i>
                                            </button>
                                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-2 opacity-0 group-hover:opacity-100 transition">
                                                <p class="text-white text-xs truncate">Фото {{ $index+1 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="delete_images" id="deleteImages" value="">
                        </div>
                    @endif

                    {{-- Добавление новых фотографий --}}
                    <div id="dropZone"
                         class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-purple-500 transition-all duration-300 cursor-pointer group bg-gray-50/50 hover:bg-purple-50/30">
                        <input type="file" name="new_images[]" id="new_images" multiple accept="image/*" class="hidden">
                        <label for="new_images" class="cursor-pointer block">
                            <div class="w-20 h-20 mx-auto gradient-bg rounded-full flex items-center justify-center mb-4 shadow-lg transform group-hover:scale-110 transition duration-300">
                                <i class="fas fa-cloud-upload-alt text-white text-3xl"></i>
                            </div>
                            <p class="text-gray-600 font-medium">Добавить новые фотографии</p>
                            <p class="text-sm text-gray-400 mt-1">Можно выбрать несколько файлов (PNG, JPG до 2MB)</p>
                        </label>
                    </div>

                    {{-- Предпросмотр новых фотографий --}}
                    <div id="newImagesPreview" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"></div>

                    @error('new_images')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    @error('new_images.*')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Статус --}}
                <div class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $property->is_active) ? 'checked' : '' }}
                               class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded transition">
                        <span class="ml-3 text-sm font-medium text-gray-700">
                            <i class="fas fa-check-circle text-green-500 mr-1"></i>
                            Активно (отображать на сайте)
                        </span>
                    </label>
                </div>

                {{-- Кнопки --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" class="gradient-bg text-white px-8 py-3.5 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 font-semibold flex items-center justify-center gap-2 flex-1">

                        Сохранить изменения
                    </button>
                    <a href="{{ route('profile.my-properties') }}" class="border-2 border-gray-300 text-gray-700 px-8 py-3.5 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 font-medium flex items-center justify-center gap-2">

                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let imagesToDelete = [];

    function markImageForDeletion(index, button) {
        if (confirm('Удалить это фото?')) {
            imagesToDelete.push(index);
            document.getElementById('deleteImages').value = imagesToDelete.join(',');
            const imgDiv = button.closest('.relative');
            imgDiv.style.opacity = '0.4';
            imgDiv.style.pointerEvents = 'none';
            const overlay = document.createElement('div');
            overlay.className = 'absolute inset-0 bg-red-500/50 rounded-xl flex items-center justify-center';
            overlay.innerHTML = '<i class="fas fa-trash text-white text-xl"></i>';
            imgDiv.querySelector('.relative').appendChild(overlay);
        }
    }

    const newImagesInput = document.getElementById('new_images');
    const previewContainer = document.getElementById('newImagesPreview');
    const dropZone = document.getElementById('dropZone');

    newImagesInput.addEventListener('change', function(e) {
        previewContainer.innerHTML = '';
        const files = Array.from(this.files);

        files.forEach((file, index) => {
            if (file.size > 2 * 1024 * 1024) {
                alert(`Файл "${file.name}" слишком большой! Максимальный размер 2MB.`);
                return;
            }
            if (!file.type.match('image.*')) {
                alert(`Файл "${file.name}" не является изображением!`);
                return;
            }

            if (file.type && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'relative group';
                    previewDiv.innerHTML = `
                        <div class="relative rounded-xl overflow-hidden aspect-square bg-gray-100 shadow-md">
                            <img src="${e.target.result}" alt="Предпросмотр" class="w-full h-full object-cover">
                            <button type="button" onclick="removeNewImage(${index})"
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
        });
    });

    window.removeNewImage = function(index) {
        const dt = new DataTransfer();
        const files = Array.from(newImagesInput.files);
        files.splice(index, 1);
        files.forEach(file => dt.items.add(file));
        newImagesInput.files = dt.files;
        const event = new Event('change');
        newImagesInput.dispatchEvent(event);
    };

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-purple-500', 'bg-purple-50/50');
    });

    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-purple-500', 'bg-purple-50/50');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-purple-500', 'bg-purple-50/50');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            newImagesInput.files = files;
            newImagesInput.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush
@endsection
