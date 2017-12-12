<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class News extends Model{

    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'n_title',
        'n_content',
        'n_language',
        'n_updated_at'
    ];

    protected $dates = [
        'n_created_at',
        'n_deleted_at'
    ];

    const DELETED_AT = 'n_deleted_at';

    protected $primaryKey = 'n_id';

    protected $table = 'news';

    /**
     * Function for update model
     * @param array $array - with
     * @return bool
     */
    public function updateNews(Array $array){
        DB::beginTransaction();
        try{
            //setting right data to variables
            $newTitle = array_key_exists ('n_title',$array) ?  $array['n_title'] :  $this->n_title;
            $newContent = array_key_exists ('n_content',$array) ?  $array['n_content'] : $this->n_content;
            $newLang = array_key_exists ('n_language',$array) ?  $array['n_language'] : $this->n_language;
            //checking is in DB model
            $news = News::where('n_id','=',$this->n_id)->first();
            if(!$news){
                DB::rollback();
                return false;
            }elseif(!is_null($news->n_deleted_at)){
                DB::rollback();
                return false;
            }else{
                $news->update([
                    'n_title'       => $newTitle,
                    'n_content'     => $newContent,
                    'n_language'    => $newLang,
                    'n_updated_at'   => date('Y-m-d H:i:s')
                ]);
                DB::commit();
                return true;
            }
        }catch(\Exception $e){
            DB::rollback();
            Log::error('Method updateNews (Exception): ' . $e);
            return false;
        }catch(\Throwable $e){
            DB::rollback();
            Log::error('Method updateNews (Throwable): ' . $e);
            return false;
        }
    }

    /**
     * function to save model in DB
     * @return bool
     */
    public function saveIt(){
        DB::beginTransaction();
        try{
            $this->save();
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollback();
            Log::error('Method saveIt on Model news (Exception): '. $e);
            return false;
        }catch(\Throwable $e){
            DB::rollback();
            Log::error('Method saveIt on Model news (Throwable): ' . $e);
            return false;
        }
    }

    /**
     * Get enum types of language in news
     * 0 - pl
     * 1 - en
     * @return array
     */
    public function getLanguageTypes(){
        $query = "SHOW COLUMNS FROM `news` LIKE 'n_language';";
        $res = DB::select(DB::raw($query));
        if(count($res) == 1){
            if($enum = $res[0]->Type){
                if(str_contains($enum,'enum(')){
                    $enums = explode(',',str_replace([
                                                'enum(',
                                                ')',
                                                "'"
                    ],'',$enum));
                    if(count($enums) > 0){
                        return $enums;
                    }
                }
            }
        }
    }
}
