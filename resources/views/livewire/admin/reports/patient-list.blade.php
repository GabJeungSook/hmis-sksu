@section('title', 'Patient List')
<div>
    <table id="example" class="table-auto mt-5" style="width:100%" x-ref="printContainer">
        <thead class="font-normal">
          <tr>
            <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
              Full Name
            </th>
            <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
                Guardian Name
            </th>
            <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
              Type
            </th>
            <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
              Birth Day
            </th>
            <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
              Contact Number
            </th>
            <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
              Address</th>
            <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
              Blood Type
            </th>
            <th class="border bg-blue-700   text-center px-2 text-sm font-medium text-white py-2 whitespace-nowrap">
              Initial Diagnosis
            </th>
          </tr>
        </thead>
        <tbody class="">
          @foreach ($patients as $item)
            <tr>
              <td class="border text-gray-600  px-3 py-1">{{ $item->name}}</td>
              <td class="border text-gray-600  px-3 py-1">{{ $item->guardian_name}}</td>
              <td class="border text-gray-600  px-3 py-1">{{ $item->type}}</td>
              <td class="border text-gray-600  px-3 py-1">{{ Carbon\Carbon::parse($item->birth_date)->format('F d, Y')}}</td>
              <td class="border text-gray-600  px-3 py-1">{{ $item->contact_number}}</td>
              <td class="border text-gray-600  px-3 py-1">{{ $item->address}}</td>
              <td class="border text-gray-600  px-3 py-1">{{ $item->blood_type}}</td>
              <td class="border text-gray-600  px-3 py-1">{{ $item->initial_diagnosis }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
