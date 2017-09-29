<?php
/**
 * 实例化Event层

 * @param  unknown $name
 * @param  string  $layer
 * @param  string  $level
 * @return Ambigous <Action, \Think\Controller, false, Controller, boolean, unknown>
 */
function AE($name, $layer = 'Event', $level = '')
{
    return A($name, $layer, $level);
}

/**
 * 实例化Logic层

 * @param  unknown $name
 * @param  string  $layer
 * @param  string  $level
 * @return Ambigous <Action, \Think\Controller, false, Controller, boolean, unknown>
 */
function AL($name, $layer = 'Logic', $level = '')
{
    return A($name, $layer, $level);
}


function p($data, $flag = true)
{
    header('Content-type:text/html;charset=utf-8');
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if ($flag) {
        exit();
    }
}

function get_class_all_methods($class = "BaseAction")
{
    $reflect = new reflectionclass($class);
    p($class);
    $methods = array();
    foreach ($reflect->getmethods() as $key => $methodobj) {
        if ($methodobj->isprivate()) {
            $methods[$key]['type'] = 'private';
        } else if ($methodobj->isprotected()) {
            $methods[$key]['type'] = 'protected';
        } else {
            $methods[$key]['type'] = 'public';
        }
        $methods[$key]['name'] = $methodobj->name;
        $methods[$key]['class'] = $methodobj->class;
    }
    return $methods;
}

// 将多维数组转化为字符串
function arrayToString($arr)
{
    if (is_array($arr)) {return implode(',', array_map('arrayToString', $arr));}
    return $arr;
}

/**
 * 处理手机号
 */
function disposephone($str)
{
    if (account_type($str) == 4) {
        $str = showphone($str);
    }
    return $str;
}
function getClientIp(){
    if (getenv("X-Real-IP"))
    {
        $ip = getenv("X-Real-IP");
    }
    elseif (getenv("REMOTE_ADDR"))
    {
        $ip = getenv("REMOTE_ADDR");
    }
    elseif (getenv("HTTP_X_FORWARDED_FOR"))
    {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    }
    else
    {
        $ip = "Unknown";
    }
    return $ip ;
}
/**
 * 判断账号类型 4:手机号码 2:邮箱
 */
function account_type($user_account)
{
    $pregEmail = "/([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?/i";
    $pregMobie = "/^17[0-9]{1}[0-9]{8}$|13[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[0123456789]{1}[0-9]{8}$|14[012356789]{1}[0-9]{8}$/";
    if (preg_match($pregEmail, $user_account) == 0) {
        if (preg_match($pregMobie, $user_account) == 1) {
            $logintype = 4;
        } else {
            $logintype = 2;
        }
    } else {
        $logintype = 2;
    }
    return $logintype;
}

function showphone($phone)
{
    return substr($phone, 0, 3) . '****' . substr($phone, 7);
}

function _insertMode($object,$data){
    if($object->add($data)){
        	
        $return=$object->getLastInsID();

    }else{
        $return=0;
    }
    //print_r($object->getLastSql());
    return $return;
}
//记录调试的一些ｌｏｇ //add 2014-8-5 sherry
function add_log_com($mess='加入log',$act='',$mod=''){
    $m = M("TsLog");
    $dd = array();
    if (defined(ACTION_NAME)) {
        $act =  ACTION_NAME;
    }else{
        $act ="action_name";
    }

    if (defined(ACTION_NAME)) {
        $mod =  MODULE_NAME;
    }else{
        $mod ="model_name";
    }
    $dd["model"] = $act;
    $dd["action"] = $mod;
    $dd["message"] = $mess;
    $dd["addtime"] = time();
    $res = $m->add($dd);
}


/* 排课_新
 * @param $cid      课程id
 * @param $sid      学生id
 * @param $isbig    是否是大包
 * @param $app_type 0 正常 1延期
 * @param $invalide_time    如果没有开启截止日期表示月份
 * @param $bigcid   大包id
 * @param $is_expiration     0为 正常课 1延期
 * @param $bigTime         截止日期
 * @param $isprobation 0为正课 1试听课
 * */
