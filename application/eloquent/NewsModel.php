<?php 

namespace Eloquent;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model {

    protected $fillable = ['title', 'text'];

    protected $table = 'news';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
