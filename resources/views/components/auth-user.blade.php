@props(['msg', 'bg' => 'bg-green-500'])
<div class="flex gap-2">
    @auth
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.outside="open = false"
                    class="flex items-center space-x-2 focus:outline-none">
                    @if (false)
                        <img src="" alt="User Avatar" class="w-10 h-10 rounded-full">
                    @else
                        <img src="/default.jpg" alt="User Avatar" class="w-10 h-10 rounded-full">
                    @endif
                    <span class="font-medium px-3">{{ auth()->user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-cloak
                    class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg overflow-hidden z-50">
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
    @endauth
</div>
