<?php
namespace App\Modules\General\Match\Models;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table    = "match";
    protected $fillable = ['id','code'];

    public function players(){
        return $this->hasMany("App\Modules\General\MatchPlayer\Models\MatchPlayer","match_id","id");
    }

}