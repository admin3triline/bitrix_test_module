<?php

namespace Triline\Test;

use Bitrix\Crm\Controller\Timeline;
use Bitrix\Crm\Timeline\Entity\TimelineTable;
use \Bitrix\Crm\Timeline\Entity\TimelineBindingTable;
use Bitrix\Crm\Timeline\TimelineType;
use Bitrix\Crm\Timeline\HistoryDataModel;
use Bitrix\UI\Timeline\Comment;

class TimelineSort {

    public function commentOutput () // получаем комментарий из конкретной сделки
    {
        $result = TimelineTable::getList(
            ['select' => ['CREATED', 'COMMENT'],
                'filter' => [
                    'TYPE_ID' => TimelineType::COMMENT,
                    'BINDINGS.ENTITY_ID' => 11], // ID сущности
            ]);
        print_r($result->fetchAll());
    }

    public function setCommnetEd ()
    {
        global $USER;

        $user_ID_now = $USER->GetID();



    }

    public function getSomeData ()
    {

    }
}