<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Daily Attendance</h3>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @php
                        $todayAttendance = $attendances->where('date', \Carbon\Carbon::today()->toDateString())->first();
                    @endphp

                    <div class="mb-8 flex gap-4">
                        <form method="POST" action="{{ route('attendance.clock-in') }}">
                            @csrf
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" {{ $todayAttendance ? 'disabled' : '' }} style="{{ $todayAttendance ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
                                Clock In
                            </button>
                        </form>

                        <form method="POST" action="{{ route('attendance.clock-out') }}">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" {{ (!$todayAttendance || $todayAttendance->clock_out_time || $todayAttendance->status !== 'present') ? 'disabled' : '' }} style="{{ (!$todayAttendance || $todayAttendance->clock_out_time || $todayAttendance->status !== 'present') ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
                                Clock Out
                            </button>
                        </form>
                        
                        <form method="POST" action="{{ route('attendance.leave') }}">
                            @csrf
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded" {{ $todayAttendance ? 'disabled' : '' }} style="{{ $todayAttendance ? 'opacity: 0.5; cursor: not-allowed;' : '' }}" onclick="return confirm('Are you sure you want to take leave today?')">
                                Request Leave
                            </button>
                        </form>
                    </div>

                    <h3 class="text-lg font-bold mb-4 mt-8 border-t pt-4">Your Attendance History</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b py-2 font-semibold">Date</th>
                                <th class="border-b py-2 font-semibold">Clock In</th>
                                <th class="border-b py-2 font-semibold">Clock Out</th>
                                <th class="border-b py-2 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td class="border-b py-2">{{ $attendance->date }}</td>
                                    <td class="border-b py-2">{{ $attendance->clock_in_time ? \Carbon\Carbon::parse($attendance->clock_in_time)->format('H:i') : '-' }}</td>
                                    <td class="border-b py-2">{{ $attendance->clock_out_time ? \Carbon\Carbon::parse($attendance->clock_out_time)->format('H:i') : '-' }}</td>
                                    <td class="border-b py-2">{{ ucfirst($attendance->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
