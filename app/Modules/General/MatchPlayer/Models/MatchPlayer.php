<?php
namespace App\Modules\General\MatchPlayer\Models;
use Illuminate\Database\Eloquent\Model;

class MatchPlayer extends Model
{
    protected $table    = "match_player";
    protected $fillable = ['id','match_id','name','value'];
}