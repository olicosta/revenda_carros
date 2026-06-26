<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomerCommunication;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerCommunicationController extends Controller
{
    public function index(Lead $lead): JsonResponse
    {
        return response()->json([
            'data' => CustomerCommunication::query()
                ->where('lead_id', $lead->id)
                ->latest('sent_at')
                ->get(),
        ]);
    }

    public function store(Request $request, Lead $lead): JsonResponse
    {
        $validated = $request->validate([
            'channel' => ['required', Rule::in(['WhatsApp', 'Telefone', 'E-mail', 'Anotação'])],
            'direction' => ['nullable', Rule::in(['Entrada', 'Saída'])],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $communication = CustomerCommunication::query()->create([
            ...$validated,
            'lead_id' => $lead->id,
            'user_id' => $request->user()->id,
            'direction' => $validated['direction'] ?? 'Saída',
            'sent_at' => now(),
        ]);

        $lead->update(['last_interaction' => $communication->message]);

        return response()->json(['data' => $communication], 201);
    }
}
