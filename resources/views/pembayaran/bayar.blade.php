@extends('layouts.app')
@section('header')
    Pembayaran | Detail Pembayaran
@endsection

@section('content')
    <h1 class="font-bold text-4xl text-primary text-center mb-8">Detail Pembayaran</h1>

    <div class="max-w-3xl mx-auto p-4 sm:p-6 rounded shadow-xl border border-gray-300">
        @if ($pembayaran->status === 'menunggu pembayaran')
            <div class="mb-4 flex flex-col items-center justify-center text-center">
                <p class="text-lg font-bold">Waktu Pembayaran Tersisa</p>
                <span id="countdown" class="text-lg font-bold text-red-600"></span>
            </div>
        @endif

        {{-- Metode --}}
        <div class="mb-6 flex flex-col items-center justify-center text-center">
            <p class="text-2xl sm:text-3xl font-bold">Nomor Pembayaran {{ $pembayaran->metodePembayaran->nama_bank }}</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-2 mt-2 w-full sm:w-auto">
                <h1 class="text-lg sm:text-xl mt-1 break-words">{{ $pembayaran->metodePembayaran->no_rekening }}</h1>
                <button onclick="copyRekening()"
                    class="text-md cursor-pointer hover:underline flex items-center justify-center">
                    <i class="fa-solid fa-file"></i>
                </button>
            </div>
        </div>

        {{-- Form Upload --}}
        @if ($pembayaran->status === 'menunggu pembayaran')
            <form action="{{ route('pembayaran.bayar.store', $pembayaran->id) }}" method="POST"
                enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="flex flex-col items-center justify-center text-center w-full">
                    <div class="mb-4 w-full sm:w-3/4">
                        <label class="block mb-2 font-semibold">Upload Bukti Pembayaran</label>
                        <input type="file" name="bukti_pembayaran" class="border p-2 rounded w-full">
                    </div>
                </div>
                <div class="flex items-center justify-end w-full sm:w-3/4 mx-auto">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
                </div>
            </form>
        @elseif ($pembayaran->status === 'ditolak')
            <p class="text-red-600 font-bold text-center">Waktu pembayaran telah habis. Status: DITOLAK</p>
        @elseif ($pembayaran->status === 'menunggu disetujui')
            <p class="text-yellow-600 font-semibold text-center">Bukti sudah dikirim. Menunggu disetujui.</p>
        @endif
    </div>

    {{-- JS Countdown & Copy --}}
    <script>
        function copyRekening() {
            const rekening = document.getElementById("rekening");
            navigator.clipboard.writeText(rekening.value);
            alert("Nomor rekening disalin!");
        }

        const timezone = 'Asia/Jakarta';

        @if ($pembayaran->status === 'menunggu pembayaran')
            let expiredAt = "{{ $pembayaran->expired_at }}";
            let countDownDate = new Date(expiredAt).toLocaleString('en-US', {
                timeZone: timezone
            });
            countDownDate = new Date(countDownDate).getTime();

            let x = setInterval(function() {
                let now = new Date().getTime();
                let distance = countDownDate - now;

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "Waktu habis!";
                    window.location.reload();
                } else {
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById("countdown").innerHTML = `${minutes}m ${seconds}s`;
                }
            }, 1000);
        @endif
    </script>
@endsection