//assignCourse_new($course_id_p,$msDetail['id'],1,$cDetail['isbig'], $cDetail['appoint_type'], $cDetail['cycle'], $cDetail['expiration_date'], 0, $cDetail['is_expiration']);
function assignCourse_new($cid,$sid,$type,$isbig,$app_type=0,$invalid_time=0,$bigTime=0,$bigcid=0,$is_expiration=0,$big_project_id=0,$source='线下派课',$kk_sign=0,$isprobation=0){
    static $isSingle = 1; //用来区别单课程和大包里的课程 
    $course=D("Course");
    $StudentAssign = D('MembersStudentAssign');
    $courseware = M('CourseWareRelative');
    $coursepart = M('CoursewarePart');
    $map['id']=$cid;
    $coursdetail=$course->where($map)->find();
    //为了兼容以前的派课
    if($app_type==0 && $invalid_time==0 && $bigTime==0){
        $app_type = $coursdetail['appoint_type'];
        $invalid_time = $coursdetail['cycle'];
        $bigTime = $coursdetail['expiration_date'];
    }
    if($big_project_id == 0){
        $big_project_id = $coursdetail['project_id'];
    }
    //如果为0 可能是按月份来算截止日期
    if($bigTime == 0){
        $bigTime = strtotime('+'.$invalid_time.' month');
    }

	//如果是职称则走另外的分班
	if(in_array($coursdetail['project_id'], [14,29,30,16]) ){
		$class_id = (int)end(explode('_', $coursdetail['bbs_class']));
		cma_fenban_tobbs($sid, $class_id);
	}

    if(!empty($coursdetail)){
        if($isbig==1 || $isbig==2){
            if($bigcid==0){
                $bigcid=$cid;
            }
            $isSingle ++;
            $courselist=explode(",",$coursdetail['courses']);
            //循环排大包里的小课
            foreach($courselist as $key=>$val){
                $maps['id']=$val;
                $detail=$course->where($maps)->find();
				$subject_array[] = $detail['subject_id'];  //CMA课程分班 jason 2016-01-27ADD
                $return=assignCourse_new($val,$sid,$type,$detail['isbig'],$app_type,$invalid_time,$bigTime,$bigcid,$is_expiration,$big_project_id,$source,$kk_sign,$isprobation);
            }

			if(in_array('114', $subject_array)){ //属于CMA-英文
				$class_type = 'en';
				cma_fenban($sid, $cid,$class_type);
			}elseif(in_array('76', $subject_array)){ //属于CMA-中文
				$class_type = 'cn';
				cma_fenban($sid, $cid, $class_type);
			}
            return $return;
        }

        //精英计划  加入解锁表
        if($coursdetail['type_id']==17 && $cid!=$bigcid){
            $validate = M('EliteCourseLock')->field('id')->where(['course_id'=>$cid,
                'student_id'=>$sid])->find();
            if(!empty($validate)){
                M('EliteCourseLock')->where(['id'=>$validate['id']])->delete();
            }
            M('EliteCourseLock')->add([
                'regdate'=>time(),
                'student_id'=>$sid,
                'course_id'=>$cid,
                'type_id' => 17,
                'big_id' => $bigcid,
                'project_id'=>$coursdetail['project_id'],
                'sort'=>$coursdetail['sortid']]);
        }

        if (isset($cid) && isset($sid) && isset($type)) {
            $condition['course_id'] = $cid;
            $condition['student_id'] = $sid;
            $isadd = $StudentAssign->where($condition)->find(); 
            //之前派过课
            if ($isadd) {
                /*if($isadd['invalid_time']>time()){//截止日期是否大于今天
                 $time=strtotime(date('Y-m-d',strtotime('+'.$invalid_time.' month')))+$isadd['invalid_time']-time();
                 }else{
                 $time=strtotime(date('Y-m-d',strtotime('+'.$invalid_time.' month')));
                 }
                 */
                $data_assign['appoint_type']=1;//延期
                $time = time();
                $data_assign['month']=$invalid_time>$isadd['month']?$invalid_time:$isadd['month'];//延期
                //只有单课程才能按最大的截止日期来
                if($app_type==0 && $isSingle ==1){
                    $timeTmp = strtotime(date('Y-m-d',strtotime('+'.$invalid_time.' month')));
                    $time = $bigTime>$isadd['invalid_time']?$bigTime:$isadd['invalid_time'];
                    $time = $time>$timeTmp?$time:$timeTmp;
                    $data_assign['appoint_type'] =0;
                }
                //如果不为1并且正常开课  肯定是大包 所以按大包的截止日期来
                if($isSingle != 1 && $app_type==0){
                    //$time = $bigTime;
                    $time = $bigTime>$isadd['invalid_time']?$bigTime:$isadd['invalid_time'];
                    $timeTmp = strtotime(date('Y-m-d',strtotime('+'.$invalid_time.' month')));
                    $time = $time>$timeTmp?$time:$timeTmp;
                    $data_assign['appoint_type'] =0;
                }

                $data_assign['invalid_time'] =$time;
                $data_assign['modifydate']=time();
                $data_assign['ass_time']=time();
                $data_assign['big_project_id']=$big_project_id;
                $data_assign['is_big']=$bigcid;
                //以前是试听,现在改正课,才变
                if($isadd['isprobation']==1 && $isprobation==0){
                    $data_assign['isprobation']=0; 
                }else{ 
                    $data_assign['isprobation'] = $isprobation;
                }
                if($kk_sign!=0){
                	$data_assign['kk_sign']=$kk_sign;
                }
                $StudentAssign->where($condition)->save($data_assign);
                $title=$coursdetail['name'].'课程已续费至'.date('Y年m月d日',$time);
                $content='您购买的'.$coursdetail['name'].'课程已续费至'.date('Y年m月d日',$time).'，请到学习空间开始学习。如有疑问请致电400-825-0088。';
                addmessage($title,$content,$sid,3); // 原来是addmessage($title,$content,$sid,2);
                return  "1";

            }else{
                //增加指派
                if ($type == 1) {
                    //查询课件
                    $conditions['course_id'] = $cid;
                    $getcourseware = $courseware->field('ware_id as war_id')->where($conditions)->select();
                    $playnums = array();
                    if (!empty($getcourseware)) {
                        foreach ($getcourseware as $key => $val) {
                            //查询段落
                            $conditionss['courseware_id'] = $val['war_id'];
                            $getcoursepart = $coursepart->field('id as part_id')->where($conditionss)->select();
                            if (!empty($getcoursepart)) {
                                foreach ($getcoursepart as $keys => $vals)
                                    $playnums[$val['war_id']][$vals['part_id']] = '999';
                            }
                        }
                    }
                    $playnums = serialize($playnums);
                    $StudentAssign->student_id = $sid;
                    $StudentAssign->big_project_id = $big_project_id;
                    $StudentAssign->course_id = $cid;
                    $StudentAssign->regdate=time();
                    $StudentAssign->appoint_type=$app_type;
                    $StudentAssign->subject_id=$coursdetail['subject_id'];
                    $StudentAssign->project_id=$coursdetail['project_id'];
                    $StudentAssign->modifydate=time(); 
                    $StudentAssign->MembersStudentLecture = array(
                        'student_id' => $sid,
                        'course_id' => $cid,
                        'playnums' => $playnums,
                    );

                    $StudentAssign->is_big=$bigcid;
                    $StudentAssign->ass_time = time();
                    //$invalidtime=strtotime(date('Y-m-d',strtotime('+'.$invalid_time.' month')));
                    if($app_type==0){//开启截止日期
                        //$invalidtime=$bigTime;
                        //后台当改成月份，会把截止日期更新为0
                        $timeTmp = strtotime(date('Y-m-d',strtotime('+'.$invalid_time.' month')));
                        $time = $bigTime>$timeTmp?$bigTime:$timeTmp;
                        $invalidtime=$time;
                    }else{
                        $invalidtime =time();
                        $StudentAssign->month =$invalid_time;
                    }
                    //cpa vip直播 特别处理2016-4-12
                    $invalidtime_vip = zhibo_cpavip($cid,$sid);
                    if($invalidtime_vip!='-1'){
                        $invalidtime = $invalidtime_vip;
                    }
                    $StudentAssign->invalid_time =$invalidtime;
                    $StudentAssign->source = $source;
                    $StudentAssign->isprobation = $isprobation; //加试听
                    if($StudentAssign->relation('MembersStudentLecture')->add()) {
                        //note 收费直播时，预约人数加1
                        if($coursdetail['type_id'] == 15 && $coursdetail['similarcourse'] > 0){
                            $cLive = M("CourseLive");
                            $cLive->where('id='.$coursdetail['similarcourse'])->setInc('reservation',1);//Note 预约人数累加
                            //如果没预约过则预约
                            $LiveLog = M("CourseLiveStudentLog");
                            $map_ll['live_id'] = $coursdetail['similarcourse'];
                            $map_ll['student_id'] = $sid;
                            $map_ll['isdel'] = 0;
                            $hascount = $LiveLog->where($map_ll)->count();
                            if(empty($hascount)){
                            	//$advTraceCookie = cookie('advTraceCookie');
                            	//$advTraceCookie = json_decode($advTraceCookie); 
                               /*  $seocookie = D('SeoCookie');
                                $advTraceCookie = $seocookie->getcookieinfo();
                                if (! empty($advTraceCookie)) {
                                    $sdata = array_merge($sdata, $advTraceCookie);
                                } */
                                $sdata['regdate'] = $sdata['modifydate'] = time();
                                $sdata['ip'] = $_SERVER["REMOTE_ADDR"];
                                $sdata['live_id'] = $coursdetail['similarcourse'];;
                                $sdata['student_id'] = $sid;
                                _insertMode($LiveLog,$sdata);
                            }
                        }

                        return "1";
                    } else {
                        return "5";
                    }

                }else{
                    return "4";
                }
            }
        }else{
            return "3";
        }
    }
}


