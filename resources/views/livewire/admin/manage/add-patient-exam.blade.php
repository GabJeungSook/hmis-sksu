<div>
    @section('title', 'Patient Examination')

  
        <div class="mb-4">
            <label for="qr" class="block mb-2 font-semibold">Scan QR Code:</label>
            <input
                type="text"
                wire:model="qrCode" autocomplete="off" wire:change="readQR"
                class="w-full px-4 py-2 border rounded-lg"
                placeholder="Scan QR Code here..."
                autofocus
            >
            <p class="mt-2 text-red-500">Please scan a patient's QR code to proceed.</p>
        </div>


    @if ($isValid)
        <div>
            <div class="mt-6 border-t border-gray-100">
              <dl class="divide-y divide-gray-100">
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Full name</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$patient->first_name.' '.$patient->middle_name.' '.$patient->last_name}}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Full Address</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$patient->full_address}}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm/6 font-medium text-gray-900">Gender</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$patient->gender}}</dd>
                  </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm/6 font-medium text-gray-900">Birthday</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{Carbon\Carbon::parse($patient->birthday)->format('F d, Y')}}</dd>
                </div>
              </dl>
            </div>
        </div>
        <div class="mt-5">
            {{ $this->form }}
        </div>
        <div class="flex mt-4 justify-end space-x-4">
            <a href="{{ route('doctor.vitals') }}" class="px-4 py-3 bg-gray-50 text-gray-500 font-semibold rounded-lg border border-gray-400">Cancel</a>
            <button wire:click="submitPatientExam" wire:confirm="Are you sure you want to submit this information?" class="px-4 py-3 bg-blue-500 text-white font-semibold rounded-lg">Submit</button>
        </div>
    @endif
</div>
