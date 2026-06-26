<?php

namespace App\Http\Controllers;

use App\Models\FinancingApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerPortalController extends Controller
{
    public function show(Request $request): View
    {
        $application = null;
        $applicationId = $request->session()->get('customer_financing_id');

        if ($applicationId) {
            $application = FinancingApplication::query()
                ->with('documents')
                ->find($applicationId);
        }

        return view('site.customer-portal', compact('application'));
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cpf' => ['required', 'string', 'max:14'],
            'protocol' => ['required', 'string', 'max:16'],
        ]);

        $application = FinancingApplication::query()
            ->where('cpf', $validated['cpf'])
            ->where('protocol', strtoupper($validated['protocol']))
            ->latest()
            ->first();

        if (! $application) {
            return back()
                ->withErrors(['cpf' => 'CPF ou protocolo não conferem.'])
                ->onlyInput('cpf');
        }

        $request->session()->regenerate();
        $request->session()->put('customer_financing_id', $application->id);

        return redirect()->route('customer.portal');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('customer_financing_id');
        $request->session()->regenerateToken();

        return redirect()->route('customer.portal');
    }
}
