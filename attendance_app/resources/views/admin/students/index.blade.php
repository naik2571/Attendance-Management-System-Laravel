<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Students') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">All Registered Students</h3>
                        <a href="{{ route('admin.students.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            + Add Student
                        </a>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b py-2 font-semibold">Name</th>
                                <th class="border-b py-2 font-semibold">Email</th>
                                <th class="border-b py-2 font-semibold">Created At</th>
                                <th class="border-b py-2 font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td class="border-b py-2">{{ $student->name }}</td>
                                    <td class="border-b py-2">{{ $student->email }}</td>
                                    <td class="border-b py-2">{{ $student->created_at->format('Y-m-d') }}</td>
                                    <td class="border-b py-2 flex items-center gap-2">
                                        <form method="POST" action="{{ route('admin.students.absent', $student->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-orange-600 hover:underline text-sm" onclick="return confirm('Mark this student as absent for today?')">Mark Absent</button>
                                        </form>
                                        <span class="text-gray-300">|</span>
                                        <a href="{{ route('admin.students.edit', $student->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <span class="text-gray-300">|</span>
                                        <form method="POST" action="{{ route('admin.students.destroy', $student->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

