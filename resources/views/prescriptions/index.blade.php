<!-- filepath: /home/d/coder/pharmacy/resources/views/prescriptions/index.blade.php -->
<x-dashboardLayout :title="'Prescriptions'" :breadcrumb="['Prescriptions' => route('prescriptions.index')]">
    <div class="w-full">
        <h1 class="text-2xl font-bold mb-6">Prescription Management</h1>

        <!-- Add Prescription Button -->
        <div class="mb-4">
            <a href="{{ route('prescriptions.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Add New Prescription
            </a>
        </div>

        <!-- Prescription Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-left">ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Profile ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Status</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Medical Notes</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Issued Date</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Images</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prescriptions as $prescription)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300">{{ $prescription->id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $prescription->profile_id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $prescription->status }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $prescription->medical_notes }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $prescription->issued_date }}</td>
                            <td class="px-4 py-2 border border-gray-300">
                                @if ($prescription->images)
                                    @foreach ($prescription->images as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="Prescription Image"
                                            class="w-16 h-16 object-cover rounded">
                                    @endforeach
                                @else
                                    <span class="text-gray-500">No Images</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                <a href="{{ route('prescriptions.edit', $prescription->id) }}"
                                    class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('prescriptions.destroy', $prescription->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline"
                                        onclick="return confirm('Are you sure you want to delete this prescription?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $prescriptions->links() }}
            </div>
        </div>
    </div>
</x-dashboardLayout>
