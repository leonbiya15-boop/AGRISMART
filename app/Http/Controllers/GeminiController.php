<?php

namespace App\Http\Controllers;

use Gemini\Laravel\Facades\Gemini;

class GeminiController extends Controller
{
    public function test()
    {
        $result = Gemini::generativeModel(
            model: 'gemini-3.6-flash'
        )->generateContent(
            'Présente AgrisSmart en une phrase.'
        );

        return response()->json([
            'reponse' => $result->text(),
        ]);
    }
}