<?php

namespace GildedRose\Cases;

use GildedRose\Item;
use GildedRose\Cases\UpdateCase;

/**
 * Товар «Backstage passes». Качество увеличивается по мере приближения к сроку хранения.
 * Качество увеличивается на 2, когда до истечения срока хранения 10 или менее дней и на 3,
 * если до истечения 5 или менее дней. При этом качество падает до 0 после даты проведения концерта.
 */
class BackstagePassesCase  implements UpdateCase {
    public function refresh(Item $item): void {

        // Качество не может быть больше 50
        if ($item->quality > 50) {
            $item->quality = 50;
        }

        if ($item->quality < 50) {
            // Качество увеличивается каждый день
            $item->quality++;

            // Качество увеличивается на 2, когда до истечения срока хранения 10 или менее дней
            if ($item->sellIn <= 10 && $item->quality < 50) {
                $item->quality++;
            }

            // Качество увеличивается на 3, когда до истечения срока хранения 5 или менее дней
            if ($item->sellIn <= 5 && $item->quality < 50) {
                $item->quality++;
            }
        }

        // Уменьшение срока годности
        $item->sellIn --;

        // После даты проведения концерта качество становится 0
        if ($item->sellIn < 0) {
            $item->quality = 0;
        }
    }
}