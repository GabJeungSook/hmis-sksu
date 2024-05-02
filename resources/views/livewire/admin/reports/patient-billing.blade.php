@section('title', 'Patient Bill')
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
                  Patient Name
                </th>
                <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                  Guardian Name
                </th>
                <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                  Total Bill
                </th>
                <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                  Amount Paid
                </th>
                <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                  Change
                </th>
                <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                    Payment Date
                </th>
              </tr>
            </thead>
            <tbody class="">
              @foreach ($billing as $item)
                <tr>
                  <td class="border text-gray-600  px-3 py-1">{{ $item->patient->name}}</td>
                  <td class="border text-gray-600  px-3 py-1">{{ $item->patient->guardian_name}}</td>
                  <td class="border text-gray-600  px-3 py-1">₱ {{number_format($item->total, 2) }}</td>
                  <td class="border text-gray-600  px-3 py-1">₱ {{number_format($item->amount_paid, 2) }}</td>
                  <td class="border text-gray-600  px-3 py-1">₱ {{number_format($item->change, 2) }}</td>
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
