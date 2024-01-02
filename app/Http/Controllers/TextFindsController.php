<?php

namespace App\Http\Controllers;

use App\Models\AllFindsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TextFindsController extends Controller
{
    private function findSnapID($text)
    {
        $patterns = [
            'snap', 'sc', 'SnapChat', 'snapchat', 'Snp', 'AMOSC',
            '👻', 'Snap', 'SN', 'Snk', 'SNK', 'SNAP'
        ];

        $patternRegex = implode('|', array_map('preg_quote', $patterns));

        $regex = "/($patternRegex)[ ]*(:|::|.|,)[ ]*\\w+/i";

        preg_match_all($regex, $text, $matches);

        $result = [];
        foreach ($matches[0] as $match) {
            $result[] = $match;
        }
        $data = $result ? implode('; ', $result) : '';

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
        $data = $result ? implode('; ', $result) : '';

        return $data;
    }
    private function findsNumber ($text){

        $regex = '/\b(\d+)[-| ]*(\d+)\b/';
        preg_match_all($regex, $text, $matches);

        $result = [];
        foreach ($matches[0] as $match) {
            if(strlen($match) > 5)
                $result[] = $match;
        }
        $data = $result ? implode('; ', $result) : '';
        return $data;
    }

    public function submitText(Request $request){

        $findsData['user_id'] = Auth::user()->id;
        $findsData['phone_number'] = $this->findsNumber($request->inputText);
        $findsData['email'] = $this->findEmails($request->inputText);
        $findsData['snap_id'] = $this->findSnapID($request->inputText);

        $validation = Validator::make($findsData, [
            'phone_number' => 'unique:all_finds_data,phone_number',
            'email' => 'unique:all_finds_data,email',
            'snap_id' => 'unique:all_finds_data,snap_id',
        ]);

        if (!$validation->fails() && ($findsData['phone_number'] || $findsData['email'] || $findsData['snap_id'])) {
            AllFindsData::create($findsData);
        }

        $findsData['phone_number'] = $findsData['phone_number'] ? $findsData['phone_number'] : 'Nothing found';
        $findsData['email'] = $findsData['email'] ? $findsData['email'] : 'Nothing found';
        $findsData['snap_id'] = $findsData['snap_id'] ? $findsData['snap_id'] : 'Nothing found';

        $number ='<p> Numbers: ' . $findsData['phone_number'] . '</p>';
        $email = '<p> Emails or Telegram: ' . $findsData['email'] . '</p>';
        $snapID = '<p> Snap ID: ' . $findsData['snap_id'] . '</p>';

        $data = $number . $email . $snapID;

        return $data ;
    }
}
