@extends('layouts.app')

@section('content')
<div x-data="{ lang: 'en' }" class="bg-gray-950 text-gray-200 min-h-screen font-sans">
    {{-- Language Switcher --}}
    <div class="flex justify-end px-6 py-4 text-sm text-gray-400">
        <button @click="lang = 'en'" :class="lang === 'en' ? 'text-green-400' : ''">EN</button>
        <span class="mx-2">|</span>
        <button @click="lang = 'bm'" :class="lang === 'bm' ? 'text-green-400' : ''">BM</button>
    </div>

    {{-- Hero --}}
    <section class="relative text-center py-24 overflow-hidden">
        {{-- <img src="/images/farm-hero.jpg" alt="Farm background" class="absolute inset-0 w-full h-full object-cover opacity-10"> --}}
        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <h1 class="text-5xl font-extrabold text-green-400 mb-4" x-text="lang === 'en' ? 'Cloud Farming — Agriculture Reinvented' : 'Pertanian Awan — Revolusi Baru Pertanian'"></h1>
            <p class="text-gray-400 text-lg"
               x-text="lang === 'en'
               ? 'Own a digital farm, grow your crops remotely, and connect farmers to guaranteed buyers'
               : 'Miliki ladang digital, tanam tanaman anda dari jauh, dan bantu petani mendapatkan pembeli sebelum benih ditanam '">
            </p>
        </div>
    </section>

    {{-- Section 1: Urban dream --}}
    <section class="max-w-6xl mx-auto py-20 px-6 grid md:grid-cols-2 gap-12 items-center">
        <div class="space-y-4" x-show="lang === 'en'" x-transition>
            <h2 class="text-3xl font-semibold text-green-400">Want to own a farm but have no time or space?</h2>
            <p class="text-gray-400 leading-relaxed">
                With <span class="text-green-400">CloudFarm</span>, you can subscribe to a small plot of land — managed by our partnered farmers.
                Choose what you want to grow, like tomatoes or pak choy, and our farmers will plant, care, and harvest them for you.
            </p>
            <p class="text-gray-400 leading-relaxed">
                You can monitor your crops through live camera feeds, updates, and photos, right from your dashboard.
            </p>
        </div>
        <div class="space-y-4" x-show="lang === 'bm'" x-transition>
            <h2 class="text-3xl font-semibold text-green-400">Nak miliki ladang tapi tiada masa atau ruang?</h2>
            <p class="text-gray-400 leading-relaxed">
                Dengan <span class="text-green-400">CloudFarm</span>, anda boleh langgan sebidang tanah kecil yang diuruskan oleh petani rakan kami.
                Pilih tanaman seperti tomato atau sawi, dan petani akan menanam serta menuai bagi pihak anda.
            </p>
            <p class="text-gray-400 leading-relaxed">
                Pantau perkembangan tanaman anda melalui kamera langsung dan kemas kini bergambar di papan pemuka.
            </p>
        </div>
        <div class="relative">
            <img src="{{ asset('images/home_farm.webp') }}" alt="Urban farm"
                 class="rounded-2xl shadow-lg transform hover:scale-105 transition duration-500">
        </div>
    </section>

    {{-- Section 2: For Farmers --}}
    <section class="max-w-6xl mx-auto py-20 px-6 grid md:grid-cols-2 gap-12 items-center mb-20">
        <div class="relative order-2 md:order-1">
            <img src="{{ asset('images/home_garden.webp') }}" alt="Farmer hand"
                 class="rounded-2xl shadow-lg transform hover:scale-105 transition duration-500">
        </div>
        <div class="space-y-4 order-1 md:order-2 " x-show="lang === 'en'" x-transition>
            <h2 class="text-3xl font-semibold text-green-400">For farmers — get funded before you plant.</h2>
            <p class="text-gray-400 leading-relaxed">
                CloudFarm connects you with urban growers who pre-pay for their crops.
                This means you have funds to start planting and guaranteed buyers for your harvest.
            </p>
            <p class="text-gray-400 leading-relaxed">
                No more risk of oversupply or wasted vegetables — every seed is grown for someone who already owns it.
            </p>
        </div>
        <div class="space-y-4 order-1 md:order-2" x-show="lang === 'bm'" x-transition>
            <h2 class="text-3xl font-semibold text-green-400">Untuk petani — dapatkan dana sebelum menanam.</h2>
            <p class="text-gray-400 leading-relaxed">
                CloudFarm menghubungkan anda dengan pengguna bandar yang menempah hasil tanaman mereka lebih awal.
                Ini memberi anda dana untuk memulakan penanaman dan memastikan hasil anda mempunyai pembeli tetap.
            </p>
            <p class="text-gray-400 leading-relaxed">
                Tiada lagi masalah lambakan sayur — setiap benih yang ditanam sudah pun dimiliki.
            </p>
        </div>
    </section>

    {{-- Section 3: Sustainable Impact --}}
    <section class="max-w-6xl mx-auto py-20 px-6 text-center ">
        <h2 class="text-3xl font-semibold text-green-400 mb-6"
            x-text="lang === 'en' ? 'Sustainability through Smart Collaboration' : 'Kelestarian Melalui Kerjasama Pintar'">
        </h2>
        <p class="max-w-3xl mx-auto text-gray-400 leading-relaxed"
           x-text="lang === 'en'
           ? 'This model reduces food waste, supports small farmers, and reconnects people with their food sources — making agriculture accessible, transparent, and rewarding for all.'
           : 'Model ini mengurangkan pembaziran makanan, menyokong petani kecil, dan menghubungkan semula orang ramai dengan sumber makanan mereka — menjadikan pertanian lebih telus dan mampan.'">
        </p>

        <div class="mt-10 grid sm:grid-cols-3 gap-6">
            <div class="bg-gray-900 rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition">
                <img src="/images/icon-plant.webp" class="w-12 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-green-400">Urban Growers</h3>
                <p class="text-gray-400 text-sm">Grow your crops remotely and eat your own food.</p>
            </div>
            <div class="bg-gray-900 rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition">
                <img src="/images/icon-farmer.webp" class="w-12 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-green-400">Local Farmers</h3>
                <p class="text-gray-400 text-sm">Gain stable funding and pre-booked buyers.</p>
            </div>
            <div class="bg-gray-900 rounded-2xl p-6 hover:shadow-lg hover:-translate-y-1 transition">
                <img src="/images/icon-earth.webp" class="w-12 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-green-400">Environment</h3>
                <p class="text-gray-400 text-sm">Reduced waste, efficient farming, better planet.</p>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-10 text-center text-gray-500 text-sm">
        © {{ date('Y') }} CloudFarm • All rights reserved
    </footer>
</div>
@endsection
