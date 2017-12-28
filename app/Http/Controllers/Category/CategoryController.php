<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category =  Category::all();
    
         // return response()->json(['data'=>$category,'code'=>200],200);

        return $this->showAll($category);
    }

    
    public function store(Request $request)
    {
        
        $newCategory =  new Category;

        $newCategory->name = $request->input('name');
        $newCategory->description = $request->input('description');
        $newCategory->save();

        return response()->json(['data'=>$newCategory],201 );

    }


    public function show($id)
    {
        $category =  Category::findOrFail($id);

        return response()->json(['data'=>$category,'code'=>200],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function update(Request $request, $id)
    {
        
        $category =  Category::findOrFail($id);

        $category->name =  $request->input('name');
        $category->description =  $request->input('description');
        if ($category->isClean())
         {
             return response()->json(['error'=>'You need to specify and different value','code'=>422],422);
         }
         $category->save();

         return response()->json(['data'=>$category,'code'=>200],200);
    }

    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json(['data'=>$category ],200);
    }
}
