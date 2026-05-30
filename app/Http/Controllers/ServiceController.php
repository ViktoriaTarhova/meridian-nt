<?php
// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Страница услуг (доступна всем)
     */
    public function index()
    {
        $services = Service::where('is_active', true)->latest()->paginate(9);
        return view('services.index', compact('services'));
    }

    /**
     * Показать форму создания услуги (только для админов)
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isAdmin()) {
            abort(403, 'У вас нет прав на создание услуг. Только администраторы могут добавлять услуги.');
        }

        return view('services.create');
    }

    /**
     * Сохранить новую услугу (только для админов)
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isAdmin()) {
            abort(403, 'У вас нет прав на создание услуг.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['is_active'] = true;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $data['image'] = $path;
        }

        Service::create($data);

        return redirect()->route('services')->with('success', 'Услуга успешно добавлена!');
    }

    /**
     * Показать форму редактирования услуги (только для админов)
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isAdmin()) {
            abort(403, 'У вас нет прав на редактирование услуг.');
        }

        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    /**
     * Обновить услугу (только для админов)
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isAdmin()) {
            abort(403, 'У вас нет прав на редактирование услуг.');
        }

        $service = Service::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except(['image']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $path = $request->file('image')->store('services', 'public');
            $data['image'] = $path;
        }

        $service->update($data);

        return redirect()->route('services')->with('success', 'Услуга успешно обновлена!');
    }

    /**
     * Удалить услугу (только для админов)
     */
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->isAdmin()) {
            abort(403, 'У вас нет прав на удаление услуг.');
        }

        $service = Service::findOrFail($id);

        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('services')->with('success', 'Услуга успешно удалена!');
    }
}
