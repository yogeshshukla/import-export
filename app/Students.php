<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
class Students extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student';

    public $timestamps = false;


    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function address()
    {

        return $this->hasOne('StudentAddresses', 'id');

    }
}
