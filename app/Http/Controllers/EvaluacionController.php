<?php

namespace App\Http\Controllers;

use App\Evaluacion;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    
    function Obtener($ArchJson)
    {// Funcion que obtiene los JSONs para enviar las encuentas a las vistas
        $data = Storage::disk('vistas')->get($ArchJson.'.json');
        $bloques = json_decode($data,true);
        return($bloques);
    }

    function ValidarHabitos(Request $habitos)
    {
        //Validación de los Hábitos
    }
    
    function ValidarAPersonales(Request $APersonales)
    {
        //Validación de los Antecedentes Personales
    }
    function ValidarAFamiliares(Request $AFamiliares)
    {
        //Validación de los Antecedentes Familiares
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function api_createEncuesta()
    {// toma las preguntas en formato JSON y las envía a la API
        $Habitos= $this->Obtener("Annamnesis/habitos");
        $APersonales = $this->Obtener("Annamnesis/apersonales");
        $AFamiliares = $this->Obtener("Annamnesis/afamiliares");
        return(compact('Habitos','APersonales','AFamiliares'));
    }

    public function api_createMedica()
    {// toma las preguntas en formato JSON y las envía a la API
        $Medica = $this->Obtener("medica");
        return(compact('Medica');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function api_storeEncuesta(Request $request)
    {// Valida las entradas y guarda el registro
        ValidarHabitos($request);
        ValidarAPersonales($request);
        ValidarAFamiliares($request);

        $Registro = new Evaluacion;
        
        $Registro->FEncuesta = date("Y-m-d H:i:s");
        $Registro->idCliente = $request->idCliente;
        $Registro->Habitos = $request->Habitos;
        $Registro->APersonales = $request->APersonales;
        $Registro->AFamiliares = $request->AFamiliares;

        $Registro->save();
    }

    public function api_storeMedica(Request $request)
    {// Valida las entradas y guarda el registro Médico
        $Registro = App\Evaluacion::find($request->idCliente);

        $Registro->FDiagnostico = date("Y-m-d H:i:s");
        $Registro->Medica = $request->Medica;
        $Registro->Diagnostico = $request->Diagnostico;
        $Registro->RealizadoPor = 12345;

        $Registro->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evaluacion  $evaluacion
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluacion $evaluacion)
    {//Retorna la evaluación que tiene ese id
        $Registro = App\Evaluacion::find($evaluacion);
        return($Registro);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evaluacion  $evaluacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluacion $evaluacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evaluacion  $evaluacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluacion $evaluacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evaluacion  $evaluacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluacion $evaluacion)
    {
        //
    }
}
