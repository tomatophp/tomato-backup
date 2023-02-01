<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/backup', [\TomatoPHP\TomatoBackup\Http\Controllers\BackupController::class, 'index'])->name('backup.index');
    Route::get('admin/backup/create', [\TomatoPHP\TomatoBackup\Http\Controllers\BackupController::class, 'create'])->name('backup.create');
    Route::post('admin/backup', [\TomatoPHP\TomatoBackup\Http\Controllers\BackupController::class, 'store'])->name('backup.store');
    Route::get('admin/backup/{record}', [\TomatoPHP\TomatoBackup\Http\Controllers\BackupController::class, 'download'])->name('backup.download');
    Route::delete('admin/backup/{record}', [\TomatoPHP\TomatoBackup\Http\Controllers\BackupController::class, 'destroy'])->name('backup.destroy');
});
