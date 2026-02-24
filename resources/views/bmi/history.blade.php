@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">BMI Calculation History</h4>
            </div>
            <div class="card-body">
                @if($records->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Weight (kg)</th>
                                    <th>Height (cm)</th>
                                    <th>BMI</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <td>{{ $record->created_at->format('d.m.Y H:i') }}</td>
                                        <td>{{ $record->weight }}</td>
                                        <td>{{ $record->height }}</td>
                                        <td>{{ number_format($record->bmi, 1) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $record->category == 'Normal weight' ? 'success' : ($record->category == 'Underweight' ? 'info' : ($record->category == 'Overweight' ? 'warning' : 'danger')) }}">
                                                {{ $record->category }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $records->links() }}
                @else
                    <p class="text-muted text-center mb-0">No calculations yet. <a href="{{ route('bmi.index') }}">Calculate your first BMI!</a></p>
                @endif
            </div>
        </div>
    </div>
@endsection