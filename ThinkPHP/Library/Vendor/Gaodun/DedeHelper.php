<?php
namespace Gaodun;

/**
 * 数组帮助类，dede
 * 
 * @author Stone
 *        
 */
class DedeHelper
{

    /**
     * 
     * @param number $typeid
     */
    public static function vProjectToDedeType($project_id = 0)
    {
        $dedeTypeToVproject = [
            '11' => '1',
            '12' => '2',
            '13' => '3',
            '14' => '4',
            '1' => '5',
            '7' => '9',
            '9' => '10',
            '8' => '11',
            '3' => '14',
            '4' => '14',
            '5' => '14',
            '853' => '15',
            '852' => '16',
            '20' => '17',
            '93' => '18',
            '94' => '20',
            '15' => '21',
            '6' => '8'
        ];
        $dedeType = [];
        foreach ($dedeTypeToVproject as $k => $v) {
            if ($project_id == $v) {
                $dedeType[] = $k;
            }
        }
        return $dedeType;
    }

    
}
