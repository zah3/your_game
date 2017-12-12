<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    /**
     * Per page
     * @var int
     */
    protected $paginate = 3;

    /**
     * @param Request $request
     * @param News $newsModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, News $newsModel){
        $skip = ($request->input('page') == null || $request->input('page') == 1 ) ? 0 : $request->input('page') * $this->paginate - $this->paginate;
        $lang = ($request->input('lang') != null) ? 'en' : (in_array($request->input('lang'),$newsModel->getLanguageTypes())) ? $request->input('lang') : 'en';
        $news = News::where('n_language','=',$lang)->orderBy('n_created_at', 'DESC')->skip($skip)->take($this->paginate)->get();
        $page = ($skip == 0) ? 1 : ($skip + $this->paginate)/$this->paginate;
        return response()->json(['news' => $news, 'page' => $page, 'lang' => $lang],200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        $this->formValidate($request->all());
        $news = News::create([
            'n_title'   => $request->input('title'),
            'n_content' => $request->input('content'),
            'n_language' => $request->input('language')
        ]);
        $isSaved = $news->saveIt();
        if($isSaved) {
            return response()->json(['message' => 'success'], 201);
        }else {
            return response()->json(['message' => 'failure'], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id){
        $new = News::where('n_id',$id)->first();
        if(!$new){
            return response()->json(['message' => trans('json_messages.fail.cannot_find', ['model' => trans('json_messages.model.news')])]);
        }elseif($new->n_deleted_at != null) {
            return response()->json(['message' => trans('json_messages.fail.deleted', ['model' => trans('json_messages.model.news')])]);
        }else {
            return response()->json(['show' => $new], 200);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function update(Request $request,$id){
        if($request->input('title') && $request->input('content') && $request->input('language')){
            $this->formValidate($request->all());
            $new = News::where('n_id',$id)->first();
            if(!$new) {
                return response()->json(['message' => trans('json_messages.fail.cannot_find', ['model' => trans('json_messages.model.news')])]);
            }elseif(!is_null($new->n_deleted_at)) {
                return response()->json(['message' => trans('json_messages.fail.deleted', ['model' => trans('json_messages.model.news')])]);
            }
            if( $new->n_title != $request->input('n_title') ||
                $new->n_content != $request->input('n_content') ||
                $new->n_language != $request->input('n_language')){
                $checkIsUpdated = $new->updateNews(['n_title' => $request->input('title'), 'n_content' => $request->input('content'),'n_language' => $request->input('language')]);
                if($checkIsUpdated){
                    return response()->json(['message' => trans('json_messages.success.updated', trans('json_messages.model.news')) ], 200);
                }else{
                    return response()->json(['message' => trans('json_messages.fail.updating' , trans('json_messages.model.news'))]);
                }
            }
        }else{
            return response()->json(['message' => trans('json_messages.fail.send_failed_inf')]);
        }
    }

    /**
     * @param Model news.id - $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id){
        $news = News::find($id);
        if(!$news) {
            return response()->json(['message' => trans('json_messages.fail.cannot_find', ['model' => trans('json_messages.model.news')])]);
        }else{
            $checkIsDone = $news->delete();
            if($checkIsDone) {
                return response()->json(['message' => 'success'], 200);
            }else {
                return response()->json(['message' => 'fail go to logs'], 400);
            }
        }
    }

    /**
     * validate incame request
     * @param $request
     */
    private function formValidate($request){
        $news = new News();
        $rules = [
            'title'     => 'required|string|min:5|max:255',
            'content'   => 'required|min:5',
            'language'  => ['required', Rule::in($news->getLanguageTypes())]
        ];
        Validator::make($request,$rules)->validate();
    }
}
