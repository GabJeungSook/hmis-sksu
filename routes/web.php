<?php

use App\Livewire\Doctor\Vitals;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Manage\Rooms;
use App\Livewire\Doctor\Laboratories;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Manage\Doctors;
use App\Livewire\Doctor\EmergencyRoom;
use App\Livewire\Doctor\MedicalRecord;
use App\Livewire\Admin\Manage\Patients;
use App\Livewire\Admin\Manage\ManageBed;
use App\Livewire\Doctor\ManageLaboratory;
use App\Livewire\Doctor\ViewMedicalRecord;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

//admin routes
Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');
Route::get('/manage/doctors', Doctors::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.doctors');
Route::get('/manage/patients', Patients::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.patients');
Route::get('/manage/rooms-and-beds', Rooms::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.rooms-and-beds');
Route::get('/manage/manage-beds/{record}', ManageBed::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.manage-beds');

//doctor routes
Route::get('/doctor/emergency-room', EmergencyRoom::class)->middleware(['auth', 'verified', 'role:admin'])->name('doctor.emergency-room');
Route::get('/doctor/vitals', Vitals::class)->middleware(['auth', 'verified', 'role:admin'])->name('doctor.vitals');
Route::get('/doctor/laboratories', Laboratories::class)->middleware(['auth', 'verified', 'role:admin'])->name('doctor.laboratories');
Route::get('/doctor/manage-laboratories/{record}', ManageLaboratory::class)->middleware(['auth', 'verified', 'role:admin'])->name('doctor.manage-labs');
Route::get('/doctor/medical-records', MedicalRecord::class)->middleware(['auth', 'verified', 'role:admin'])->name('doctor.medical-records');
Route::get('/doctor/view-medical-records/{record}', ViewMedicalRecord::class)->middleware(['auth', 'verified', 'role:admin'])->name('doctor.view-medical-records');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
