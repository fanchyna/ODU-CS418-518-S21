<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class mainController extends Controller
{
    
    public function update()
    {
       return view('update');
    }


    public function search(Request $request)
    {
    $input = $request->get("q");
    $input1 = $request->get("submit");
    echo $input1;

    // $q=htmlspecialchars($input);
    $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $input);
    // echo($q);
    if ($input != "") 
    {
        
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
     }
     public function summary(Request $request)
    {

       return view('summary');
     
  }

   
}
