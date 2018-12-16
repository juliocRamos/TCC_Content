<?php

namespace App\Http\Controllers;

use App\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DisciplinaController extends Controller
{
    private $disciplina;
    public function __construct(Disciplina $disciplina){
        $this->disciplina = new Disciplina();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('disciplina.index');
    }

    public function listar_disciplinas(){
        return view('disciplina.listar-disci');
    }
    
    public function getall()
    {
        $data = Disciplina::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $disciplina = new Disciplina();
        $disciplina->create($request->all());
        $data = 'success';
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function show(Disciplina $disciplina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = $_GET['id'];
        $disciplina = Disciplina::findOrFail($id);
        if($disciplina){
            return response()->json($disciplina);
        }
        else{
            $data = 'error';
            return response()->json($data);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $_GET['id'];
        $disciplina= Disciplina::findOrFail($id);
        $disciplina->update($request->all());
        if($disciplina){
            $data = 'success';
            return response()->json($data);
        }
        else{
            $data = 'error';
            return response()->json($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $_GET['id'];
        $disciplina = Disciplina::findOrFail($id);
        $disciplina->delete();
        $msg = 'success';
        return response()->json($msg);

    }
}
