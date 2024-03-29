<?php

use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Manage\Doctors;
use App\Livewire\Admin\Manage\Patients;
use App\Livewire\Admin\Manage\Rooms;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

//admin routes
Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');
Route::get('/manage/doctors', Doctors::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.doctors');
Route::get('/manage/patients', Patients::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.patients');
Route::get('/manage/rooms-and-beds', Rooms::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.rooms-and-beds');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
