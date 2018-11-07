<?php

Route::post('uploadTmp', 'Utils\\FileController@uploadTmp')->name('upload.tmp');
Route::delete('removeTmp/{arquivo}', 'Utils\\FileController@removeTmp')->name('remove.tmp');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
