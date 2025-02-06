@extends('layout.layout')

@section('content')
  <h1>Employee Details</h1>

  @if(session('success_created'))
  <div class="alert alert-primary" role="alert">
      {{session ('success_created')}}
  </div>
  @endif
  @if(session('success_updated'))
  <div class="alert alert-primary" role="alert">
      {{session ('success_updated')}}
  </div>
  @endif

  @if(session('success_deleted'))
        <div class="alert alert-warning" role="alert">
            {{session ('success_deleted')}}
        </div>
  @endif
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Email</th>
        <th>User Type</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @if ($employees->isEmpty())
        <tr>
          <td colspan="4">No Employee found.</td>
        </tr>
      @else
        @foreach ($users as $user)
        @if ($user->usertype === 'employee')
          <tr>
            
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td> <!-- Assuming you have a relationship between Employee and User -->
            <td>{{ $user->usertype }}</td> <!-- User type if it's defined in your user model -->
            <td>
              <!-- Add actions like Edit, Delete -->
              <form action="{{route ('auth.admin.view', $user->id)}}" method="POST" style="display:inline">
                @csrf
                @method('GET')
                <button class="btn btn-primary" type="submit"
                onclick="return confirm('Are you sure you want to view this employee?')">
                View</button>
              </form>
              {{-- <a href="{{ route('auth.admin.view', $user->id) }}">View</a> --}}

              <form action="{{route('auth.admin.edit', $user->id)}}"  method="POST" style="display:inline">
                @csrf
                @method('GET')
                <button class="btn btn-success" type="submit" 
                onclick="return confirm('Are you sure you want to Edit this employee?')">
                Edit</button>
              </form>
              
              {{-- <a href="{{ route('auth.admin.edit', $user->id) }}">Edit</a> --}}

             <form action="{{ route('auth.admin.delete', $user->id) }}" method="POST" style="display:inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit"
              onclick="return confirm('Are you sure you want to Delete this employee?')"
              >Delete</button>
            </form>          
            </td>
          </tr>
          @endif
        @endforeach
      @endif
    </tbody>
  </table>
@endsection
