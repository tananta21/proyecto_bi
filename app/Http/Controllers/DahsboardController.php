<?php

namespace App\Http\Controllers;


use App\Core\fact_sismo\FactRepository;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DahsboardController extends Controller
{
    protected $repoFactSismo;

    public function __construct()
    {
        $this->repoFactSismo = new FactRepository();
    }

    public function index()
    {
        //
    }

    public function resumenMeses()
    {
        $pais_id = Input::get('pais_id');
        $query = $this->repoFactSismo->resumenMeses($pais_id);
        $datos = array($query);
        if (empty($datos)) {
            return 0;
        } else {
            return response()->json($datos);
        }
    }

    public function resumenPaises()
    {
        $query = $this->repoFactSismo->resumenPaises();
        $datos = array($query);
        if (empty($datos)) {
            return 0;
        } else {
            return response()->json($datos);
        }
    }

    public function mapaPaises()
    {
        $pais_id = Input::get('pais_id');
        $inten_id = Input::get('intensidad_id');
        if ($inten_id == 15) {
            if ($pais_id == 15) {
                $query = $this->repoFactSismo->mapaPaises();
            } else {
                $query = $this->repoFactSismo->mapaPaisesDetail($pais_id);
            }
        }
        else{
            if ($pais_id == 15) {
                $query = $this->repoFactSismo->mapaPaisesIntens($inten_id);
            }
            else{
                $query = $this->repoFactSismo->mapaPaisesIntensDetail($pais_id,$inten_id);
            }
        }
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