//回传分班信息至BBS
function cma_fenban_tobbs($sid, $class_id){
	$domain = $_SERVER['SERVER_NAME'];
	if(stripos($domain,'dev.v.gaodun.com') !== false || stripos($domain,'test.v.gaodun.com') !== false){
		$url_to = "http://test.apidea.gaodun.com/bbs/activationclass";
	}elseif(stripos($domain,'yun.v.gaodun.com') !== false){
		$url_to = "http://yun.apidea.gaodun.com/bbs/activationclass";
	}else{
		$url_to = "http://apidea.gaodun.com/bbs/activationclass";
	}
	$json['uid'] = $sid;
	$json['act']= 'activationclass';
	$json['session_id']='';
	$json['student_id']='0';
	$json['token'] = md5('gaodunApps'.$json['session_id'].$json['act'].$json['student_id']);
	$json['class'] = $class_id;
	$json['nickname'] = session('studentNickName');
	$ch = curl_init();
	$html = http_build_query($json);
	$url = $url_to.'?'.$html;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$statusCode = curl_exec($ch);
	$str = json_decode($statusCode, false);
	if($str->status == 5100){  //返回结果成功
		return true;
	}else{
		return false;
	}
}

/*
 * 插入CMA分班信息
 * @author jason
 * @param $sid :学生ID, $cid: 大包课程ID, $class_type:课程的科目中英文类型('en'/'cn')
 */
