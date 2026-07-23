<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Throwable;

class PasswordResetController extends Controller
{
    public function request(): View
    {
        return view('site.forgot-password');
    }

    public function email(Request $request): RedirectResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        try {
            $status = Password::sendResetLink($request->only('email'));
        } catch (Throwable $exception) {
            Log::error('Falha ao enviar e-mail de recuperação de senha.', [
                'email' => $request->input('email'),
                'exception' => $exception::class,
                'message' => $exception->getMessage(),
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Não foi possível enviar o e-mail agora. Verifique a configuração SMTP do sistema.',
                ]);
        }

        if ($status === Password::RESET_THROTTLED) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Aguarde alguns instantes antes de solicitar um novo link.',
                ]);
        }

        if ($status !== Password::RESET_LINK_SENT && $status !== Password::INVALID_USER) {
            Log::warning('Recuperação de senha retornou status inesperado.', [
                'email' => $request->input('email'),
                'status' => $status,
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Não foi possível iniciar a recuperação. Tente novamente em alguns minutos.',
                ]);
        }

        return back()->with('status', 'Se o e-mail estiver cadastrado, enviaremos o link de recuperação.');
    }

    public function reset(Request $request, string $token): View
    {
        return view('site.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
        ]);

        $status = Password::reset(
            $validated,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', 'Senha redefinida com sucesso.')
            : back()->withErrors(['email' => 'O link é inválido ou expirou.']);
    }
}
