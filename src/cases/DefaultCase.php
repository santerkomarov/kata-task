<?php

namespace GildedRose\Cases;

use GildedRose\Item;
use GildedRose\Cases\UpdateCase;

/**
 * Товар «по умолчанию», всё что не входит вдругие категории особых товаров.
 * В конце дня наша система снижает значение обоих свойств для каждого товара.
 * После того, как срок храния прошел, качество товара ухудшается в два раза быстрее.
 * Качество товара никогда не может быть отрицательным.
 */
class DefaultCase implements UpdateCase {

    public function refresh(Item $item): void {

        // Уменьшаем срок годности
        $item->sellIn --;

        // Снижаем качество с учётом срока годности
        if ($item->sellIn < 0) {
            $item->quality -= 2;
        } else {
            $item->quality --;
        }

        // Качество не может быть меньше 0
        if ($item->quality < 0) {
            $item->quality = 0;
        }

        // Качество не может быть больше 50
        if ($item->quality > 50) {
            $item->quality = 50;
        }
    }
}