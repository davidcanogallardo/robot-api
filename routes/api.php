<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Robot;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/bitches', function (Request $request) {
    return "sum bitches";
});
Route::get('/robot', function (Request $request) {
    return Robot::find(1);
});

Route::post('/update/{axis}/{grados}', function ($axis,$grados) {
    $robot = Robot::find(1);
    switch ($axis) {
        case "amarillo":
            $robot->amarillo = $grados;
            break;
        case "rojo":
            $robot->rojo = $grados;
            break;
        case "rosa":
            $robot->rosa = $grados;
            break;
        case "naranja":
            $robot->naranja = $grados;
            break;
    }
    $robot->save();

    return $robot;
});
