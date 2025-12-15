<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Order') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- STEP: posisi di Pembayaran --}}
            <div class="bg-white shadow-sm rounded-lg p-4">
                <div class="flex justify-center space-x-10">
                    <div class="flex flex-col items-center text-sm">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-gray-300 text-gray-700 font-semibold">
                            1
                        </div>
                        <span class="mt-2 text-gray-700">Keranjang</span>
                    </div>

                    <div class="flex flex-col items-center text-sm">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-gray-300 text-gray-700 font-semibold">
                            2
                        </div>
                        <span class="mt-2 text-gray-700">Order</span>
                    </div>

                    <div class="flex flex-col items-center text-sm">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-indigo-500 text-white font-semibold">
                            3
                        </div>
                        <span class="mt-2 font-medium text-gray-900">Pembayaran</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Data Order --}}
                <div class="md:col-span-2 bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Data Order
                    </h3>

                    <dl class="divide-y divide-gray-200 text-sm text-gray-700">
                        <div class="py-3 flex justify-between">
                            <dt class="font-medium">ID Order</dt>
                            <dd>#{{ $order->order_id }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="font-medium">Total Harga</dt>
                            <dd>Rp {{ number_format($order->total_price, 0, ',', '.') }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="font-medium">Status Order</dt>
                            <dd>{{ ucfirst($order->status) }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="font-medium">Status Pembayaran</dt>
                            <dd>{{ ucfirst($order->payment_status) }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="font-medium">Tanggal</dt>
                            <dd>{{ $order->created_at->format('d M Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>

                {{-- Box Pembayaran --}}
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Pembayaran
                    </h3>

                    @if ($order->payment_status == 'unpaid')
                        <p class="text-sm text-gray-600 mb-4">
                            Klik tombol di bawah ini untuk melanjutkan ke halaman pembayaran Midtrans.
                        </p>
                        <button
                            id="pay-button"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Bayar Sekarang
                        </button>
                    @elseif ($order->payment_status == 'paid')
                        <div class="px-3 py-2 rounded-md bg-green-100 text-green-800 text-sm text-center">
                            Pembayaran berhasil. Terima kasih!
                        </div>
                    @else
                        <div class="px-3 py-2 rounded-md bg-yellow-100 text-yellow-800 text-sm text-center">
                            Status pembayaran: {{ ucfirst($order->payment_status) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Script Midtrans --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.querySelector('#pay-button');
        if (payButton) {
            payButton.addEventListener('click', function (e) {
                e.preventDefault();
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function (result) {
                        console.log(result);
                        location.reload();
                    },
                    onPending: function (result) {
                        console.log(result);
                    },
                    onError: function (result) {
                        console.log(result);
                        alert('Terjadi kesalahan saat proses pembayaran.');
                    }
                });
            });
        }
    </script>
</x-app-layout>