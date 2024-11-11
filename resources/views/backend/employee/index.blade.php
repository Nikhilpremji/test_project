@extends('layouts.app')

@section('content')

<div class="container">
    <x-page-header
        title="Employees List"
        :breadcrumb-items="[
        ['url' => route('home'), 'label' => 'Home'],
        ['url' => '', 'label' => 'Employees List']
    ]"
        button-text="New Employees"
        button-link="{{ route('employees.create') }}" />


        <div class="card card-body shadow border-0 table-wrapper table-responsive">
        <table class="table user-table table-hover align-items-center" id="employee-table">
            
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#employee-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employees.data') }}", // Route to fetch data
            columns: [{
                    data: 'id',
                    name: 'id',
                    title: 'id'
                },
                {
                    data: 'first_name',
                    name: 'first_name',
                    title: 'name'
                },
                {
                    data: 'company_name',
                    name: 'company_name',
                    title: 'Company Name',

                },
                {
                    data: 'email',
                    name: 'email',
                    title: 'email',
                },
                {
                    data: 'phone',
                    name: 'phone',
                    title: 'Phone',
                    
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush