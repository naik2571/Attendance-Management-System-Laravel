<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AttendanceController;

Route::get('/dashboard', function () {
    $attendances = App\Models\Attendance::where('user_id', auth()->id())->orderBy('date', 'desc')->get();
    return view('dashboard', compact('attendances'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clock-in');
    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clock-out');
    Route::post('/attendance/leave', [AttendanceController::class, 'markLeave'])->name('attendance.leave');
    Route::get('/admin/attendances', [AttendanceController::class, 'adminIndex'])->name('admin.attendances');
    Route::resource('/admin/students', \App\Http\Controllers\AdminStudentController::class)->names([
        'index' => 'admin.students.index',
        'create' => 'admin.students.create',
        'store' => 'admin.students.store',
        'edit' => 'admin.students.edit',
        'update' => 'admin.students.update',
        'destroy' => 'admin.students.destroy',
    ])->except(['show']);
    Route::post('/admin/students/{student}/absent', [\App\Http\Controllers\AdminStudentController::class, 'markAbsent'])->name('admin.students.absent');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
