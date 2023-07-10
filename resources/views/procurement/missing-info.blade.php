@extends('layouts.app')

@section('content')

    <section class="flex relative flex-col gap-4 p-3 sm:p-6">

        <center class="text-2xl">Rows with complete information</center>
        <table class="table">
            <thead>
            <tr>
                <th>Firm Name</th>
                <th>Certificate Number</th>
                <th>AGPO Cert No</th>
                <th>Category</th>
                <th>Directors</th>
                <th>Postal Address</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Amount</th>
                <th>Spend Category</th>
                <th>Method of Procurement</th>
                <th>Procurement Number</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rowsWithMissingInfo as $row)
                <tr>
                    <td>{{ $row['FIRM NAME'] ?? 'Missing' }}</td>
                    <td>{{ $row['CERTIFICATE NO'] ?? 'Missing' }}</td>
                    <td>{{ $row['AGPO CERT NO'] ?? 'Missing' }}</td>
                    <td>{{ $row['CATEGORY'] ?? 'Missing' }}</td>
                    <td>{{ $row['DIRECTORS'] ?? 'Missing' }}</td>
                    <td>{{ $row['ADDRESS'] ?? 'Missing' }}</td>
                    <td>{{ $row['EMAIL'] ?? 'Missing' }}</td>
                    <td>{{ $row['CONTACT'] ?? 'Missing' }}</td>
                    <td>{{ $row['AMOUNT'] ?? 'Missing' }}</td>
                    <td>{{ $row['SPEND CATEGORY'] ?? 'Missing' }}</td>
                    <td>{{ $row['METHOD OF PROCUREMENT'] ?? 'Missing' }}</td>
                    <td>{{ $row['PROCUREMENT NUMBER'] ?? 'Missing' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <center class="text-2xl">Rows with complete information</center>
        <table class="table">
            <thead>
            <tr>
                <th>Firm Name</th>
                <th>Certificate Number</th>
                <th>AGPO Cert No</th>
                <th>Category</th>
                <th>Directors</th>
                <th>Postal Address</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Amount</th>
                <th>Spend Category</th>
                <th>Method of Procurement</th>
                <th>Procurement Number</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rowsWithFullInfo as $row)
                <tr>
                    <td>{{ $row['FIRM NAME'] }}</td>
                    <td>{{ $row['CERTIFICATE NO'] }}</td>
                    <td>{{ $row['AGPO CERT NO'] }}</td>
                    <td>{{ $row['CATEGORY'] }}</td>
                    <td>{{ $row['DIRECTORS'] }}</td>
                    <td>{{ $row['ADDRESS'] }}</td>
                    <td>{{ $row['EMAIL'] }}</td>
                    <td>{{ $row['CONTACT'] }}</td>
                    <td>{{ $row['AMOUNT'] }}</td>
                    <td>{{ $row['SPEND CATEGORY'] }}</td>
                    <td>{{ $row['METHOD OF PROCUREMENT'] }}</td>
                    <td>{{ $row['PROCUREMENT NUMBER'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Open the modal using ID.showModal() method -->
        <button class="btn absolute top-1 left-[10px] ring btn-circle" id="open_modal" onclick="my_modal_1.showModal()">
            <i class="fas fa-info"></i>
        </button>
        <dialog id="my_modal_1" class="modal">
            <form method="dialog" class="modal-box relative">
                <h3 class="font-bold text-lg">Missing Fields detected</h3>
                <p class="py-4">Please fix the following field on your Excell Sheet and try re-uploading</p>
                <div class="modal-action">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn absolute top-[10px] right-[10px] btn-circle ring">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </form>
        </dialog>

        <section class="flex justify-center gap-4">
            <div class="flex justify-center">
                <a href="{{ route('procurement.create') }}" class="btn btn-circle ring">
                    <i class="fa-solid fa-file-arrow-up"></i>
                </a>
            </div>

            <div class="flex justify-center">
                <a href="{{ route('procurement-data') }}" class="btn btn-circle ring">
                    <i class="fa-solid fa-clipboard-list"></i>
                </a>
            </div>

        </section>

    </section>

    <script>

        //on page load
        window.addEventListener('load', function () {
            //click on button to open modal
            //get the modal element
            var modal = document.getElementById('my_modal_1');
            //open modal
            modal.showModal();
        });

    </script>

@endsection
