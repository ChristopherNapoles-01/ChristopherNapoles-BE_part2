<?php

namespace App\Http\Controllers;

use App\Http\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //Implemented Service And Repository Pattern
    //Resolve ItemService class
    public function __construct(
        protected ItemService $itemService,
    ){}

    public function index(Request $request)
    {
        return response($this->itemService->listItems());
    }

    public function show(string $itemId)
    {
        return response($this->itemService->findItem($itemId));
    }

    public function store(Request $request)
    {
        return response($this->itemService->createItem($request->all()));
    }

    public function update(string $itemId, Request $request)
    {
        return response($this->itemService->updateItem($itemId, $request->all()));
    }

    public function destroy(string $itemId)
    {   
        return response ($this->itemService->deleteItem($itemId));
    }
    
    public function listItemsWithCategoryDetails()
    {
        return response($this->itemService->listItemsWithCategory());
    }
}
