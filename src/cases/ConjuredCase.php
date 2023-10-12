<?php

namespace GildedRose\Cases;

use GildedRose\Item;
use GildedRose\Cases\UpdateCase;

/**
 * Товар «Conjured». Теряет качество в два раза быстрее, чем обычные товары.
 *
 */
class ConjuredCase implements UpdateCase  {

    public function refresh(Item $item): void {


        if ($item->quality > 0) {
            // Уменьшаем качество на 2 единицы
            $item->quality = $item->quality - 2;
        }

        // Уменьшаем срок годности
        $item->sellIn --;

        // Качество не может быть отрицательным
        if ($item->quality < 0) {
            $item->quality = 0;
        }

        // Качество не может быть больше 50
        if ($item->quality > 50) {
            $item->quality = 50;
        }
    }
}