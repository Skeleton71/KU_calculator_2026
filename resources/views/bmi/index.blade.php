@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Calculate Your BMI</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bmi.calculate') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight (kg)</label>
                                <input type="number" step="0.1" class="form-control @error('weight') is-invalid @enderror" 
                                       id="weight" name="weight" value="{{ old('weight') }}" required>
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="height" class="form-label">Height (cm)</label>
                                <input type="number" step="0.1" class="form-control @error('height') is-invalid @enderror" 
                                       id="height" name="height" value="{{ old('height') }}" required>
                                @error('height')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Calculate BMI</button>
                        </form>
                    </div>
                </div>
            </div>

            @if(session('result'))
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-white {{ session('result')['color'] }}">
                            <h5 class="mb-0">Your Result</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Weight:</strong> {{ session('result')['weight'] }} kg</p>
                                    <p><strong>Height:</strong> {{ session('result')['height'] }} cm</p>
                                    <p><strong>BMI:</strong> {{ session('result')['bmi'] }}</p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Category:</strong></p>
                                    <p class="h4 text-center {{ session('result')['text_color'] }}">
                                        {{ session('result')['category'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">BMI Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="p-3 bg-info text-white rounded">
                                    <strong>Underweight</strong><br>
                                    BMI < 18.5
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-success text-white rounded">
                                    <strong>Normal</strong><br>
                                    18.5 - 24.9
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-warning text-white rounded">
                                    <strong>Overweight</strong><br>
                                    25 - 29.9
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 bg-danger text-white rounded">
                                    <strong>Obese</strong><br>
                                    BMI ≥ 30
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection