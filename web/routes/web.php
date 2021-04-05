<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illiminate\Http\Controllers\mainController;
use App\Http\Controller\DissertationController;


Route::get('/',[DissertationController::class, 'getData']);

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

Auth::routes(['verify' =>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/update', [App\Http\Controllers\mainController::class, 'update'])->name('update');



//Route::get('/etd', [App\Http\Controllers\mainController::class, 'process_etd'])->name('etd');


Route::get('/etd', function () {
    return view('etd');

});

Route::get('/uploadfile',function() 
{
  return view('uploadfile');
});




Route :: post('/advancesearch', function(){
  return view ('advancesearch');
});

Route::post('/search', function (Request $request) {
    $input = $request->get("q");
    $input1 = $request->get("submit");
    echo $input1;

    // $q=htmlspecialchars($input);
    $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $input);
    // echo($q);
    if ($input != "") {
        
        $searchParams = [
        'index' => 'etd',
        'body' => [
          'query' => [
            'bool' =>[
              'must' =>[
                'multi_match' =>[
                'query'=> $q,
                'fields' => ['handle','contributor_author','title','type','subject','description_abstract','degree_grantor'.
              'contributor_department','contributor_committeemember','contributor_committeechair','publisher']
                  ]
                ]
              ]
              ],
        'size'=>1000
        ]
      ];
      return view('serp',["sparam"=>$input])->withquery($searchParams);
    }
    else
    {
     $title = $request->get('title'); 
     $author = $request->get('author'); 
     $dept= $request->get('dept'); 
     $university = $request->get('university'); 
     $degree_name = $request->get('degree_name'); 

      
      if ($title != "" || $author != "" || $dept != "" || $university != "" || $degree_name != "")
      {
        $advParams =  [
          'index' => 'etd',
          'body' => [
            'query' => [
              'bool' =>[
                'must' =>[
                  'match' =>[
                  'title'=> $title ?? '',
                ],
                'match' =>[
                  'contributor_author'=> $author ?? '',
                ],
                  ]
                ]
              ],
          'size'=>50
          ]
        ];
    
        return view('serp',["sparam"=>$input])->withquery($advParams);
      }
      else
      {
        return redirect('/');
      }
    }
    return view('advancesearch');
});

