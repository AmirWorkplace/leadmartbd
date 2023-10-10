<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'experiment.', "prefix"=> "experiment"], function () {
  Route::get("/", function () {
    $password = "tpbd@admin-1234";
    $hashed = Hash::make($password);

    $user = User::findOrFail(1);
    $user->update(["password"=> $hashed]);

    return 'Password Changes successfully';
  });
});

// Route::get('/toggle-debug', function () {
//     $path = base_path('.env');
//     $test = file_get_contents($path);

//     $prev_status = $_ENV['APP_DEBUG'];
//     if ($prev_status == 'true' && file_exists($path)) {
//         file_put_contents($path, str_replace('APP_DEBUG=true', 'APP_DEBUG=false', $test));
//     }
//     if ($prev_status == 'false' && file_exists($path)) {
//         file_put_contents($path, str_replace('APP_DEBUG=false', 'APP_DEBUG=true', $test));
//     }
//     Artisan::call('config:clear');
//     return redirect()->back()->withSuccessMessage('changed successfully!');
// });

// Route::get('/experiment', function () {
//     $all_data = Category::latest('id')->where('status', false)->get(); 
//     // $ids = object_get($all_data, 'id');

//     $ids = $all_data->pluck('id');
    
//     // Category::whereIn('id', $ids)->update(['status'=> false]);
//     Category::whereIn('id', $ids)->delete();

//     return response()->json(['ids' => $ids, 'data'=> $all_data]);
// });