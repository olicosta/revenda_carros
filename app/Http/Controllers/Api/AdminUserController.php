<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class AdminUserController extends Controller
{
    private const ROLES = ['gestor', 'vendedor', 'financeiro', 'estoque', 'marketing'];

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => User::query()
                ->select(['id', 'name', 'username', 'email', 'role', 'created_at', 'updated_at'])
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->merge([
            'username' => str($request->input('username', ''))->trim()->lower()->toString(),
            'email' => str($request->input('email', ''))->trim()->lower()->toString(),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in(self::ROLES)],
            'password' => ['required', 'string', $this->passwordRule(), 'confirmed'],
        ], $this->validationMessages());

        $user = User::query()->create($validated);

        return response()->json([
            'data' => $this->publicUser($user),
            'message' => 'Conta criada com sucesso.',
        ], 201);
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $request->merge([
            'username' => str($request->input('username', ''))->trim()->lower()->toString(),
            'email' => str($request->input('email', ''))->trim()->lower()->toString(),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role' => ['required', Rule::in(self::ROLES)],
            'password' => ['nullable', 'string', $this->passwordRule(), 'confirmed'],
        ], $this->validationMessages());

        $this->ensureAtLeastOneGestorRemains($user, $validated['role']);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'data' => $this->publicUser($user->refresh()),
            'message' => 'Conta atualizada com sucesso.',
        ]);
    }

    public function destroy(Request $request, User $user): JsonResponse
    {
        if ($request->user()?->is($user)) {
            throw ValidationException::withMessages([
                'user' => 'Você não pode excluir a própria conta logada.',
            ]);
        }

        $this->ensureAtLeastOneGestorRemains($user, null);

        $user->delete();

        return response()->json([
            'message' => 'Conta removida com sucesso.',
        ]);
    }

    private function ensureAtLeastOneGestorRemains(User $user, ?string $newRole): void
    {
        if ($user->role !== 'gestor' || $newRole === 'gestor') {
            return;
        }

        $otherGestors = User::query()
            ->where('role', 'gestor')
            ->whereKeyNot($user->id)
            ->exists();

        if (! $otherGestors) {
            throw ValidationException::withMessages([
                'role' => 'Mantenha pelo menos uma conta Admin/Gestor ativa.',
            ]);
        }
    }

    private function publicUser(User $user): array
    {
        return $user->only(['id', 'name', 'username', 'email', 'role', 'created_at', 'updated_at']);
    }

    private function validationMessages(): array
    {
        return [
            'name.required' => 'Informe o nome da conta.',
            'username.required' => 'Informe o usuário de login.',
            'username.unique' => 'Este usuário já está cadastrado.',
            'email.required' => 'Informe o e-mail da conta.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'role.required' => 'Selecione o perfil de acesso.',
            'role.in' => 'Selecione um perfil de acesso válido.',
            'password.required' => 'Informe uma senha para a nova conta.',
            'password.min' => 'A senha deve ter pelo menos 10 caracteres.',
            'password.letters' => 'A senha deve conter letras.',
            'password.numbers' => 'A senha deve conter números.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ];
    }

    private function passwordRule(): Rules\Password
    {
        return Rules\Password::min(10)->letters()->numbers();
    }
}
