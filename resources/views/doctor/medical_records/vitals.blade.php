<div class="bg-blue-50 p-5 rounded-md shadow-md">
    <div>
        <div class="px-4 sm:px-0">
          <h3 class="text-base font-semibold leading-7 text-gray-900">{{$record->name}} (Patient)</h3>
          <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{$record->guardian_name}} (Guardian)</p>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Temperature (°C)</dt>
                <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <span class="flex-grow">{{$record->vital->temperature}}</span>
                </dd>
              </div>
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Blood Pressure</dt>
                <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <span class="flex-grow">{{$record->vital->blood_pressure}}</span>
                </dd>
              </div>
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Heart Rate</dt>
                <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <span class="flex-grow">{{$record->vital->heart_rate}}</span>
                </dd>
              </div>
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Respiratory Rate</dt>
                <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <span class="flex-grow">{{$record->vital->respiratory_rate}}</span>
                </dd>
              </div>
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Date Conducted</dt>
                <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <span class="flex-grow">{{Carbon\Carbon::parse($record->vital->created_at)->format('F d, Y h:i A')}}</span>
                </dd>
              </div>
            </dl>
          </div>
      </div>

</div>

