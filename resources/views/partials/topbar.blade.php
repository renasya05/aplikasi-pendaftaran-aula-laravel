{{-- =====================================================================
     TOPBAR KANAN ATAS: HARI REALTIME, NOTIFIKASI, PROFIL
     Dipakai di: dashboard user & riwayat pendaftaran user
     Pemakaian : @include('partials.topbar')
====================================================================== --}}

@php
    $tbUser = auth()->user();

    $tbNow = now('Asia/Makassar');

    $tbHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    $tbBulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    $tbNotifs = $tbUser
        ? $tbUser->pendaftarans()
            ->with('aula')
            ->latest('updated_at')
            ->limit(6)
            ->get()
        : collect();
@endphp

<style>
    /*
      Semua selector diawali .topbar dan ukuran font memakai !important,
      karena layout memaksa font-size 18px !important untuk span/a/p
      di dalam .main-content.
    */

    .topbar {
        position: relative;
        z-index: 30;

        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 12px;

        margin-bottom: 24px;
    }

    .topbar .tb-date {
        display: flex;
        flex-direction: column;
        align-items: flex-end;

        padding: 6px 14px;

        line-height: 1.3;
        white-space: nowrap;

        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
    }

    .topbar .tb-day {
        font-size: 14px !important;
        font-weight: 800;
        color: #12355b;
    }

    .topbar .tb-time {
        font-size: 12px !important;
        color: #64748b;
        font-variant-numeric: tabular-nums;
    }

    .topbar .tb-dropdown {
        position: relative;
    }

    .topbar .tb-btn {
        display: flex;
        align-items: center;
        gap: 10px;

        height: 44px;
        padding: 0 12px;

        font-family: inherit;
        font-size: 14px !important;
        color: #12355b;

        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);

        cursor: pointer;

        transition: 0.2s ease;
    }

    .topbar .tb-btn:hover,
    .topbar .tb-btn[aria-expanded="true"] {
        background: #f1f5f9;
    }

    .topbar .tb-bell {
        position: relative;

        width: 44px;
        padding: 0;

        justify-content: center;
    }

    .topbar .tb-bell svg {
        width: 21px;
        height: 21px;
    }

    .topbar .tb-badge {
        position: absolute;
        top: -7px;
        right: -7px;

        display: none;
        align-items: center;
        justify-content: center;

        min-width: 21px;
        height: 21px;
        padding: 0 5px;

        font-size: 11px !important;
        font-weight: 800;
        color: #ffffff;

        background: #ef4444;
        border: 2px solid #ffffff;
        border-radius: 999px;
    }

    .topbar .tb-badge.show {
        display: flex;
    }

    .topbar .tb-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;

        width: 30px;
        height: 30px;

        font-size: 14px !important;
        font-weight: 800;
        color: #ffffff;

        background: #12355b;
        border-radius: 50%;
    }

    .topbar .tb-user-name {
        max-width: 130px;

        font-size: 14px !important;
        font-weight: 700;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .topbar .tb-caret {
        font-size: 10px !important;
        opacity: 0.7;
    }

    .topbar .tb-panel {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        z-index: 50;

        display: none;

        width: 340px;
        max-width: calc(100vw - 32px);

        overflow: hidden;

        font-size: 14px !important;
        color: #1e293b;

        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.18);
    }

    .topbar .tb-panel.open {
        display: block;
    }

    .topbar .tb-panel-title {
        padding: 14px 16px;

        font-size: 15px !important;
        font-weight: 800;
        color: #12355b;

        border-bottom: 1px solid #e2e8f0;
    }

    .topbar .tb-list {
        max-height: 340px;
        overflow-y: auto;
    }

    .topbar .tb-item {
        display: flex;
        gap: 12px;

        padding: 12px 16px;

        color: inherit;
        text-decoration: none;

        border-bottom: 1px solid #f1f5f9;

        transition: 0.15s ease;
    }

    .topbar .tb-item:last-child {
        border-bottom: none;
    }

    .topbar .tb-item:hover {
        background: #f8fafc;
    }

    .topbar .tb-item.unread {
        background: #eff6ff;
    }

    .topbar .tb-dot {
        flex-shrink: 0;

        width: 10px;
        height: 10px;
        margin-top: 6px;

        border-radius: 50%;
    }

    .topbar .tb-item.disetujui .tb-dot {
        background: #16a34a;
    }

    .topbar .tb-item.ditolak .tb-dot {
        background: #dc2626;
    }

    .topbar .tb-item.menunggu .tb-dot {
        background: #f59e0b;
    }

    .topbar .tb-item-text strong {
        display: block;

        font-size: 14px !important;
        line-height: 1.35;
        color: #12355b;
    }

    .topbar .tb-item-text span {
        display: block;

        margin-top: 2px;

        font-size: 12.5px !important;
        line-height: 1.4;
        color: #64748b;
    }

    .topbar .tb-empty {
        padding: 26px 16px;

        font-size: 14px !important;
        text-align: center;
        color: #94a3b8;
    }

    .topbar .tb-profile-head {
        display: flex;
        align-items: center;
        gap: 12px;

        padding: 16px;

        background: #f1f5f9;
        border-bottom: 1px solid #e2e8f0;
    }

    .topbar .tb-profile-head .tb-avatar {
        width: 44px;
        height: 44px;

        font-size: 19px !important;
    }

    .topbar .tb-profile-head strong {
        display: block;

        font-size: 15px !important;
        color: #12355b;
    }

    .topbar .tb-profile-head span {
        display: block;

        font-size: 12.5px !important;
        color: #64748b;
        word-break: break-all;
    }

    .topbar .tb-profile-head .tb-avatar {
        display: flex;

        color: #ffffff;
        word-break: normal;
    }

    .topbar .tb-profile-head .tb-role {
        display: inline-block;

        margin-top: 4px;
        padding: 1px 9px;

        font-size: 11px !important;
        font-weight: 700;
        color: #12355b;

        background: #dbeafe;
        border-radius: 20px;
    }

    .topbar .tb-menu {
        padding: 8px;
    }

    .topbar .tb-menu a,
    .topbar .tb-menu button {
        display: block;

        width: 100%;
        padding: 10px 12px;

        font-family: inherit;
        font-size: 14px !important;
        font-weight: 600;
        text-align: left;
        text-decoration: none;
        color: #1e293b;

        background: none;
        border: none;
        border-radius: 8px;

        cursor: pointer;
    }

    .topbar .tb-menu a:hover,
    .topbar .tb-menu button:hover {
        background: #f1f5f9;
    }

    .topbar .tb-menu .tb-logout {
        color: #dc2626;
    }

    @media (max-width: 700px) {

        .topbar {
            justify-content: space-between;
        }

        .topbar .tb-date {
            align-items: flex-start;
        }

        .topbar .tb-dropdown {
            position: static;
        }

        .topbar .tb-panel {
            left: 0;
            right: 0;
            top: calc(100% + 6px);

            width: auto;
            max-width: none;
        }
    }

    @media (max-width: 480px) {

        .topbar .tb-user-name,
        .topbar .tb-caret {
            display: none;
        }
    }
