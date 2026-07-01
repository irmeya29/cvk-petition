@extends('layouts.app')

@push('head')
<style>
/* ════════════════════════════════════════
   TOKENS & RESET
════════════════════════════════════════ */
.sr-only { position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0); }

/* ════════════════════════════════════════
   HERO
════════════════════════════════════════ */
.hero {
    position: relative;
    overflow: hidden;
    background: var(--navy);
    color: var(--white);
    padding-bottom: 120px;
}

/* Mesh gradient blobs */
.hero-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: .45;
    pointer-events: none;
}
.hero-blob-1 {
    width: 700px; height: 700px;
    top: -200px; right: -120px;
    background: radial-gradient(circle, #1668C4 0%, transparent 70%);
}
.hero-blob-2 {
    width: 500px; height: 500px;
    bottom: -100px; left: -60px;
    background: radial-gradient(circle, #FECA0A22 0%, transparent 70%);
}
.hero-blob-3 {
    width: 360px; height: 360px;
    top: 40%; left: 38%;
    background: radial-gradient(circle, #0E8FA033 0%, transparent 70%);
}

/* Subtle dot grid */
.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
}

.hero-inner {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 52px;
    align-items: center;
    padding-top: 80px;
}

/* ── LEFT COL ── */
.hero-left {}


.hero-h1 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(36px, 5.5vw, 68px);
    font-weight: 800;
    line-height: 1.0;
    letter-spacing: -1.5px;
    margin-bottom: 22px;
}
.hero-h1 span {
    background: linear-gradient(90deg, var(--gold) 0%, #FF9D00 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-sub {
    font-size: clamp(16px, 1.8vw, 20px);
    color: rgba(255,255,255,.68);
    line-height: 1.65;
    max-width: 560px;
    margin-bottom: 36px;
}

/* Progress counter block */
.counter-block {
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 20px;
    padding: 28px 28px 24px;
    backdrop-filter: blur(16px);
    max-width: 540px;
    margin-bottom: 32px;
}
.counter-stats {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 16px;
    margin-bottom: 18px;
}
.counter-main {}
.counter-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .8px;
    color: rgba(255,255,255,.48);
    margin-bottom: 4px;
}
.counter-number {
    font-family: 'Sora', sans-serif;
    font-size: clamp(44px, 7vw, 72px);
    font-weight: 800;
    line-height: 1;
    letter-spacing: -2px;
    color: var(--white);
}
.counter-goal {
    text-align: right;
}
.counter-goal-label {
    font-size: 12px;
    font-weight: 600;
    color: rgba(255,255,255,.4);
    text-transform: uppercase;
    letter-spacing: .7px;
}
.counter-goal-val {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: rgba(255,255,255,.72);
}
.counter-pct {
    font-size: 13px;
    font-weight: 700;
    color: var(--gold);
}

/* Progress bar */
.progress-wrap {
    position: relative;
    height: 10px;
    background: rgba(255,255,255,.12);
    border-radius: 999px;
    overflow: hidden;
}
.progress-bar {
    height: 100%;
    border-radius: inherit;
    background: linear-gradient(90deg, var(--gold) 0%, #FF9D00 100%);
    transition: width 1.2s cubic-bezier(.16,1,.3,1);
    position: relative;
}
.progress-bar::after {
    content: '';
    position: absolute;
    right: 0; top: 50%;
    transform: translateY(-50%);
    width: 18px; height: 18px;
    border-radius: 50%;
    background: var(--gold2);
    box-shadow: 0 0 0 4px rgba(254,202,10,.25);
}

.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}
.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    height: 56px;
    padding: 0 28px;
    border-radius: 14px;
    background: var(--gold);
    color: var(--navy);
    font-weight: 800;
    font-size: 16px;
    font-family: 'Sora', sans-serif;
    cursor: pointer;
    transition: background .2s, transform .2s, box-shadow .2s;
    text-decoration: none;
}
.btn-primary:hover {
    background: var(--gold2);
    transform: translateY(-2px);
    box-shadow: 0 16px 40px rgba(254,202,10,.38);
}

