<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use App\Models\Contremaitre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', ['users' => User::with(['administrateur', 'contremaitre'])->orderBy('name')->paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.form', ['user' => new User(), 'action' => route('users.store'), 'method' => 'POST']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $user = User::create(['name' => $data['name'], 'email' => $data['email'], 'password' => Hash::make($data['password'])]);
        $this->syncRole($user, $data);
        return redirect()->route('users.index')->with('success', 'Utilisateur créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return redirect()->route('users.edit', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load(['administrateur', 'contremaitre']);
        return view('users.form', ['user' => $user, 'action' => route('users.update', $user), 'method' => 'PUT']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $this->validated($request, $user);
        $user->update(array_filter(['name' => $data['name'], 'email' => $data['email'], 'password' => isset($data['password']) ? Hash::make($data['password']) : null]));
        $this->syncRole($user, $data);
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->is(auth()->user())) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        // On supprime d'abord les enregistrements liés (contremaitre/administrateur)
        // pour éviter l'erreur de contrainte de clé étrangère
        Administrateur::whereKey($user->id)->delete();
        Contremaitre::whereKey($user->id)->delete();

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }

    private function validated(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => [$user ? 'nullable' : 'required', 'confirmed', 'min:8'],
            'role' => 'required|in:administrateur,contremaitre',
            'telephone' => 'nullable|required_if:role,contremaitre|string|max:30',
            'niveau_acces' => 'nullable|required_if:role,administrateur|string|max:60',
        ]);
    }

    private function syncRole(User $user, array $data): void
    {
        if ($data['role'] === 'administrateur') {
            Contremaitre::whereKey($user->id)->delete();
            Administrateur::updateOrCreate(['id' => $user->id], ['niveau_acces' => $data['niveau_acces'] ?? 'standard']);
        } else {
            Administrateur::whereKey($user->id)->delete();
            Contremaitre::updateOrCreate(['id' => $user->id], ['telephone' => $data['telephone']]);
        }
    }
}