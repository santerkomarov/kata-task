<?php

namespace GildedRose\Cases;

use GildedRose\Item;
use GildedRose\Cases\UpdateCase;

/**
 * Товар «Sulfuras». Является легендарным товаром, поэтому у него нет срока хранения и не подвержен ухудшению качества.
 * Имеет качество 80 и оно никогда не меняется.
 *
 */
class SulfurasCase implements UpdateCase {
    public function refresh(Item $item): void {
        $item->quality = 80;
    }
}