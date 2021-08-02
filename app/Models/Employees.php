<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

     /**
     * ---------------------------Scope Functions---------------------------------------
     */
    public function setAttributeValue($name,$value)
    {
        if(!empty($value) && $value !== 'undefined'){
            $this->attributes[$name] = $value;
        }
        return $this;
    }

  /**
     * ---------------------------ORM Relations---------------------------------------
     */
    public function company(){
        return $this->belongsTo(Companies::class,"company_id","id");
    }


    public function scopeSaveOrUpdate($query,$object,$request){
        $object->setAttributeValue('first_name',$request->input('first_name'))
        ->setAttributeValue('last_name',$request->input('last_name'))
        ->setAttributeValue('company_id',$request->input('company_id'))
        ->setAttributeValue('email',$request->input('email'))
        ->setAttributeValue('phone',$request->input('phone'))


    

            ->save();
        return $object;
    }
}
