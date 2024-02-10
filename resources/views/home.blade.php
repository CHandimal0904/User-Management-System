@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">User Name </th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Action</th>
                    <th scope="col">View</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)  
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->user_name}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->status}}</td>
                    {{-- <td>{{$user->}}</td> --}}
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" onchange="updateStatus('{{$user->id}}')"
                            {{ $user->is_active == 1 ? 'checked' : '' }} name="userStatus" id="userStatus">
                        </div>
                    </td>
                    <td>
                        <i class="fa fa-eye text-primary" data-toggle="modal" data-target="#userModal{{$user->id}}" ></i>
                    </td>
                  </tr> 

 <!-- Modal -->
 <div class="modal fade" id="userModal{{$user->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>
       </div>
       <div class="modal-body">
       <div class="row">
           <div class="col-md-6 mb-3">
               <label>ID</label>
               <input type="text" class="form-control" value="{{$user->id}}" name="id">
           </div>
           <div class="col-md-6 mb-3" >
            <label>User Name</label>
               <input type="text" class="form-control" value="{{$user->user_name}}" name="id">
           </div>
           <div class="col-md-6 mb-3">
            <label>Name</label>
               <input type="text" class="form-control" value="{{$user->name}}" name="id">
           </div>
           <div class="col-md-6 mb-3">
            <label>Email</label>
               <input type="text" class="form-control" value="{{$user->email}}" name="id">
           </div>
           <div class="col-md-6 mb-3">
            <label>User Type</label>
               <input type="text" class="form-control" value="{{$user->status}}" name="id">
           </div>
       </div>
       </div>
       <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div>
   </div>
   </div>
</div>

                  @endforeach
                
                </tbody>
              </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
        function updateStatus(id) {
            var status = document.getElementById('userStatus').checked;

            $.ajax({
                url: "{{ route('updateUserAvailability') }}",
                method: 'POST',
                dataType: "json",
                data: {
                    id: id,
                    status: status,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    alert('Success');
                },
                error: function (xhr, status, error) {
                    alert('Failed');
                }
            });
}

</script>

@endsection
