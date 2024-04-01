@section('title', 'Manage Beds')
<div>
    <div class="flex justify-end">
        <div>
            {{ $this->returnAction }}
        </div>
    </div>
    <div class="mt-4 poppins-light">
        <div>
            <div class="px-4 sm:px-0">
              <h3 class="text-2xl font-semibold leading-7 text-gray-900">{{ucfirst($record->name)}}</h3>
            </div>
            <div class="mt-6 border-t border-gray-100">
              <dl class="divide-y divide-gray-100">
                <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm font-medium leading-6 text-gray-900">Description</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->description != null ? $record->description : 'No Description added'}}</dd>
                </div>
                <div class="bg-white px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3">
                  <dt class="text-sm font-medium leading-6 text-gray-900">Beds</dt>
                  <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                    @if($record->beds->count() > 0)
                        @foreach($record->beds as $bed)
                    <ul role="list" class="px-4 divide-y divide-gray-100 rounded-md border border-gray-200 my-2">
                      <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                        <div class="flex w-0 flex-1 items-center space-x-3">
                            <svg class="h-6 w-6 shrink-0 text-blue-600" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.775 6C7.22236 6 8.4 4.87844 8.4 3.5C8.4 2.12156 7.22236 1 5.775 1C4.32764 1 3.15 2.12156 3.15 3.5C3.15 4.87844 4.32764 6 5.775 6ZM17.325 2H9.975C9.68494 2 9.45 2.22375 9.45 2.5V7H2.1V0.5C2.1 0.22375 1.86506 0 1.575 0H0.525C0.234937 0 0 0.22375 0 0.5V11.5C0 11.7762 0.234937 12 0.525 12H1.575C1.86506 12 2.1 11.7762 2.1 11.5V10H18.9V11.5C18.9 11.7762 19.1349 12 19.425 12H20.475C20.7651 12 21 11.7762 21 11.5V5.5C21 3.56687 19.3548 2 17.325 2Z"
                                fill="#5B5B5B"/>
                            </svg>
                          <div class="ml-5 flex min-w-0 flex-1 gap-2">
                            <span class="truncate font-medium">{{$bed->name}}</span>
                          </div>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                          {{ ($this->updateBedAction)(['id' => $bed->id]) }}
                        </div>
                      </li>
                    </ul>
                        @endforeach
                    @else
                    <p class="text-sm leading-6 text-gray-700">No Beds added</p>
                    @endif
                    <div class="flex justify-end mt-4">
                        {{ $this->addBedAction }}
                        <x-filament-actions::modals />
                    </div>
                  </dd>
                </div>
              </dl>
            </div>
          </div>

    </div>
</div>
