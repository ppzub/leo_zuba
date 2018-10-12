<?php

namespace Kazka;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
	protected $fillable = ['pic', 'post_id'];

    public function post()
    {
        return $this->belongsTo('Kazka\Post');
    }
}
