<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'student.', 'controller' => StudentController::class], function(){
    Route::get('/student', 'show')->name('show');
    Route::get('/student/{student}', 'view')->name('view');
    Route::post('/student/create', 'store')->name('store');
    Route::post('/student/{student}/update', 'update')->name('update');
    Route::post('/student/{student}/delete', 'delete')->name('delete');
});

Route::group(['as' => 'speciality.', 'controller' => SpecialityController::class], function(){
    Route::get('/speciality', 'show')->name('show');
    Route::get('/speciality/{speciality}', 'view')->name('view');
    Route::post('/speciality/create', 'store')->name('store');
    Route::post('/speciality/{speciality}/update', 'update')->name('update');
    Route::post('/speciality/{speciality}/delete', 'delete')->name('delete');
});

Route::group(['as' => 'grade.', 'controller' => GradeController::class], function(){
    Route::get('/grade', 'show')->name('show');
    Route::get('/grade/{grade}', 'view')->name('view');
    Route::post('/grade/create', 'store')->name('store');
    Route::post('/grade/{grade}/update', 'update')->name('update');
    Route::post('/grade/{grade}/delete', 'delete')->name('delete');
});

Route::group(['as' => 'subject.', 'controller' => SubjectController::class], function(){
    Route::get('/subject', 'show')->name('show');
    Route::get('/subject/{subject}', 'view')->name('view');
    Route::post('/subject/create', 'store')->name('store');
    Route::post('/subject/{subject}/update', 'update')->name('update');
    Route::post('/subject/{subject}/delete', 'delete')->name('delete');
});
