<?php

$arComponentDescription = array(
    "NAME" => GetMessage("COMP_NAME"),
    "DESCRIPTION" => GetMessage("COMP_DESCR"),
    "ICON" => "/images/icon.gif",
    "PATH" => array(
        "ID" => "content",
        "CHILD" => array(
            "ID" => "catalog",
            "NAME" => "Каталог товаров"
        )
    ),
    "AREA_BUTTONS" => array(
        array(
            'URL' => "javascript:alert('Это кнопка!!!');",
            'SRC' => '/images/button.jpg',
            'TITLE' => "Это кнопка!"
        ),
    ),
    "CACHE_PATH" => "Y",
    "COMPLEX" => "Y"
);
