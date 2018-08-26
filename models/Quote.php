<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model {
  protected $table = 'quote';
    
  public $timestamps = false;

  public function author() {
    return $this->belongsTo('models\Author');
  }
}