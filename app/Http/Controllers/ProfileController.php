<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'telegram' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'vk' => 'nullable|string|max:255',
        ]);

        $user->update($request->only('name', 'email', 'phone', 'telegram', 'whatsapp', 'vk'));

        return redirect()->route('profile.index')->with('success', 'Профиль успешно обновлен!');
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Аватарка загружена!');
    }

    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = null;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Аватарка удалена!');
    }

    public function changePassword()
{
    $user = Auth::user();
    return view('profile.change-password', compact('user'));
}

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Текущий пароль неверен']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('profile.index')->with('success', 'Пароль изменен!');
    }

    /**
     * Избранное - загружаем данные пользователя (агента) с аватаркой
     */
    public function saved()
{
    $user = Auth::user();

    // Загружаем избранное с данными пользователя (агента)
    $favorites = $user->savedProperties()->with('user')->paginate(24);

    // Добавляем аватарку пользователя в данные
    $user->avatar_url = $user->avatar ? asset('storage/' . $user->avatar) : null;

    return view('profile.saved', compact('favorites', 'user'));
}

    /**
     * Мои объекты - загружаем данные пользователя (агента) с аватаркой
     */
    public function myProperties()
{
    $user = Auth::user();

    if (!$user->isAdmin() && !$user->isAgent()) {
        abort(403, 'У вас нет прав на просмотр этой страницы.');
    }

    // Загружаем объекты с данными пользователя (агента)
    $properties = $user->properties()->with('user')->latest()->paginate(24);

    // Добавляем аватарку пользователя в данные
    $user->avatar_url = $user->avatar ? asset('storage/' . $user->avatar) : null;

    return view('profile.my-properties', compact('properties', 'user'));
}
}
