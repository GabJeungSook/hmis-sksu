@section('title', 'Manage Stocks')
<div>
    <div class="flex justify-start">
        <div>
            {{ $this->returnAction }}
        </div>
    </div>
    <div class="mt-8 poppins-light w-full">
        <div class="">
            <div class="sm:flex sm:items-center">
              <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Stock History</h1>
                <p class="mt-2 text-sm text-gray-700">Here is the stock history for this medicine</p>
              </div>
              <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                {{($this->addStockAction)(['id' => $record->id])}}
                <x-filament-actions::modals />
              </div>
            </div>
            <div class="mt-8 flow-root">
              <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                  @if($record->stocks->isNotEmpty())
                  <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                      <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Category</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Quantity</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date Added</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($record->stocks as $stock)
                        <tr>
                            {{-- <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{$record->category->name}}</td> --}}
                            <td class="whitespace-nowrap px-1 py-4 text-sm text-gray-500">{{$record->category->name}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$record->name}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">₱ {{number_format($record->price, 2)}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$stock->quantity}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{Carbon\Carbon::parse($stock->created_at)->format('F d, Y h:i A')}}</td>
                          </tr>
                        @endforeach
                      <!-- More people... -->
                    </tbody>
                  </table>
                  @else
                    <div class="flex justify-center items-center h-64">
                        <p class="text-gray-500">No stocks available</p>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>


    </div>
</div>
