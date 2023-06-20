<?php

\Bitrix\Main\Loader::registerAutoLoadClasses('SomeTest',
    [
        'Bitrix\Triline\Test\SomeTest' => 'lib/sometest.php'
    ]
);