<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Pétition CVK') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:   #08192A;
            --navy2:  #0D2337;
            --blue:   #1054A0;
            --blue2:  #1668C4;
            --teal:   #0E8FA0;
            --gold:   #FECA0A;
            --gold2:  #FFD740;
            --white:  #FFFFFF;
            --off:    #F4F7FA;
            --border: #E2E8F0;
            --muted:  #6B849A;
            --ink:    #0B1928;
            --green:  #10B981;
            --red:    #EF4444;
            --r:      14px;
            --shadow: 0 20px 60px rgba(8,25,42,.13);
        }

        html { scroll-behavior: smooth; font-size: 16px; }

        body {
            background: var(--off);
            color: var(--ink);
            font-family: 'Inter', system-ui, sans-serif;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        a { color: inherit; text-decoration: none; }
        img { display: block; max-width: 100%; }

        .wrap {
            width: min(1200px, 100% - 48px);
            margin-inline: auto;
        }

        /* ── NAV ── */
        .nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(8,25,42,.88);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            height: 68px;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-logo {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(0,0,0,.3);
        }
        .brand-logo img { width: 100%; height: 100%; object-fit: cover; }
        .brand-logo-text {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 16px;
            color: var(--navy);
        }
        .brand-name {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 18px;
            color: var(--white);
            letter-spacing: -.3px;
        }
        .brand-tag {
            font-size: 11px;
            font-weight: 600;
            color: rgba(255,255,255,.5);
            text-transform: uppercase;
            letter-spacing: .8px;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }
        .nav-links a {
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255,255,255,.72);
            transition: color .2s, background .2s;
        }
        .nav-links a:hover { color: var(--white); background: rgba(255,255,255,.08); }
        .nav-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 40px;
            padding: 0 18px;
            border-radius: 10px;
            background: var(--gold);
            color: var(--navy) !important;
            font-weight: 700;
            font-size: 14px;
            transition: background .2s, transform .2s, box-shadow .2s;
        }
        .nav-cta:hover {
            background: var(--gold2) !important;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(254,202,10,.35);
        }

        /* ── FOOTER ── */
        .footer {
            background: var(--navy);
            color: rgba(255,255,255,.56);
            padding: 32px 0;
            margin-top: 96px;
        }
        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            font-size: 13px;
            font-weight: 500;
        }
        .footer-links {
            display: flex;
            gap: 20px;
        }
        .footer-links a {
            color: rgba(255,255,255,.44);
            transition: color .2s;
        }
        .footer-links a:hover { color: rgba(255,255,255,.9); }

        @media (max-width: 640px) {
            .nav-links { display: none; }
            .nav-mobile-cta { display: flex; }
            .footer-inner { flex-direction: column; gap: 12px; text-align: center; }
        }

        /* ── LUCIDE ICONS ── */
        [data-lucide] { display: inline-block; vertical-align: middle; flex-shrink: 0; }
    </style>
    @stack('head')
</head>
<body>

<nav class="nav" role="navigation" aria-label="Navigation principale">
    <div class="wrap nav-inner">
        <a href="{{ route('petition.show') }}" class="brand">
            <div class="brand-logo">
                @if(file_exists(public_path('images/cvk-logo.jpg')))
                    <img src="{{ asset('images/cvk-logo.jpg') }}" alt="CVK">
                @else
                    <span class="brand-logo-text">CVK</span>
                @endif
            </div>
            <div>
                <div class="brand-name">CVK</div>
                <div class="brand-tag">Pétition officielle</div>
            </div>
        </a>

        <ul class="nav-links">
            <li><a href="{{ route('petition.show') }}#pourquoi">Pourquoi signer</a></li>
            <li><a href="{{ route('petition.show') }}#signatures">Signataires</a></li>
            <li><a href="{{ route('petition.show') }}#signer" class="nav-cta"><i data-lucide="pencil-line" width="15" height="15"></i> Je signe</a></li>
        </ul>
    </div>
</nav>

<main>@yield('content')</main>

<footer class="footer">
    <div class="wrap footer-inner">
        <span>© {{ date('Y') }} CVK — Pétition officielle. Tous droits réservés. · By <a href="https://irmeyaouedraogo.com" target="_blank" rel="noopener noreferrer" style="color:rgba(255,255,255,.7);font-weight:700;transition:color .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.7)'">IRDEL</a></span>
        <div class="footer-links">
            <a href="{{ route('legal.show', 'conditions-utilisation') }}">Conditions d'utilisation</a>
            <a href="{{ route('legal.show', 'politique-utilisation-donnees') }}">Politique des données</a>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>lucide.createIcons();</script>
@stack('scripts')
</body>
</html>
