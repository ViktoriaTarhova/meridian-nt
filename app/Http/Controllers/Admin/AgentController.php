<?php
// app/Http/Controllers/Admin/AgentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    // Убираем конструктор с middleware

    public function index()
    {
        $agents = User::where('role', 'agent')->latest()->paginate(10);
        return view('admin.agents.index', compact('agents'));
    }

    public function create()
    {
        return view('admin.agents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'agent',
        ]);

        return redirect()->route('admin.agents.index')->with('success', 'Агент успешно создан!');
    }

    public function edit($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        return view('admin.agents.edit', compact('agent'));
    }

    public function update(Request $request, $id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $agent->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $agent->update($request->only('name', 'email', 'phone'));

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $agent->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.agents.index')->with('success', 'Агент обновлен!');
    }

    public function destroy($id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        $agent->delete();

        return redirect()->route('admin.agents.index')->with('success', 'Агент удален!');
    }
}
