<!-- filepath: /home/d/coder/pharmacy/resources/views/pharmacies/index.blade.php -->
<x-dashboardLayout :title="'Pharmacies'" :breadcrumb="['Pharmacies' => route('pharmacies.index')]">
    <div class="w-full">
        <h1 class="text-2xl font-bold mb-6">Pharmacy Management</h1>
        {{--         @if (session('success'))
            {
            <x-messanger msg="{{ session('success') }}" />
            } --}}
        {{-- @endif --}}
        <!-- Add Pharmacy Button -->
        <div class="mb-4">
            <a href="{{ route('pharmacies.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Add New Pharmacy
            </a>
        </div>

        <!-- Pharmacy Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-left">ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Name</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">License Number</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Location</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Phone</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Email</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Picture</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Country</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">State</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">City</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Latitude</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Longitude</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pharmacies as $pharmacy)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->name }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->license_number }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->location }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->phone }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->email }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                @if ($pharmacy->picture)
                                    <img src="{{ asset('storage/' . $pharmacy->picture) }}" alt="Pharmacy Image"
                                        class="w-16 h-16 object-cover rounded">
                                @else
                                    <span class="text-gray-500">No Image</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->country }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->state }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->city }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->latitude }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $pharmacy->longitude }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                <a href="{{ route('pharmacies.edit', $pharmacy->id) }}"
                                    class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('pharmacies.destroy', $pharmacy->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline"
                                        onclick="return confirm('Are you sure you want to delete this pharmacy?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $pharmacies->links() }}
            </div>
        </div>
    </div>
</x-dashboardLayout>
