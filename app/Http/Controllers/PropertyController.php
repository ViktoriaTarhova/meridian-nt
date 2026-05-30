<?php
// app/Http/Controllers/PropertyController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use App\Models\SavedProperty;

class PropertyController extends Controller
{
    /**
     * Страница домов с фильтрацией
     */
    public function houses(Request $request)
{
    $query = Property::where('type', 'house')->where('is_active', true);

    if ($request->filled('rooms')) {
        if ($request->rooms == '4+') {
            $query->where('rooms', '>=', 4);
        } else {
            $query->where('rooms', $request->rooms);
        }
    }

    if ($request->filled('area_from')) {
        $query->where('area', '>=', $request->area_from);
    }

    if ($request->filled('land_area_from')) {
        $query->where('land_area', '>=', $request->land_area_from);
    }

    if ($request->filled('price_to')) {
        $query->where('price', '<=', $request->price_to);
    }

    // Загружаем данные пользователя
    $properties = $query->with('user')->latest()->paginate(12);

    // Добавляем avatar_url для каждого объекта
    foreach ($properties as $property) {
        if ($property->user) {
            $property->user->avatar_url = $property->user->avatar
                ? asset('storage/' . $property->user->avatar)
                : null;
        }
    }

    $favoriteIds = [];
    if (Auth::check()) {
        $favoriteIds = SavedProperty::where('user_id', Auth::id())
            ->pluck('property_id')
            ->toArray();
    }

    return view('properties.houses', compact('properties', 'favoriteIds'));
}

    /**
     * Страница квартир с фильтрацией
     */
    /**
 * Страница квартир с фильтрацией
 */
public function apartments(Request $request)
{
    $query = Property::where('type', 'apartment')->where('is_active', true);

    if ($request->filled('rooms')) {
        if ($request->rooms == '4+') {
            $query->where('rooms', '>=', 4);
        } else {
            $query->where('rooms', $request->rooms);
        }
    }

    if ($request->filled('area_from')) {
        $query->where('area', '>=', $request->area_from);
    }

    if ($request->filled('price_to')) {
        $query->where('price', '<=', $request->price_to);
    }

    // Загружаем данные пользователя
    $properties = $query->with('user')->latest()->paginate(12);

    // Добавляем avatar_url для каждого объекта
    foreach ($properties as $property) {
        if ($property->user) {
            $property->user->avatar_url = $property->user->avatar
                ? asset('storage/' . $property->user->avatar)
                : null;
        }
    }

    $favoriteIds = [];
    if (Auth::check()) {
        $favoriteIds = SavedProperty::where('user_id', Auth::id())
            ->pluck('property_id')
            ->toArray();
    }

    return view('properties.apartments', compact('properties', 'favoriteIds'));
}

    /**
     * Страница участков с фильтрацией
     */
    public function plots(Request $request)
{
    $query = Property::where('type', 'plot')->where('is_active', true);

    if ($request->filled('area_from')) {
        $query->where('area', '>=', $request->area_from);
    }

    if ($request->filled('price_to')) {
        $query->where('price', '<=', $request->price_to);
    }

    // Загружаем данные пользователя
    $properties = $query->with('user')->latest()->paginate(12);

    // Добавляем avatar_url для каждого объекта
    foreach ($properties as $property) {
        if ($property->user) {
            $property->user->avatar_url = $property->user->avatar
                ? asset('storage/' . $property->user->avatar)
                : null;
        }
    }

    $favoriteIds = [];
    if (Auth::check()) {
        $favoriteIds = SavedProperty::where('user_id', Auth::id())
            ->pluck('property_id')
            ->toArray();
    }

    return view('properties.plots', compact('properties', 'favoriteIds'));
}

    /**
     * Страница аренды с фильтрацией
     */
    /**
 * Страница аренды с фильтрацией
 */
public function rent(Request $request)
{
    $query = Property::where('type', 'rent')->where('is_active', true);

    if ($request->filled('rooms')) {
        if ($request->rooms == '4+') {
            $query->where('rooms', '>=', 4);
        } else {
            $query->where('rooms', $request->rooms);
        }
    }

    if ($request->filled('area_from')) {
        $query->where('area', '>=', $request->area_from);
    }

    if ($request->filled('price_to')) {
        $query->where('price', '<=', $request->price_to);
    }

    // Загружаем данные пользователя
    $properties = $query->with('user')->latest()->paginate(24);

    // Добавляем avatar_url для каждого объекта
    foreach ($properties as $property) {
        if ($property->user) {
            $property->user->avatar_url = $property->user->avatar
                ? asset('storage/' . $property->user->avatar)
                : null;
        }
    }

    $favoriteIds = [];
    if (Auth::check()) {
        $favoriteIds = SavedProperty::where('user_id', Auth::id())
            ->pluck('property_id')
            ->toArray();
    }

    return view('properties.rent', compact('properties', 'favoriteIds'));
}

