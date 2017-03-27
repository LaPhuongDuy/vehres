<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\AdministrationUnit;
use App\Models\Garage;

/**
 * Created by PhpStorm.
 * User: Laptop
 * Date: 2/3/2017
 * Time: 8:42 AM
 */
class MyHelper
{
   public static function uploadFile(UploadedFile $file, $options = array())
   {
       $fileName = uniqid() . '.' . $file->extension();
       $path = '';
       for ($i = 0; $i < 5; $i ++) {
           $randomString = md5(str_random(10));
           $randomFolder = substr($randomString, 0, 2);
           $path .= '/' . $randomFolder;
       }
       $path .= '/' . $fileName;
       //storage uploaded file
       $stored = Storage::disk('upload')->put('images' . $path,  \File::get($file));
            if ($stored == 1) {
                return $path;
            }
            abort(502);
   }

   public static function chosePlace($id)
   {
       $places = AdministrationUnit::select('name', 'id')->where('parent_id', $id)->get();

       return $places;
   }
   public static function getPlace($id)
   {
       $garage = Garage::find($id);

       return $place = [
           AdministrationUnit::where('parent_id', 0)->pluck('name', 'id'),
           AdministrationUnit::where('parent_id', $garage->province_id)->pluck('name', 'id'),
           AdministrationUnit::where('parent_id', $garage->district_id)->pluck('name', 'id'),
       ];
   }
   public static function getCurrentPlace($id)
   {
       $garage = Garage::find($id);

       return $curentplace = [
           AdministrationUnit::where('id', $garage->province_id)->pluck('name', 'id'),
           AdministrationUnit::where('id', $garage->district_id)->pluck('name', 'id'),
           AdministrationUnit::where('id', $garage->ward_id)->pluck('name', 'id'),
       ];
   }
}
