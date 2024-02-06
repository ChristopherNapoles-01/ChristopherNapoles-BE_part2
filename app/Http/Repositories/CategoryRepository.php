<?php

namespace App\Http\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryModel;



class CategoryRepository
{
    private $builder = '';
    public function __construct()
    {
        $this->setBuilder();
    }
    private function setBuilder()
    {
        $this->builder = DB::connection('mongodb')->table('category');
    }
    public function createCategory(array $data)
    {
        return CategoryModel::create($data);
    }

    public function listCategories()
    {
        return CategoryModel::all();
    }

    public function findCategory(string $categoryId)
    {
        return CategoryModel::find($categoryId);
    }

    public function deleteCategory(string $categoryId)
    {
        return CategoryModel::destroy($categoryId);
    }

    public function updateCategory(string $categoryId, array $data)
    {
        return CategoryModel::where('_id', $categoryId)->update($data);
    }
}