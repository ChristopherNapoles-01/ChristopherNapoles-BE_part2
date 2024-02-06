<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\CategoryRepository;

class CategoryService
{
    //resolve CategoryRepository
    public function __construct(
        protected CategoryRepository $categoryRepository,
    ){}
    
    public function createCategory(array $data)
    {
        $this->validate($data, [
            'name' => 'required|string',
            'description' => 'string'
        ]);
        return $this->categoryRepository->createCategory($data);
    }

    public function listCategories()
    {
        return $this->categoryRepository->listCategories();
    }

    public function findCategory(string $categoryId)
    {
        return $this->categoryRepository->findCategory($categoryId);
    }

    public function deleteCategory(string $categoryId)
    {
        return $this->categoryRepository->deleteCategory($categoryId);
    }

    public function updateCategory(string $categoryId, array $data)
    {
        $this->validate($data, [
            'name' => 'string',
            'description' => 'string'
        ]);
        return $this->categoryRepository->updateCategory($categoryId, $data);
    }

    //validate request data
    private function validate(array $data, array $rules, array $messages = [])
    {
        $validator = Validator::make($data, $rules, $messages);

        return $validator;
    }

}