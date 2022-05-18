<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Direccion;
use Illuminate\Support\Facades\Gate;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores=Proveedor::with('direccion')->paginate(5);
        return view('proveedor.index', compact('proveedores'),['direcciones'=>Direccion::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedor.create',['direccion'=>Direccion::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = Proveedor::create($request->only('nombre_proveedor', 'rut_proveedor', 'representante','rut_representante','direccion_id'));
        return redirect()->route('proveedor.index', $proveedor->id)->with('success', 'Usuario creado correctamente.');
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
    public function edit(Proveedor $proveedores)
    {
        return view('proveedor.edit',compact('proveedores'),['direccion'=>Direccion::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedores)
    {
        $proveedores->update($request->only('nombre_proveedor', 'rut_proveedor', 'representante','rut_representante','direccion_id'));

        return redirect()->route('proveedor.index', $proveedores->id)->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedores)
    {
        $proveedores->delete();
        return redirect()->route('proveedor.index');
    }
}
