<?php

use PHPUnit\Framework\TestCase;
use App\Models\Database;
use App\Models\Winner;

final class WinnerTest extends TestCase
{

    public function testWinnerTableHasThreeRows()
    {
        $model = new Winner();
        $rows = $model->read();
        $this->assertEquals(3, count($rows));
    }
}
