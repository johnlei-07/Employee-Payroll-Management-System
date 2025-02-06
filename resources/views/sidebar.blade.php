<nav class="nav flex-column bg-dark vh-100 text-white" style="width: 20rem;">
    <a href="{{route('admin/dashboard')}} " class="text-decoration-none fs-2 text-white text-center mt-4">Dashboard</a>
     <div class="mt-5 mx-3">
         <p class="">Interface</p>
         {{-- employee --}}
         <p class="">Employee:</p>
             <a class="nav-link" href="{{route('auth.register')}}">Add Employee</a>
             <a class="nav-link" href="{{route ('auth.admin.employees')}}">View Employees</a>
         {{-- users --}}
         <p class="">User Account:</p>
             <a class="nav-link" href="{{route('auth.admin.create_admin')}}">Create Admin</a>     
             <a class="nav-link" href="{{route('auth.admin.admins')}}">View Admin</a>
         {{-- admin --}}
         <p class="mt-3">Admin:</p>
             <form method="POST" action="{{ route('logout') }}">
                 @csrf
 
                 <a class="nav-link" href="{{route('logout')}}"
                 onclick="event.preventDefault();
                 this.closest('form').submit();">
                 {{ __('Log Out') }}
                 </a>
             </form>
     </div>
 </nav>
 
 <style>
     .nav-link{
         color: white;
     }
     .nav-link:hover{
         color: black;
         font-weight: bold;
         background-color: white;
         transition: 0.5s;
     }
     .dropdown-item:hover{
         background-color:black ;
         color: white;
     }
   </style>