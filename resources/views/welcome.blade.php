<x-layout>
    <section class="bg-gradient-to-r from-green-500 to-emerald-600 text-white py-20 lg:py-32">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                Welcome to {{ config('app.name', 'PharmaConnect') }}
            </h1>
            <p class="text-lg lg:text-xl mb-8 max-w-3xl mx-auto">
                Easily upload your prescription, compare prices, and locate nearby pharmacies on our interactive map. Your health, your choice.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
                <a href="{{ route('dashboard') }}" class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-300 shadow-md w-full sm:w-auto">
                    <i class="fas fa-upload mr-2"></i> Upload Prescription
                </a>
                <a href="{{ route('home') }}#map"class="bg-emerald-700 text-white px-8 py-3 rounded-lg font-semibold text-lg hover:bg-emerald-800 transition duration-300 border border-emerald-400 w-full sm:w-auto">
                    <i class="fas fa-map-marked-alt mr-2"></i> View Pharmacies on Map
                </a>
            </div>
            <p class="text-sm text-green-100">
                Are you a Pharmacy Owner or Manager? <a href="{{ route('register') }}" class="font-semibold hover:underline">Join Our Network</a>.
            </p>
        </div>
    </section>

    <section id="how-it-works" class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-12 text-gray-800">Your Journey to Better Pharmacy Access</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                <div class="flex flex-col items-center p-6">
                    <div class="bg-green-100 text-green-600 rounded-full p-5 mb-6 inline-flex">
                        <i class="fas fa-file-upload fa-2x"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-700">1. Upload Prescription</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Securely submit your prescription. Our platform makes it simple and quick.
                    </p>
                </div>
                <div class="flex flex-col items-center p-6">
                    <div class="bg-green-100 text-green-600 rounded-full p-5 mb-6 inline-flex">
                        <i class="fas fa-search-location fa-2x"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-700">2. Find & Compare Pharmacies</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Discover local pharmacies, view them on a map, and compare prices and services instantly.
                    </p>
                </div>
                <div class="flex flex-col items-center p-6">
                    <div class="bg-green-100 text-green-600 rounded-full p-5 mb-6 inline-flex">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-700">3. Choose & Connect</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Select your preferred pharmacy and arrange for pickup or delivery.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="map-teaser" class="py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 lg:pr-12 mb-8 lg:mb-0 text-center lg:text-left">
                    <h2 class="text-3xl lg:text-4xl font-bold mb-6 text-gray-800">Discover Pharmacies Visually</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Our interactive map allows you to easily find pharmacies near your location, view their details, and check services offered. No more guessing where the closest or best-priced pharmacy is!
                    </p>
                    <ul class="list-none space-y-3 mb-8 text-gray-700">
                        <li class="flex items-start"><i class="fas fa-map-pin text-green-500 fa-fw mr-3 mt-1"></i>Pinpoint pharmacies by proximity.</li>
                        <li class="flex items-start"><i class="fas fa-dollar-sign text-green-500 fa-fw mr-3 mt-1"></i>Quickly see which pharmacies offer competitive pricing.</li>
                        <li class="flex items-start"><i class="fas fa-info-circle text-green-500 fa-fw mr-3 mt-1"></i>Access pharmacy contact info and opening hours.</li>
                    </ul>
                    {{-- <a href="{{ route('pharmacies.index') }}" class="bg-green-500 text-white px-8 py-3 rounded-lg font-semibold text-lg hover:bg-green-600 transition duration-300 shadow-md">
                        <i class="fas fa-map-marked-alt mr-2"></i> Explore the Map
                    </a> --}}
                </div>
                <div id="map" class="lg:w-2/3 lg:ml-12 z-20">
                    <x-map :quotations="[]" />
                    
                </div>
            </div>
        </div>
    </section>


    <section id="features" class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-12 text-gray-800">Why {{ config('app.name', 'PharmaConnect') }}?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="text-green-500 mb-4">
                        <i class="fas fa-tags fa-3x"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-700">Transparent Pricing</h3>
                    <p class="text-gray-600">Compare medication prices from various pharmacies to ensure you get the best deal.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="text-green-500 mb-4">
                        <i class="fas fa-street-view fa-3x"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-700">Ultimate Convenience</h3>
                    <p class="text-gray-600">Find nearby pharmacies easily with our map view and manage prescriptions online.</p>
                </div>
                <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="text-green-500 mb-4">
                        <i class="fas fa-users-cog fa-3x"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-700">For Everyone Involved</h3>
                    <p class="text-gray-600">Tailored dashboards and tools for patients, pharmacists, and pharmacy managers.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="featured-pharmacies" class="py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl lg:text-4xl font-bold mb-12 text-center text-gray-800">Featured Partner Pharmacies</h2>
            @if(isset($featuredPharmacies) && $featuredPharmacies->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($featuredPharmacies as $pharmacy)
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col">
                            <div class="h-48 w-full mb-4 rounded overflow-hidden">
                                @if ($pharmacy->picture)
                                    <img   src="{{ asset('storage/' . $pharmacy->picture) }}" src="{{ asset('storage/' . $pharmacy->picture) }}" alt="{{ $pharmacy->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-clinic-medical fa-4x text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-xl font-semibold mb-2 text-green-700">{{ $pharmacy->name }}</h3>
                            <p class="text-gray-600 mb-1"><i class="fas fa-map-marker-alt mr-2 text-green-500"></i>{{ $pharmacy->location }}</p>
                            <div class="mt-auto pt-4">
                                <a href="{{ route('pharmacies.show', $pharmacy) }}" class="inline-block bg-green-500 text-white px-5 py-2 rounded-md font-medium hover:bg-green-600 transition duration-300 text-sm">
                                    View Details & Offers
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-12">
                    <a href="{{ route('pharmacies.index') }}" class="text-green-600 hover:underline font-semibold text-lg">
                        Browse All Pharmacies <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            @else
                <p class="text-center text-gray-600">Our network of pharmacies is growing. Check back soon!</p>
            @endif
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-gradient-to-r from-green-600 to-emerald-700 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-6">Ready for a Smarter Pharmacy Experience?</h2>
            <p class="text-lg lg:text-xl mb-8 max-w-xl mx-auto">
                Join thousands of users benefiting from easier prescription management and better prices.
            </p>
            <a href="{{ route('dashboard') }}" class="bg-white text-green-600 px-10 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition duration-300 shadow-lg transform hover:scale-105">
                <i class="fas fa-notes-medical mr-2"></i> Get Started with Your Prescription
            </a>
        </div>
    </section>

    {{-- Trending Products Section (Optional) --}}
    @if(isset($trendingProducts) && $trendingProducts->count() > 0)
    <section id="trending-products" class="py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl lg:text-4xl font-bold mb-12 text-center text-gray-800">Popular Health Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($trendingProducts as $product)
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->brand_name }}</h3>
                        <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->brand_name }}"
                            class="w-full h-40 object-contain p-1 border rounded-md mb-4">
                       
                        {{-- <p class="text-green-600 font-bold text-xl my-2">${{ number_format($product->price, 2) }}</p> --}}
                        <div class="mt-auto">
                            <a href="{{ route('products.index', $product) }}" class="inline-block bg-emerald-500 text-white px-5 py-2 rounded-md font-medium hover:bg-emerald-600 transition duration-300 text-sm w-full text-center">
                                View Product
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

</x-layout>