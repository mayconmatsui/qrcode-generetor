<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/qrcode', function (Request $request) {
    $dados = $request->all();
    $image = $request->file('logo') ? base64_encode(file_get_contents($request->file('logo'))) : '';
    $logoqr = $request->file('logoqr') ? $request->logoqr->storeAs('logo', 'logoqr.png') : '';
    if($image !== ''){
        $dados['logomarca'] = $image;
    }
    if($logoqr !== ''){
        $dados['logoqr'] = $logoqr;
    }
    return view('welcome', ['dados' => $dados]);
});
