<?php

function checkNumber(string $number)
{
    $regExpstr = "/^((80|\+380)|0|380)[6,9,5,4,7][0-9](((\-|\ )[0-9]{3}\-[0-9]{2}\-[0-9]{2})|(\ [0-9]{3}\ [0-9]{2}\ [0-9]{2})|[0-9]{7})\$/";

    return (bool)preg_match($regExpstr, $number);
}
