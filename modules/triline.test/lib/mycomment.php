<?php

namespace Triline\Test;

use Bitrix\Main\Loader;
use Bitrix\Crm\Timeline\Entity;

class MyComment {

    public function getCommentaries ()
    {
        global $USER;

        $user_ID_now = $USER->GetID();
        $user_admin = $USER->IsAdmin();
        $user_group = "";
        $user_role = "";


        if ($user_admin) {
            MyComment::allComments();
        }
        elseif (in_array(10, $USER->GetUserGroupArray()))
        {
            MyComment::allComments();
        }
        else
        {
            MyComment::onliMineComments ();
        }
    }

    public function onliMineComments () // Выводит список только с комментариями настоящего пользователя во всех
    {
        global $USER;

        $user_ID_now = $USER->GetID();

        Loader::includeModule('crm');

        $rs = Entity\TimelineTable::getList(array(
            'order' => array("ID" => "DESC"),
            'filter' => array('=TYPE_ID' => 7, '=AUTHOR_ID' => $user_ID_now), // ID пользователя
        ));
        while($ar = $rs->Fetch())
        {
            echo '<pre>';
            print_r($ar);
            echo '</pre>';
        }
    }

    public function allComments () // Выводит список со всеми комментариями во всех сделках
    {
        Loader::includeModule('crm');

        $rs = Entity\TimelineTable::getList(array(
            'order' => array("ID" => "DESC"),
            'filter' => array('=TYPE_ID' => 7),
        ));
        while($ar = $rs->Fetch())
        {
            echo '<pre>';
            print_r($ar);
            echo '</pre>';
        }
    }
}