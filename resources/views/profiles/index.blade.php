<!-- filepath: /home/d/coder/pharmacy/resources/views/profile/index.blade.php -->
<x-dashboardLayout :title="'Profiles'" :breadcrumb="['Profiles' => route('profiles.index')]">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Profile Management</h1>

        <!-- Add Profile Button -->
        {{-- <div class="mb-4">
            <a href="{{ route('') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                Add New Profile
            </a>
        </div> --}}

        <!-- Profile Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-left">ID</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Full Name</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Role</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Phone</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Address</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border border-gray-300">{{ $profile->id }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $profile->fullname }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $profile->role }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $profile->phone }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $profile->address }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                <a href="{{ route('profiles.edit', $profile->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this profile?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $profiles->links() }}
            </div>
        </div>
    </div>
</x-dashboardLayout>