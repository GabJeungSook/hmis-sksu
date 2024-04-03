@section('title', 'Point Of Sale')
<div>
    <div class="grid grid-cols-2">
        <div class="col-span-1">
            <div class="mr-4 mt-5">
                {{$this->form}}
                <div class="mt-3">
                    {{ $this->addItemAction }}

                    <x-filament-actions::modals />
                </div>
            </div>
        </div>
  <!-- Order summary -->
  <div class="mt-10 lg:mt-0 col-span-1">
    <h2 class="text-lg font-medium text-gray-900">Order summary</h2>

    <div class="mt-4 rounded-lg border border-gray-200 bg-white shadow-sm">
      <h3 class="sr-only">Items in your cart</h3>
      <ul role="list" class="divide-y divide-gray-200">
        @if($selectedMedicines != null)
        @foreach ($selectedMedicines as $item)
        <li class="flex px-4 py-6 sm:px-6">
          <div class="ml-6 flex flex-1 flex-col">
            <div class="flex">
              <div class="min-w-0 flex-1">
                <h4 class="text-sm">
                  <a href="#" class="font-medium text-gray-700 hover:text-gray-800">{{$item['name']}}</a>
                </h4>
                <p class="mt-1 text-sm text-gray-500">{{$item['description']}}</p>
              </div>

              <div class="ml-4 flow-root flex-shrink-0">
                {{ ($this->removeItemAction)(['id' => $item['id']]) }}

                <x-filament-actions::modals />
                {{-- <button type="button" class="-m-2.5 flex items-center justify-center bg-white p-2.5 text-gray-400 hover:text-gray-500">
                  <span class="sr-only">Remove</span>
                  <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                  </svg>
                </button> --}}
              </div>
            </div>

            <div class="flex flex-1 items-end justify-between pt-2">
              <p class="mt-1 text-sm font-medium text-gray-900">₱ {{number_format($item['price'], 2)}}</p>

              <div class="ml-4">
                <label for="quantity" class="sr-only">Quantity</label>
                <input type="text" value="{{$item['quantity']}}">
                {{-- <select id="quantity" name="quantity" class="rounded-md border border-gray-300 text-left text-base font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>

                </select> --}}
              </div>
            </div>
          </div>
        </li>
        @endforeach
        <!-- More products... -->
      </ul>
      <dl class="space-y-6 border-t border-gray-200 px-4 py-6 sm:px-6">
        <div class="flex items-center justify-between">
          <dt class="text-sm">Subtotal</dt>
          <dd class="text-sm font-medium text-gray-900">₱ {{number_format($sub_total, 2)}}</dd>
        </div>
        {{-- <div class="flex items-center justify-between">
          <dt class="text-sm">Taxes</dt>
          <dd class="text-sm font-medium text-gray-900">$5.52</dd>
        </div> --}}
        <div class="flex items-center justify-between border-t border-gray-200 pt-6">
          <dt class="text-base font-medium">Total</dt>
          <dd class="text-base font-medium text-gray-900">$75.52</dd>
        </div>
      </dl>

      <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
        <button type="submit" class="w-full rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">Confirm order</button>
      </div>
    </div>
    @else
    <div class="p-6 text-center italic">
        <span class="text-sm text-gray-500 text-center">No items added yet</span>
    </div>

    @endif
  </div>
</form>
</div>
    </div>
</div>
