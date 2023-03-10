<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    
    public function r_item(){
        return $this->belongsTo(Item::class,'item_id');
    }
    
    public function getstatus(){
        switch($this->status){
            case 0:
                return "<span class='badge bg-danger'>Rejected request</span>";
                break;
            case 1:
                return "<span class='badge bg-primary'>New request</span>";
                break;
            case 2:
                return "<span class='badge bg-success'>Accepted request</span>";
                break;
            default:
                return 'error';
              
        }
    }
}
