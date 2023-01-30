<?php
/**
 * Created by PhpStorm.
 * User: dev02
 * Date: 03/01/19
 * Time: 09:45 AM
 */

namespace backend\helpers;


class Helpers
{
    /**
     * Change the keys of `$arr` by another specified in the `$set`.
     *
     * @link https://fellowtuts.com/php/change-array-key-without-changing-order/
     *
     * @param array $arr The array whose key will be replaced.
     * @param array $set An array contains the translation of the old key to new key, in a key/value fashion.
     *
     * @return array New array with new keys keeping same order.
     */
    public static function changeKeys($arr, $set)
    {
        if (is_array($arr) && is_array($set)) {
            $newArr = array();
            foreach ($arr as $k => $v) {
                $key = array_key_exists($k, $set) ? $set[$k] : $k;
                $newArr[$key] = is_array($v) ? self::changeKeys($v, $set) : $v;
            }
            return $newArr;
        }
        return $arr;
    }

    /**
     * Sum two arrays with same dimension regardless the key.
     * @param $array_1
     * @param $array_2
     * @return array The array with computed values. The keys of this array is numeric starting from 0.
     * @throws \Exception If dimensions is not same.
     */
    public static function array_aritmetic_sum($array_1, $array_2)
    {
        if (sizeof($array_1) != sizeof($array_2)) throw new \Exception("Both arrays must have same dimension.");
        $add = function ($a, $b) {
            return (float)$a + (float)$b;
        };
        return array_map($add, $array_1, $array_2);
    }

    /**
     * Rest two arrays with same dimension regardless the key.
     * @param $array_1
     * @param $array_2
     * @return array The array with computed values. The keys of this array is numeric starting from 0.
     * @throws \Exception If dimensions is not same.
     */
    public static function array_aritmetic_rest($array_1, $array_2)
    {
        if (sizeof($array_1) != sizeof($array_2)) throw new \Exception("Both arrays must have same dimension.");
        $rest = function ($a, $b) {
            return (float)$a - (float)$b;
        };
        return array_map($rest, $array_1, $array_2);
    }

    public static function get_string_between($string, $start, $end)
    {
        $string = " " . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    /**
     * Obtain the las [[$ines]] lines from a file.
     *
     * Slightly modified version of http://www.geekality.net/2011/05/28/php-tail-tackling-large-files/
     * @author Torleif Berger, Lorenzo Stanco
     * @link http://stackoverflow.com/a/15025877/995958
     * @license http://creativecommons.org/licenses/by/3.0/
     */
    public static function tailCustom($filepath, $lines = 1, $adaptive = true)
    {
        // Check if is dir
        if (is_dir($filepath)) return false;
        // Open file
        $f = @fopen($filepath, "rb");
        if ($f === false) return false;
        // Sets buffer size, according to the number of lines to retrieve.
        // This gives a performance boost when reading a few lines from the file.
        if (!$adaptive) $buffer = 4096;
        else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));
        // Jump to last character
        fseek($f, -1, SEEK_END);
        // Read it and adjust line number if necessary
        // (Otherwise the result would be wrong if file doesn't end with a blank line)
        if (fread($f, 1) != "\n") $lines -= 1;

        // Start reading
        $output = '';
        $chunk = '';
        // While we would like more
        while (ftell($f) > 0 && $lines >= 0) {
            // Figure out how far back we should jump
            $seek = min(ftell($f), $buffer);
            // Do the jump (backwards, relative to where we are)
            fseek($f, -$seek, SEEK_CUR);
            // Read a chunk and prepend it to our output
            $output = ($chunk = fread($f, $seek)) . $output;
            // Jump back to where we started reading
            fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);
            // Decrease our line counter
            $lines -= substr_count($chunk, "\n");
        }
        // While we have too many lines
        // (Because of buffer size we might have read too many)
        while ($lines++ < 0) {
            // Find first newline and remove all text before that
            $output = substr($output, strpos($output, "\n") + 1);
        }
        // Close file and return
        fclose($f);
        return trim($output);
    }
}