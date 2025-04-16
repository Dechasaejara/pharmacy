<x-layout>
    <!-- Hero Section -->
    <section class="bg-green-600 text-white py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to {{ env('APP_NAME', 'Pharmacy') }}</h1>
            <p class="text-lg mb-6">Your one-stop solution for all your pharmacy needs.</p>
            <a href="#services" class="bg-white text-green-600 px-6 py-3 rounded-md font-medium hover:bg-gray-100">Explore
                Services</a>
        </div>
    </section>
  
    <!-- Services Section -->
    <section id="services" class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Online Prescriptions</h3>
                    <p>Order your prescriptions online and get them delivered to your doorstep.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Health Consultations</h3>
                    <p>Consult with our expert pharmacists for personalized health advice.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold mb-4">Wide Range of Products</h3>
                    <p>Explore a wide range of health and wellness products at competitive prices.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Pharmacies Section -->
    <section id="top-pharmacies" class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Top Pharmacies</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($topPharmacies as $pharmacy)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        @if ($pharmacy->picture)
                            <img src="{{ asset('storage/' . $pharmacy->picture) }}" alt="{{ $pharmacy->name }}" />
                        @endif
                        <h3 class="text-xl font-bold mb-2">{{ $pharmacy->name }}</h3>
                        <p class="text-gray-600">{{ $pharmacy->location }}</p>
                        <a href="#" class="text-green-600 hover:underline mt-4 block">View Details</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Trending Products Section -->
    <section id="trending-products" class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Trending Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach ($trendingProducts as $product)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}"
                            class="w-full h-40 object-cover rounded-md mb-4">
                        <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                        <p class="text-gray-600">${{ $product->price }}</p>
                        <a href="#" class="text-green-600 hover:underline mt-4 block">Buy Now</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-layout>
