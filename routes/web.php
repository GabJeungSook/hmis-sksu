<?php

use App\Livewire\Doctor\Vitals;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Cashier\Billing;
use App\Livewire\Cashier\BillOut;
use App\Livewire\Pharmacy\Receipt;
use App\Livewire\Admin\Manage\Rooms;
use App\Livewire\Pharmacy\Inventory;
use App\Livewire\Doctor\Laboratories;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Manage\Doctors;
use App\Livewire\Doctor\EmergencyRoom;
use App\Livewire\Doctor\MedicalRecord;
use App\Livewire\Pharmacy\ManageStock;
use App\Livewire\Pharmacy\PointOfSale;
use App\Livewire\Pharmacy\Transaction;
use App\Livewire\Admin\Manage\Patients;
use App\Livewire\Admin\Manage\ManageBed;
use App\Livewire\Doctor\ManageLaboratory;
use App\Livewire\Admin\Inventory\Category;
use App\Livewire\Admin\Inventory\Medicine;
use App\Livewire\Doctor\ViewMedicalRecord;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Manage\AssignBed;
use App\Livewire\Admin\Manage\AssignDoctor;
use App\Livewire\Admin\Manage\InitialDiagnosis;
use App\Livewire\Admin\Reports\MedicineList;
use App\Livewire\Admin\Reports\PatientAdmission;
use App\Livewire\Admin\Reports\PatientBilling;
use App\Livewire\Admin\Reports\PatientList;
use App\Livewire\Doctor\Prescription;
use App\Models\PatientBill;

Route::get('/', function () {
    return redirect()->route('login');
});

//admin routes
Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified', 'role:admin,doctor,pharmacist,cashier,ipd / opd'])->name('admin.dashboard');
Route::get('/manage/doctors', Doctors::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.doctors');

Route::get('/manage/rooms-and-beds', Rooms::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.rooms-and-beds');
Route::get('/manage/manage-beds/{record}', ManageBed::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.manage-beds');
Route::get('/manage/inventory/category', Category::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.inventory.category');
Route::get('/manage/inventory/medicine', Medicine::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.inventory.medicine');
Route::get('/reports/patient-list', PatientList::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports.patient-list');
Route::get('/reports/patient-admission', PatientAdmission::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports.patient-admission');
Route::get('/reports/patient-billing', PatientBilling::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports.patient-billing');
Route::get('/reports/medicine-list', MedicineList::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports.medicine-list');

Route::get('/ipd-opd/patients', Patients::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('admin.patients');
Route::get('/ipd-opd/assign-doctor', AssignDoctor::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('ipd.assign-doctor');
Route::get('/ipd-opd/assign-bed', AssignBed::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('ipd.assign-bed');
Route::get('/ipd-opd/vitals', Vitals::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('doctor.vitals');
Route::get('/ipd-opd/laboratories', Laboratories::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('doctor.laboratories');
Route::get('/ipd-opd/initial-diagnosis', InitialDiagnosis::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('ipd.initial-diagnosis');

//doctor routes
Route::get('/doctor/emergency-room', EmergencyRoom::class)->middleware(['auth', 'verified', 'role:admin,doctor'])->name('doctor.emergency-room');
Route::get('/doctor/manage-laboratories/{record}', ManageLaboratory::class)->middleware(['auth', 'verified', 'role:admin,doctor'])->name('doctor.manage-labs');
Route::get('/doctor/medical-records', MedicalRecord::class)->middleware(['auth', 'verified', 'role:admin,doctor'])->name('doctor.medical-records');
Route::get('/doctor/view-medical-records/{record}', ViewMedicalRecord::class)->middleware(['auth', 'verified', 'role:admin,doctor'])->name('doctor.view-medical-records');
Route::get('/doctor/prescription', Prescription::class)->middleware(['auth', 'verified', 'role:admin,doctor'])->name('doctor.prescription');

//pharmacy routes
Route::get('/pharmacy/inventory', Inventory::class)->middleware(['auth', 'verified', 'role:admin,pharmacist'])->name('pharmacy.inventory');
Route::get('/pharmacy/manage-stock/{record}', ManageStock::class)->middleware(['auth', 'verified', 'role:admin,pharmacist'])->name('pharmacy.manage-stock');
Route::get('/pharmacy/point-of-sale', PointOfSale::class)->middleware(['auth', 'verified', 'role:admin,pharmacist'])->name('pharmacy.pos');
Route::get('/pharmacy/receipt/{record}', Receipt::class)->middleware(['auth', 'verified', 'role:admin,pharmacist'])->name('pharmacy.receipt');
Route::get('/pharmacy/transactions', Transaction::class)->middleware(['auth', 'verified', 'role:admin,pharmacist'])->name('pharmacy.transaction');

//cashier routes
Route::get('/cashier/billing', Billing::class)->middleware(['auth', 'verified', 'role:admin,cashier'])->name('cashier.billing');
Route::get('/cashier/patient-bill/{record}', BillOut::class)->middleware(['auth', 'verified', 'role:admin,cashier'])->name('cashier.bill-out');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
