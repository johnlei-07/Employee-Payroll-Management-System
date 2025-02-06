<x-app-layout>
    

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    @if(session('success_updated'))
    <div class="alert alert-success d-flex align-items-center justify-content-center mt-3" role="alert" style="max-width: 50em; margin: 0 auto;">
        {{session ('success_updated')}}
    </div>
    @endif
    <div class="d-flex align-items-center justify-content-center mt-4 ">
        <table class="table table-borderless custom-table " style="max-width: 50em;">
            <thead class="table-dark">
                <tr>
                  <th class="fs-3 border-3">Empolyee Account</th>
                </tr>
            </thead>
            @if (Auth::user()->employees)
            <tbody>
                <tr>
                    <td><b>Email: </b> {{ (Auth::user()->email) }}</td>
                </tr>
                <tr>
                    <td><b>Password: </b> {{ (Auth::user()->password) }}</td>
                </tr>
                <tr>
                    <td><b>UserType: </b> {{ (Auth::user()->usertype) }}</td>
                </tr>
            </tbody>
            @endif
        </table>
    </div>

    <div class="d-flex align-items-center justify-content-center mt-2 ">
        <table class="table table-borderless custom-table " style="max-width: 50em;">
            <thead class="table-dark">
                <tr>
                  <th class="fs-3 border-3">Empolyee Profile</th>
                </tr>
            </thead>
            <tbody>
                @if (Auth::user()->employees)
                    <tr>
                        <td><b>Name: </b> {{ (Auth::user()->employees->Name) }}</td>
                    </tr>
                    <tr>
                        <td><b>Employee ID: </b> {{ (Auth::user()->employees->Employee_id) }}</td>
                    </tr>
                    <tr>
                        <td><b>Phone: </b> {{ (Auth::user()->employees->Phone) }}</td>
                    </tr>
                    <tr>
                        <td><b>Address: </b> {{ (Auth::user()->employees->Address) }}</td>
                    </tr>
                    <tr>
                        <td><b>Working Status: </b>{{ (Auth::user()->employees->WorkingStatus) }}</td>
                    </tr>
                    <tr>
                        <td><b>Department: </b>{{ (Auth::user()->employees->Department) }}</td>
                    </tr>
                @else
                    <tr>
                        <td>Salary no set</td>
                    </tr>
                @endif
              </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center align-items-center">
        <div class="card mt-2" style="max-width: 50em; width:100%;">
            <div class="card-header">
                <h3 style="display: inline;">Payslip</h3>
                <span class="fs-4" style="display: inline; margin-left: 5px;"> 
                    ( 
                    @if(\Carbon\Carbon::parse(Auth::user()->employees->PayslipStart)->year == \Carbon\Carbon::parse(Auth::user()->employees->PayslipEnd)->year)
                        {{ \Carbon\Carbon::parse(Auth::user()->employees->PayslipStart)->format('M j') }} - {{ \Carbon\Carbon::parse(Auth::user()->employees->PayslipEnd)->format('j, Y') }}
                    @else
                        {{ \Carbon\Carbon::parse(Auth::user()->employees->PayslipStart)->format('M j, Y') }} - {{ \Carbon\Carbon::parse(Auth::user()->employees->PayslipEnd)->format('M j, Y') }}
                    @endif
                    )
                </span>     
            </div>
            <div class="card-body"> 
                
                <p>Date Posted:<b> {{ (Auth::user()->employees->created_at)->format('F j, Y') }}
                    {{ (Auth::user()->employees->created_at)->timezone('Asia/Manila')->format('g:i A') }}</b>
                </p>
                <table class="table  custom-table " style="max-width: 50em;">
                    <thead class="table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Basic Salary: </b></td>
                            <td>{{ (Auth::user()->employees->BasicSalary) }}</td>
                        </tr>
                        <tr>
                            <td><b>No of Days: </b></td>
                            <td>{{ (Auth::user()->employees->NumDays) }}</td>
                        </tr>
                        <tr>
                            <td><b>OverTime: </b></td>
                            <td>{{ (Auth::user()->employees->OverTime) }}</td>
                        </tr>
                        <tr>
                            <td><b>Bonus: </b></td>
                            <td>{{ (Auth::user()->employees->Bonus) }}</td>
                        </tr>
                        <tr>
                            <td><b>Total: </b></td>
                            <td>{{ (Auth::user()->employees->Total) }} </td>
                        </tr>
                        <tr>
                            <td><b>Tax Deduction</b></td>
                            <td>{{ (Auth::user()->employees->TaxDeduction) }} </td>
                        </tr>
                        <tr>
                            <td><b>Insurance Deduction</b></td>
                            <td>{{ (Auth::user()->employees->InsuranceDeduction) }} </td>
                        </tr>
                        <tr>
                            <td><b>Net Salary</b></td>
                            <td>{{ (Auth::user()->employees->NetSalary) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
<style>
    .custom-table {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

</style>
</html>

{{-- @if (Auth::user()->employees)
BasicSalary: {{ (Auth::user()->employees->BasicSalary) }}<br>
Employee ID: {{ (Auth::user()->employees->Employee_id) }}
@else
         Salary not set.
@endif --}}

</x-app-layout>
