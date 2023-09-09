<?php

use App\Http\Controllers\MemoController;
use App\Http\Controllers\ProfileController;
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

function BingWebSearch ($url, $key, $query) {
    $headers = "Ocp-Apim-Subscription-Key: $key\r\n";
    $options = array ('http' => array (
        'header' => $headers,
        'method' => 'GET'));
    $context = stream_context_create($options);
    $result = file_get_contents($url . "?q=" . urlencode($query), false, $context);
    $headers = array();
    foreach ($http_response_header as $k => $v) {
        $h = explode(":", $v, 2);
        if (isset($h[1]))
            if (preg_match("/^BingAPIs-/", $h[0]) || preg_match("/^X-MSEdge-/", $h[0]))
                $headers[trim($h[0])] = trim($h[1]);
    }
    return array($headers, $result);
}

Route::get('/', function () {
    $accessKey = env('AZURE_KEY');
    $endpoint = 'https://api.cognitive.microsoft.com/bing/v7.0/search';
    $term = 'Microsoft Cognitive Services';
    if (strlen($accessKey) == 32) {

        print "Searching the Web for: " . $term . "\n";
        list($headers, $json) = $this->BingWebSearch($endpoint, $accessKey, $term);
        dd($headers);
        print "\nRelevant Headers:\n\n";
        foreach ($headers as $k => $v) {
            print $k . ": " . $v . "\n";
        }
        print "\nJSON Response:\n\n";
        echo json_encode(json_decode($json), JSON_PRETTY_PRINT);

    } else {
        print("Invalid Bing Search API subscription key!\n");
        print("Please paste yours into the source code.\n");
    }

    return view('chatgpt.create');



//    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('memo', MemoController::class);
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
