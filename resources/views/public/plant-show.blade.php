{{-- resources/views/public/plant-show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8 animate-fadeIn">

        {{-- 🌿 PLANT HEADER CARD --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-8 mb-10 transition-all duration-300 hover:shadow-2xl">
            <div class="flex flex-col md:flex-row gap-8">
                {{-- Image --}}
                <div
                    class="w-full md:w-60 aspect-square bg-gray-100 dark:bg-gray-800 rounded-2xl overflow-hidden flex items-center justify-center shadow-inner">
                    @if ($plant->images && count($plant->images) > 0)
                        <img src="{{ Storage::url($plant->images[0]) }}" alt="{{ $plant->name }}"
                            class="w-full h-full object-cover rounded-2xl">
                    @else
                        <span class="text-7xl block text-center">
<x-plant-icon :plant="$plant" />                        </span>
                    @endif
                </div>

                {{-- Details --}}
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $plant->name }}
                        </h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Code: <span class="font-medium text-gray-800 dark:text-gray-200">{{ $plant->plant_code }}</span>
                        </p>

                        <div class="mt-4 text-gray-700 dark:text-gray-300 space-y-2 text-sm leading-relaxed">
                            @if ($plant->description)
                                <p>{{ $plant->description }}</p>
                            @endif
                            <p>
                                Farm:
                                <a href="{{ route('public.farms.show', $plant->farm->slug) }}"
                                    class="text-green-600 dark:text-green-400 hover:underline">
                                    {{ $plant->farm->name }}
                                </a>
                            </p>
                            @if ($plant->planted_at)
                                <p>Planted: {{ $plant->planted_at->format('M d, Y') }}</p>
                            @endif
                            @if ($plant->insertion_date)
                                <p>Inserted: {{ $plant->insertion_date->format('M d, Y') }}</p>
                            @endif
                            @if ($plant->batch)
                                <p>Batch: {{ $plant->batch }}</p>
                            @endif

                            @if (auth()->check() && auth()->id() === $plant->farm->user_id)
                                <a href="{{ route('plants.edit', $plant) }}"
                                    class="text-sm px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-gray-700 dark:text-gray-200 hover:bg-gray-200">Edit</a>
                            @endif

                            @foreach ($plant->types as $type)
                                <button type="button"
                                    class="inline-flex items-center gap-2 px-4 rounded-full text-sm font-medium
               border border-green-600 bg-green-600 text-white hover:bg-green-700
               focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                                    {{-- <span>{{ $type->icon ?? '🌿' }}</span> --}}
                                    <span>{{ $type->name_en }}</span>
                                </button>
                            @endforeach

                        </div>
                    </div>

                    {{-- QR Code --}}
                    @if ($plant->qr_code_path && Storage::exists($plant->qr_code_path))
                        <div class="mt-6 flex flex-col sm:flex-row sm:items-center gap-3">
                            <img src="{{ Storage::url($plant->qr_code_path) }}" alt="QR for {{ $plant->name }}"
                                class="w-24 h-24 rounded-xl border border-gray-200 dark:border-gray-700 shadow">
                            <a href="{{ Storage::url($plant->qr_code_path) }}" download
                                class="text-sm text-green-600 dark:text-green-400 hover:underline font-medium">
                                ⬇️ Download QR Code
                            </a>
                        </div>
                    @endif

                    {{-- Printable QR that redirects to this page (generated client-side via quickchart.io) --}}
                    <div class="mt-6">
                        <div class="flex items-center gap-4">
                            <img
                                src="https://quickchart.io/qr?text={{ urlencode(request()->fullUrl()) }}&size=300&dark=000000&light=ffffff"
                                alt="QR redirect to {{ $plant->name }}"
                                class="w-24 h-24 rounded-xl border border-gray-200 dark:border-gray-700 shadow">

                            <div class="flex flex-col">
                                <button type="button" onclick="printPlantQr()"
                                    class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition">
                                    🖨️ Print QR
                                </button>

                                <a target="_blank"
                                    href="https://quickchart.io/qr?text={{ urlencode(request()->fullUrl()) }}&size=600"
                                    class="mt-2 text-sm text-gray-600 dark:text-gray-300 hover:underline">Open larger
                                    QR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🪴 PLANT UPDATES SECTION --}}
        <section
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-800 p-6 transition-all duration-300 hover:shadow-2xl">
            <div class="flex items-center justify-between mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
                <h2 class="text-2xl font-extrabold text-gray-800 dark:text-white flex items-center gap-2">
                    🪴 Plant Updates
                </h2>

                {{-- Add Button for Farm Owner --}}
                @if (auth()->check() && auth()->id() === $plant->farm->user_id)
                    <button
                        onclick="Livewire.dispatch('openModal', { component: 'plant-update-modal', arguments: { plant: {{ $plant->id }} }})"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition">
                        + Add Update
                    </button>
                @endif
            </div>

            @if ($plant->updates && $plant->updates->count())
                <div class="space-y-4">
                    @foreach ($plant->updates as $update)
                        <div
                            class="bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-4 hover:shadow-md transition-all duration-300">
                            <div class="flex justify-between items-center mb-2">
                                <p class="font-medium text-gray-800 dark:text-white">
                                    {{ $update->title ?? 'Update' }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $update->created_at->diffForHumans() }}
                                </p>
                            </div>
                              <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $update->status  }}
                            </p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $update->description  }}
                            </p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $update->height  }}
                            </p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $update->diseases  }}
                            </p>
                            @if ($update->photos && count($update->photos) > 0)
                                <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 gap-3">
                                    @foreach ($update->photos as $photo)
                                        <img src="{{ Storage::url($photo) }}" alt="Update photo"
                                            class="rounded-xl object-cover w-full h-32 border border-gray-200 dark:border-gray-700 shadow-sm">
                                    @endforeach
                                </div>
                            @endif
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">
                                Recorded by: {{ $update->user->name ?? 'Unknown' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="text-center text-gray-500 dark:text-gray-400 py-10 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300 dark:border-gray-700">
                    No updates yet 🌿
                </div>
            @endif
        </section>

        {{-- 💬 UPDATE MODAL --}}
        {{-- Modal is opened via LivewireUI's openModal. No direct include needed. --}}
    </div>

    <script>
        function printPlantQr() {
            const url = {!! json_encode(request()->fullUrl()) !!};
            const title = {!! json_encode($plant->name) !!};
            const qrUrl = 'https://quickchart.io/qr?text=' + encodeURIComponent(url) + '&size=600&dark=000000&light=ffffff';

            const win = window.open('', '_blank', 'width=700,height=800');
            if (!win) {
                // Popup blocked — open the QR image directly in a new tab as fallback
                const newWin = window.open(qrUrl, '_blank');
                if (newWin) newWin.focus();
                else alert('Popup blocked. Please allow popups or use the "Open larger QR" link.');
                return;
            }

            const html = `
                <!doctype html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <title>Print QR - ${title}</title>
                    <meta name="viewport" content="width=device-width,initial-scale=1">
                    <style>
                        body{font-family:Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; text-align:center; padding:28px; color:#111}
                        h1{font-size:20px;margin-bottom:12px}
                        .qr{margin:0 auto}
                        .url{word-break:break-all; color:#333; margin-top:12px; font-size:13px}
                        @media print { body { margin: 0; } img{ max-width:100%; } }
                    </style>
                </head>
                <body>
                    <h1>${title}</h1>
                    <div class="qr"><img src="${qrUrl}" alt="QR for ${title}"></div>
                    <p class="url">${url}</p>
                    <script>
                        (function(){
                            var img = document.querySelector('img');
                            function doPrint(){ try{ window.focus(); window.print(); }catch(e){}
                            }
                            if(img){
                                if(img.complete) setTimeout(doPrint, 200);
                                else img.onload = doPrint;
                                // safety fallback
                                setTimeout(doPrint, 2000);
                            } else {
                                setTimeout(doPrint, 300);
                            }
                        })();
                    <\/script>
                </body>
                </html>
            `;

            win.document.open();
            win.document.write(html);
            win.document.close();
            win.focus();
        }
    </script>

    {{-- Fade animation --}}
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.6s ease-in-out;
        }
    </style>
@endsection
