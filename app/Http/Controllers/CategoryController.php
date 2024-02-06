<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Implemented Service And Repository Pattern
    //resolve CategoryService
    public function __construct(
        protected CategoryService $categoryService
    ){}

    public function index()
    {
        return response($this->categoryService->listCategories());
    }

    public function show(string $categoryId)
    {   
        return response($this->categoryService->findCategory($categoryId));
    }

    public function store(Request $request)
    {
        return response($this->categoryService->createCategory($request->all()));
    }

    public function update(string $categoryId, Request $request)
    {
        return response($this->categoryService->updateCategory($categoryId, $request->all()));
    }

    public function destroy(string $categoryId)
    {
        return response($this->categoryService->deleteCategory($categoryId));
    }
}
