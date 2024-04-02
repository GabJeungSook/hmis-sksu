<div class="bg-blue-50 p-5 rounded-md shadow-md">
    <div>
        <div class="px-4 sm:px-0">
          <h3 class="text-base font-semibold leading-7 text-gray-900">{{$record->name}} (Patient)</h3>
          <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{$record->guardian_name}} (Guardian)</p>
        </div>
        <div class="mt-6 border-t border-gray-100">
            @if($record->bed != null)
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">Room</dt>
                  <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <span class="flex-grow">{{$record->bed->room->name}}</span>
                  </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">Bed</dt>
                  <dd class="mt-1 flex text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <span class="flex-grow">{{$record->bed->name}}</span>
                  </dd>
                </div>
              </dl>
            @else
            {{$this->assignRoomAction}}
            <x-filament-actions::modals />
            @endif
          </div>
      </div>

</div>