/* ── RIGHT COL — FORM CARD ── */
.form-card {
    background: var(--white);
    border-radius: 24px;
    padding: 36px 32px;
    box-shadow: 0 32px 80px rgba(8,25,42,.38), 0 0 0 1px rgba(255,255,255,.04);
    position: sticky;
    top: 84px;
}
.form-card-header {
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border);
}
.form-card-title {
    font-family: 'Sora', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: var(--ink);
    margin-bottom: 6px;
}
.form-card-sub {
    font-size: 14px;
    color: var(--muted);
    line-height: 1.5;
}

/* Alerts */
.alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 16px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 20px;
    line-height: 1.5;
}
.alert-icon {
    font-size: 18px;
    flex-shrink: 0;
    margin-top: 1px;
}
.alert-success { background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; }
.alert-error   { background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }

/* Form fields */
.fields-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.field { margin-bottom: 14px; }
.field-label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    color: #374151;
    margin-bottom: 7px;
    letter-spacing: .1px;
}
.field-input {
    width: 100%;
    height: 48px;
    padding: 0 14px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    font-size: 15px;
    color: var(--ink);
    font-family: 'Inter', sans-serif;
    background: var(--white);
    outline: none;
    transition: border-color .2s, box-shadow .2s;
}
.field-input:focus {
    border-color: var(--blue2);
    box-shadow: 0 0 0 4px rgba(22,104,196,.12);
}
.field-input.is-error { border-color: var(--red); }
.field-error {
    font-size: 12px;
    font-weight: 600;
    color: var(--red);
    margin-top: 5px;
}

/* Checkboxes */
.check-group { margin: 8px 0; }
.check-label {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    cursor: pointer;
    font-size: 13.5px;
    color: #4B5563;
    line-height: 1.55;
    padding: 4px 0;
}
.check-label input[type="checkbox"] {
    flex-shrink: 0;
    width: 18px; height: 18px;
    margin-top: 2px;
    border-radius: 5px;
    accent-color: var(--blue);
    cursor: pointer;
}
.check-label a {
    color: var(--blue2);
    font-weight: 700;
    text-decoration: underline;
    text-underline-offset: 2px;
}
.check-label a:hover { color: var(--blue); }

/* Submit */
.btn-submit {
    width: 100%;
    height: 56px;
    border: none;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--blue) 0%, var(--blue2) 100%);
    color: var(--white);
    font-family: 'Sora', sans-serif;
    font-size: 16px;
    font-weight: 800;
    cursor: pointer;
    margin-top: 20px;
    transition: opacity .2s, transform .2s, box-shadow .2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.btn-submit:hover {
    opacity: .92;
    transform: translateY(-2px);
    box-shadow: 0 16px 40px rgba(16,84,160,.38);
}
.btn-submit:active { transform: translateY(0); }

.form-secure {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 12px;
    color: var(--muted);
    font-weight: 500;
    margin-top: 14px;
}

/* ════════════════════════════════════════
   WHY SECTION
════════════════════════════════════════ */
.section-why {
    padding: 96px 0 0;
}
.section-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 32px;
    align-items: start;
}

/* Section label */
.section-label {
    display: inline-flex;
    align-items: center;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--blue2);
    margin-bottom: 16px;
}
.section-h2 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(26px, 3.5vw, 40px);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -.8px;
    color: var(--ink);
    margin-bottom: 28px;
}

/* Content card */
.content-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 36px;
    box-shadow: var(--shadow);
}
.petition-body {
    font-size: 17px;
    color: #334B5D;
    line-height: 1.85;
    white-space: pre-line;
}


