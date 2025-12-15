<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Order') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- STEP: posisi di Order --}}
            <div class="bg-white shadow-sm rounded-lg p-4">
                <div class="flex justify-center space-x-10">
                    <div class="flex flex-col items-center text-sm">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-gray-300 text-gray-700 font-semibold">
                            1
                        </div>
                        <span class="mt-2 text-gray-700">Keranjang</span>
                    </div>

                    <div class="flex flex-col items-center text-sm">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-indigo-500 text-white font-semibold">
                            2
                        </div>
                        <span class="mt-2 font-medium text-gray-900">Order</span>
                    </div>

                    <div class="flex flex-col items-center text-sm">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-gray-300 text-gray-700 font-semibold">
                            3
                        </div>
                        <span class="mt-2 text-gray-700">Pembayaran</span>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    Riwayat Order Anda
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-left text-gray-700">
                                <th class="px-4 py-2 font-semibold">#</th>
                                <th class="px-4 py-2 font-semibold">ID Order</th>
                                <th class="px-4 py-2 font-semibold">Total Harga</th>
                                <th class="px-4 py-2 font-semibold">Status Order</th>
                                <th class="px-4 py-2 font-semibold">Status Pembayaran</th>
                                <th class="px-4 py-2 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($orders as $order)
                                <tr>
                                    <td class="px-4 py-3 text-gray-700">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-900">
                                        #{{ $order->order_id }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-700">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold
                                            @if($order->status === 'completed')
                                                bg-green-100 text-green-800
                                            @elseif($order->status === 'pending')
                                                bg-yellow-100 text-yellow-800
                                            @else
                                                bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs font-semibold
                                            @if($order->payment_status === 'paid')
                                                bg-green-100 text-green-800
                                            @elseif($order->payment_status === 'unpaid')
                                                bg-red-100 text-red-800
                                            @else
                                                bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a
                                            href="{{ route('orders.show', $order->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        >
                                            Detail &amp; Pembayaran
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                        Tidak ada data order.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>