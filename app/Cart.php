<?php

namespace App;


class Cart
{
    public $items=null;
    public $totalQty = 0;
    public $totalPrice;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }

    }

    public function add($item, $id){
        $storedItem = ['qty' => 0,'price' => $item->price, 'item' => $item];

        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    public function delete($item){
        $id = $item->id;
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
                if($storedItem['qty']>0){
                    $storedItem['qty']--;
                    $this->totalPrice -= $storedItem['price'];
                    $storedItem['price'] = $item->price * $storedItem['qty'];
                    $this->items[$id] = $storedItem;
                    $this->totalQty--;
                    $this->totalPrice += $storedItem['price'];
                    if($storedItem['qty']==0)
                    unset($items, $this->items[$id]);
                }
            }
        }

    }
}