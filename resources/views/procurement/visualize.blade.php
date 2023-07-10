@extends('layouts.app')

@section('title', 'Procurement Data Visualization')

@section('content')

<table class="table">
    @foreach($procurements as $proc)
<tr>
    <td>{{ $proc->firm_name }}</td>
    <td>{{ $proc->certificate_number }}</td>
</tr>
    @endforeach
</table>



@endsection
