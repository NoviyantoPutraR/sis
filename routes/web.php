<?php

use Illuminate\Support\Facades\Route; // Pastikan mengimpor Route
use Illuminate\Support\Facades\Auth; // Pastikan mengimpor Auth

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
    return redirect(route('login'));
});
Route::get('/starter', function () {
    return view('starter');
});

// Auth::routes(['verify' => false, 'reset' => false]);


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('adminDashboard');
});

Route::get('/admin/pembelian', 'PembelianController@index')->name('daftarPembelian');


Route::get('/admin/user', 'UserController@index')->name('daftarUser');
Route::get('/admin/user/add', 'UserController@create')->name('addUser');
Route::post('/admin/user/add', 'UserController@store')->name('storeUser');

// Menampilkan formulir edit
Route::get('/admin/user/{user}/edit', 'UserController@edit')->name('editUser');

// Menangani pembaruan pengguna
Route::put('/admin/user/{user}', 'UserController@update')->name('updateUser');

// Pembatalan edit
Route::get('/admin/user/cancel-edit', 'UserController@cancelEdit')->name('cancelEdit');

// Menangani penghapusan pengguna
Route::delete('/admin/user/{user}', 'UserController@destroy')->name('deleteUser');



Route::get('/admin/pembelian/add', 'PembelianController@create')->name('addPembelian');
Route::post('/admin/pembelian/add', 'PembelianController@store')->name('storePembelian');



Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/dashboard', function () {
        return view('manager.dashboard');
    })->name('managerDashboard');
});

Route::middleware(['auth', 'employee'])->group(function () {
    Route::get('/employee/dashboard', function () {
        return view('employee.dashboard');
    })->name('employeeDashboard');
});


// Route::group(['middleware' => 'employee'], function () {
//     Route::get('employee.dashboard', 'EmployeeController@dashboard')->name('EmployeeDashboard');
// });

// Route::group(['middleware' => 'manager'], function () {
//     Route::get('manager.dashboard', 'ManagerController@index')->name('ManagerDashboard');
// });

// Route::group(['middleware' => 'admin'], function () {
//     Route::get('admin.dashboard', 'AdminController@index')->name('AdminDashboard');
// });

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('my-login');
