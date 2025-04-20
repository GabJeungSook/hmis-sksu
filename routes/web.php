<?php

use App\Models\PatientBill;
use App\Livewire\Doctor\Vitals;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Cashier\Billing;
use App\Livewire\Cashier\BillOut;
use App\Livewire\Pharmacy\Receipt;
use App\Livewire\Admin\Manage\Rooms;
use App\Livewire\Pharmacy\Inventory;
use App\Livewire\Doctor\Laboratories;
use App\Livewire\Doctor\Prescription;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Manage\Doctors;
use App\Livewire\Admin\Manage\HealthRecords;
use App\Livewire\Admin\Manage\HealthCases;
use App\Livewire\AddHealthCase;
use App\Livewire\Doctor\EmergencyRoom;
use App\Livewire\Doctor\MedicalRecord;
use App\Livewire\Pharmacy\ManageStock;
use App\Livewire\Pharmacy\PointOfSale;
use App\Livewire\Pharmacy\Transaction;
use App\Livewire\Admin\Manage\Patients;
use App\Livewire\Admin\Manage\AssignBed;
use App\Livewire\Admin\Manage\DoctorFee;
use App\Livewire\Admin\Manage\ManageBed;
use App\Livewire\Admin\Manage\AddPatientExam;
use App\Livewire\Admin\Manage\AddHealthRecord;
use App\Livewire\ViewHealthRecord;
use App\Livewire\ViewReferralDetails;
use App\Livewire\Admin\Manage\Referrals;
use App\Livewire\Admin\Manage\AddReferral;
use App\Livewire\Doctor\ManageLaboratory;
use App\Livewire\Admin\Inventory\Category;
use App\Livewire\Admin\Inventory\Medicine;
use App\Livewire\Doctor\ViewMedicalRecord;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\Manage\AssignDoctor;
use App\Livewire\Admin\Reports\PatientList;
use App\Livewire\Admin\Reports\MedicineList;
use App\Livewire\Admin\Reports\PatientBilling;
use App\Livewire\Admin\Manage\InitialDiagnosis;
use App\Livewire\Admin\Reports\PatientAdmission;
use App\Livewire\Admin\Reports\LabResults;

Route::get('/', function () {
    $user = auth()->user();

    if ($user) {
        return $user->role_id == 2
            ? redirect()->route('student.dashboard')
            : redirect()->route('admin.dashboard');
    }

    return redirect()->route('login');
})->name('home');

//admin routes
Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified', 'role:admin,student,doctor,pharmacist,cashier,ipd / opd,laboratory'])->name('admin.dashboard');
Route::get('/manage/doctors', Doctors::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.doctors');

Route::get('/manage/rooms-and-beds', Rooms::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.rooms-and-beds');
Route::get('/manage/manage-beds/{record}', ManageBed::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.manage-beds');
Route::get('/manage/doctors-fee', DoctorFee::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.doctors-fee');
Route::get('/manage/inventory/category', Category::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.inventory.category');
Route::get('/manage/inventory/medicine', Medicine::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.inventory.medicine');
Route::get('/reports/patient-list', PatientList::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports.patient-list');
Route::get('/reports/patient-admission', PatientAdmission::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports.patient-admission');
Route::get('/reports/patient-billing', PatientBilling::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports.patient-billing');
Route::get('/reports/medicine-list', MedicineList::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports.medicine-list');
Route::get('/reports/lab-results', LabResults::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.reports.lab-results');

Route::get('/ipd-opd/patients', Patients::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('admin.patients');
Route::get('/ipd-opd/assign-doctor', AssignDoctor::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('ipd.assign-doctor');
Route::get('/ipd-opd/assign-bed', AssignBed::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('ipd.assign-bed');
Route::get('/ipd-opd/vitals', Vitals::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('doctor.vitals');
Route::get('/lab-management/laboratories', Laboratories::class)->middleware(['auth', 'verified', 'role:admin,laboratory'])->name('doctor.laboratories');
Route::get('/ipd-opd/initial-diagnosis', InitialDiagnosis::class)->middleware(['auth', 'verified', 'role:admin,ipd / opd'])->name('ipd.initial-diagnosis');

//doctor routes
Route::get('/doctor/emergency-room', EmergencyRoom::class)->middleware(['auth', 'verified', 'role:admin,doctor'])->name('doctor.emergency-room');
Route::get('/doctor/manage-laboratories/{record}', ManageLaboratory::class)->middleware(['auth', 'verified', 'role:admin,laboratory'])->name('doctor.manage-labs');
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

//student routes
Route::get('/student/dashboard', function () {
    return view('student.dashboard');
})->middleware(['auth', 'verified', 'role:student'])->name('student.dashboard');

Route::get('/admin/add-patient-exam', AddPatientExam::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.add-patient-exam');
Route::get('/admin/add-health-record', AddHealthRecord::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.add-health-record');
Route::get('/admin/health-records', HealthRecords::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.health_records');
Route::get('/admin/referrals', Referrals::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.referrals');
Route::get('/admin/cases', HealthCases::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.cases');
Route::get('/admin/add-referral', AddReferral::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.add_referral');
Route::get('/admin/add-health-case', AddHealthCase::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.add-health-case');
Route::get('/admin/view-health-record/{record}', ViewHealthRecord::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.view-health-record');
Route::get('/admin/view-referral-details/{record}/{id}', ViewReferralDetails::class)->middleware(['auth', 'verified', 'role:admin'])->name('admin.view-referral-details');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
