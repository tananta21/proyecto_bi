<?php

namespace App\Http\Controllers;


use App\Core\fact_sismo\FactRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class DahsboardController extends Controller
{
    protected $repoFactSismo;

    public function __construct(){
        $this->repoFactSismo = new FactRepository() ;
    }
    public function index()
    {
        //
    }

    public function resumenMeses(){
        $pais_id = Input::get('pais_id');
        $query = $this->repoFactSismo->resumenMeses($pais_id);
        $datos = array($query);
        if (empty($datos)) {
            return 0;
        } else {
            return response()->json($datos);
        }
    }
    public function resumenPaises(){
        $query = $this->repoFactSismo->resumenPaises();
        $datos = array($query);
        if (empty($datos)) {
            return 0;
        } else {
            return response()->json($datos);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
