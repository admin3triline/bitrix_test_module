<?php

namespace Triline\Test;

use Bitrix\Crm\Timeline\Entity\TimelineTable;
use Bitrix\Crm\Timeline\TimelineType;

class TimelineSort {

    public function commentOutput () // получаем комментарий из конкретной сделки
    {
        $result = TimelineTable::getList(
            ['select' => ['CREATED', 'COMMENT'],
                'filter' => [
                    'TYPE_ID' => TimelineType::COMMENT,
                    'BINDINGS.ENTITY_ID' => 11], // ID комментария сделки
            ]);
        print_r($result->fetchAll());
    }
}