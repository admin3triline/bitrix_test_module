<?php

\Bitrix\Main\Loader::registerAutoLoadClasses('triline.test', array(
    '\Ttiline\Test\SomeTest' => '/lib/sometest.php',
    '\Triline\Test\MyComment' => '/lib/mycomment.php',
));