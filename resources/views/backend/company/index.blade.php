@extends('layouts.app')

@section('content')
<div class="container">
    <x-page-header title="Companies List" :breadcrumb-items="[
            ['url' => route('home'), 'label' => 'Home'],
            ['url' => '', 'label' => 'Companies List']
        ]" button-text="New Company" button-link="{{ route('companies.create') }}" />

    <div class="card card-body shadow border-0 table-wrapper table-responsive">
        <table class="table user-table table-hover align-items-center" id="companies-table">
            <thead>
               
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#companies-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('companies.data') }}", // Route to fetch data
            columns: [{
                    data: 'id',
                    name: 'id',
                    title: 'id'
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'name'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    title: 'Created At',

                },

                {
                    data: 'employee_count',
                    name: 'employee_count',
                    title: 'employee count',

                },

                
                {
                    data: 'website',
                    name: 'website',
                    title: 'Website',
                },
                {
                    data: 'logo',
                    name: 'logo',
                    title: 'Company Logo',
                    render: function(data, type, row) {
                        // Check if the logo field contains a valid URL
                        return data ? `<img src="{{ asset('${data}') }}" alt="Logo" width="100" height="100" />` : 'No Logo'; // Fallback text if no logo
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    title: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush