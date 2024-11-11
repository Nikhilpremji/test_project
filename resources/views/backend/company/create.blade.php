@extends('layouts.app')

@section('content')
<div class="container">
    <x-page-header title="Companies Create" :breadcrumb-items="[
            ['url' => route('home'), 'label' => 'Home'],
            ['url' => '', 'label' => 'Companies Create']
        ]" button-text="" button-link="" />



    <div class="row justify-content-center">
        <div class="col-12 col-xl-8 ">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">General information</h2>

                @if ($errors->any())
                <div class="text-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <x-form-input
                                label="Companie"
                                id="name"
                                name="name"
                                placeholder="Enter your companie name"
                                required="true" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <x-form-input
                                label="Companie Website"
                                id="website"
                                name="website"
                                placeholder="Enter your website"
                                 />
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-12 mb-3">
                            <x-form-input
                                label="Logo"
                                type="file"
                                id="logo"
                                name="logo"
                                placeholder="Uplod Logo"
                                 />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <x-form-input
                                label="Companie Email"
                                id="email"
                                name="email"
                                type="email"
                                placeholder="Enter your companie Email"
                                />
                        </div>

                    </div>
                    <div class="mt-3"><button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Save</button></div>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection