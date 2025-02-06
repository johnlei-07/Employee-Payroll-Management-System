@extends('layout.layout')
    @section('content')
    
 
    <form method="POST" action="{{ route('auth.admin.update', $user->id) }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <!-- Email Address -->
        <div class="p-4 rounded-0 shadow-lg m-4">
      
            <div class="row ">
                <h1>Update Account</h1>
                <div class="col">
                    <label class="fw-bold fs-5" for="email">Email</label>
                    <input id="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" 
                    name="email" value="{{ $user->email }}" required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>
                <div class="col">
                    <label class="fw-bold fs-5" for="password">Password</label>
                    <input id="password" type="password" class="form-control" placeholder="Password" aria-label="Password"
                        name="password" value="{{ $user->password }}" required autocomplete="new-password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label class="fw-bold fs-5" for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password"
                    name="password_confirmation"  value="{{ $user->password }}" required autocomplete="new-password">
                    @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                     @enderror

                </div>
            </div>

            

            <div class="row">
                <h1 class="mt-3">Employee Profile</h1>
                <div class="col"> 
                    <label class="fw-bold fs-5" for="Name">Name</label>
                    <input id="Name" type="text" class="form-control" id="floatingInput" placeholder="Name" 
                    name="Name" value="{{$user->employees->Name}}" required autocomplete="Name">
                    <x-input-error :messages="$errors->get('Name')" class="mt-2" />
                </div>
                <div class="col">
                    <label class="fw-bold fs-5" for="Phone">Phone</label>
                    <input id="Phone" type="number" class="form-control" id="floatingInput" placeholder="Phone" 
                    name="Phone" value="{{$user->employees->Phone}}" required autocomplete="Phone">
                    <x-input-error :messages="$errors->get('Phone')" class="mt-2" />
                </div>
                <div class="col">
                    <label class="fw-bold fs-5" for="WorkingStatus">Working Status</label>
                    <select class="form-select" id="WorkingStatus" name="WorkingStatus" required>
                        <option selected disabled>Select WorkingStatus</option>
                        <option value="Full Time" {{($user->employees->WorkingStatus) == 'Full Time' ? 'selected' : ''}}>Full Time</option>
                        <option value="Part Time" {{($user->employees->WorkingStatus) == 'Part Time' ? 'selected' : ''}}>Part Time</option>
                    </select>
                    <x-input-error :messages="$errors->get('WorkingStatus')" class="mt-2" />
                </div>
            </div>

            <div class="row mt-4">
                <div class="col"> 
                    <label class="fw-bold fs-5" for="Address">Address</label>
                    <input id="Address" type="text" class="form-control" id="floatingInput" placeholder="Address" 
                    name="Address" value="{{$user->employees->Address}}" required autocomplete="Address">
                    <x-input-error :messages="$errors->get('Address')" class="mt-2" />
                </div>
                <div class="col">
                    <label class="fw-bold fs-5" for="Department">Department</label>
                    <select class="form-select" id="Department" name="Department" required>
                        <option selected disabled>Select Department</option>
                        <option value="IT" {{($user->employees->Department) == 'IT' ? 'selected' : ''}}>IT</option>
                        <option value="Marketing" {{($user->employees->Department) == 'Marketing' ? 'selected' : ''}}>Marketing</option>
                        <option value="Sales" {{($user->employees->Department) == 'Sales' ? 'selected' : ''}}>Sales</option>
                        <option value="Researcher" {{($user->employees->Department) == 'Researcher' ? 'selected' : ''}}>Researcher</option>
                        <option value="Finance" {{($user->employees->Department) == 'Finance' ? 'selected' : ''}}>Finance</option>
                    </select>
                    <x-input-error :messages="$errors->get('Department')" class="mt-2" />
                </div> 
            </div>

            <div class="row mt-3">
                <h1>Payslip</h1>
                <div class="col">
                    <label class="fw-bold fs-5" for="BasicSalary">BasicSalary</label>
                    <input id="BasicSalary" type="number" class="form-control" id="floatingInput" placeholder="Basic Salary" 
                    name="BasicSalary" value={{$user->employees->BasicSalary}} required autocomplete="BasicSalary">
                    <x-input-error :messages="$errors->get('BasicSalary')" class="mt-2" />
                  </div>
                <div class="col">
                    <label class="fw-bold fs-5" for="OverTime">OverTime</label>
                    <input id="OverTime" type="number" class="form-control" placeholder="OverTime" aria-label="Confirm Password"
                    name="OverTime" value={{$user->employees->OverTime}} required autocomplete="Overtime">
                    <x-input-error :messages="$errors->get('OverTime')" class="mt-2" />

                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label class="fw-bold fs-5" for="Bonus">Bonus</label>
                        <input id="Bonus" type="number" class="form-control" id="floatingInput" placeholder="Basic Salary" 
                        name="Bonus" value={{$user->employees->Bonus}} required autocomplete="Bonus">
                        <x-input-error :messages="$errors->get('Bonus')" class="mt-2" />
                      </div>
                      <div class="col">
                        <label class="fw-bold fs-5" for="Numdays">Numdays</label>
                        <input id="Numdays" type="number" class="form-control" placeholder="Numdays" aria-label="Numdays"
                            name="Numdays" value={{$user->employees->NumDays}} required autocomplete="Numdays">
                        <x-input-error :messages="$errors->get('Numdays')" class="mt-2" />
                    </div>
                </div>

                
                <div class="row mt-4">
                    <h1>Payslip Information</h1>
                    <div class="col">
                        <label class="fw-bold fs-5" for="PayslipStart">Payslip Start Date</label>
                        <input id="PayslipStart" type="date" class="form-control" name="PayslipStart" 
                        value={{$user->employees->PayslipStart}} required>
                        <x-input-error :messages="$errors->get('PayslipStart')" class="mt-2" />
                    </div>
                    <div class="col">
                        <label class="fw-bold fs-5" for="PayslipEnd">Payslip End Date</label>
                        <input id="PayslipEnd" type="date" class="form-control" name="PayslipEnd" required
                        value={{$user->employees->PayslipEnd}}>
                        <x-input-error :messages="$errors->get('PayslipEnd')" class="mt-2" />
                    </div>
                </div>
        </div>
        

        <!-- Email Address -->
        {{-- <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> --}}

        <!-- Password -->
        {{-- <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> --}}

        <!-- Confirm Password -->
        {{-- <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> --}}

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
@endsection('content')
