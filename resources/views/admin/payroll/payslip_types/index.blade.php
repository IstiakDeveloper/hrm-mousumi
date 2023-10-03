@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Payslip Types</h1>
        <div>
            <a href="{{ route('payslip_types.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Payslip Type</a>
        </div>
    </div>
    @if (count($payslipTypes) > 0)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">ID</th>
                <th class="py-2 px-4 bg-gray-100">Payslip Type</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payslipTypes as $payslip)
            <tr>
                <td class="py-2 px-4 text-center">{{ $payslip->id }}</td>
                <td class="py-2 px-4 text-center">{{ $payslip->payslip_type }}</td>
                <td class="py-2 px-4 text-center">
                    <form class="inline-block" action="{{ route('payslip_types.destroy', $payslip) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-4">No Payslip types found.</p>
    @endif
</div>
@endsection
