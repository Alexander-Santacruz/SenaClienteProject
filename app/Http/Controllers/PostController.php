<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PostController extends Controller
{
     // Método privado para manejar llamadas HTTP repetitivas
     private function fetchDataFromApi($url)
     {
         $response = Http::get($url);
         return $response->json();
     }

     public function index()   //http://api.blog.test/v1/categories?included=posts
     {

         $url = env('URL_SERVER_API');

         $posts = $this->fetchDataFromApi($url . '/posts');

         return view('publication.index', compact('posts'));
     }


}
