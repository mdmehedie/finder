<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextFindsController extends Controller
{
    private function findSnapID($text)
    {
        $patterns = [
            'snap', 'Sc', 'SnapChat', 'snapchat', 'Snp', 'AMOSC',
            '👻', 'Snap', 'SN', 'Snk', 'SNK', 'SC', 'SNAP'
        ];

        $patternRegex = implode('|', array_map('preg_quote', $patterns));

        $regex = "/($patternRegex):\\w+/i";

        preg_match_all($regex, $text, $matches);

        $result = [];
        foreach ($matches[0] as $match) {
            $result[] = $match;
        }
        $data = $result ? implode(', ', $result) : 'Nothing found';

        return $data;

    }

    private function findEmails($text)
    {
        $regex = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';

        preg_match_all($regex, $text, $matches);

        $result = [];
        foreach ($matches[0] as $match) {
            $result[] = $match;
        }
        $data = $result ? implode(', ', $result) : 'Nothing found';

        return $data;
    }
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

        $email = '<p> Emails: ' . $this->findEmails($request->inputText) . '</p>';

        $snapID = '<p> Snap ID: ' . $this->findSnapID($request->inputText) . '</p>';

        $data = $numbers . $email . $snapID;
        // Your logic here...

        // Return a response (optional)
        return $data ;
    }
}
