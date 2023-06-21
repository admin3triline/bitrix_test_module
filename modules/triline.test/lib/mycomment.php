<?php

namespace Triline\Test;

use Bitrix\Main\Loader;
use Bitrix\Crm\Timeline\Entity;

class MyComment {

    public function hideComment ()
    {
        global $USER;

        $user_ID_now = $USER->GetID();

        echo $user_ID_now;

        Loader::includeModule('crm');

        $rs = Entity\TimelineTable::getList(array(
            'order' => array("ID" => "DESC"),
            'filter' => array('=TYPE_ID' => 7, '=AUTHOR_ID' => $user_ID_now),
        ));
        while($ar = $rs->Fetch())
        {
            echo '<pre>';
            print_r($ar);
            echo '</pre>';
        }

        return true;
    }
}