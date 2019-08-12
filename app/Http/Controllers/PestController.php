<?php

namespace App\Http\Controllers;


use App\Question;
use Illuminate\Http\Request;

class PestController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function questions(Request $request)
    {
        $data = Question::with('answers')->inRandomOrder()->limit(10)->get();

    }

    public function storeUserAnswer(Request $request)
    {

    }
}
