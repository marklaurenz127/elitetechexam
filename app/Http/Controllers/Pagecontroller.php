<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admins;
use App\Models\Crews;
use App\Models\Documents;

class Pagecontroller extends Controller
{
    public function index(){
        return view('admin.pages.index',[
            "ctr" => 1,
            "crews" => Crews::orderBy('id','desc')->limit(10)->get(),
        ]);
    }

    public function singleCrew($crewid){
        $crew = Crews::where('crewid', $crewid)->first();
        if(empty($crew)){
            abort(404);
        }else{
            return view('admin.pages.single.crew',[
                "data" => $crew,
                "documents" => Documents::where('crewid', $crew->crewid)->get(),
            ]);
        }
    }

    public function singleDocument($documentid){
        $document = Documents::where('documentid', $documentid)->first();
        if(empty($document)){
            abort(404);
        }else{
            return view('admin.pages.single.document',[
                "data" => $document,
                "crew" => Crews::where('crewid', $document->crewid)->first(),
                "crews" => Crews::orderBy('firstname','ASC')->get(),
            ]);
        }
    }

    public function crews(){
        return view('admin.pages.crewlist',[
            "data" => Crews::all(),
            "ctr" => 1
        ]);
    }

    public function documents(){
        return view('admin.pages.documents',[
            "data" => Documents::join('crews','crews.crewid','documents.crewid')->get(),
            "crews" => Crews::orderBy('firstname','ASC')->get(),
            "ctr" => 1
        ]);
    }

    public function admins(){
        return view('admin.pages.admins',[
            "data" => Admins::all(),
            "ctr" => 1
        ]);
    }
}
