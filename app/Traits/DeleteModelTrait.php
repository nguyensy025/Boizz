<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait DeleteModelTrait
{
    public function DeleteModelTrait($id, $model)
    {
        try{
            $model->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Delete success'
            ], status: 200);
        }catch(\Exception $exceoption){
            Log::error("Lỗi: " . $exceoption->getMessage() . " Line: " . $exceoption->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Delete fail'
            ], status: 500);
        }
    }

}
