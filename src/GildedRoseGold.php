<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Cases\AgedBrieCase;
use GildedRose\Cases\BackstagePassesCase;
use GildedRose\Cases\SulfurasCase;
use GildedRose\Cases\DefaultCase;
use GildedRose\Cases\ConjuredCase;
use GildedRose\Cases\UpdateCase;

final class GildedRoseGold
{
    private array $items;

    public function __construct(array $items) {
        $this->items = $items;
    }

    public function updateQuality(): void {
        foreach ($this->items as $item) {
            $this->getCaseForItem($item)->refresh($item);
        }
    }

    private function getCaseForItem(Item $item): UpdateCase {
        switch ($item->name) {
            case 'Aged Brie' :
                return new AgedBrieCase();
            case 'Backstage passes to a TAFKAL80ETC concert' :
                return new BackstagePassesCase();
            case 'Sulfuras, Hand of Ragnaros' :
                return new SulfurasCase();
            case 'Conjured Mana Cake' :
                return new ConjuredCase();
            default:
                return new DefaultCase();
        }
    }
}
