<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Comentario;
use Illuminate\Http\Request;
use App\Http\Requests\EntradaFormRequest;
use Illuminate\Support\Facades\DB; // se importa cuando quieramos utilizar query builder
use App\Http\Requests\ComentarioFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
//Use Auth;
//use Validator;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        //$entradas = Entrada::all();
        $texto=trim($request->get('texto'));
        $entradas = DB::table('entradas')
                        ->select('id','titulo','created_at',\DB::raw('SUBSTRING(contenido,1,200) as contenido'))
                        ->where('titulo','LIKE','%'.$texto.'%')
                        ->where('user_id','=',Auth::user()->id)
                        ->orderBy('id','desc')
                        ->paginate(10);
        //dd($entradas);
        return view('entrada.index',compact('entradas','texto'));
        
        //response request
        //dd($request);
        /*echo $request->path();
        echo "<br>";
        echo $request->url();*/
        //echo $request->input("titulo");

        //response
        //return "respuesta";
        //return view('entrada.index',compact('entradas'));
        //return response("Respuesta", 200);//todo esta correcto
        //return response("Este es un error", 404);//todo esta correcto
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entrada.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntradaFormRequest $request)
    {
        //dd($request)->all();
        /*$validator = Validator::make($request->all(),[
            'titulo' => 'required|min:5|max:70',
            'contenido' => 'required|min:5|max:255'
        ]);
        if ($validator->fails()) {
            return redirect()
            ->route('entrada.create')
            ->withErrors($validator)
            ->withInput();
        } Tener nuetsra validacion en una sla clase es un mala practica por lo que haremos uso del formrequest*/
        $entrada = new Entrada;
        $entrada->titulo=$request->input("titulo");
        $entrada->contenido=$request->input("contenido");
        $entrada->user_id=Auth::user()->id;  //$request->user()->id;
        $entrada->save();
        return redirect()->route('entrada.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function show(Entrada $entrada)
    {
        $comentarios=DB::table('comentarios')
                        ->join('users','comentarios.user_id','=','users.id')
                        ->where('comentarios.entrada_id','=',$entrada->id)
                        ->select('users.email','users.name','comentarios.contenido','comentarios.created_at')
                        ->orderBy('comentarios.id','desc')
                        ->get();
        return view('entrada.show',compact('entrada','comentarios'));
    }

    public function comentarioGuardar(ComentarioFormRequest $request){
        $comentario = new Comentario();
        $comentario->contenido=$request->input('contenido');
        $comentario->entrada_id=$request->input('entrada_id');
        $comentario->user_id=Auth::user()->id;
        $comentario->save();
        return redirect()->route('entrada.show',['entrada'=>$request->input('entrada_id')])
                         ->with('mensaje',trans('main.registered-data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function edit(Entrada $entrada)
    {
        return view('entrada.edit', compact('entrada'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function update(EntradaFormRequest $request, Entrada $entrada)
    {
        if (Auth::user()->cant('update',$entrada)) {
            return redirect()->route('entrada.index')
                    ->with('mensaje',trans('main.no-authorized'));
        }

        $entrada->titulo=$request->input('titulo');
        $entrada->contenido=$request->input('contenido');
        $entrada->save();
        return redirect()
                ->route('entrada.edit',['entrada'=>$entrada])
                ->with('mensaje',trans('main.updated-data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrada $entrada)
    {
       // if (Auth::user()->cant('delete',$entrada)) {
        //$user = User::find(4)
        //if (Gate::forUser($user)->denies('deleteEntrada',$entrada)) {
        if (Gate::denies('deleteEntrada',$entrada)) {
            return redirect()->route('entrada.index')
                    ->with('mensaje',trans('main.no-authorized'));
        }
        $entrada->delete();
        return redirect()->route('entrada.index');
    }
}
