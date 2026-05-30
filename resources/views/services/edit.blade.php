{{-- resources/views/services/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Редактировать услугу')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        {{-- Hero секция --}}
        <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-r from-purple-600 to-indigo-600">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="relative z-10 py-8 px-8 text-white">
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-3xl md:text-4xl font-bold">Редактирование услуги</h1>
                </div>
                <p class="text-lg opacity-90">Измените информацию об услуге</p>
            </div>
        </div>

        {{-- Форма --}}
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-white/50 relative">
            <div class="absolute top-0 left-8 right-8 h-1 gradient-bg rounded-full"></div>



            <form method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Название --}}
                <div class="group">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-tag text-purple-500 mr-2"></i>
                        Название услуги <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-star text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input id="title"
                               type="text"
                               name="title"
                               value="{{ old('title', $service->title) }}"
                               required
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="Например: Оценка недвижимости">
                    </div>
                    @error('title')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
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
                                  class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90 resize-none"
                                  placeholder="Подробное описание услуги...">{{ old('description', $service->description) }}</textarea>
                    </div>
                    @error('description')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Цена --}}
                <div class="group">
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-ruble-sign text-purple-500 mr-2"></i>
                        Стоимость <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-wallet text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <input id="price"
                               type="number"
                               name="price"
                               value="{{ old('price', $service->price) }}"
                               required
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300 bg-white/90"
                               placeholder="5000">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-400">₽</span>
                        </div>
                    </div>
                    @error('price')
                        <p class="text-red-500 text-xs mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Иконка --}}


                {{-- Изображение --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-image text-purple-500 mr-2"></i>
                        Изображение
                    </label>

                    @if($service->image)
                        <div class="mb-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <p class="text-xs text-gray-500 mb-2">Текущее изображение:</p>
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/' . $service->image) }}"
                                     alt="Текущее изображение"
                                     class="w-32 h-32 object-cover rounded-xl shadow-md border-2 border-purple-200">
                            </div>
                        </div>
                    @endif

                    <div id="dropZone"
                         class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-purple-500 transition-all duration-300 cursor-pointer group bg-gray-50/50 hover:bg-purple-50/30">
                        <input type="file" name="image" id="image" accept="image/*" class="hidden">
                        <label for="image" class="cursor-pointer block">
                            <div class="w-20 h-20 mx-auto gradient-bg rounded-full flex items-center justify-center mb-4 shadow-lg transform group-hover:scale-110 transition duration-300">
                                <i class="fas fa-cloud-upload-alt text-white text-3xl"></i>
                            </div>
                            <p class="text-gray-600 font-medium">{{ $service->image ? 'Заменить изображение' : 'Нажмите для загрузки изображения' }}</p>
                            <p class="text-sm text-gray-400 mt-1">PNG, JPG до 2MB</p>
                        </label>
                    </div>

                    <div id="imagePreview" class="mt-4 hidden">
                        <div class="relative inline-block">
                            <img id="previewImg" src="#" alt="Предпросмотр" class="w-32 h-32 object-cover rounded-xl shadow-lg border-2 border-purple-500">
                            <button type="button" onclick="removePreview()" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white text-xs hover:bg-red-600 transition shadow-md">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    @error('image')
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
                               {{ old('is_active', $service->is_active) ? 'checked' : '' }}
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
                    <a href="{{ route('services') }}" class="border-2 border-gray-300 text-gray-700 px-8 py-3.5 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 font-medium flex items-center justify-center gap-2">

                        Отмена
                    </a>
                </div>
            </form>
        </div>

       
    </div>
</div>

@push('scripts')
<script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const dropZone = document.getElementById('dropZone');

    imageInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];

            // Проверка размера файла (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Файл слишком большой! Максимальный размер 2MB.');
                this.value = '';
                return;
            }

            // Проверка типа файла
            if (!file.type.match('image.*')) {
                alert('Пожалуйста, загрузите изображение (PNG, JPG)');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
                previewImg.classList.add('animate-fade-in');
                setTimeout(() => {
                    previewImg.classList.remove('animate-fade-in');
                }, 300);
            };
            reader.readAsDataURL(file);
        }
    });

    dropZone.addEventListener('click', function() {
        imageInput.click();
    });

    // Drag & Drop
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('border-purple-500', 'bg-purple-50/50');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-purple-500', 'bg-purple-50/50');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-purple-500', 'bg-purple-50/50');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            const event = new Event('change');
            imageInput.dispatchEvent(event);
        }
    });

    function removePreview() {
        imageInput.value = '';
        imagePreview.classList.add('hidden');
        previewImg.src = '';
    }
</script>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>
@endpush
@endsection
