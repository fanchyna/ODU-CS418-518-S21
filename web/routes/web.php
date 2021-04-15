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
Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/update', [App\Http\Controllers\mainController::class, 'update'])->name('update');

Route::post('/summary', [App\Http\Controllers\mainController::class, 'summary'])->name('summary');

Route::get('/save', function () {
    $users = DB::table('savedister')->select('id','title','author','degree_grantor', 'publisher','identifier_uri', 'description_abstract')->get();
    return view('save', compact('users'));
});

Route::get('delete-records','Delete@index');
Route::get('delete/{id}','Delete@destroy');

Route::get('/saved', function () {return view('saved');});

//Route::get('/posts/{post}', 'PostController@summary')->name('post.summary');

//Route::get('/etd', [App\Http\Controllers\mainController::class, 'process_etd'])->name('etd');


Route::get('/etd', function () {
    return view('etd');

});

Route::get('/summary', function () {
    return view('summary');

});


Route::get('/save', function () {return view('save');});

Route::post('/uploadfile',function() 
{
  return view('uploadfile');
});

Route::get('/claims',function() 
{
  return view('claims');
});




Route :: post('/advancesearch', function(){
  return view ('advancesearch');
});

Route::get('/save', function () 
{
    $users = DB::table('savedister')->select('id','title','author','degree_grantor', 'publisher','identifier_uri', 'description_abstract')->get();
    return view('save', compact('users'));
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

if(isset($_POST['uploadfile'])){
  $client = Elasticsearch\ClientBuilder::create()->build();
  $params = [
      'index' => 'etd',
      'body'  => [
          '_source' => false,
          'fields' => [
              '_id'
          ],
          'query' => [
              'match_all' => ["boost" => 1.0]
          ],
          'sort' => [
              '_id' => 'desc'
          ],
          'size' => 1
      ]
  ];

  $results = $client->search($params);


  $id = $results['hits']['hits'][0]["_id"] + 1;
  $doc = array("handle"=>$id);
  if(isset($_POST['contributor_author'])){
      $doc += ["contributor_author" => $_POST['contributor_author']];
  }
  if(isset($_POST['date_accessioned'])){
      $doc += ["date_accessioned" => str_replace('+00:00', 'Z', gmdate('c', strtotime($_POST['date_accessioned'])))];
  }
  if(isset($_POST['date_available'])){
      $doc += ["date_available" => str_replace('+00:00', 'Z', gmdate('c', strtotime($_POST['date_available'])))];
  }
  if(isset($_POST['date_issued'])){
      $doc += ["date_issued" => $_POST['date_issued']];
  }
  if(isset($_POST['identifier_other'])){
      $doc += ["identifier_other" => $_POST['identifier_other']];
  }
  if(isset($_POST['identifier_uri'])){
      $doc += ["identifier_uri" => $_POST['identifier_uri']];
  }
  if(isset($_POST['identifier_sourceurl'])){
      $doc += ["identifier_sourceurl" => $_POST['identifier_sourceurl']];
  }
  if(isset($_POST['identifier_oclc'])){
      $doc += ["identifier_oclc" => $_POST['identifier_oclc']];
  }
  if(isset($_POST['description'])){
      $doc += ["description" => $_POST['description']];
  }
  if(isset($_POST['description_abstract'])){
      $doc += ["description_abstract" => $_POST['description_abstract']];
  }
  if(isset($_POST['description_provenance'])){
      $doc += ["description_provenance" => $_POST['description_provenance']];
  }
  if(isset($_POST['description_sponsorship'])){
      $doc += ["description_sponsorship" => $_POST['description_sponsorship']];
  }
  if(isset($_POST['format_medium'])){
      $doc += ["format_medium" => $_POST['format_medium']];
  }
  if(isset($_POST['publisher'])){
      $doc += ["publisher" => $_POST['publisher']];
  }
  if(isset($_POST['rights'])){
      $doc += ["rights" => $_POST['rights']];
  }
  if(isset($_POST['subject'])){
      $doc += ["subject" => $_POST['subject']];
  }
  if(isset($_POST['subject_lcc'])){
      $doc += ["subject_lcc" => $_POST['subject_lcc']];
  }
  if(isset($_POST['subject_lcsh'])){
      $doc += ["subject_lcsh" => $_POST['subject_lcsh']];
  }
  if(isset($_POST['title'])){
      $doc += ["title" => $_POST['title']];
  }
  if(isset($_POST['type'])){
      $doc += ["type" => $_POST['type']];
  }
  if(isset($_POST['language_iso'])){
      $doc += ["language_iso" => $_POST['language_iso']];
  }
  if(isset($_POST['contributor_author'])){
      $doc += ["contributor_author" => $_POST['contributor_author']];
  }
  if(isset($_POST['relation'])){
      $doc += ["relation" => $_POST['relation']];
  }
  if(isset($_POST['contributor_department'])){
      $doc += ["contributor_department" => $_POST['contributor_department']];
  }
  if(isset($_POST['description_degree'])){
      $doc += ["description_degree" => $_POST['description_degree']];
  }
  if(isset($_POST['contributor_committeechair'])){
      $doc += ["contributor_committeechair" => $_POST['contributor_committeechair']];
  }
  if(isset($_POST['contributor_committeecochair'])){
      $doc += ["contributor_committeecochair" => $_POST['contributor_committeecochair']];
  }
  if(isset($_POST['contributor_committeemember'])){
      $doc += ["contributor_committeemember" => $_POST['contributor_committeemember']];
  }
  if(isset($_POST['degree_name'])){
      $doc += ["v" => $_POST['degree_name']];
  }
  if(isset($_POST['degree_level'])){
      $doc += ["degree_level" => $_POST['degree_level']];
  }
  if(isset($_POST['degree_grantor'])){
      $doc += ["degree_grantor" => $_POST['degree_grantor']];
  }
  if(isset($_POST['degree_discipline'])){
      $doc += ["degree_discipline" => $_POST['degree_discipline']];
  }
  if(isset($_POST['date_adate'])){
      $doc += ["date_adate" => $_POST['date_adate']];
  }
  if(isset($_POST['date_sdate'])){
      $doc += ["date_sdate" => $_POST['date_sdate']];
  }
  if(isset($_POST['date_rdate'])){
      $doc += ["date_rdate" => $_POST['date_rdate']];
  }
  if(isset($_POST['document'])){
      $doc += ["contributor_author" => $_POST['contributor_author']];
  }
  $target_dir = "resources/";
  $target_file = $target_dir . basename($_FILES["document"]["name"]);
  //echo json_encode($doc);
  $params = [
    'index' => 'etd',
    'id' => $id,
    'body' => json_encode($doc),

  ];
  $response = $client->index($params);
  //echo $response;
  header('location: search.php');

}

Auth::routes();