/* Target block */
.target-block {
    display: flex;
    gap: 12px;
    background: #F8FAFC;
    border: 1px solid var(--border);
    border-left: 4px solid var(--blue2);
    border-radius: 12px;
    padding: 18px 20px;
    margin-top: 28px;
    align-items: flex-start;
    box-shadow: none;
}
.target-icon { flex-shrink: 0; margin-top: 2px; line-height: 1; color: var(--blue2); }
.target-label {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .8px;
    color: #64748B;
    margin-bottom: 4px;
}
.target-name { font-size: 16px; font-weight: 700; color: var(--ink); line-height: 1.45; }
.target-note {
    margin-top: 6px;
    font-size: 13px;
    color: var(--muted);
    line-height: 1.55;
}

/* ── SIGNATURES SIDEBAR ── */
.sig-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 28px;
    box-shadow: var(--shadow);
    position: sticky;
    top: 84px;
}
.sig-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border);
}
.sig-card-title {
    font-family: 'Sora', sans-serif;
    font-size: 17px;
    font-weight: 800;
    color: var(--ink);
}
.sig-card-count {
    font-size: 13px;
    font-weight: 700;
    color: var(--blue2);
    background: #EFF6FF;
    border-radius: 999px;
    padding: 3px 10px;
}

.sig-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 0;
    border-bottom: 1px solid #F1F5F9;
}
.sig-item:last-child { border-bottom: none; }
.sig-avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--blue) 0%, var(--teal) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Sora', sans-serif;
    font-weight: 700;
    font-size: 14px;
    color: var(--white);
    flex-shrink: 0;
}
.sig-info {}
.sig-name {
    font-size: 14px;
    font-weight: 700;
    color: var(--ink);
    line-height: 1.3;
}
.sig-time {
    font-size: 12px;
    color: var(--muted);
    font-weight: 500;
}
.sig-empty {
    text-align: center;
    padding: 32px 0;
    color: var(--muted);
    font-size: 14px;
    line-height: 1.6;
}
.sig-empty-icon { margin-bottom: 12px; color: var(--muted); line-height: 1; }