</style>


<div class="topbar">

    {{-- HARI & JAM REALTIME (diperbarui tiap detik oleh JavaScript) --}}
    <div class="tb-date">
        <span class="tb-day" id="tbDay">
            {{ $tbHari[(int) $tbNow->format('w')] }},
            {{ $tbNow->format('j') }}
            {{ $tbBulan[(int) $tbNow->format('n')] }}
            {{ $tbNow->format('Y') }}
        </span>

        <span class="tb-time" id="tbTime">
            {{ $tbNow->format('H.i.s') }} WITA
        </span>
    </div>


    {{-- NOTIFIKASI --}}
    <div class="tb-dropdown">

        <button
            type="button"
            class="tb-btn tb-bell"
            data-tb-toggle="tbNotifPanel"
            aria-expanded="false"
            aria-label="Notifikasi"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.7 21a2 2 0 0 1-3.4 0"></path>
            </svg>

            <span class="tb-badge" id="tbBadge"></span>
        </button>

        <div class="tb-panel" id="tbNotifPanel">

            <div class="tb-panel-title">Notifikasi</div>

            <div class="tb-list">

                @forelse ($tbNotifs as $n)

                    @php
                        $tbNamaAula = $n->aula->nama_aula ?? 'Aula';

                        $tbRentang = $n->tanggal_mulai
                            ? $n->tanggal_mulai->format('d/m/Y')
                            : '';

                        if (
                            $n->tanggal_selesai
                            && $n->tanggal_mulai
                            && $n->tanggal_selesai->ne($n->tanggal_mulai)
                        ) {
                            $tbRentang .= ' – ' . $n->tanggal_selesai->format('d/m/Y');
                        }
                    @endphp

                    <a
                        href="{{ route('pendaftaran.show', $n) }}"
                        class="tb-item {{ $n->status }}"
                        data-status="{{ $n->status }}"
                        data-ts="{{ $n->updated_at->timestamp }}"
                    >
                        <span class="tb-dot"></span>

                        <span class="tb-item-text">
                            <strong>
                                @if ($n->status === 'disetujui')
                                    Pengajuan {{ $tbNamaAula }} disetujui
                                @elseif ($n->status === 'ditolak')
                                    Pengajuan {{ $tbNamaAula }} ditolak
                                @else
                                    Pengajuan {{ $tbNamaAula }} menunggu persetujuan
                                @endif
                            </strong>

                            <span>
                                @if ($n->status === 'ditolak' && $n->catatan_admin)
                                    {{ \Illuminate\Support\Str::limit($n->catatan_admin, 70) }}
                                @else
                                    {{ $tbRentang }}
                                @endif
                            </span>

                            <span>
                                {{ $n->updated_at->timezone('Asia/Makassar')->format('d/m/Y H:i') }} WITA
                            </span>
                        </span>
                    </a>

                @empty

                    <div class="tb-empty">
                        Belum ada notifikasi.
                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- PROFIL --}}
    <div class="tb-dropdown">

        <button
            type="button"
            class="tb-btn"
            data-tb-toggle="tbProfilePanel"
            aria-expanded="false"
        >
            <span class="tb-avatar">
                {{ mb_strtoupper(mb_substr($tbUser->name ?? 'U', 0, 1)) }}
            </span>

            <span class="tb-user-name">
                {{ $tbUser->name ?? '' }}
            </span>

            <span class="tb-caret">▼</span>
        </button>

        <div class="tb-panel" id="tbProfilePanel">

            <div class="tb-profile-head">

                <span class="tb-avatar">
                    {{ mb_strtoupper(mb_substr($tbUser->name ?? 'U', 0, 1)) }}
                </span>

                <div>
                    <strong>{{ $tbUser->name ?? '' }}</strong>

                    <span>{{ $tbUser->email ?? '' }}</span>

                    <span class="tb-role">
                        {{ $tbUser && $tbUser->isAdmin() ? 'Administrator' : 'Pengguna' }}
                    </span>
                </div>

            </div>

            <div class="tb-menu">

                <a href="{{ route('dashboard') }}">Dashboard</a>

                <a href="{{ route('pendaftaran.history') }}">Riwayat Pendaftaran</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="tb-logout">Keluar</button>
                </form>

            </div>

        </div>

    </div>

