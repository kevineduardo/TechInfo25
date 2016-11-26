<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContatoMail;
use App\Http\Requests;
use App\Setting;

class ContactController extends Controller
{
    public function index() {
        $c = [];
        $c[] = [ 'name' => 'Email', 'value' => Setting::where('name','email')->first()['value'] ];
        $c[] = [ 'name' => 'Telefone', 'value' => Setting::where('name','phone')->first()['value'] ];
    	return view( 'contato', [ 'contato' => $c ] );
    }
}
