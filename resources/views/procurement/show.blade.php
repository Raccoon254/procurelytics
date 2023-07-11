@extends('layouts.app')

@section('content')
    <div class="z-50">
        @include('layouts.sidebar')
    </div>

    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 text-2xl fw-bold">{{ $procurement->firm_name }}&nbsp;{{ $procurement->created_at->diffForHumans() }}</h1>
    </div>

    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="card bordered">
                <figure>
                    <i class="fas fa-certificate text-blue-500 text-2xl"></i>
                </figure>
                <div class="card-body">
                    <p class="z-30 card-title">Certificate Number</p>
                    <p>{{ $procurement->certificate_number }}</p>
                </div>
            </div>

            <div class="card bordered">
                <figure>
                    <i class="fas fa-id-badge text-green-500 text-2xl"></i>
                </figure>
                <div class="card-body">
                    <p class="z-30 card-title">AGPO Cert. No.</p>
                    <p>{{ $procurement->agpo_cert_no }}</p>
                </div>
            </div>

            <div class="card bordered">
                <figure>
                    <i class="fas fa-tags text-red-500 text-2xl"></i>
                </figure>
                <div class="card-body">
                    <p class="z-30 card-title">Category</p>
                    <p>{{ $procurement->category->name }}</p>
                </div>
            </div>

            <div class="card bordered">
                <figure>
                    <i class="fas fa-user-tie text-purple-500 text-2xl"></i>
                </figure>
                <div class="card-body">
                    <p class="z-30 card-title">Directors</p>
                    @foreach($procurement->directors as $director)
                        <p>{{ $director }}</p>
                    @endforeach
                </div>
            </div>

            <div class="card bordered">
                <figure>
                    <i class="fas fa-envelope text-yellow-500 text-2xl"></i>
                </figure>
                <div class="card-body">
                    <p class="z-30 card-title">Email</p>
                    <p>{{ $procurement->email }}</p>
                </div>
            </div>

            <div class="card bordered">
                <figure>
                    <i class="fas fa-phone text-indigo-500 text-2xl"></i>
                </figure>
                <div class="card-body">
                    <p class="z-30 card-title">Mobile Number</p>
                    <p>{{ $procurement->mobile_number }}</p>
                </div>
            </div>

            <div class="card bordered">
                <figure>
                    <i class="fas fa-dollar-sign text-green-500 text-2xl"></i>
                </figure>
                <div class="card-body">
                    <p class="z-30 card-title">Amount</p>
                    <p>{{ $procurement->amount }}</p>
                </div>
            </div>

            <div class="card bordered">
                <figure>
                    <i class="fas fa-shopping-cart text-pink-500 text-2xl"></i>
                </figure>
                <div class="card-body">
                    <p class="z-30 card-title">Procurement Number</p>
                    <p>{{ $procurement->procurement_number }}</p>
                </div>
            </div>

            <div class="card bordered">
                <figure>
                    <i class="fas fa-handshake text-blue-500 text-2xl"></i>
                </figure>
                <div class="card-body">
                    <p class="z-30 card-title">Procurement Method</p>
                    <p>{{ $procurement->procurement_method }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