/* ════════════════════════════════════════
   SHARE SECTION
════════════════════════════════════════ */
.section-share {
    padding: 72px 0 0;
}
.share-card {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
    border-radius: 24px;
    padding: 48px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
    flex-wrap: wrap;
    position: relative;
    overflow: hidden;
}
.share-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 22px 22px;
}
.share-blob {
    position: absolute;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, #1668C433 0%, transparent 70%);
    top: -150px; right: -80px;
    pointer-events: none;
}
.share-left { position: relative; z-index: 1; }
.share-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--gold);
    margin-bottom: 10px;
}
.share-h2 {
    font-family: 'Sora', sans-serif;
    font-size: clamp(24px, 3vw, 34px);
    font-weight: 800;
    color: var(--white);
    line-height: 1.1;
    letter-spacing: -.5px;
}
.share-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    position: relative;
    z-index: 1;
}
.share-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 48px;
    padding: 0 20px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: transform .2s, opacity .2s;
}
.share-btn:hover { transform: translateY(-2px); opacity: .92; }
.share-wa  { background: #25D366; color: var(--white); }
.share-fb  { background: #1877F2; color: var(--white); }
.share-tw  { background: #000000; color: var(--white); }
.share-li  { background: #0A66C2; color: var(--white); }
.share-cp  {
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.2);
    color: var(--white);
    cursor: pointer;
    font-family: inherit;
    border: none;
}

/* ════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════ */
@media (max-width: 1024px) {
    .hero-inner  { grid-template-columns: 1fr; }
    .form-card   { max-width: 560px; position: static; }
    .section-grid { grid-template-columns: 1fr; }
    .sig-card    { position: static; }
}
@media (max-width: 640px) {
    .hero-inner     { padding-top: 48px; }
    .hero           { padding-bottom: 72px; }
    .fields-row     { grid-template-columns: 1fr; }
    .stats-row      { grid-template-columns: 1fr 1fr; }
    .content-card   { padding: 24px 20px; }
    .share-card     { padding: 32px 24px; }
    .share-buttons  { gap: 8px; }
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════
     HERO
═══════════════════════════════════ --}}
<section class="hero" aria-labelledby="hero-title">
    <div class="hero-blob hero-blob-1"></div>
    <div class="hero-blob hero-blob-2"></div>
    <div class="hero-blob hero-blob-3"></div>

    <div class="wrap hero-inner">

        {{-- LEFT --}}
        <div class="hero-left">
            <h1 class="hero-h1" id="hero-title">
                Pour le retour<br>de <span>CVK</span><br>sur CANAL+
            </h1>

            @if($petition->subtitle)
                <p class="hero-sub">{{ $petition->subtitle }}</p>
            @endif

            <div class="counter-block" aria-live="polite" aria-atomic="true">
                <div class="counter-stats">
                    <div class="counter-main">
                        <div class="counter-label">Signatures collectées</div>
                        <div class="counter-number" id="live-count" data-count="{{ $petition->signatures_count }}">
                            {{ number_format($petition->signatures_count, 0, ',', ' ') }}
                        </div>
                    </div>
                    <div class="counter-goal">
                        <div class="counter-goal-label">Objectif</div>
                        <div class="counter-goal-val" id="goal-val">{{ number_format($petition->goal_signatures, 0, ',', ' ') }}</div>
                        <div class="counter-pct" id="pct-val">{{ $petition->progress_percentage }}%</div>
                    </div>
                </div>
                <div class="progress-wrap">
                    <div class="progress-bar" id="progress-bar" style="width: {{ $petition->progress_percentage }}%"></div>
                </div>
            </div>

            <div class="hero-actions">
                <a class="btn-primary" href="#signer">
                    <i data-lucide="pencil-line" width="18" height="18"></i> Je signe la pétition
                </a>
            </div>
        </div>

        {{-- RIGHT — FORM CARD --}}
        <div class="form-card" id="signer">
            <div class="form-card-header">
                <div class="form-card-title">Signer la pétition</div>
                <div class="form-card-sub">Une voix par adresse e-mail. Les doublons sont automatiquement bloqués.</div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <span class="alert-icon"><i data-lucide="check-circle-2" width="18" height="18"></i></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <span class="alert-icon"><i data-lucide="alert-triangle" width="18" height="18"></i></span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('petition.sign') }}" novalidate>
                @csrf
                <input type="hidden" name="petition_id" value="{{ $petition->id }}">

                <div class="fields-row">
                    <div class="field">
                        <label class="field-label" for="first_name">Prénom</label>
                        <input
                            class="field-input {{ $errors->has('first_name') ? 'is-error' : '' }}"
                            id="first_name" type="text" name="first_name"
                            value="{{ old('first_name') }}"
                            autocomplete="given-name"
                            placeholder="Awa"
                            required>
                        @error('first_name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="field-label" for="last_name">Nom</label>
                        <input
                            class="field-input {{ $errors->has('last_name') ? 'is-error' : '' }}"
                            id="last_name" type="text" name="last_name"
                            value="{{ old('last_name') }}"
                            autocomplete="family-name"
                            placeholder="Ouédraogo"
                            required>
                        @error('last_name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label class="field-label" for="email">Adresse e-mail</label>
                    <input
                        class="field-input {{ $errors->has('email') ? 'is-error' : '' }}"
                        id="email" type="email" name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        placeholder="awa.ouedraogo@email.com"
                        required>
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="check-group">
                    <label class="check-label">
                        <input type="checkbox" name="display_name" value="1" {{ old('display_name', true) ? 'checked' : '' }}>
                        <span>Afficher mon nom publiquement dans la liste des signatures</span>
                    </label>
                </div>

                <div class="check-group">
                    <label class="check-label">
                        <input type="checkbox" name="accepted_terms" value="1" required>
                        <span>J'accepte les <a href="{{ route('legal.show', 'conditions-utilisation') }}" target="_blank">conditions d'utilisation</a></span>
                    </label>
                    @error('accepted_terms')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="check-group">
                    <label class="check-label">
                        <input type="checkbox" name="accepted_data_policy" value="1" required>
                        <span>J'accepte la <a href="{{ route('legal.show', 'politique-utilisation-donnees') }}" target="_blank">politique d'utilisation des données</a> de CVK</span>
                    </label>
                    @error('accepted_data_policy')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn-submit" type="submit">
                    <i data-lucide="pencil-line" width="18" height="18"></i> Signer officiellement
                </button>
            </form>

            <div class="form-secure">
                <i data-lucide="lock" width="13" height="13"></i> Formulaire sécurisé — données protégées
            </div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════
     WHY + SIGNATURES
═══════════════════════════════════ --}}
<section class="section-why" id="pourquoi" aria-labelledby="why-title">
    <div class="wrap section-grid">

        <div class="content-card">
            <div class="section-label">La pétition</div>
            <h2 class="section-h2" id="why-title">Une demande claire,<br>publique et respectueuse.</h2>

            <div class="petition-body">{{ $petition->description }}</div>


            @if($petition->target_text)
                <div class="target-block">
                    <div class="target-icon"><i data-lucide="send" width="21" height="21"></i></div>
                    <div>
                        <div class="target-label">Demande adressée à</div>
                        <div class="target-name">{{ $petition->target_text }}</div>
                        <div class="target-note">La pétition reste une démarche publique, respectueuse et centrée sur le retour de CVK dans les offres concernées.</div>
                    </div>
                </div>
            @endif
        </div>

        <aside class="sig-card" id="signatures" aria-label="Dernières signatures">
            <div class="sig-card-header">
                <div class="sig-card-title">Dernières signatures</div>
                <div class="sig-card-count" id="sig-count">{{ $petition->signatures_count }}</div>
            </div>

            <div id="recent-signatures">
                @forelse($recentSignatures as $signature)
                    @php
                        $parts = explode(' ', $signature->public_name);
                        $initials = strtoupper(mb_substr($parts[0] ?? '?', 0, 1) . mb_substr($parts[1] ?? '', 0, 1));
                        $colors = ['#1054A0','#0E8FA0','#7C3AED','#DC2626','#059669','#D97706'];
                        $color = $colors[crc32($signature->public_name) % count($colors)];
                    @endphp
                    <div class="sig-item">
                        <div class="sig-avatar" style="background: linear-gradient(135deg, {{ $color }}cc, {{ $color }})">
                            {{ $initials }}
                        </div>
                        <div class="sig-info">
                            <div class="sig-name">{{ $signature->public_name }}</div>
                            <div class="sig-time">{{ $signature->signed_at?->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <div class="sig-empty">
                        <div class="sig-empty-icon"><i data-lucide="feather" width="36" height="36"></i></div>
                        Aucune signature publique pour l'instant.<br>Soyez parmi les premiers à soutenir CVK.
                    </div>
                @endforelse
            </div>
        </aside>

    </div>
</section>

{{-- ═══════════════════════════════════
     SHARE
═══════════════════════════════════ --}}
<section class="section-share">
    <div class="wrap">
        <div class="share-card">
            <div class="share-blob"></div>
            <div class="share-left">
                <div class="share-label">Partagez la pétition</div>
                <h2 class="share-h2">Faites passer le mot.<br>Chaque partage compte.</h2>
            </div>
            <div class="share-buttons">
                @php
                    $url = urlencode(route('petition.show'));
                    $text = urlencode('Je viens de signer la pétition pour le retour de CVK sur CANAL+ ! Rejoignez le mouvement 👇');
                @endphp
                <a class="share-btn share-wa"
                   href="https://wa.me/?text={{ $text }}%20{{ $url }}"
                   target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="17" height="17" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp
                </a>
                <a class="share-btn share-fb"
                   href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"
                   target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="17" height="17" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Facebook
                </a>
                <a class="share-btn share-tw"
                   href="https://x.com/intent/tweet?text={{ $text }}&url={{ $url }}"
                   target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="17" height="17" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.213 5.567zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    Twitter / X
                </a>
                <button class="share-btn share-cp" onclick="copyLink(this)" data-url="{{ route('petition.show') }}">
                    <i data-lucide="link-2" width="16" height="16"></i> Copier le lien
                </button>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    'use strict';

    const liveCountEl = document.getElementById('live-count');
    const progressEl  = document.getElementById('progress-bar');
    const pctEl       = document.getElementById('pct-val');
    const goalEl      = document.getElementById('goal-val');
    const sigCountEl  = document.getElementById('sig-count');
    const recentEl    = document.getElementById('recent-signatures');

    let currentCount = Number(liveCountEl?.dataset.count ?? 0);

    const fmt = (n) => new Intl.NumberFormat('fr-FR').format(n);

    function animateCount(target) {
        const start = currentCount;
        const diff  = target - start;
        if (diff === 0) return;

        const startTime = performance.now();
        const duration  = 800;

        function tick(now) {
            const t = Math.min((now - startTime) / duration, 1);
            const ease = 1 - Math.pow(1 - t, 3);
            liveCountEl.textContent = fmt(Math.round(start + diff * ease));
            if (t < 1) requestAnimationFrame(tick);
            else currentCount = target;
        }
        requestAnimationFrame(tick);
    }

    function renderRecent(items) {
        if (!items.length) {
            recentEl.innerHTML = `<div class="sig-empty"><div class="sig-empty-icon" style="color:var(--muted)"><i data-lucide="feather" width="36" height="36"></i></div>Aucune signature publique pour l'instant.<br>Soyez parmi les premiers.</div>`;
            lucide.createIcons();
            return;
        }
        const colors = ['#1054A0','#0E8FA0','#7C3AED','#DC2626','#059669','#D97706'];
        recentEl.innerHTML = items.map(({ name, signed_at }) => {
            const parts    = name.split(' ');
            const initials = ((parts[0]?.[0] ?? '') + (parts[1]?.[0] ?? '')).toUpperCase();
            let hash = 0;
            for (const c of name) hash = (hash * 31 + c.charCodeAt(0)) | 0;
            const color = colors[Math.abs(hash) % colors.length];
            return `
            <div class="sig-item">
                <div class="sig-avatar" style="background:linear-gradient(135deg,${color}cc,${color})">${initials}</div>
                <div class="sig-info">
                    <div class="sig-name">${name}</div>
                    <div class="sig-time">${signed_at ?? ''}</div>
                </div>
            </div>`;
        }).join('');
    }

    async function refresh() {
        try {
            const res = await fetch('{{ route('petition.stats') }}', { headers: { Accept: 'application/json' } });
            if (!res.ok) return;
            const data = await res.json();

            animateCount(Number(data.signatures_count));
            const pct = Number(data.progress_percentage);
            if (progressEl) progressEl.style.width = `${pct}%`;
            if (pctEl)      pctEl.textContent = `${pct}%`;
            if (goalEl)     goalEl.textContent = fmt(Number(data.goal_signatures));
            if (sigCountEl) sigCountEl.textContent = fmt(Number(data.signatures_count));
            renderRecent(data.recent_signatures ?? []);
        } catch (e) {
            // silent
        }
    }

    animateCount(currentCount);
    setInterval(refresh, 15000);

    window.copyLink = function (btn) {
        navigator.clipboard.writeText(btn.dataset.url).then(() => {
            const orig = btn.innerHTML;
            btn.innerHTML = '<i data-lucide="check" width="16" height="16"></i> Lien copié !';
            lucide.createIcons();
            setTimeout(() => { btn.innerHTML = orig; lucide.createIcons(); }, 2200);
        });
    };
})();
</script>

@endsection
