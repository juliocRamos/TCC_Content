<?php

namespace App\Http\Controllers;

use App\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AlunoController extends Controller
{
    private $aluno = 0; 
    public function __construct(){
        $this->aluno = new Aluno();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('aluno.index');
    }
    public function listar_alunos(){
        return view('aluno.listar-aluno');
    }
    public function getAll()
    {
        $data = Aluno::all();
        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    
        $aluno = new Aluno();
        $result = $aluno->create($request->all());
        $msg = 'success';
        return response()->json($msg);
        
        
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = $_POST['_id'];
        $aluno = Aluno::findOrFail($id);
        if($aluno){
            return response()->json($aluno);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $_POST['_id'];
        $aluno= Aluno::findOrFail($id);
        $aluno->update($request->all());
        if($aluno){
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $_POST['_id'];
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();
        $msg = 'success';
        return response()->json($msg);
       
    }
    
}