<?php
namespace Home\Controller;

use Gaodun\SystemConstant;

class TestController extends CommonController
{
    public function test()
    {
        p(AL('User')->findAroundUser(39.98123848,116.30683690, 6));
        
    }
}