<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSignatureRequest;
use App\Models\LegalPage;
use App\Models\Petition;
use App\Models\Signature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class PetitionController extends Controller
{
    public function show(): View
    {
        $petition = Petition::query()
            ->where('is_active', true)
            ->withCount('signatures')
            ->firstOrFail();

        $recentSignatures = $petition->publicSignatures()
            ->limit(10)
            ->get();

        return view('petition.show', compact('petition', 'recentSignatures'));
    }

    public function sign(StoreSignatureRequest $request): RedirectResponse
    {
        $ipAddress = $request->ip();

        $petition = Petition::query()
            ->where('id', $request->petition_id)
            ->where('is_active', true)
            ->firstOrFail();

        if ($petition->ends_at && now()->greaterThan($petition->ends_at)) {
            return back()
                ->withInput()
                ->with('error', 'Cette pétition est clôturée.');
        }

        if ($ipAddress && $petition->signatures()->where('ip_address', $ipAddress)->exists()) {
            return back()
                ->withInput($request->except('email'))
                ->with('error', 'Une signature a deja ete enregistree depuis cette connexion.');
        }

        Signature::create([
            'petition_id' => $petition->id,
            'first_name' => trim($request->first_name),
            'last_name' => trim($request->last_name),
            'email' => strtolower(trim($request->email)),
            'display_name' => $request->boolean('display_name'),
            'accepted_terms' => true,
            'accepted_data_policy' => true,
            'signed_at' => now(),
            'ip_address' => $ipAddress,
            'user_agent' => substr((string) $request->userAgent(), 0, 1000),
        ]);

        return redirect()
            ->route('petition.show')
            ->with('success', 'Merci ! Votre signature a bien été enregistrée. Ensemble, on fait la différence.');
    }

    public function stats(): JsonResponse
    {
        $petition = Petition::query()
            ->where('is_active', true)
            ->withCount('signatures')
            ->firstOrFail();

        return response()->json([
            'signatures_count' => $petition->signatures_count,
            'progress_percentage' => $petition->progress_percentage,
            'goal_signatures' => $petition->goal_signatures,
            'recent_signatures' => $petition->publicSignatures()
                ->limit(10)
                ->get()
                ->map(fn (Signature $signature): array => [
                    'name' => $signature->public_name,
                    'signed_at' => $signature->signed_at?->diffForHumans(),
                ]),
        ]);
    }

    public function legal(string $slug): View
    {
        $page = LegalPage::where('slug', $slug)->firstOrFail();

        return view('legal.show', compact('page'));
    }
}
