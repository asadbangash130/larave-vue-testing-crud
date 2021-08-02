<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
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
    public function scopeSaveOrUpdate($query,$object,$request){
        $object->setAttributeValue('name',$request->input('name'))
        ->setAttributeValue('email',$request->input('email'))
        ->setAttributeValue('file',
        !empty($request->file('file')) && $request->hasFile('files')
            ? uploadAvatar($request->file('file'))
            : $object->avatar
    )
    

            ->save();
        return $object;
    }
}
