@section('title', 'View Patient Record')
<div>
    <div class="flex justify-end">
        <div>
            {{ $this->returnAction }}
        </div>
    </div>
    <div class="mt-2 poppins-light">
<div class="mt-6">
    <div class="sm:hidden">
      <label for="tabs" class="sr-only">Select a tab</label>
      <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
      <select id="tabs" name="tabs" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
        <option selected>My Account</option>
        <option>Company</option>
        <option>Team Members</option>
        <option>Billing</option>
      </select>
    </div>
    <div class="hidden sm:block" x-data="{ activeTab: localStorage.getItem('activeTab') || 'patient' }" x-cloak>
        <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow" aria-label="Tabs">
            <a href="#" class="text-gray-900 rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                @click.prevent="activeTab = 'patient'; localStorage.setItem('activeTab', 'patient')"
                :class="{ 'text-blue-900': activeTab === 'patient', 'text-gray-500 hover:text-gray-700': activeTab !== 'patient' }"
                aria-current="page">
                <span>Patient Profile</span>
                <span aria-hidden="true" class="bg-blue-600 absolute inset-x-0 bottom-0 h-0.5" x-show="activeTab === 'patient'"></span>
            </a>
            <!-- Add similar click handlers and classes for other tabs -->
            <!-- Laboratory Tab -->
            <a href="#" class="text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                @click.prevent="activeTab = 'laboratory'; localStorage.setItem('activeTab', 'laboratory')"
                :class="{ 'text-blue-900': activeTab === 'laboratory', 'text-gray-500 hover:text-gray-700': activeTab !== 'laboratory' }">
                <span>Laboratory</span>
                <span aria-hidden="true" class="bg-blue-600 absolute inset-x-0 bottom-0 h-0.5" x-show="activeTab === 'laboratory'"></span>
            </a>
            <!-- Vitals Tab -->
            <a href="#" class="text-gray-500 hover:text-gray-700 group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                @click.prevent="activeTab = 'vitals'; localStorage.setItem('activeTab', 'vitals')"
                :class="{ 'text-blue-900': activeTab === 'vitals', 'text-gray-500 hover:text-gray-700': activeTab !== 'vitals' }">
                <span>Vitals</span>
                <span aria-hidden="true" class="bg-blue-600 absolute inset-x-0 bottom-0 h-0.5" x-show="activeTab === 'vitals'"></span>
            </a>
            @if($record->type == 'In-Patient')
            <!-- Room & Bed Tab -->
            <a href="#" class="text-gray-500 hover:text-gray-700 rounded-r-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10"
                @click.prevent="activeTab = 'room_bed'; localStorage.setItem('activeTab', 'room_bed')"
                :class="{ 'text-blue-900': activeTab === 'room_bed', 'text-gray-500 hover:text-gray-700': activeTab !== 'room_bed' }">
                <span>Room & Bed</span>
                <span aria-hidden="true" class="bg-blue-600 absolute inset-x-0 bottom-0 h-0.5" x-show="activeTab === 'room_bed'"></span>
            </a>
            @endif
        </nav>
        {{-- views --}}
        <div x-show="activeTab === 'patient'">
            <div class="">
                <div class="relative block mt-3 w-full rounded-lg focus:outline-none">
                    <span class="mt-4 block text-gray-600">
                        @include('doctor.medical_records.profile')
                    </span>
                </div>
            </div>
        </div>

        <div x-show="activeTab === 'laboratory'">
            <div class="">
                <div class="relative block mt-3 w-full rounded-lg focus:outline-none">
                    <span class="mt-4 block text-gray-600">
                        @include('doctor.medical_records.laboratory')
                    </span>
                </div>
            </div>
        </div>

        <div x-show="activeTab === 'vitals'">
            <div class="">
                <div class="relative block mt-3 w-full rounded-lg focus:outline-none">
                    <span class="mt-4 block text-gray-600">
                        @include('doctor.medical_records.vitals')
                    </span>
                </div>
            </div>
        </div>

        <div x-show="activeTab === 'room_bed'">
            <div class="flex justify-center items-center">
                <div class="relative block mt-3 w-full rounded-lg focus:outline-none">
                    <span class="mt-4 block text-gray-600">
                        @include('doctor.medical_records.room_bed')
                    </span>
                </div>
            </div>
        </div>
    </div>
  </div>

              {{-- <div class="-mx-4 px-4 py-8 bg-blue-50 rounded-md">
                  <div>
                    <dd class="mt-2 text-gray-500"><span class="font-medium text-gray-900">{{$record->name}} (Patient)</span><br>{{$record->guardian_name}} (Guardian)
                        <br>{{$record->contact_number}}<br><span class="inline-flex items-center gap-x-1.5 rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                            <svg class="h-1.5 w-1.5 fill-green-500" viewBox="0 0 6 6" aria-hidden="true">
                              <circle cx="3" cy="3" r="3" />
                            </svg>
                            {{$record->type}}
                          </span>
                        </dd>
                  </div>
                </dl>
                <table class="mt-4 w-full whitespace-nowrap text-left text-sm leading-6">
                  <colgroup>
                    <col class="w-1/4">
                    <col>
                    <col>
                    <col>
                  </colgroup>
                  <thead class="border-b border-gray-200 text-gray-900">
                    <tr>
                      <th scope="col" class="px-0 py-3 font-semibold">Laboratory</th>
                      <th scope="col" class="hidden py-3 pl-8 pr-0 text-right font-semibold sm:table-cell">Test Date</th>
                      <th scope="col" class="hidden py-3 pl-8 pr-5 text-right font-semibold sm:table-cell">Result Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($record->laboratoryTests->count() > 0)
                    @foreach ($record->laboratoryTests as $test)
                    <tr class="border-b border-gray-100">
                      <td class="max-w-0 px-0 py-5 align-top">
                        @php
                        $result = App\Models\LaboratoryResult::where('laboratory_test_id', $test->id)->first();
                        @endphp
                        <div class="truncate font-medium text-gray-900">Test: {{$test->test}}</div>
                        <div class="truncate text-gray-500">Result: {{$result->result}}</div>
                      </td>
                      <td class="hidden py-5 pl-8 pr-0 text-right align-top tabular-nums text-gray-700 sm:table-cell">{{Carbon\Carbon::parse($test->created_at)->format('F d, Y h:i A')}}</td>
                      <td class="hidden py-5 pl-8 pr-5 text-right align-top tabular-nums text-gray-700 sm:table-cell">{{Carbon\Carbon::parse($result->created_at)->format('F d, Y h:i A')}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="border-b border-gray-100">
                      <td class="max-w-0 px-0 py-5 align-top">
                        <div class="truncate font-medium text-gray-900">No Laboratory Test added</div>
                        </td>
                    </tr>
                    @endif
                  </tbody>
                </table>
                <div class="relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                      <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center">
                    </div>
                  </div>

                <div class="mt-4">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Patient Vitals</h3>
                        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Vital signs recorded by the doctor</p>
                      </div>
                      <div class="mt-6 border-t border-gray-100">
                        <dl class="divide-y divide-gray-100">
                          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Temperature</dt>
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
                          <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Prescriptions</dt>
                            <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                              <span class="flex-grow">Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.</span>
                              <span class="ml-4 flex-shrink-0">
                                <button type="button" class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500">Update</button>
                              </span>
                            </dd>
                          </div>
                        </dl>
                      </div>

                </div>
              </div> --}}
    </div>
</div>
