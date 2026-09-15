<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function clockIn(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();

        $existingAttendance = Attendance::where('user_id', $user->id)
                                        ->where('date', $today)
                                        ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('error', 'You have already clocked in today.');
        }

        Attendance::create([
            'user_id' => $user->id,
            'date' => $today,
            'clock_in_time' => Carbon::now(),
            'status' => 'present',
        ]);

        return redirect()->back()->with('success', 'Clocked in successfully!');
    }

    public function clockOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)
                                ->where('date', $today)
                                ->first();

        if (!$attendance) {
            return redirect()->back()->with('error', 'You have not clocked in today.');
        }

        if ($attendance->clock_out_time) {
            return redirect()->back()->with('error', 'You have already clocked out.');
        }

        $attendance->update([
            'clock_out_time' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Clocked out successfully!');
    }

    public function markLeave(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();

        $existingAttendance = Attendance::where('user_id', $user->id)
                                        ->where('date', $today)
                                        ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('error', 'You already have an attendance record for today.');
        }

        Attendance::create([
            'user_id' => $user->id,
            'date' => $today,
            'status' => 'leave',
        ]);

        return redirect()->back()->with('success', 'Marked as on leave today.');
    }

    public function adminIndex(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $query = Attendance::with('user');

        // Date Filtering
        $filterDate = $request->input('date', Carbon::today()->toDateString());
        if ($request->filled('date')) {
            $query->whereDate('date', $filterDate);
        } else {
             $query->whereDate('date', $filterDate); // default to today
        }

        // Pagination
        $attendances = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Statistics for the selected date
        $totalStudents = \App\Models\User::where('role', 'student')->count();
        $presentCount = Attendance::whereDate('date', $filterDate)->where('status', 'present')->count();
        $absentCount = Attendance::whereDate('date', $filterDate)->where('status', 'absent')->count();
        $leaveCount = Attendance::whereDate('date', $filterDate)->where('status', 'leave')->count();

        return view('admin.attendances', compact('attendances', 'filterDate', 'totalStudents', 'presentCount', 'absentCount', 'leaveCount'));
    }

    public function createStudent()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.create-student');
    }

    public function storeStudent(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'student',
        ]);

        return redirect()->route('admin.attendances')->with('success', 'Student created successfully!');
    }
}
