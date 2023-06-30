<?php

namespace Triline\Test;

use Bitrix\Crm\Timeline\TimelineType;
use CBitrixComponent;
use CUser;
use Bitrix\Main\Loader;
use Bitrix\Crm\Timeline\Entity\TimelineTable;
use Bitrix\Crm;

class SomeTest extends CBitrixComponent{

    /** @var int */
    protected $entityID = 0;

    public function doAny ()
    {
        global $APPLICATION;

        $arr = $APPLICATION->IncludeComponent(
            'bitrix:crm.timeline',
            '',
            array(
                'ENTITY_TYPE_ID' => 1,
                'ENTITY_ID' => 11,
                'ENTRY_CATEGORY_ID' => Crm\Filter\TimelineEntryCategory::COMMENT,
            ),
        );

        echo $arr;
    }
}