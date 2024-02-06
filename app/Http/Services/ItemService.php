<?php

namespace App\Http\Services;

use App\Http\Repositories\ItemRepository;
use Illuminate\Support\Facades\Validator;


class ItemService
{
    public function __construct(
        protected ItemRepository $itemRepository,
    ){}

    public function createItem(array $data)
    {
        $this->validate($data, [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer|float',
            'quantity' => 'integer',
            'category_id' => 'required'
        ]);
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
        $this->validate($data, [
            'name' => 'string',
            'description' => 'string',
            'price' => 'integer|float',
            'quantity' => 'integer',
        ]);
        return $this->itemRepository->updateItem($itemId, $data);
    }

    public function listItemsWithCategory()
    {
        return $this->itemRepository->listItemsWithCategory();
    }
    
    //validate request data
    private function validate(array $data, array $rules, array $messages = [])
    {
        $validator = Validator::make($data, $rules, $messages);

        return $validator;
    }

}