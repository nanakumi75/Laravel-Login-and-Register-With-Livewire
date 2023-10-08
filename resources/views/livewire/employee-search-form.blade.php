<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h5 class="text-info text-center">Search Employees Database</h5>
             <div class="my-3 p-3 bg-light border rounded">
               <div class="input-group">
                 <input type="search" wire:model.live="search" name="search" placeholder="Search Employees Database" class="form-control form-control-lg">
                 <span class="input-group-text"><i class="bi bi-search"></i></span>
              </div> 
             </div>
            <table class="table table-bordered table-striped">
                <thead class="table-warning">
                    <tr>
                        <th>Employee First Name</th>
                        <th>Employee Last Name</th>
                        <th>Employee Email</th>
                        <th>Employee Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>{{ $employees->links() }}</p>
        </div>
    </div>
</div>