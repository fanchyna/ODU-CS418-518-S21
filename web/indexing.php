<?php
set_time_limit(0);
use Elasticsearch\ClientBuilder;
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

$extension="json";


$main_dir= new RecursiveDirectoryIterator('/Applications/XAMPP/xamppfiles/htdocs/Sites/dissertation/');

foreach (new RecursiveIteratorIterator($main_dir) as $key => $folder_name) {

    $ext = pathinfo($folder_name, PATHINFO_EXTENSION);
    if($ext == $extension) {
        // $file = '11042/11042.json';
        $json = file_get_contents($folder_name);
        // print($json);
        $params = [
  'index' => 'elastic',
  'body'  => $json
        ];

        try{
            $response = $client->index($params);
        } catch(Exception $e) {

            }
        }
    }
      function sendResponseToElasticSearch($params){
          $client = $GLOBALS["client"];
          print_r($client);
      }


 ?>

