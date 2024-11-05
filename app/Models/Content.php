<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $appends = ['link'];

    public function getLinkAttribute(){
        return asset($this->url);
    }
}
