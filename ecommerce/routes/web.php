<?php

use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\ProfileController;
use App\Models\SliderModel;
use Illuminate\Support\Facades\Route;

Route::get('/',function() {
    $sliders = SliderModel::all();
    return view('frontend/Home', compact('sliders'));
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(SliderController::class)->middleware(['auth','verified'])->group(function (){
    Route::get('/SliderIndex','index')->name('slider.index');
    Route::post('/saveSlider', 'storeSlider')->name('slider.store');
    Route::post('/updateSlider', 'updateSlider')->name('slider.update');
    Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
});


require __DIR__.'/auth.php';
