<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoverImage extends Model
{
    // Table name
    protected $table = 'cover_images';

    // Primary key
    public $primaryKey = 'id';

    //Timestamps
    public $timestamps = true;
}
