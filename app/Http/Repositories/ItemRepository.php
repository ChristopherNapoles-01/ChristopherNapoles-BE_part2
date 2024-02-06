<?php

namespace App\Http\Repositories;
use Illuminate\Support\Facades\DB;
use App\Models\ItemModel;



class ItemRepository
{
    private $builder = '';
    public function __construct()
    {
        $this->setBuilder();
    }
    private function setBuilder()
    {
        $this->builder = DB::connection('mongodb')->table('Item');
    }
    public function createItem(array $data)
    {
        return ItemModel::create($data);
    }

    public function listItems()
    {
        return ItemModel::all();
    }

    public function findItem(string $itemId)
    {
        return ItemModel::find($itemId);
    }

    public function deleteItem(string $itemId)
    {
        return ItemModel::destroy($itemId);
    }

    public function updateItem(string $itemId, array $data)
    {
        return ItemModel::where('_id', $itemId)->update($data);
    }

    public function listItemsWithCategory()
    {
        return ItemModel::aggregate(
            [
                '$lookup' => [
                    'from' => 'category',
                    'localField' => 'category_id',
                    'foreign_field' => '_id',
                'as' => 'category'
                ]
            ]
        );
    }
}