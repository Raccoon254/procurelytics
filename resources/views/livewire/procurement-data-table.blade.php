<div>
    <label>
        <input wire:model="search" type="text" placeholder="Search...">
    </label>

    <table class="table-auto">
        <thead>
        <tr>
            <th class="px-4 py-2">Firm Name</th>
            <th class="px-4 py-2">Certificate Number</th>
            <!-- Add other headers here -->
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td class="border px-4 py-2">{{ $row->firm_name }}</td>
                <td class="border px-4 py-2">{{ $row->certificate_number }}</td>
                <!-- Add other data cells here -->
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>
