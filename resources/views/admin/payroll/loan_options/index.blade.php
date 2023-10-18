@extends('layouts.app')

@section('content')
<div class="container mx-auto py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">loan Option</h1>
        <div>
            <a href="{{ route('loan_options.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create Loan Option</a>
        </div>
    </div>
    @if (count($loanOptions) > 0)
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100">SL</th>
                <th class="py-2 px-4 bg-gray-100">loan Option</th>
                <th class="py-2 px-4 bg-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($loanOptions as $key=> $loan)
            <tr>
                <td class="py-2 px-4 text-center">{{ $key+1}}</td>
                <td class="py-2 px-4 text-center">{{ $loan->loan_option }}</td>
                <td class="py-2 px-4 text-center">
                    <form class="inline-block" action="{{ route('loan_options.destroy', $loan) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="mt-4">No Loan option found.</p>
    @endif
</div>
@endsection
