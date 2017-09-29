<?php
namespace Gaodun;

/**
 * 数组帮助类，把function.php中的方法取缔掉
 * 
 * @author Stone
 *        
 */
class ArrayHelper
{

    
    public static function multi_array_sort($multi_array, $sort_key, $sort = SORT_DESC)
    {
        if (is_array($multi_array)) {
            foreach ($multi_array as $row_array) {
                if (is_array($row_array)) {
                    // 把要排序的字段放入一个数组中，
                    $key_array[] = $row_array[$sort_key];
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
        // 对多个数组或多维数组进行排序
        array_multisort($key_array, $sort, $multi_array);
        return $multi_array;
    }
    
    
}
