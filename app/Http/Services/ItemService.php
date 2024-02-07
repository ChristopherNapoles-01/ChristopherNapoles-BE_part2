<?php

namespace App\Http\Services;

use Illuminate\Validation\Rule;
use App\Http\Repositories\ItemRepository;
use Illuminate\Support\Facades\Validator;
use MongoDB\BSON\ObjectId;


class ItemService
{
    public function __construct(
        protected ItemRepository $itemRepository,
    ){}

    public function createItem(array $data)
    {
        $message = $this->validate($data, [
            'name' => [Rule::unique('mongodb.item', 'name'), 'required'],
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'integer',
            'category_id' => 'required'
        ]);

        if ($message) {
            return [
                'error' => $message,
            ];
        }
        $data['category_id'] = new ObjectId($data['category_id']);
        return $this->itemRepository->createItem($data);
    }

    public function listItems()
    {
        return $this->itemRepository->listItems();
    }

    public function findItem(string $itemId)
    {
        return $this->itemRepository->findItem($itemId);
    }

    public function deleteItem(string $itemId)
    {
        return $this->itemRepository->deleteItem($itemId);
    }

    public function updateItem(string $itemId, array $data)
    {
        $message = $this->validate($data, [
            'name' => [Rule::unique('mongodb.item', 'name'), 'required'],
            'description' => 'string',
            'price' => 'numeric',
            'quantity' => 'integer',
        ]);

        if ($message) {
            return [
                'error' => $message,
            ];
        }

        return $this->itemRepository->updateItem($itemId, $data);
    }

    public function listItemsWithCategory()
    {
        return $this->itemRepository->listItemsWithCategory();
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