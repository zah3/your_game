<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $news = News::orderBy('n_creatd_at', 'DESC')->get();
        return response()->json(['news' => $news],200);
    }
    public function create(Request $request){

    }

    public function show($id){
        $new = News::where('n_id',$id)->first();
        $this->simplyValidate($new);
    }

    public function update(){

    }



    public function destroy(){

    }
    private function simplyValidate($new){
        if(!$new)
            return response()->json(['message' => trans('json_messages.fail.cannot_find',['model' => trans('json_messages.model.news')])]);
        elseif($new->n_deleted_at != null)
            return response()->json(['message' => trans('json_messages.fail.deleted',['model' => trans('json_messages.model.news')])]);
        else
            return response()->json(['new' => $new],200);
    }
}