</div>


<script>
    (function () {

        /* ---------- Hari & jam realtime (Asia/Makassar) ---------- */
        var dayEl = document.getElementById('tbDay');
        var timeEl = document.getElementById('tbTime');

        var fmt = new Intl.DateTimeFormat('id-ID', {
            timeZone: 'Asia/Makassar',
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hourCycle: 'h23'
        });

        function tick() {
            var p = {};

            fmt.formatToParts(new Date()).forEach(function (x) {
                p[x.type] = x.value;
            });

            dayEl.textContent =
                p.weekday + ', ' + p.day + ' ' + p.month + ' ' + p.year;

            timeEl.textContent =
                p.hour + '.' + p.minute + '.' + p.second + ' WITA';
        }

        tick();
        setInterval(tick, 1000);


        /* ---------- Dropdown notifikasi & profil ---------- */
        var toggles = document.querySelectorAll('[data-tb-toggle]');

        function closeAll(except) {
            toggles.forEach(function (btn) {
                if (btn === except) return;

                btn.setAttribute('aria-expanded', 'false');

                document
                    .getElementById(btn.getAttribute('data-tb-toggle'))
                    .classList.remove('open');
            });
        }

        toggles.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();

                var panel = document.getElementById(
                    btn.getAttribute('data-tb-toggle')
                );

                var willOpen = !panel.classList.contains('open');

                closeAll(btn);

                panel.classList.toggle('open', willOpen);

                btn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');

                if (willOpen && panel.id === 'tbNotifPanel') {
                    markRead();
                }
            });
        });

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.tb-dropdown')) closeAll();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeAll();
        });


        /* ---------- Penanda notifikasi belum dibaca ----------
           Disimpan di browser (localStorage), per akun. */
        var KEY = 'sapa_notif_read_{{ auth()->id() }}';
        var badge = document.getElementById('tbBadge');
        var items = document.querySelectorAll('.tb-item[data-ts]');

        function getRead() {
            try {
                return parseInt(localStorage.getItem(KEY) || '0', 10) || 0;
            } catch (e) {
                return 0;
            }
        }

        function setBadge(n) {
            badge.textContent = n > 9 ? '9+' : n;
            badge.classList.toggle('show', n > 0);
        }

        var lastRead = getRead();
        var unread = 0;

        items.forEach(function (it) {
            var isUnread =
                it.getAttribute('data-status') !== 'menunggu' &&
                parseInt(it.getAttribute('data-ts'), 10) > lastRead;

            it.classList.toggle('unread', isUnread);

            if (isUnread) unread++;
        });

        setBadge(unread);

        function markRead() {
            var max = lastRead;

            items.forEach(function (it) {
                max = Math.max(max, parseInt(it.getAttribute('data-ts'), 10));
            });

            try {
                localStorage.setItem(KEY, String(max));
            } catch (e) {}

            setBadge(0);
        }

    })();
</script>