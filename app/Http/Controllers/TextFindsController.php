<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextFindsController extends Controller
{
    private function findsNumber ($text){

        $regex = '/\b(\d+)[-]*(\d+)\b/';
        preg_match_all($regex, $text, $matches);

        $result = [];
        foreach ($matches[0] as $match) {
            $result[] = $match;
        }
        $data = $result ? implode(', ', $result) : 'Nothing found';
        return $data;
    }

    public function submitText(Request $request){

        // dd($request);
        $numbers ='<p> Numbers: ' . $this->findsNumber($request->inputText) . '</p>';

        $email = '<p> Email: No Email found</p>';

        $data = $numbers . $email;
        // Your logic here...

        // Return a response (optional)
        return $data ;
    }
}
