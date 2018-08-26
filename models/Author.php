<?php

namespace models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model {
  protected $table = 'author';
  
  public $timestamps = false;

  public function quotes() {
    return $this->hasMany('models\Quote');
  }
}