@section('title', 'Patient Cases')
<div>
    <div class="flex justify-end">
        <div class="flex">
            <div class="px-1">
                <x-filament::button  type="button" icon="heroicon-o-printer" class="btn btn-primary w-32" onclick="printDiv('printarea')">Print</x-filament::button>
            </div>
        </div>

    </div>
    <div id="printarea">
        <table id="example" class="table-auto mt-5" style="width:100%" >
            <thead class="font-normal">
              <tr>
                <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                  Full Name
                </th>
                <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                    Full Address
                </th>
                <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                  Gender
                </th>
                <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                  Birthday
                </th>
                <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                  Date Added
                </th>
              </tr>
            </thead>
            <tbody class="">
              @foreach ($patients as $item)
                <tr>
                  <td class="border text-gray-600  px-3 py-1">{{ $item->first_name}} {{ $item->last_name }}</td>
                  <td class="border text-gray-600  px-3 py-1">{{ $item->full_address}}</td>
                  <td class="border text-gray-600  px-3 py-1">{{ $item->gender}}</td>
                  <td class="border text-gray-600  px-3 py-1">{{ Carbon\Carbon::parse($item->birthday)->format('F d, Y')}}</td>
                  <td class="border text-gray-600  px-3 py-1">{{ Carbon\Carbon::parse($item->created_at)->format('F d, Y')}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
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
