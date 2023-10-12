<?php

declare(strict_types=1);

use GildedRose\GildedRoseGold;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseGoldTest extends TestCase
{

    /**
     * Данные для теста.
     */
    public function dataProvider(): array
    {
        return [
            'Default Case'    => ['default', 10, 5, 9, 4],          // по дефолту, качество снижается на 1 после одного дня
            'Default Case 2'  => ['Dexterity Vest', -1, 6, -2, 4],  // после окончания хранения, качество снижается на 2 после одного дня
            'Min Default'     => ['10 Aberdin', 10, -2, 9, 0],      // качество не может быть меньше 0
            'Max Default'     => ['Izhevsk', 10, 60, 9, 50],        // качество не может быть больше 50

            'Aged Brie Case'  => ['Aged Brie', 10, 5, 9, 6],         // по дефолту, качество для этого товара увеличивается на 1 после одного дня
            'Aged Brie Case 2'=> ['Aged Brie', -1, 6, -2, 7],        // после окончания хранения, качество увеличивается на 2 после одного дня
            'Min Aged Brie'   => ['Aged Brie', 10, -2, 9, 0],        // качество не может быть меньше 0
            'Max Aged Brie'   => ['Aged Brie', 10, 60, 9, 50],       // качество не может быть больше 50

            'Backstage Case'  => ['Backstage passes to a TAFKAL80ETC concert', 12, 5, 11, 6],    // по дефолту, качество для этого товара увеличивается на 1 после одного дня
            'Backstage Case 2'=> ['Backstage passes to a TAFKAL80ETC concert', 10, 20, 9, 22],   // качество увеличивается на 2, когда до истечения срока хранения 10 или менее дней
            'Backstage Case 3'=> ['Backstage passes to a TAFKAL80ETC concert', 5, 30, 4, 33],    // качество увеличивается на 3,если до истечения 5 или менее дней.
            'Backstage Case 4'=> ['Backstage passes to a TAFKAL80ETC concert', 0, 40, -1, 0],    // качество падает до 0 после даты проведения концерта.
            'Min Backstage'   => ['Backstage passes to a TAFKAL80ETC concert', 10, -2, 9, 0],    // качество не может быть меньше 0
            'Max Backstage'   => ['Backstage passes to a TAFKAL80ETC concert', 10, 60, 9, 50],   // качество не может быть больше 50

            'Sulfuras Case'   => ['Sulfuras, Hand of Ragnaros', 10, 80, 10, 80],                 // У него нет срока хранения и не подвержен ухудшению качества. Всегда значение 80

            'Conjured Case'   => ['Conjured Mana Cake', 10, 5, 9, 3],                            // по дефолту, качество этого товара теряется на 2 после каждого дня
            'Min Conjured'    => ['Conjured Mana Cake', 10, -2, 9, 0],                           // качество не может быть меньше 0
            'Max Conjured'    => ['Conjured Mana Cake', 10, 60, 9, 50],                          // качество не может быть больше 50
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function test(string $name, int $sellIn, int $quality, int $expectedSellIn, int $expectedQuality): void
    {
        $items = [new Item($name, $sellIn, $quality)];
        $gildedRoseGold = new GildedRoseGold($items);
        $gildedRoseGold->updateQuality();

        $this->assertSame($expectedSellIn, $items[0]->sellIn);
        $this->assertSame($expectedQuality, $items[0]->quality);
    }
}
