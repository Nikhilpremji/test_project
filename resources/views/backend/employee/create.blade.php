@extends('layouts.app')

@section('content')
<div class="container">
    <x-page-header title="Employees Create" :breadcrumb-items="[
            ['url' => route('home'), 'label' => 'Home'],
            ['url' => '', 'label' => 'Employees Create']
        ]" button-text="" button-link="" />



    <div class="row justify-content-center">
        <div class="col-12 col-xl-8 ">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">Employee information</h2>

                @if ($errors->any())
                <div class="text-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <x-form-input
                                label="First Name"
                                id="first_name"
                                name="first_name"
                                placeholder="Enter your first_name"
                                required="true" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <x-form-input
                                label="Last Name"
                                id="last_name"
                                name="last_name"
                                placeholder="Enter your last_name" />
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-12 mb-3">
                            <x-form-select
                                label="Select Company"
                                name="company_id"
                                :options="$companies"
                                placeholder="Choose a company" />


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <x-form-input
                                label="Email"
                                id="email"
                                name="email"
                                type="email"
                                placeholder="Enter Email Id" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <x-form-input
                                label="Phone"
                                id="phone"
                                name="phone"
                                type="phone"
                                placeholder="Enter Phone Number" />
                        </div>

                    </div>
                    <div class="mt-3"><button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Save</button></div>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection