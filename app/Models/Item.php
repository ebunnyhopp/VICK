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
    
    public function r_request() {
        return $this->hasOne(Request::class, 'item_id');
    }
    
    public function r_location(){
        return $this->belongsTo(LLocation::class,'location_id');
    }
    
    public function getstatus(){
        switch($this->status){
            case 1:
                if($this->r_request && $this->r_request->status ==1){
                    return "<span class='badge bg-primary'>new request</span>";
                } else if ($this->r_request && $this->r_request->status ==2){
                    return "<span class='badge bg-primary'>pending return</span>";
                }
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
