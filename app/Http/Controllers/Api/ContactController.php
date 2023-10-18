<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'message'=>'required|max:500',
            'attachment'=>'nullable|file|max:5000'
        ]);
        //Salvo nella tabella i dati che ricevo
        $newContact = new Contact();

        $newContact->name = $data['name'];
        $newContact->email = $data['email'];
        $newContact->message = $data['message'];
        //Il file in allegato no è required quindi faremo un if
        if(key_exists("attachment", $data)){
            $path = Storage::put("contacts", $data['attachment']);
            $newContact->attachment = $path;
        }
        $newContact->save();

        //Salvo dentro la tabella contacts i dati ricevuti
        return response()->json([
            'message'=> 'Thank you for your message. We will be in touch soon!'], 201);
    }
}
