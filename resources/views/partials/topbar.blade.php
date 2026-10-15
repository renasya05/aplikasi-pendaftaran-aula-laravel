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
            aria-haspopup="true"
            aria-label="Notifikasi"
        >
            <x-icon name="bell" size="20" />

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
                                @elseif ($n->status === 'dibatalkan')
                                    Pengajuan {{ $tbNamaAula }} dibatalkan
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

            <span class="tb-caret">
                <x-icon name="chevron-down" size="16" />
            </span>
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
            // Hanya perubahan status oleh admin yang dibaca sebagai
            // notifikasi baru; dibatalkan oleh user sendiri bukan.
            var isUnread =
                ['disetujui', 'ditolak'].indexOf(it.getAttribute('data-status')) !== -1 &&
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