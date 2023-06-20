<?php

namespace Bitrix\Triline\Test;

use \Bitrix\Main\Localization\loc;
use \Bitrix\Main;
use \Bitrix\Main\UserTable;


class IsOnwer {


    public function HideComment ()
    {
        global $USER;
        $userIdNow = $USER->getID();
        $userIdComment = '';

        echo $userIdNow;

//        if ($userIdNow["ID"] != $userIdComment)
//            echo $userIdNow;
        return $userIdNow;
    }


}