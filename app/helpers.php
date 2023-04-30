<?php

if(!function_exists('createRandom')){
    function createRandom($length)
    {
        return Str::padLeft( mt_rand( 1, str_repeat(9, $length) ), $length, '0' );
    }
}

if(!function_exists('unlinkPhoto')){
    function unlinkPhoto($path) 
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}


if(!function_exists('randomName')){
    function randomName(string $extension, string $delimiter) : string
    {
        $random = createRandom(10);
        return $randomName = time().$delimiter.$random. "." . $extension;
    }
}

if(!function_exists('money')){
    function money(int $value, string $currency) : string
    {
		return $money = $currency . '. ' . number_format($value, 2, ',', '.');
	}
}
if(!function_exists('dateFormatter')){
    function dateFormatter(string $timestamp)
    {
        return date('M, d Y | H:i', strtotime($timestamp));
    }
}