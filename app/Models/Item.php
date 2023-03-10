<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    public function r_category(){
        return $this->belongsTo(LCategory::class,'category_id');
    }
    
    public function getstatus(){
        switch($this->status){
            case 1:
                return "<span class='badge bg-primary'>new item</span>";
                break;
            case 2:
                return "<span class='badge bg-success'>returned item</span>";
                break;
            default:
                return 'error';
              
        }
    }
    
}
