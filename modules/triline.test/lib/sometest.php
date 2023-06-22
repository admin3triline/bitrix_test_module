<?php

namespace Triline\Test;

use CUser;


class SomeTest {

    public function doAny ()
    {
        global $USER;

        $user_ID_now = $USER->GetID();
        $user_group_ar = CUser::GetUserGroup($user_ID_now);

        print_r($user_group_ar);

        echo '<pre>';
        echo 'Принадлежит группе "Сотрудники" '.in_array(12, $USER->GetUserGroupArray());
        echo '<pre>';

        return true;
    }
}