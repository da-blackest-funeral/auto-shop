<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attribute;

class AttributesController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Attribute $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute) {
        $attribute->delete();
        return response(null, \Illuminate\Http\Response::HTTP_NO_CONTENT);
    }
}
