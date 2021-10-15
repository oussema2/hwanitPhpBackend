<?php

namespace App\Http\Controllers;

use App\Models\TypeHanout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class TypeHanoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vendors = DB::table('type_hanouts')->get();
        return ['vendor' => $vendors];
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
     * @param  \App\Models\TypeHanout  $typeHanout
     * @return \Illuminate\Http\Response
     */
    public function show(TypeHanout $typeHanout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeHanout  $typeHanout
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeHanout $typeHanout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeHanout  $typeHanout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeHanout $typeHanout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeHanout  $typeHanout
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeHanout $typeHanout)
    {
        //
    }

    public function addTypeHanout(Request $req)
    {
        $typeHAnout = new TypeHanout();
        $typeHAnout->nomType =  $req->input('nomType');
        $typeHAnout->save();
        return $typeHAnout;

    }
    public function deleteTypeHanout($id)
    {
        TypeHanout::find($id)->delete();
         return 'deleted';
    }
    public function findTypeHanout($id)
    {
        return TypeHanout::find($id);
    }
}
