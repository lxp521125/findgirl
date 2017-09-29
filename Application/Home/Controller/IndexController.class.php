<?php
namespace Home\Controller;

use Gaodun\SystemConstant;
use Home\Service;

class IndexController extends CommonController
{
    public function test()
    {
        p(M('User'));
        
    }
}