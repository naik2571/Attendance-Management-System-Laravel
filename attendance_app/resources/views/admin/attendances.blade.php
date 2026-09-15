<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin - All Attendances') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold">Attendance Records</h3>
                        <a href="{{ route('admin.students.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Manage Students
                        </a>
                    </div>
                    
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-4 gap-4 mb-8">
                        <div class="bg-blue-100 p-4 rounded-lg shadow-sm">
                            <div class="text-sm text-blue-600 font-semibold uppercase tracking-wide">Total Students</div>
                            <div class="text-3xl font-bold text-blue-800">{{ $totalStudents }}</div>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow-sm">
                            <div class="text-sm text-green-600 font-semibold uppercase tracking-wide">Present</div>
                            <div class="text-3xl font-bold text-green-800">{{ $presentCount }}</div>
                        </div>
                        <div class="bg-red-100 p-4 rounded-lg shadow-sm">
                            <div class="text-sm text-red-600 font-semibold uppercase tracking-wide">Absent</div>
                            <div class="text-3xl font-bold text-red-800">{{ $absentCount }}</div>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg shadow-sm">
                            <div class="text-sm text-yellow-600 font-semibold uppercase tracking-wide">On Leave</div>
                            <div class="text-3xl font-bold text-yellow-800">{{ $leaveCount }}</div>
                        </div>
                    </div>

                    <!-- Date Filter -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg border flex items-center justify-between">
                        <span class="font-semibold text-gray-700">Filter by Date:</span>
                        <form method="GET" action="{{ route('admin.attendances') }}" class="flex items-center gap-2">
                            <input type="date" name="date" value="{{ $filterDate }}" class="border-gray-300 rounded-md shadow-sm">
                            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Filter</button>
                            <a href="{{ route('admin.attendances') }}" class="text-gray-500 hover:underline text-sm ml-2">Clear</a>
                        </form>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full text-left border-collapse mb-4">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border-b py-3 px-4 font-semibold text-gray-700">Student Name</th>
                                <th class="border-b py-3 px-4 font-semibold text-gray-700">Date</th>
                                <th class="border-b py-3 px-4 font-semibold text-gray-700">Clock In</th>
                                <th class="border-b py-3 px-4 font-semibold text-gray-700">Clock Out</th>
                                <th class="border-b py-3 px-4 font-semibold text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $attendance)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="border-b py-3 px-4">{{ $attendance->user->name }}</td>
                                    <td class="border-b py-3 px-4">{{ $attendance->date }}</td>
                                    <td class="border-b py-3 px-4">{{ $attendance->clock_in_time ? \Carbon\Carbon::parse($attendance->clock_in_time)->format('h:i A') : '-' }}</td>
                                    <td class="border-b py-3 px-4">{{ $attendance->clock_out_time ? \Carbon\Carbon::parse($attendance->clock_out_time)->format('h:i A') : '-' }}</td>
                                    <td class="border-b py-3 px-4">
                                        <span class="px-2 py-1 rounded text-sm font-semibold 
                                            {{ $attendance->status === 'present' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $attendance->status === 'absent' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $attendance->status === 'leave' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                            {{ ucfirst($attendance->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border-b py-4 px-4 text-center text-gray-500">No attendance records found for this date.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

