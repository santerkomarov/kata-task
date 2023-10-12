<?php

namespace GildedRose\Cases;

use GildedRose\Item;
use GildedRose\Cases\UpdateCase;

 /**
 * Товар «Aged Brie». Качество увеличивается пропорционально возрасту.
 */
class AgedBrieCase implements UpdateCase  {

    public function refresh(Item $item): void {

        // Уменьшаем срок годности
        $item->sellIn --;

        // Качество увеличивается пропорционально возрасту
        if ($item->quality < 50) {
            $item->quality++;
        }

        // Качество не может быть больше 50
        if ($item->quality > 50) {
            $item->quality = 50;
        }
        // Качество не может быть меньше 0
        if ($item->quality < 0) {
            $item->quality = 0;
        }
    }
}