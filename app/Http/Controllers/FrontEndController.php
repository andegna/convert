<?php

namespace Convert\Http\Controllers;

use Convert\Http\Requests\LoginRequest;
use GuzzleHttp\Exception\ConnectException;

class FrontEndController extends Controller
{
    public function getIndex() {
        return view('app');
    }
    
    public function postCrawler(LoginRequest $request) {
        try {
            $username = $request->get('username');
            $password = $request->get('password');
            
            return dd(app('Convert\Converter')->convertScrap($username, $password));
        } catch(ConnectException $exception) {
            return redirect('/')->withErrors(collect(['Unable to connect with <a class="text-danger" href="//studentinfo.bdu.edu.et"><b>SIMS</b></a> !<br/>Please come back later.']));
        } catch(\Exception $exception) {
            return redirect('/')->withErrors(collect([$exception->getMessage()]));
        }
    }
    
    public function postUpload(Request $request) {
        try {
            $html = $request->get('html');
            
            return dd(app('Convert\Converter')->convertHtml($html));
        } catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