function cma_fenban($sid, $cid, $class_type){
	$cmaFenBan = M('CmaDivideclass');
	$class_id = cma_fenban_id($class_type);
	if(!empty($class_id) && !empty($cid) && !empty($sid)){
		$data['course_id'] = $cid;
		$data['class_id'] = $class_id;
		$data['student_id'] = $sid;
		$data['createtime'] = time();
		$data['updatetime'] = time();
		$cmaFenBan->data($data)->add();
		cma_fenban_tobbs($sid, $class_id);
		return true;
	}else{
		return false;
	}
}


/*$title 站内信标题
	$content 站内信内容
	$stuId 学院编号
	$mtype 站内信类型:1系统通知，2课程通知，3学员通知，4学习通知
	*/
	function addmessage($title,$content,$stuId,$mtype){
		$mg=M('Message');
		$mg->title=$title;
		$mg->type=$mtype;
		$host=$_SERVER['HTTP_HOST'];
		$mg->content=$content;
		$mg->ids=$stuId;//id
		$mg->regdate=time();
		$mg->modifydate=time();
		$result=$mg->add();

		$mgl=M('MessageSend');
		$mgl->type=$mtype;
		$mgl->smid=$result;
		$mgl->student_id=$stuId;
		$mgl->regdate=time();
		$mgl->modifydate=time();
		$mgl->add();
	}
	
	
	/*
     * @author:sherry
     * @date:2016.04.11
     * @desc:派cpa vip直播时, STORY #2711 CPA直播套餐，有效期内可再次购买套餐（相同套餐/不同套餐）
     * 1. V IP套餐购买页面，购买入口开放；
     * 2. 有效期内，可再次购买套餐（相同套餐或不同套餐），套餐的有效期可累加。
     * //这个之前没购买过,看之前有没有
     */
    function zhibo_cpavip($course_id,$student_id){
        $course = M('Course');
        $course_cc = $course->where(" type_id = 18 and id=$course_id ")->field(' cycle')->find();
        $endtime = '-1';
        if(empty($course_cc)){
            return $endtime;
        }
         $cycle = $course_cc['cycle'];
        //派这类的课,并且未过期
        $sql = "SELECT msa.invalid_time FROM gaodun.gd_members_student_assign msa 
                JOIN gaodun.gd_course cur on msa.course_id=cur.id 
                WHERE msa.student_id='".$student_id."'
                AND cur.type_id=18 
                AND ( msa.appoint_type=1 or msa.invalid_time>=".time()." or msa.invalid_time=0 ) 
                order by msa.invalid_time desc limit 1 ";
        $mem_info = $course->query($sql); 
        $invalid_time2 = time();
        if(!empty($mem_info)){ 
            $invalid_time2 = $mem_info[0]['invalid_time']; 
        }
        $endtime =  strtotime("+$cycle months", $invalid_time2); 
        return $endtime;
    }

