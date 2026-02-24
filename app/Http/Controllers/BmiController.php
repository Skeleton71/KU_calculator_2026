<?php

namespace App\Http\Controllers;

use App\Models\BmiRecord;
use Illuminate\Http\Request;

class BmiController extends Controller
{
    public function index()
    {
        return view('bmi.index');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:20|max:300',
            'height' => 'required|numeric|min:100|max:250',
        ]);

        $weight = $request->weight;
        $height = $request->height / 100; // convert cm to meters
        
        // Calculate BMI
        $bmi = round($weight / ($height * $height), 1);
        
        // Determine category
        if ($bmi < 18.5) {
            $category = 'Underweight';
            $color = 'bg-info';
            $textColor = 'text-info';
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            $category = 'Normal weight';
            $color = 'bg-success';
            $textColor = 'text-success';
        } elseif ($bmi >= 25 && $bmi < 30) {
            $category = 'Overweight';
            $color = 'bg-warning';
            $textColor = 'text-warning';
        } else {
            $category = 'Obese';
            $color = 'bg-danger';
            $textColor = 'text-danger';
        }

        // Save to database
        BmiRecord::create([
            'weight' => $weight,
            'height' => $request->height,
            'bmi' => $bmi,
            'category' => $category
        ]);

        return redirect()->route('bmi.index')
            ->with('success', 'BMI calculated successfully!')
            ->with('result', [
                'weight' => $weight,
                'height' => $request->height,
                'bmi' => $bmi,
                'category' => $category,
                'color' => $color,
                'text_color' => $textColor
            ]);
    }

    public function history()
    {
        $records = BmiRecord::latest()->paginate(10);
        return view('bmi.history', compact('records'));
    }
}