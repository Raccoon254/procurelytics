
<div>
    <label class="relative">
        <input class="input input-bordered h-10 w-full max-w-xs" wire:model="search" type="text" placeholder="Search any text...">
        <span class="absolute top-[-10px] right-1 text-[10px] text-gray-500">Powered by Raccoon</span>
    </label>

    <table class="table">
        <thead>
        <tr>
            <th>Firm Name</th>
            <th>Certificate Number</th>
            <th>AGPO Cert No</th>
            <th>Category</th>
            <th>Postal Address</th>
            <th>Directors</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Amount</th>
            <th>Spend Category</th>
            <th>Actions</th>
            <!-- Add other headers here -->
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->firm_name }}</td>
                <td>{{ $row->certificate_number }}</td>
                <td>{{ $row->agpo_cert_no }}</td>
                <td>{{ $row->category->name }}</td>
                <td>{{ $row->postal_address }}</td>
                <td>{{ implode(', ', $row->directors) }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->mobile_number }}</td>
                <td>{{ $row->amount }}</td>
                <td>{{ $row->spendCategory->name }}</td>
                <td title="View data for {{ $row->firm_name }} procurement }}">
                    <a href="{{ route('procurement.show', $row) }}" class="btn btn-circle ring">
                        <i class="fa-solid fa-mountain"></i>
                    </a>
                </td>
                <!-- Add other data cells here -->
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>

