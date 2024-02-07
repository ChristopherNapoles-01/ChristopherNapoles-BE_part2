<?php

namespace App\Http\Services;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\CategoryRepository;
use App\Models\CategoryModel;

class CategoryService
{
    //resolve CategoryRepository
    public function __construct(
        protected CategoryRepository $categoryRepository,
    ){}
    
    public function createCategory(array $data)
    {
        $message = $this->validate($data, [
            'name' => [Rule::unique('mongodb.category', 'name'), 'required', 'string'],
            'description' => 'string'
        ]);

        if ($message) {
            return [
                'error' => $message,
            ];
        }

       
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
        $message = $this->validate($data, [
            'name' => [Rule::unique('mongodb.category', 'name'), 'string'],
            'description' => 'string'
        ]);

        if ($message) {
            return [
                'error' => $message,
            ];
        }
        
        return $this->categoryRepository->updateCategory($categoryId, $data);
    }

    //validate request data
    private function validate(array $data, array $rules, array $messages = [])
    {
        Validator::getPresenceVerifier();
        $validator = Validator::make($data, $rules, $messages);
        
        if ($validator->fails()) {
            return $validator->errors();
        }
    }

}