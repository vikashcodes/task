<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Illuminate\Http\Request;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function GetRepos(Request $request)
    {
        $searchtext = $request->searchtext;
        $client = new Client();
        $response = $client->request('GET', "https://api.github.com/search/repositories?q=$searchtext&per_page=100");
        $result=(json_decode($response->getBody(), true));
        return view('welcome', compact('result'));
    }
}
