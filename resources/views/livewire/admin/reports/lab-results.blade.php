@section('title', 'Lab Results')
<div>
      <div class="flex justify-end">
        <div class="flex">
            <div class="px-1">
                <x-filament::button  type="button" icon="heroicon-o-printer" class="btn btn-primary w-32" onclick="printDiv('printarea')">Print</x-filament::button>
            </div>
        </div>
    </div>
    <div  class="px-4 sm:px-6 lg:px-8">
        <div id="printarea" class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <table class="min-w-full">
                <tbody class="bg-white">
                  @forelse ($labResults as $item)
                  <tr class="border-t border-gray-200">
                    <th colspan="5" scope="colgroup" class="bg-gray-50 py-2 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">Patient Name : {{$item->name}}</th>
                  </tr>
                  @foreach ($item->laboratoryTests as $test)
                  @php
                  $result = App\Models\LaboratoryResult::where('laboratory_test_id', $test->id)->first();
                  @endphp
                  <tr class="border-t border-gray-300">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">Laboratory Test : </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $test->test}}</td>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">Result : </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$result != null ? $result->result : 'No Result Yet'}}</td>
                  </tr>
     
                  <tr class="border-t border-gray-200">
                    
                  </tr>
                  @endforeach
                  
                  @empty
                      <tr class="col-span-4 text-center">
                        <span>No Record Yet</span>
                      </tr>
                  @endforelse
                 
                  

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</div>
