@extends('layouts.app')

@section('content')



<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> -->

        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <h3>Add New Data</h3>
    <br>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


</head>
<body> 
<form action="{{URL::to('/search')}}" method="POST" role="search">
        {{ csrf_field() }}
       

<div class="form-box">
          <label for="title"><b>Title</b></label>
		  <input type ="text" class="search" name="title" >
        
        </div>
<div class="form-box">
          <label for="author"><b>Author</b></label>
		<input type ="text" class="search" name="author" > 
           </div>
<div class="form-box">
          <label for="name"><b>University</b></label>
		<input type ="text" class="search" name="university" > 
           </div>
<div class="form-box">
         <label for="unv"><b>Name of the degree</b></label>
		<input type ="text" class="search" name="degree_name" > 
           </div>

           
<div class="form-box" >       
  <input type ="file" name="image"/>
  <form action="{{URL::to('/search')}}" method="POST" role="search">
  <button class ="search-btn" type="submit"> Submit</button> 
  
  </form>
   </div>
    
   </body>


<?php

if(isset($_POST['/uploadfile']))
{
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
    if(isset($_POST['contributor_author']))
    {
        $doc += ["contributor_author" => $_POST['contributor_author']];
    }
 if(isset($_POST['identifier_uri']))
    {
        $doc += ["identifier_uri" => $_POST['identifier_uri']];
    }
    if(isset($_POST['identifier_sourceurl']))
    {
        $doc += ["identifier_sourceurl" => $_POST['identifier_sourceurl']];
    }
    if(isset($_POST['identifier_oclc']))
    {
        $doc += ["identifier_oclc" => $_POST['identifier_oclc']];
    }
    if(isset($_POST['description']))
    {
        $doc += ["description" => $_POST['description']];
    }
    if(isset($_POST['description_abstract']))
    {
        $doc += ["description_abstract" => $_POST['description_abstract']];
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
    header('location: serp.php');
}


?>
@endsection


