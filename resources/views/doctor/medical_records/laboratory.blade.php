<div class="bg-blue-50 p-5 rounded-md shadow-md">
    <div>
        <div class="px-4 sm:px-0">
          <h3 class="text-base font-semibold leading-7 text-gray-900">{{$record->name}} (Patient)</h3>
          <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{$record->guardian_name}} (Guardian)</p>
        </div>
        <div class="mt-6 border-t border-gray-100">
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
        </div>
      </div>

</div>

