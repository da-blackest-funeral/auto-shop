<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            Category::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            Category::create([
                'title' => $request->validate(['title' => 'required'])
            ])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            $category->load('autoparts')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Category $category): \Illuminate\Http\JsonResponse
    {
        $category->update($request->validate(['title' => 'required']));
        $category->autoparts()->save($request->input('autoparts'));

        return response()->json($category->load('autoparts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category): Response
    {
        $category->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
