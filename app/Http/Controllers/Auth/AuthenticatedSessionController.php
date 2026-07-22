<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        }

        $messages = [
            'Cada atendimento bem conduzido aproxima o próximo fechamento.',
            'Venda boa começa com escuta, confiança e velocidade no retorno.',
            'Quem conhece o estoque vende com mais segurança e passa mais valor.',
            'O cliente lembra de quem simplifica a decisão e cumpre o combinado.',
            'Organização no painel hoje vira oportunidade fechada amanhã.',
            'Fotos boas, dados certos e resposta rápida aumentam a chance de venda.',
            'Todo contato merece atenção: a próxima venda pode estar na conversa mais simples.',
            'Consistência no atendimento transforma interesse em chave na mão.',
        ];

        return view('site.login', [
            'motivation' => $messages[array_rand($messages)],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'username' => str($request->input('username', ''))->trim()->lower()->toString(),
        ]);

        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['username' => 'Usuário ou senha inválidos.'])
                ->onlyInput('username');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function updateCredentials(Request $request): JsonResponse
    {
        $request->merge([
            'current_username' => str($request->input('current_username', ''))->trim()->lower()->toString(),
            'username' => str($request->input('username', ''))->trim()->lower()->toString(),
        ]);

        $user = $request->user();
        $validated = $request->validate([
            'current_username' => ['required', 'string'],
            'current_password' => ['required', 'string'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (
            $validated['current_username'] !== $user->username ||
            ! Hash::check($validated['current_password'], $user->password)
        ) {
            return response()->json([
                'message' => 'Usuário ou senha atual inválidos.',
            ], 422);
        }

        $user->update([
            'username' => $validated['username'],
            'password' => $validated['password'],
        ]);

        return response()->json([
            'message' => 'Acesso atualizado com sucesso.',
        ]);
    }
}
