<?php

namespace GildedRose\Cases;
use GildedRose\Item;

interface UpdateCase {
    public function refresh(Item $item): void;
}