<!-- Action column buttons -->
<div class="d-flex">
    <!-- View/Detail button -->

    <a href="javascript:void(0);" class="text-gray ms-1" data-bs-toggle="modal" data-bs-target="#viewModal{{ $employee->id }}" title="View">
        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
        </svg>
    </a>

    

    <!-- Edit button -->
    <a href="{{ route('employees.edit', $employee->id) }}" class="text-warning ms-1" data-bs-toggle="tooltip" title="Edit">
        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M17.621 2.379a3 3 0 00-4.243 0l-1.414 1.414a3 3 0 000 4.242l8.485 8.485a3 3 0 004.242-4.243L17.621 2.38zM14.207 4.793L15.793 6.379 13.414 8.758l-1.415-1.415L14.207 4.793zM2 18a2 2 0 002 2h12a2 2 0 002-2V6H2v12z" clip-rule="evenodd"></path>
        </svg>
    </a>

    <!-- Delete button -->
    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $employee->id }}">

        <svg class="icon icon-xs text-danger ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>
    </a>


</div>



<!-- View Modal -->
<div class="modal fade" id="viewModal{{ $employee->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel{{ $employee->id }}">Employee Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Display company details here -->
                <div>
                    <strong>Name:</strong> {{ $employee->first_name }}  {{ $employee->last_name }}
                </div>
                <div>
                    <strong>Email:</strong> {{ $employee->email }}
                </div>
               
                <div>
                    <strong>Phone:</strong> {{ $employee->phone }}
                </div>
                <div>
                    <strong>Company:</strong> {{ $employee->company->name }}
                </div>
               
                <div>
                    <strong>Created At:</strong> {{ $employee->created_at }}
                </div>

                <div>
                    <strong>Update At:</strong> {{ $employee->updated_at }}
                </div>
                <!-- Add more company details as necessary -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Delete confirmation -->

<div class="modal fade" id="deleteModal{{ $employee->id }}">


    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $employee->id }}">Delete Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Employee?
            </div>
            <div class="modal-footer">
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>