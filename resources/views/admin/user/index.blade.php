@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"><div class="heading">
                        <H2> Imams List</H2>
                    </div>
            <div class="card">
                <div class="container">
                    
                <table class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th> 
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                    @foreach($users as $key => $user)
                      <tr>
                        <td>{{ $user->name }}</td> 
                        <td>{{ $user->email }}</td> 
                        <td>{{ $user->phone_number }}</td> 
                        <td>{{ $user->address }}</td>  
                        <td>{{ $user->created_at->diffForHumans() }}</td> 
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-small">Edit</a> 
                        </td> 
                      </tr>
                    @endforeach
                    </tbody>
                  </table>{!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
                 
                
            </div>
        </div>
    </div>
</div>
@endsection
