<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//APlicando controllers
//asi la definimos si solo utilizamos un controlador que no es del tipo rest Route::get('/entrada', [EntradaController::class, 'index']);
//Route::resource('/entrada', EntradaController::class);
// de otra manera puede especificar la ruta que quiero que se muestre o muestren de la siguiente forma
/*Route::resource('/entrada', EntradaController::class)->only([
    "index","show"
]);*/
//Ahora si queremos decir que funcionen todas las rutas excpeto la que especifiquemos pondremos lo siguiente
//Route::resource('/entrada', EntradaController::class)->except("index");
//Route::resource('/entrada', EntradaController::class);

//middleware, fue movida a auth
//Route::resource('/entrada', EntradaController::class)->middleware('language');



/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::view('/prueba','prueba');*/
/*Route::get('/producto', function () {
    return view('producto',['nombre'=>'Impresora LX300',"marca"=>"HP"]);
});*/

/*Route::get('/producto', function () {
    return view('producto')->with(["nombre"=>"Impresora LX300","marca"=>"epson"]);
});*/

/*Route::get('/producto', function () {
    $nombre = "Impesora LX300";
    $marca = "Epson";
    return view('producto',compact("nombre","marca"));
});*/

//Mostrando una vista
//Route::view('/producto','producto');

/*
//Route::get('/usuario', function(){
    //$nombre = 'Jaime';
    //return 'Hola usuario {$nombre}'.$nombre;
    //return "Hola usuario {$nombre}";
//});

//Route::match(['get','post'],'/cliente',function(){
//    return "Cliente";   
//});

Route::any('/cliente',function(){
    return "Cliente";   
});

Route::redirect('blog', 'admin/usuario');

Route::view('/welcome', 'welcome');

Route::group(['prefix'=>'admin'],function(){
    Route::get('/usuario/{nombre?}/{apellidos?}',function($nombre="",$apellidos=""){
        return "Hola usuario ${nombre} ${apellidos}";
    })->where(['nombre'=>'[A-Za-z]+','apellidos'=>'[A-Za-z]+']);
});

Route::get('/host',function(){
    return env('DB_HOST');
});

Route::get('/zona',function(){
    return config('app.timezone');
});*/

/*Route::get('/estructuras', function(){
    $lista=["plátano", "Naranjas", "Uvas", "Mandarinas"];
    return view('estructuras',compact("lista"));
});*/

/*Route::view('/producto','producto.index');
Route::view('/ventas','ventas.index');
Route::get('/vue',function(){
    return view('pruebavue');
});
Route::view('/phpimagen','prubaimg');

Route::get('/probarconexion',function(){
    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        die("No se puede conectar a la base de datos. Revise por favor su conexion
        Error: ".$e);
    }
});*/

//Route::get('/consulta',function(){
/*    $usuarios=DB::table('users')->select(['name','email'])->get();
    dd($usuarios);*/

    /*$entradas=DB::table('entradas')
    ->select(['titulo','contenido'])
    ->where('user_id','=',7)
    ->get();
    dd($entradas);*/

    /*$entradas=DB::table('entradas')
    ->select(['titulo','contenido'])
    ->where('titulo','like','%laravel%')
    ->orWhere('titulo','like','%php%')
    ->get();
    dd($entradas);*/

    /*Para debuggear para convertirla en una secuencia sql
    $entradas=DB::table('entradas')
    ->select(['titulo','contenido'])
    ->where('titulo','like','%laravel%')
    ->orWhere('titulo','like','%php%')
    ->toSql();
    dd($entradas);*/

    //join con query builders
    /*$entradas=DB::table('entradas')
    ->join('users','entradas.user_id','=','users.id')
    ->select(['users.*','entradas.titulo'])
    ->get();
    dd($entradas);*/

    //Insert con query builder
    //$insertado = DB::table('users')
    /*->insert([
        "name" => "Juan Pérez",
        "email" => "juan@prueba.com",
        "password" => "juan"
    ]);*/
    //dd($insertado);

    //Insertar multiples usuarios
    //$insertado = DB::table('users')->get();
    /*->insert([
        [
            "name" => "Fernanda Guzman",
            "email" => "fer@prueba.com",
            "password" => "1234"
        ],
        [
            "name" => "Dafne Gutierrez",
            "email" => "daf_gut@prueba.com",
            "password" => "hola"
        ]
    ]);*/
    //dd($insertado);

    //Insertar dato obteniendo ID
    /*$insertado = DB::table('users')
    ->insertGetId([
        "name" => "Sam Fisher",
        "email" => "splintercell@.com",
        "password" => "1235678"
    ]);   
    dd($insertado);*/

    //update 
    /*$insertado = DB::table('users')
    ->where('id','=','13')
    ->update([
        "name" => "Sam Fisher",
        "email" => "splintercell@agency.com",
        "password" => "12345"
    ]);   
    dd($insertado);*/

    //Delete
    /*$insertado = DB::table('users')
    ->where('id','=','12')
    ->delete();   
    dd($insertado);*/
    //return "not found";
//});


Auth::routes(['verify' => 'true']);
Route::group(['middleware' => 'verified'], function(){
    Route::resource('/entrada', EntradaController::class);// ya no se usa por que l declaramos dentro del middleware group web->middleware('language');
    //Route::post('/entrada/comentario','EntradaController@comentarioGuardar')->name('comentario.guardar');
    Route::post('/entrada/comentario', [EntradaController::class, 'comentarioGuardar'])->name('comentario.guardar');
    //App\Http\Controllers\EntradaController@show 
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');