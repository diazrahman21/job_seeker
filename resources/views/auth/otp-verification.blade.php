@extends('layouts.app')
@section('content')
<div class="mx-auto max-w-md rounded-xl border bg-white p-6">
    <h1 class="text-2xl font-bold">Verifikasi OTP</h1>
    <p class="mt-1 text-sm text-slate-600">Masukkan kode OTP 6 digit yang dikirim ke {{ $email }}.</p>

    <form method="post" action="{{ route('otp.verification.verify') }}" class="mt-4 space-y-3">
        @csrf
        <input
            name="otp_code"
            type="text"
            inputmode="numeric"
            maxlength="6"
            pattern="[0-9]{6}"
            placeholder="Contoh: 123456"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 tracking-[0.3em]"
            required
        >
        @error('otp_code')<p class="text-sm text-rose-600">{{ $message }}</p>@enderror

        <button class="w-full rounded-lg bg-slate-900 py-2 text-white">Verifikasi OTP</button>
    </form>

    <form method="post" action="{{ route('otp.verification.resend') }}" class="mt-3">
        @csrf
        <button id="resend-btn" type="submit" class="w-full rounded-lg border py-2 disabled:opacity-60" @disabled($resendCooldown > 0)>
            Kirim Ulang OTP
        </button>
        <p id="cooldown-text" class="mt-2 text-center text-xs text-slate-500">
            @if($resendCooldown > 0)
                Kirim ulang tersedia dalam {{ $resendCooldown }} detik.
            @endif
        </p>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let cooldown = {{ (int) $resendCooldown }};
    const button = document.getElementById('resend-btn');
    const text = document.getElementById('cooldown-text');

    if (cooldown <= 0) return;

    const timer = setInterval(function () {
        cooldown -= 1;

        if (cooldown <= 0) {
            button.disabled = false;
            text.textContent = '';
            clearInterval(timer);
            return;
        }

        button.disabled = true;
        text.textContent = 'Kirim ulang tersedia dalam ' + cooldown + ' detik.';
    }, 1000);
});
</script>
@endsection
