@section('title', 'Patient Bill')
<div>
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-6 sm:px-6">
          <h3 class="text-base font-semibold leading-7 text-gray-900">{{$record->name}}</h3>
          <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{$record->guardian_name}}</p>
        </div>
        <div class="border-t border-gray-100">
          <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-900">Type</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->type}}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-900">Initial Diagnosis</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->initial_diagnosis}}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium leading-6 text-gray-900">Payables</dt>
              <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                    @if ($record->type === 'In-Patient')
                    <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                        <div class="flex w-0 flex-1 items-center">
                          <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                          </svg>
                          <div class="ml-4 flex-col min-w-0 gap-2">
                            <span class="truncate font-medium">Room : {{$record->bed->room->name}}</span>
                            <p class="flex-shrink-0 text-gray-400">Bed : {{$record->bed->name}}</p>
                          </div>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <span class="font-medium text-gray-600">₱ {{number_format($record->bed->room->amount, 2)}}</span>
                        </div>
                      </li>
                    @endif
                    @if ($record->laboratoryTests)
                    @foreach ($record->laboratoryTests as $test)
                    @php
                    $result = App\Models\LaboratoryResult::where('laboratory_test_id', $test->id)->first();
                    @endphp
                    <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                      <div class="flex w-0 flex-1 items-center">
                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                        </svg>
                        <div class="ml-4 flex-col min-w-0 gap-2">
                          <span class="truncate font-medium">Test : {{$test->test}}</span>
                          <p class="flex-shrink-0 text-gray-400">Result : {{$result->result}}</p>
                        </div>
                      </div>
                      <div class="ml-4 flex-shrink-0">
                          <span class="font-medium text-gray-600">₱ {{number_format($test->amount, 2)}}</span>
                      </div>
                    </li>
                    @endforeach
                    @endif
                  <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                    <div class="flex w-0 flex-1 items-center">
                      <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                      </svg>
                      <div class="ml-4 flex-col min-w-0 gap-2">
                        <span class="truncate text-2xl font-medium">Total : </span>
                      </div>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        <span class="font-medium text-2xl text-blue-600">₱ {{number_format($grand_total, 2)}}</span>
                    </div>
                  </li>
                </ul>
                <div class="mt-3 flex justify-end">
                    {{ ($this->payBillAction)(['id' => $record->id]) }}
                </div>
                <x-filament-actions::modals />
              </dd>
            </div>
          </dl>
        </div>
      </div>

</div>
