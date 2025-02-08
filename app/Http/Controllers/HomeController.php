<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function kavach_index(){




        return view('kavach.kavach');
    }
    public function kavach_overview(){


        return view('kavach.overview');
    }
    public function kavach_multimedia(){

        return view('kavach.multimedia');

    }
    public function kavach_brochure(){

        return view('kavach.brochure');

    }
    public function kavach_advisories(){

        return view('kavach.advisories');
    }
    public function organisation_index(){
        return view('organisation.index');

    }
    public function _5G_index(){

        return view('5g.index');
    }
    public function _5G_overview(){
        return view('5g.overview');

    }
    public function _5G_brochure(){
        return view('5g.brochure');
    }
    public function _5G_advisories(){
        return view('5g.advisories');
    }
    public function _5G_multimedia(){

        return view('5g.multimedia');
    }


    public function lte_index(){
        return view('lte.index');
    }
    public function lte_overview(){
        return view('lte.overview');
    }
    public function lte_brochure(){
        return view('lte.brochure');
    }
    public function lte_advisories(){
        return view('lte.advisories');
    }
    public function lte_multimedia(){
        return view('lte.multimedia');
    }








}
