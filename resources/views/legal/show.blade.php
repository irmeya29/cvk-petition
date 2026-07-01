@extends('layouts.app')

@push('head')
<style>
.legal-hero {
    background: var(--navy);
    color: var(--white);
    padding: 72px 0 80px;
    position: relative;
    overflow: hidden;
}
.legal-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.05) 1px, transparent 1px);
    background-size: 24px 24px;
    pointer-events: none;
}
.legal-blob {
    position: absolute;
    width: 600px; height: 600px;
    border-radius: 50%;
    filter: blur(90px);
    opacity: .35;
    top: -200px; right: -100px;
    background: radial-gradient(circle, #1668C4 0%, transparent 70%);
    pointer-events: none;
}
.legal-hero-inner { position: relative; z-index: 1; }
.legal-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 700;
    color: rgba(255,255,255,.6);
    margin-bottom: 24px;
    transition: color .2s;
}
.legal-back:hover { color: rgba(255,255,255,.95); }
.legal-eyebrow {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--gold);
    margin-bottom: 14px;
}
.legal-h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(32px, 5vw, 58px);
    font-weight: 800;
    line-height: 1.05;
    letter-spacing: -1px;
    max-width: 760px;
}
.legal-updated {
    margin-top: 18px;
    font-size: 13px;
    color: rgba(255,255,255,.44);
    font-weight: 500;
}

.legal-body {
    padding: 64px 0 0;
}
.legal-card {
    max-width: 860px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 48px;
    box-shadow: var(--shadow);
    font-size: 16.5px;
    color: #334B5D;
    line-height: 1.85;
    white-space: pre-line;
}

.legal-footer {
    max-width: 860px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid var(--border);
    font-size: 13px;
    color: var(--muted);
}
.legal-footer a {
    color: var(--blue2);
    font-weight: 700;
    text-decoration: underline;
    text-underline-offset: 2px;
}

@media (max-width: 640px) {
    .legal-card { padding: 28px 20px; }
    .legal-hero { padding: 52px 0 60px; }
}
</style>
@endpush

@section('content')

<section class="legal-hero">
    <div class="legal-blob"></div>
    <div class="wrap legal-hero-inner">
        <a class="legal-back" href="{{ route('petition.show') }}"><i data-lucide="arrow-left" width="15" height="15"></i> Retour à la pétition</a>
        <div class="legal-eyebrow">Mentions légales</div>
        <h1 class="legal-h1">{{ $page->title }}</h1>
        <p class="legal-updated">Pétition officielle CVK — Tous droits réservés</p>
    </div>
</section>

<section class="legal-body">
    <div class="wrap">
        <article class="legal-card">{{ $page->content }}</article>

        <div class="legal-footer">
            <span>© {{ date('Y') }} CVK. Pétition officielle.</span>
            <div style="display:flex;gap:20px;">
                <a href="{{ route('legal.show', 'conditions-utilisation') }}">Conditions d'utilisation</a>
                <a href="{{ route('legal.show', 'politique-utilisation-donnees') }}">Politique des données</a>
            </div>
        </div>
    </div>
</section>

@endsection
