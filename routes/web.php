<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Departement\Index as DepartementIndex;
use App\Http\Livewire\Employee\Index;
use App\Http\Livewire\Eselon\Index as EselonIndex;
use App\Http\Livewire\Group\Index as GroupIndex;
use App\Http\Livewire\Unit\Index as UnitIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employee', Index::class)
    ->name('employee.index');

Route::get('/unit', UnitIndex::class)
    ->name('unit.index');

Route::get('/jabatan', DepartementIndex::class)
    ->name('jabatan.index');

Route::get('/eselon', EselonIndex::class)
    ->name('eselon.index');

Route::get('/group', GroupIndex::class)
    ->name('group.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
