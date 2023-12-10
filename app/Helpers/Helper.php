<?php

namespace App\Helpers;

class Helper
{
    public static function getAliasbyId(int $id)
    {
        $id--;
		$s1 = $s2 = $s3 = 0;

        if (0 <= $id && $id < 26) {
            $s1 = $id + 1;
        } elseif (26 <= $id && $id < 26*26 + 26) {
            $id -= 26;
            $s1 = $id % 26 + 1;
            $s2 = intdiv($id, 26) + 1;
        } elseif (26*26 + 26 <= $id && $id < 26*26*26 + 26*26 + 26) {
            $id -= (26*26 + 26);
            $s1 = $id % 26 + 1;
            $q1 = intdiv($id, 26);
            $s2 = $q1 % 26 + 1;
            $s3 = intdiv($id, 26*26) + 1;
        } else {
            dd('too much');
        }
        
		$arr = [ $s1, $s2, $s3 ];
        $collection = collect($arr);

        $letters = range('a', 'z');

        $str = $collection->map(function (?int $value) use ($letters) {
            return $value !== 0 ? $letters[$value - 1] : '';
        })->reverse()->join('');

        return $str;
    }
}
