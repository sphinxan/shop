<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cookie;

class Basket extends Model {

    /**
     * Возвращает количество позиций в корзине
     */
    public static function getCount() {
        $basket_id = request()->cookie('basket_id');
        if (empty($basket_id)) {
            return 0;
        }
        return self::getBasket()->products->count();
    }

    public static function getBasket() {
        $basket_id = request()->cookie('basket_id');
        if (!empty($basket_id)) {
            try {
                $basket = Basket::findOrFail($basket_id);
            } catch (ModelNotFoundException $e) {
                $basket = Basket::create();
            }
        } else {
            $basket = Basket::create();
        }
        Cookie::queue('basket_id', $basket->id, 525600);
        return $basket;
    }

    public function getAmount() {
        $amount = 0.0;
        foreach ($this->products as $product) {
            $amount = $amount + $product->price * $product->pivot->quantity;
        }
        return $amount;
    }


    /**
     * Связь «многие ко многим» таблицы `baskets` с таблицей `products`
     */
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    /**
     * Увеличивает кол-во товара $id в корзине на величину $count
     */
    public function increase($id, $count = 1) {
        $this->change($id, $count);
    }

    /**
     * Уменьшает кол-во товара $id в корзине на величину $count
     */
    public function decrease($id, $count = 1) {
        $this->change($id, -1 * $count);
    }

    /**
     * Изменяет количество товара $id в корзине на величину $count;
     * если товара еще нет в корзине — добавляет этот товар; $count
     * может быть как положительным, так и отрицательным числом
     */
    private function change($id, $count = 0) {
        if ($count == 0) {
            return;
        }
        // если товар есть в корзине — изменяем кол-во
        if ($this->products->contains($id)) {
            // получаем объект строки таблицы `basket_product`
            $pivotRow = $this->products()->where('product_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0) {
                // обновляем количество товара $id в корзине
                $pivotRow->update(['quantity' => $quantity]);
            } else {
                // кол-во равно нулю — удаляем товар из корзины
                $pivotRow->delete();
            }
        } elseif ($count > 0) { // иначе — добавляем этот товар
            $this->products()->attach($id, ['quantity' => $count]);
        }
        // обновляем поле `updated_at` таблицы `baskets`
        $this->touch();
    }

    /**
     * Удаляет товар с идентификатором $id из корзины покупателя
     */
    public function remove($id) {
        // удаляем товар из корзины (разрушаем связь)
        $this->products()->detach($id);
        // обновляем поле `updated_at` таблицы `baskets`
        $this->touch();
    }
}