    /**
     * Показать детальную страницу объекта
     */
    public function show($id)
{
    $property = Property::with('user')->findOrFail($id);

    $isFavorite = false;
    if (Auth::check()) {
        $isFavorite = SavedProperty::where('user_id', Auth::id())
            ->where('property_id', $id)
            ->exists();
    }

    if (request()->ajax()) {
        $agent = $property->user;
        return response()->json([
            'id' => $property->id,
            'title' => $property->title,
            'description' => $property->description,
            'address' => $property->address,
            'price' => $property->price,
            'area' => $property->area,
            'rooms' => $property->rooms,
            'floor' => $property->floor,
            'building_type' => $property->building_type,
            'type' => $property->type,
            'images' => $property->images,
            'user' => $agent ? [
                'name' => $agent->name,
                'phone' => $agent->phone,
                'telegram' => $agent->telegram,
                'whatsapp' => $agent->whatsapp,
                'vk' => $agent->vk,
                'avatar' => $agent->avatar,
                'avatar_url' => $agent->avatar ? asset('storage/' . $agent->avatar) : null,
            ] : null
        ]);
    }

    return view('properties.show', compact('property', 'isFavorite'));
}


    /**
     * Показать форму создания объекта
     */
    public function create(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isAdmin() && !Auth::user()->isAgent()) {
            abort(403, 'У вас нет прав на создание объектов. Только агенты и администраторы могут добавлять объекты недвижимости.');
        }

        $type = $request->query('type', 'apartment');
        return view('properties.create', compact('type'));
    }

    /**
     * Сохранить новый объект
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isAdmin() && !Auth::user()->isAgent()) {
            abort(403, 'У вас нет прав на создание объектов. Только агенты и администраторы могут добавлять объекты недвижимости.');
        }

        $type = $request->input('type', 'apartment');

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'area' => 'required|numeric|min:0',
            'type' => 'required|string|in:apartment,house,plot,rent',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'floor' => 'nullable|integer|min:1',
            'building_type' => 'nullable|string|max:100',
            'land_area' => 'nullable|numeric|min:0',
        ];

        if (in_array($type, ['apartment', 'house', 'rent'])) {
            $rules['rooms'] = 'required|integer|min:1';
        }

        $request->validate($rules);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'price' => $request->price,
            'area' => $request->area,
            'floor' => $request->floor,
            'building_type' => $request->building_type,
            'land_area' => $request->land_area,
            'user_id' => Auth::id(),
            'is_active' => true,
            'type' => $type,
            'rooms' => $request->has('rooms') ? $request->rooms : null,
        ];

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $images[] = $path;
            }
            $data['images'] = json_encode($images);
        }

        try {
            Property::create($data);

            $routes = [
                'house' => 'properties.houses',
                'apartment' => 'properties.apartments',
                'plot' => 'properties.plots',
                'rent' => 'properties.rent',
            ];

            $messages = [
                'house' => 'Дом успешно создан!',
                'apartment' => 'Квартира успешно создана!',
                'plot' => 'Участок успешно создан!',
                'rent' => 'Объект аренды успешно создан!',
            ];

            $route = $routes[$type] ?? 'properties.apartments';
            $message = $messages[$type] ?? 'Объект успешно создан!';

            return redirect()->route($route)->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при создании: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Показать форму редактирования
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $property = Property::where('user_id', Auth::id())->findOrFail($id);
        return view('properties.edit', compact('property'));
    }

    /**
     * Обновить объект
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $property = Property::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'area' => 'required|numeric|min:0',
            'rooms' => 'nullable|integer|min:1',
            'floor' => 'nullable|integer',
            'building_type' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
            'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|string',
        ]);

        $data = $request->except(['new_images', 'delete_images']);
        $data['is_active'] = $request->has('is_active');

        $images = $property->images;
        if (is_string($images)) {
            $images = json_decode($images, true);
        }
        if (!is_array($images)) {
            $images = [];
        }

        if ($request->filled('delete_images')) {
            $deleteIndexes = explode(',', $request->delete_images);
            foreach ($deleteIndexes as $index) {
                $index = (int)$index;
                if (isset($images[$index])) {
                    Storage::disk('public')->delete($images[$index]);
                    unset($images[$index]);
                }
            }
            $images = array_values($images);
        }

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $image) {
                $path = $image->store('properties', 'public');
                $images[] = $path;
            }
        }

        $data['images'] = !empty($images) ? json_encode($images) : null;
        $property->update($data);

        return redirect()->route('profile.my-properties')
            ->with('success', 'Объект успешно обновлен!');
    }

    /**
     * Удалить объект
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $property = Property::where('user_id', Auth::id())->findOrFail($id);

        if ($property->images) {
            $images = json_decode($property->images, true);
            if ($images) {
                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        SavedProperty::where('property_id', $id)->delete();
        $property->delete();

        return redirect()->route('profile.my-properties')
            ->with('success', 'Объект успешно удален!');
    }

    /**
     * Добавить/удалить из избранного
     */
    public function toggleFavorite($id)
    {
        try {
            $userId = Auth::id();

            $favorite = SavedProperty::where('user_id', $userId)
                ->where('property_id', $id)
                ->first();

            if ($favorite) {
                $favorite->delete();
                $isFavorite = false;
                $message = 'Удалено из избранного';
            } else {
                SavedProperty::create([
                    'user_id' => $userId,
                    'property_id' => $id
                ]);
                $isFavorite = true;
                $message = 'Добавлено в избранное';
            }

            return response()->json([
                'success' => true,
                'is_favorite' => $isFavorite,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
