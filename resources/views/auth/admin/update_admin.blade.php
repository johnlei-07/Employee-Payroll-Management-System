@extends('layout.layout')
    @section('content')
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error}}</li>
        @endforeach
    </ul>
    <form method="POST" action="{{ route('auth.admin.update_admin', $user->id) }}">
        @csrf
        @method('PUT')
        <!-- Name -->
        <!-- Email Address -->
        <div class="p-4 rounded-0 shadow-lg m-4">
      
            <div class="row ">
                <h1>Create Admin</h1>
                <div class="col">
                    <label class="fw-bold fs-5" for="email">Email</label>
                    <input id="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" 
                    name="email" value="{{ $user->email }}" required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
                <div class="col">
                    <label class="fw-bold fs-5" for="password">Password</label>
                    <input id="password" type="password" class="form-control" placeholder="Password" aria-label="Password"
                    value="{{ $user->password }}" name="password" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="col">
                    <label class="fw-bold fs-5" for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password"
                    value="{{ $user->password }}" name="password_confirmation" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                </div>
            </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('auth.admin.employees') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
@endsection('content')
