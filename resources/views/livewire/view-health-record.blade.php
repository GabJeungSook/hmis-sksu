<div  id="print-area">
    @section('title', 'Student Health Report')

    <!-- Print Button -->
    <div class="flex justify-end mb-4">
        <button onclick="window.print()" class="p-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 print:hidden">
            Print Report
        </button>
    </div>

    <!-- Student Info -->
    <div class="border-b pb-4 mb-6">
        <h2 class="text-xl font-bold mb-2">Student Information</h2>
        <div class="space-y-3 border-y text-gray-700">
            <p><strong>Full Name:</strong> {{ $record->first_name }} {{ $record->last_name }}</p>
            <p><strong>Address:</strong> {{ $record->full_address }}</p>
            <p><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($record->birthday)->format('F d, Y') }}</p>
            <p><strong>Gender:</strong> {{ ucfirst($record->gender) }}</p>
        </div>
    </div>

    <!-- Health Records -->
    <div>
        <h2 class="text-xl font-bold mb-2">Health Records</h2>
        @if($record->healthRecords && $record->healthRecords->count())
            <table class="w-full border-collapse border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">Health Record</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Date Recorded</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($record->healthRecords as $hr)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $hr->health_record }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($hr->date_recorded)->format('F d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500 italic">No health records found.</p>
        @endif
    </div>
    <!-- Optional: Print Styling -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #print-area, #print-area * {
            visibility: visible;
        }

        #print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .print\:hidden {
            display: none !important;
        }
    }
</style>
</div>


