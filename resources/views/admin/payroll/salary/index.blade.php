<!-- resources/views/salary/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employees</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->name }}</td>
                <td>
                    <a href="{{ route('salary.setSalary', $employee->id) }}" class="btn btn-primary">Set Salary</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
