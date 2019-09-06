<?php

namespace App\Http\Controllers;

use App\Number;
use Illuminate\Http\Request;

class NumbersController extends Controller
{
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
    public function create()
    {
        
        $valor = '0000000';
        $array = array();
        $count = 0;
        $tiempo_inicial = microtime(true); 
        for($i = 9800000;$i<10000000;$i++){
            if($i <= 9999999){
                $valor = $i;
                $array1 = array('NUMBER' => $valor, 'DATE' => '2019-09-04 17:50:20');
            }
                $count++;
                array_push($array,$array1);
            if($count%2000 == 0){

                Number::insert($array);
                $array = array();
            }
            
        }

        Number::insert($array);
        $tiempo_final = microtime(true);
        


        
        
        
        $tiempo = $tiempo_final - $tiempo_inicial;
        dd($tiempo);
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
     * @param  \App\Numbers  $numbers
     * @return \Illuminate\Http\Response
     */
    public function show(Numbers $numbers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Numbers  $numbers
     * @return \Illuminate\Http\Response
     */
    public function edit(Numbers $numbers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Numbers  $numbers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Numbers $numbers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Numbers  $numbers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Numbers $numbers)
    {
        //
    }
}
