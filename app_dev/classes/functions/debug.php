<?php

function Dump()
{
    echo '<pre>';
    if (count(func_get_args()) == 1) {
        var_dump(func_get_args()[0]);
    } else {
        var_dump(func_get_args());
    }
    echo '</pre>';
}