/**
 * 一周的时间 默认为本周，否则为上周
 * @param  boolean $lastWeek [description]
 * @return [type]            [description]
 */
function getWeekDate($lastWeek = false)
{
    //当前日期

    $sdefaultDate = date("Ymd");
    if ($lastWeek) {
        $theSKey = 'apidea-tiku-tool-last-week-day-' . $sdefaultDate;
    }else{
        $theSKey = 'apidea-tiku-tool-week-day-' . $sdefaultDate;
    }
    
    C('clearCache') && S($theSKey,null);
    $theWeekDay = S($theSKey);
    if (empty($theWeekDay)) {
        //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期

        $first = 1;

        //获取当前周的第几天 周日是 0 周一到周六是 1 - 6

        $w = date('w', strtotime($sdefaultDate));

        //获取本周开始日期，如果$w是0，则表示周日，减去 6 天

        $week_start = date('Ymd', strtotime("$sdefaultDate -" . ($w ? $w - $first : 6) . ' days'));
        if ($lastWeek) {
            $week_start = date('Ymd', strtotime("$week_start -7 days"));
        }
        $theWeekDay = [
            $week_start,
            date('Ymd', strtotime("$week_start +1 days")),
            date('Ymd', strtotime("$week_start +2 days")),
            date('Ymd', strtotime("$week_start +3 days")),
            date('Ymd', strtotime("$week_start +4 days")),
            date('Ymd', strtotime("$week_start +5 days")),
            date('Ymd', strtotime("$week_start +6 days")),
        ];

        S($theSKey, $theWeekDay);
    }

    return $theWeekDay;
}





