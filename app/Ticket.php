<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
   public $fillable = ['title','description','category'];
}
