<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Location;

class FibonacciController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fibonacci.index');
    }

    /**
     * Return Fibonacci Recursive to view.
     *
     * @return \Illuminate\Http\Response
    */
    public function fibonacciRecursive()
    {
        $fib = [];
        for ($i = 0; $i <= 45; $i++) {
            $fib[$i] = $this->fibonacci($i);
        }
        return response()->json($fib);
    }

    public function fibonacci($num)
    {
        if ($num <= 1) {
            return 1;
        }
        return $this->fibonacci($num -1) + $this->fibonacci($num - 2);
    }
}
