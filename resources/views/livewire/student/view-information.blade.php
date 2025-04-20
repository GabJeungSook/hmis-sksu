<div>
    <div>
        <div>
            <div class="px-4 sm:px-0">
            </div>
            <div class="mt-6 border-t border-gray-100">
                @php
                    $user = App\Models\User::find(Auth::user()->id);
                @endphp
              <dl class="divide-y divide-gray-100">
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Full name</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$user->patient->first_name.' '.$user->patient->middle_name.' '.$user->patient->last_name}}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm/6 font-medium text-gray-900">Full Address</dt>
                  <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$user->patient->full_address}}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm/6 font-medium text-gray-900">Gender</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{$user->patient->gender}}</dd>
                  </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm/6 font-medium text-gray-900">Email</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{$user->email}}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                    <dt class="text-sm/6 font-medium text-gray-900">Birthday</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0 uppercase">{{Carbon\Carbon::parse($user->patient->birthday)->format('F d, Y')}}</dd>
                </div>
              </dl>
            </div>
          </div>
      </div>
      <div class="mt-3 text-center text-2xl font-semibold">
        QR Code
      </div>
      <div class="mt-3 flex justify-center align-center">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{$user->patient->id}}" alt="">
      </div>
</div>
