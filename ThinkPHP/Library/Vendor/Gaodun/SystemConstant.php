<?php
namespace Gaodun;

/**
 * 用于定义系统常量与高顿所有用到的方法，把function.php中的方法取缔掉
 *
 * @author Stone
 *
 */
class SystemConstant
{

    private static $_allConstant = array(
        'status' => 1,
        'success' => 100, //成功
        'faile' => 101, //失败
        'severno' => 102, //服务器异常
        'parameterError' => 103, //'参数错误'
        'logoutStatus' => 104, //登录过期
        'verifyFaileStatus' => 105, //'手机验证码错误',登录学员验证失败
        'emptydata' => 106, //'没有数据'
        'nomoredata' => 107, //'没有更多数据'
        'paperhasdone' => 200, //'创建试卷中，试卷已经完成时候返回'
        'papernotdone' => 3200, //'创建试卷中，试卷未提交'
        'twoToOne' => 201, //'用户已被禁用，请联系管理员'
        'twoToTwo' => 202, //'用户激活失败'
        'twoToThree' => 203, //'用户不存在或者被删除'
        'twoToFour' => 204, //'用户密码错误'
        'twoToFive' => 205, //'未定义'
        'threeToTwo' => 302, //'用户名不合法'
        'threeToThree' => 303, //'用户名已存在'
        'threeToFour' => 304, //'包含要允许注册的词语'
        'threeToFive' => 305, //'手机号码格式错误'
        'threeToSix' => 306, //'手机号码已被注册'
        'EmailExistErr' => 309, //'手机号码已被注册'
        'threeToserven' => 307, //'未定义'
        'nopermission' => 501, //'无权限，需购课'
        'noFunction' => 99, //接口不存在
        'iosValidation' => 3821, //验证收据失败
        'isHandleTokenFlag' => 'yes', // 是否处理token验证
        'sourceErrorStatus' => 999, // 来源错误
        'tokenSalt' => 'gaodunApps', // token的盐值
        'share_photo' => '/share/v', // 图片路径
        'share_photo_tiku' => '/share/tiku', // 图片路径
        'imageerror' => 301,
        'unlockRule' => 1, //解锁规则ID
        'createPaperFaile' => 3101, // 创建试卷失败
        'createPaperSuccess' => 3102, // 创建试卷成功
        'lastpdidSuccess' => 3108, //获取最后一条pdid成功
        'lastpdidFaile' => 3109, //获取用户最后一条pdid失败
        'wrongItemSuccess' => 3118, //获取收藏错题列表成功
        'wrongItemFaile' => 3119, //获取收藏错题列表失败
        'likeItemFaile' => 3221, //标签推荐题目获取失败
        'wrongItemUpdateFaile' => 3220, //更新错题失败
        'paperAlreadySubmit' => 1111, // 试卷已经交卷
        'topSuccess' => 3500, //排行榜返回成功
        'topFaile' => 3501, //排行榜返回失败
        'topEmpty' => 3502, //排行榜为空
        'tiKuSuccess' => 3666, //通用成功
        'savePaperSuccess' => 3104, //保存试卷成功
        'failPaperSuccess' => 3105, //保存试卷失败
        'nopaperdata' => 3103, //没有生成试卷信息（paperdata）
        'noCourseAssign' => 3301, //没有课程权限
        'createTaskFaile' => 3302, // 创建任务失败
        'createTaskSuccess' => 3303, // 创建任务成功
        'paperHasSubmit' => 3401, //试卷已经提交
        'paperSubmitFail' => 3402, //试卷提交失败
        'paperSubmitSuccess' => 3400, //试卷提交成功
        'scoreRatio' => [1 => 20, 2 => 50, 3 => 30], //录播：课后练习，模考
        'testUid' => [472591, 116293, 114613, 882034, 171210, 924129, 212866, 924129, 120422, 114828, 882034, 171210, 120, 557201, 120372, 1149203, 1097540, 7278], //无需验证多台登录帐号Uid
        'KJQSG_source' => [80, 81], //会计轻松过的scoure
        'XKJTK_source' => [36, 75], //新会计从业题库的scoure1
        'XKJZC_source' => [33, 72], //新会计职称题库的scoure
        'XTKAPP_source' => [36, 75, 33, 72, 35, 74, 87, 88], //新题库app共有逻辑
        'wx_source' => [2, 77, 79], //网校的scoure
        'CFA_source' => [18, 34, 50, 73], //CFA的scoure
        'CPA_source' => [43, 86], //CPA这样学的scoure
        'CPADY_source' => [84, 85], //CPA答疑的scoure
        'CPATK_source' => [35, 74], //CPA题库的scoure
        'JJCY_source' => [87, 88], //基金从业的source
        'YHZP_source' => [89, 90], //银行招聘的source
        'ZQZY_source' => [16, 32, 52, 71], //证券从业
        'CPATK_subject' => [36, 37, 38, 39, 45, 46], //CPA题库subjectid
        'CFATK_subject' => [26, 27, 258], //CFA开启使用的subject
        'CFATK_project' => [4], //CFA 的project
        'base_no_source' => [], //证券从业
        'MIX_ITEM_TYPE_PROJECT' => [8], //支持填空题型的项目
        'cpa_sbk_courseId' => [
            'dev' => [2927],
            'test' => [2927],
            'prepare' => [3012, 3014, 2833, 2883, 2981, 3491, 3699, 3700, 3701, 3702, 3703, 3704, 3705, 3706, 3707],
            'production' => [3012, 3014, 2833, 2883, 2981, 3491, 3699, 3700, 3701, 3702, 3703, 3704, 3705, 3706, 3707],
        ],
        'cpa_sbk_show_courseId' => [3012, 3014, 2833],
        'TEST_STUDENT_ID' => [
            'dev' => [1750495],
            'test' => [1750495],
            'prepare' => [1750495, 1750958, 2064796, 2039367, 2381686],
            'production' => [1750958, 2064796, 2039367, 2381686],
        ],
        ///////////////////首页的参数介绍///////////////////////
        //'continue_do' 继续做,
        //'countdown_data'=>['def'=>'1477034071','change'=>true],倒计时
        //'sign'签到,
        //'layer',
        //'live_one'轮播,
        //      'need_live'=>'n'默认是要直播的,'need_course'=>'y'默认要课程lunbo_num=>2 默认轮播图片的数量 'live_free'=>'y'推荐的直播是免费的
        //'push_live_set'推送设置,
        //'yhq_num'优惠码,
        //'app_status'APP的状态,
        //'bdpic'背景图,
        //'service_qq'服务qq,
        //'system_message_num'系统消息数
        //'item_num'做题数,
        //'note_num'笔记数,
        //'best_course'推荐的课程,
        //'best_live'推荐的直播
        //'module' 模块的信息
        //'other_module' 其他的模块的信息
        //'first_news' 第一条咨询
        /////////////////////////////////////////
        'projectIndexInfo' => [
            'def' => ['continue_do', 'countdown_data' => ['def' => '1477034071', 'change' => true], 'sign', 'layer', 'live_one', 'push_live_set', 'yhq_num', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'item_num', 'note_num', 'best_course', 'best_live'],
            'jinrong4' => ['countdown_data' => ['def' => [9 => '0', 10 => '0', 11 => '0', 38 => '1480118400'], 'project_change' => false], 'live_one' => ['need_live' => 'n', 'need_course' => 'y'], 'app_status', 'service_qq' => ['def' => '2853906846', 'change' => false], 'system_message_num', 'best_live' => ['num' => 2, 'charges' => 0]],
            'cfa' => ['countdown_data' => ['def' => '1496419200', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'module', 'yhq_num', 'accuracy', 'other_module' => ['handle_type' => 'cfa_video', 'module_info' => ['reading' => ['module_type' => 'cfa_video', 'icid_module' => '19136', 'buy_info' => ['course_id' => '', 'is_buy' => '0']], 'mock' => ['module_type' => 'cfa_video', 'icid_module' => '19137', 'buy_info' => ['course_id' => '', 'is_buy' => '0']], 'go_vip' => ['module_type' => 'cfa_buy_video', 'buy_url' => '/apph5/active/cfa']]]],
            'cfa2' => ['countdown_data' => ['def' => '1496419200', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'module', 'yhq_num', 'accuracy', 'other_module' => ['handle_type' => 'cfa2_video', 'buy_url' => '/apph5/active/cfa']],
            'cpa' => ['countdown_data' => ['def' => '1507910400', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'yhq_num', 'best_live' => ['num' => 3], 'guide_course', 'item_num', 'push_live_set', 'live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'first_news' => ['title' => '2017注册会计师必备指南', 'url' => '/apph5/cpa_news'], 'module_info_status' => ['yicuotiji' => 'n'], 'import_mess', 'advisory_url' => 'http://q.url.cn/s/o9Zwprm?_type=wpa'],
            'cpa43' => ['countdown_data' => ['def' => '1507910400', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'yhq_num', 'best_live' => ['num' => 1], 'guide_course', 'item_num', 'push_live_set', 'live_one' => ['need_live' => 'n', 'need_course' => 'y', 'type' => '13,14'], 'first_news' => ['title' => '2017注册会计师必备指南', 'url' => '/apph5/news'], 'module_info_status' => ['yicuotiji' => 'n'], 'import_mess', 'advisory_url' => ['url' => 'http://q.url.cn/s/o9Zwprm?_type=wpa', 'open_app' => '1'], 'sub_course'],
            'jijin' => ['countdown_data' => ['def' => '1508515200', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'yhq_num', 'best_live' => ['num' => 1], 'item_num', 'guide_course', 'push_live_set', 'live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'ad_pic' => ['type' => 11, 'num' => 3], 'first_news' => ['title' => '2017基金考试必备指南', 'url' => '/apph5/news'], 'module_info_status' => ['yicuotiji' => 'n']],
            'chuji' => ['countdown_data' => ['def' => '1508515200', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'yhq_num', 'best_live' => ['num' => 1], 'item_num', 'guide_course', 'push_live_set', 'live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'ad_pic' => ['type' => 11, 'num' => 3], 'first_news' => ['title' => '2017初级考试必备指南', 'url' => '/apph5/news'], 'module_info_status' => ['yicuotiji' => 'n'], 'advisory_url' => ['url' => 'http://q.url.cn/s/32hqpFm?_type=wpa', 'open_app' => '1']],
            'sws' => ['countdown_data' => ['def' => '1508515200', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'yhq_num', 'best_live' => ['num' => 1], 'item_num', 'guide_course', 'push_live_set', 'live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'ad_pic' => ['type' => 12, 'num' => 3], 'first_news' => ['title' => '2017税务师考试必备指南', 'url' => '/apph5/news'], 'module_info_status' => ['yicuotiji' => 'n'], 'advisory_url' => ['url' => 'http://wpa.qq.com/msgrd?v=3&uin=2881354019&site=qq&menu=yes', 'open_app' => '1']],
            'zhongji2' => ['countdown_data' => ['def' => '1508515200', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'yhq_num', 'best_live' => ['num' => 1], 'item_num', 'guide_course', 'push_live_set', 'live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'ad_pic' => ['type' => 11, 'num' => 3], 'first_news' => ['title' => '2017中级考试必备指南', 'url' => '/apph5/news'], 'module_info_status' => ['yicuotiji' => 'n'], 'advisory_url' => ['url' => 'http://q.url.cn/s/GLfo0Cm?_type=wpa', 'open_app' => '1']],
            'acca' => ['countdown_data' => ['def' => '1496419200', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'accuracy', 'module_info_status' => ['zixun' => 'y']],
            'chuji2' => ['countdown_data' => ['def' => '1400000000', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'best_live' => ['num' => 4], 'item_num', 'push_live_set', 'live_one'],
            'zhongji' => ['countdown_data' => ['def' => '1400000000', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'best_live' => ['num' => 4, 'charges' => 0], 'item_num', 'push_live_set', 'live_one'],
            'zhukaojun' => ['app_status'],
            'zhengquan' => ['countdown_data' => ['def' => '1508515200', 'change' => true], 'sign', 'layer', 'app_status', 'bdpic', 'service_qq', 'system_message_num', 'yhq_num', 'best_live' => ['num' => 1], 'item_num', 'guide_course', 'push_live_set', 'live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'ad_pic' => ['type' => 11, 'num' => 3], 'first_news' => ['title' => '2017证券考试必备指南', 'url' => '/apph5/news'], 'module_info_status' => ['yicuotiji' => 'n']],
            'chujibizuo' => ['live_one' => ['need_live' => 'n', 'need_course' => 'n', 'type' => '13,14']],
            'cpabizuo' => ['live_one' => ['need_live' => 'n', 'need_course' => 'n', 'type' => '13,14']],
            'jijin31' => ['system_message_num', 'countdown_data', 'accuracy', 'app_status', 'item_num', 'best_glive', 'study_time','live_one' => ['need_live' => 'n', 'need_course' => 'n', 'type' => '13,14']],
        ],
        'projectReStartInfo' => [
            'def' => ['live_one', 'system_message_num'],
            'jinrong4' => [],
            'cpa' => ['live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'system_message_num', 'best_live' => ['num' => 3], 'countdown_data' => ['def' => '1507910400', 'change' => true], 'import_mess'],
            'cpa43' => ['system_message_num', 'best_live' => ['num' => 1], 'live_one' => ['need_live' => 'n', 'need_course' => 'n'], 'import_mess'],
            'jijin' => ['live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'system_message_num', 'ad_pic' => ['type' => 11, 'num' => 3], 'best_live' => ['num' => 1], 'countdown_data' => ['def' => '1507910400', 'change' => true], 'import_mess'],
            'chuji' => ['live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'system_message_num', 'ad_pic' => ['type' => 11, 'num' => 3], 'best_live' => ['num' => 1], 'countdown_data' => ['def' => '1507910400', 'change' => true], 'import_mess'],
            'sws' => ['live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'system_message_num', 'ad_pic' => ['type' => 12, 'num' => 3], 'best_live' => ['num' => 1], 'countdown_data' => ['def' => '1507910400', 'change' => true], 'import_mess'],
            'zhongji2' => ['live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'system_message_num', 'ad_pic' => ['type' => 11, 'num' => 3], 'best_live' => ['num' => 1], 'countdown_data' => ['def' => '1507910400', 'change' => true], 'import_mess'],
            'zhengquan' => ['live_one' => ['need_live' => 'n', 'need_course' => 'y', 'live_free' => 'y'], 'system_message_num', 'ad_pic' => ['type' => 11, 'num' => 3], 'best_live' => ['num' => 1], 'countdown_data' => ['def' => '1507910400', 'change' => true]],
            'cfa' => ['module', 'countdown_data' => ['def' => '1496419200', 'change' => true], 'yhq_num', 'accuracy', 'other_module' => ['handle_type' => 'cfa_video', 'module_info' => ['reading' => ['module_type' => 'cfa_video', 'icid_module' => '19136', 'buy_info' => ['course_id' => '', 'is_buy' => '0']], 'mock' => ['module_type' => 'cfa_video', 'icid_module' => '19137', 'buy_info' => ['course_id' => '', 'is_buy' => '0']], 'go_vip' => ['module_type' => 'cfa_buy_video', 'buy_url' => '/apph5/active/cfa']]]],
            'cfa2' => ['countdown_data' => ['def' => '1496419200', 'change' => true], 'system_message_num', 'module', 'yhq_num', 'accuracy', 'other_module' => ['handle_type' => 'cfa2_video', 'buy_url' => '/apph5/active/cfa']],
            'acca' => [],
            'chuji2' => [],
            'zhongji' => [],
            'zhukaojun' => [],
            'chujibizuo' => ['live_one' => ['need_live' => 'n', 'need_course' => 'n', 'type' => '13,14']],
            'cpabizuo' => ['live_one' => ['need_live' => 'n', 'need_course' => 'n', 'type' => '13,14']],
            'jijin31' => ['system_message_num', 'countdown_data', 'accuracy', 'app_status', 'item_num', 'best_glive', 'study_time', 'live_one' => ['need_live' => 'n', 'need_course' => 'n', 'type' => '13,14']],

        ],
        'appsTypeSourceSession_WK' => [4, 16, 43, 86],
        'appsTypeSourceSession_API' => [2, 17, 77, 78, 79, 80, 81],
        'appsTypeSourceSession_DZS' => [84, 85],
        'alreadySignCode' => 1033, //已经签到
        'classicFlag' => 3, //经典题ID  暂定
        'TikuRegisterUrl' => '/apph5/app_landing',
        'TikuRegisterRuleUrl' => '/apph5/app_rule',
        'XKJTK_app_version' => '2.1.1', //会计从业最新版本号
        'XKJZC_app_version' => '2.0.0', //职称题库最新版本号
        'XKJTK_app_status' => 'audit', //app当前状态：dev prod audit
        'XZCTK_project' => [14, 29], //职称题库包含项目
        'gift_url' => [
            '75' => 'Public/images/kjcy_git.jpg',
            '36' => 'Public/images/kjcy_git.jpg',
        ], // 注册赠送试卷图片地址
        'gift_paper_id' => [
            '75' => '5257',
            '36' => '5257',
        ], //注册赠送试卷试卷ID
        'iosShow' => '52', //高顿网校app审核
        'noShowPermissionsMsgProjectId' => [4, 5, 8, 14, 29, 30],
        'newAppProjectId' => [18, 1, 4, 8, 38, 9, 14, 11, 27, 57, 66, 93, 94], //在错题历史返回之前做的列表。
        'hasPathSubjectId' => [26],
        'CFA_EXAM_DATE' => '2017-06-03',
        'ADVISE_DO_TIME' => '3600',
        'AVERAGE_DO_TIME' => '1800',
        'CPA_EXAM_DATA' => [
            [
                's' => '2017-10-14 00:00:00',
                'e' => '2017-10-15 00:00:00',
            ], [
                's' => '2018-10-13 00:00:00',
                'e' => '2018-10-14 00:00:00',
            ],
        ],
        //徽章、顺序不能乱，带排序
        //'name'=>徽章名,'level'=>等级,'g_pic'=>获取到的地址,'n_pic'=>没有拿到的地址图片,'need_day'=>要多少天拿到 'is_get'=>用户是否拿到,
        'TIKU_EMBLEM' => [
            ['name' => '新手上路', 'level' => '1', 'g_pic' => '/web/tiku/src/resource/images/appimg/badge-1.png', 'n_pic' => '/web/tiku/src/resource/images/appimg/badge-0.png', 'need_days' => '7', 'is_get' => '0'],
            ['name' => '步入江湖', 'level' => '2', 'g_pic' => '/web/tiku/src/resource/images/appimg/badge-2.png', 'n_pic' => '/web/tiku/src/resource/images/appimg/badge-0.png', 'need_days' => '20', 'is_get' => '0'],
            ['name' => '小有名气', 'level' => '3', 'g_pic' => '/web/tiku/src/resource/images/appimg/badge-3.png', 'n_pic' => '/web/tiku/src/resource/images/appimg/badge-0.png', 'need_days' => '40', 'is_get' => '0'],
            ['name' => '常住居民', 'level' => '4', 'g_pic' => '/web/tiku/src/resource/images/appimg/badge-4.png', 'n_pic' => '/web/tiku/src/resource/images/appimg/badge-0.png', 'need_days' => '80', 'is_get' => '0'],
            ['name' => '签到达人', 'level' => '5', 'g_pic' => '/web/tiku/src/resource/images/appimg/badge-5.png', 'n_pic' => '/web/tiku/src/resource/images/appimg/badge-0.png', 'need_days' => '110', 'is_get' => '0'],
        ],
        'TIKU_EMBLEM_RULES' => '连续7日打卡获得徽章“新手上路”，连续20日得徽章“步入江湖”，连续40日得徽章“小有名气”，连续80日得徽章“常住居民”，连续110日得徽章“签到达人”。',
        'TIKU_EMBLEM_WALL_URL' => '/apph5/active/badgewall',
        'APP_LIST' => '/apph5/app_list',
        'SHARE_DO_PAPER' => '/apph5/active/grade',

        'WEIXIN_CODE' => [
            0 => ['url' => '/web/tiku/src/resource/images/tkwechatqr/gdtk.png', 'title' => '高顿题库公众号', 'wxcode' => 'gaoduntiku'],
            8 => ['url' => '/web/tiku/src/resource/images/tkwechatqr/cpa.png', 'title' => '注册会计师', 'wxcode' => 'gaoduncpa'],
            4 => ['url' => '/web/tiku/src/resource/images/tkwechatqr/cfa.jpg', 'title' => '金融第一考', 'wxcode' => 'cfaonline'],
            18 => ['url' => '/web/tiku/src/resource/images/tkwechatqr/sws.jpg', 'title' => '高顿税考', 'wxcode' => 'gaodun_ta'],
        ],
        'SHARE_DO_PAPER' => '/apph5/active/grade',
        'TIKU_ONE_CHAPTER_ANALYZE' => '/apph5/active/testBest/',
        'TIKU_ONE_CHAPTER_SHARE' => '/apph5/active/klgshare/',
        'TIKU_COURSE_COLUMN_SHARE' => '/apph5/active/zl',
        'CFA_SERVICE_QQ' => '2355739865',
        'HISTORY_LOG_MAX_NUM' => 5,
        'like_item_num' => 10, //获取相似题目的id数
        'firstIsCourse' => [5, 45, 9, 10, 11, 38], //要求第一个是推荐课程的项目
        'TIKU_VIDEO_TOKEN' => '6dbd7bdd7282f035da7909203f7a8d4f',
        'TIKU_ONE_GIFT_NEED_PEOPLE' => '10',
        'COURSE_POWER' => [
            'CFA_OTHERMODULE_POWER' => [
                '26' => [
                    'dev' => ['course_id' => '638'],
                    'test' => ['course_id' => '638'],
                    'prepare' => ['course_id' => '3784'],
                    'production' => ['course_id' => '3784'],
                ],
                '27' => [
                    'dev' => ['course_id' => '618'],
                    'test' => ['course_id' => '618'],
                    'prepare' => ['course_id' => '3784'],
                    'production' => ['course_id' => '3784'],
                ],
            ],
        ],
        //第一层为项目id，第二层为科目id，对应的是课程id[DEPLOY_APP_ENV]
        'ProjectGuideCourse' => [
            'dev' => [
                '9' => [
                    ['course_id' => '2746', 'is_listen' => '1', 'subject_id' => '167'],
                    ['course_id' => '658', 'is_listen' => '1', 'subject_id' => '168'],
                ],
                '18' => [
                    ['course_id' => '2746', 'is_listen' => '1', 'subject_id' => '85'],
                    ['course_id' => '658', 'is_listen' => '1', 'subject_id' => '86'],
                    ['course_id' => '678', 'is_listen' => '1', 'subject_id' => '87'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '88'],
                    ['course_id' => '688', 'is_listen' => '1', 'subject_id' => '89'],
                ],
                '29' => [
                    ['course_id' => '2746', 'is_listen' => '1', 'subject_id' => '132'],
                    ['course_id' => '658', 'is_listen' => '1', 'subject_id' => '133'],
                    ['course_id' => '678', 'is_listen' => '1', 'subject_id' => '134'],
                ],
                '38' => [
                    ['course_id' => '638', 'is_listen' => '1', 'subject_id' => '210'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '211'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '314'],
                ],
                '8' => [
                    ['course_id' => '638', 'is_listen' => '1', 'subject_id' => '36'],
                    ['course_id' => '658', 'is_listen' => '1', 'subject_id' => '37'],
                    ['course_id' => '668', 'is_listen' => '0', 'subject_id' => '38'],
                    ['course_id' => '678', 'is_listen' => '0', 'subject_id' => '39'],
                    ['course_id' => '608', 'is_listen' => '0', 'subject_id' => '45'],
                    ['course_id' => '688', 'is_listen' => '0', 'subject_id' => '46'],
                ],
                '14' => [
                    ['course_id' => '2382', 'is_listen' => '1', 'subject_id' => '131'],
                    ['course_id' => '658', 'is_listen' => '1', 'subject_id' => '130'],
                ],
            ],
            'test' => [
                '9' => [
                    ['course_id' => '2712', 'is_listen' => '1', 'subject_id' => '167'],
                    ['course_id' => '2746', 'is_listen' => '1', 'subject_id' => '168'],
                ],
                '18' => [
                    ['course_id' => '2746', 'is_listen' => '1', 'subject_id' => '85'],
                    ['course_id' => '658', 'is_listen' => '1', 'subject_id' => '86'],
                    ['course_id' => '678', 'is_listen' => '1', 'subject_id' => '87'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '88'],
                    ['course_id' => '688', 'is_listen' => '1', 'subject_id' => '89'],
                ],
                '29' => [
                    ['course_id' => '2746', 'is_listen' => '1', 'subject_id' => '132'],
                    ['course_id' => '658', 'is_listen' => '1', 'subject_id' => '133'],
                    ['course_id' => '678', 'is_listen' => '1', 'subject_id' => '134'],
                ],
                '38' => [
                    ['course_id' => '2712', 'is_listen' => '1', 'subject_id' => '210'],
                    ['course_id' => '2746', 'is_listen' => '1', 'subject_id' => '211'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '314'],
                ],
                '8' => [
                    ['course_id' => '638', 'is_listen' => '1', 'subject_id' => '36'],
                    ['course_id' => '3277', 'is_listen' => '1', 'subject_id' => '37'],
                    ['course_id' => '3281', 'is_listen' => '0', 'subject_id' => '38'],
                    ['course_id' => '3262', 'is_listen' => '0', 'subject_id' => '39'],
                    ['course_id' => '3012', 'is_listen' => '0', 'subject_id' => '45'],
                    ['course_id' => '2833', 'is_listen' => '0', 'subject_id' => '46'],
                ],
                '14' => [
                    ['course_id' => '2382', 'is_listen' => '1', 'subject_id' => '131'],
                    ['course_id' => '2383', 'is_listen' => '1', 'subject_id' => '130'],
                ],
            ],
            'prepare' => [
                '9' => [
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '167'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '168'],
                ],
                '18' => [
                    ['course_id' => '4059', 'is_listen' => '1', 'subject_id' => '85'],
                    ['course_id' => '4060', 'is_listen' => '1', 'subject_id' => '86'],
                    ['course_id' => '4062', 'is_listen' => '1', 'subject_id' => '87'],
                    ['course_id' => '4063', 'is_listen' => '1', 'subject_id' => '88'],
                    ['course_id' => '4061', 'is_listen' => '1', 'subject_id' => '89'],
                ],
                '29' => [
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '132'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '133'],
                    ['course_id' => '678', 'is_listen' => '1', 'subject_id' => '134'],
                ],
                '38' => [
                    ['course_id' => '2712', 'is_listen' => '1', 'subject_id' => '210'],
                    ['course_id' => '2711', 'is_listen' => '1', 'subject_id' => '211'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '314'],
                ],
                '8' => [
                    ['course_id' => '3295', 'is_listen' => '0', 'subject_id' => '36'],
                    ['course_id' => '3294', 'is_listen' => '1', 'subject_id' => '37'],
                    ['course_id' => '2235', 'is_listen' => '0', 'subject_id' => '38'],
                    ['course_id' => '3297', 'is_listen' => '0', 'subject_id' => '39'],
                    ['course_id' => '3296', 'is_listen' => '0', 'subject_id' => '45'],
                    ['course_id' => '3298', 'is_listen' => '0', 'subject_id' => '46'],
                ],
                '14' => [
                    ['course_id' => '2382', 'is_listen' => '1', 'subject_id' => '131'],
                    ['course_id' => '2383', 'is_listen' => '1', 'subject_id' => '130'],
                ],
            ],
            'production' => [
                '9' => [
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '167'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '168'],
                ],
                '18' => [
                    ['course_id' => '4059', 'is_listen' => '1', 'subject_id' => '85'],
                    ['course_id' => '4060', 'is_listen' => '1', 'subject_id' => '86'],
                    ['course_id' => '4062', 'is_listen' => '1', 'subject_id' => '87'],
                    ['course_id' => '4063', 'is_listen' => '1', 'subject_id' => '88'],
                    ['course_id' => '4061', 'is_listen' => '1', 'subject_id' => '89'],
                ],
                '29' => [
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '132'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '133'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '134'],
                ],
                '38' => [
                    ['course_id' => '3631', 'is_listen' => '1', 'subject_id' => '210'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '211'],
                    ['course_id' => '0', 'is_listen' => '1', 'subject_id' => '314'],
                ],
                '8' => [
                    ['course_id' => '3295', 'is_listen' => '0', 'subject_id' => '36'],
                    ['course_id' => '3294', 'is_listen' => '1', 'subject_id' => '37'],
                    ['course_id' => '2235', 'is_listen' => '0', 'subject_id' => '38'],
                    ['course_id' => '3297', 'is_listen' => '0', 'subject_id' => '39'],
                    ['course_id' => '3296', 'is_listen' => '0', 'subject_id' => '45'],
                    ['course_id' => '3298', 'is_listen' => '0', 'subject_id' => '46'],
                ],
                '14' => [
                    ['course_id' => '2382', 'is_listen' => '1', 'subject_id' => '131'],
                    ['course_id' => '2383', 'is_listen' => '1', 'subject_id' => '130'],
                ],
            ],
        ],
        //服务QQ key为项目的id，value为服务的qq
        'theServerQQ' => [
            0 => '2881354023',
            4 => '2355739865',
            //从业
            5 => '2881354023',
            //职称
            14 => '1690337117',
            29 => '1690337117',

            38 => '2355916249',
            //银行
            45 => '2853916999',
        ],
        //app_key
        'sourceKey0' => 'gd_tk_app_nosource',
        'sourceKey' => 'gd_tk_app_nosource',
        'sourceKey34' => 'gd_tk_app_cfa',
        'sourceKey73' => 'gd_tk_app_cfa',
        'sourceKey36' => 'gd_tk_app_kjcy',
        'sourceKey75' => 'gd_tk_app_kjcy',
        'sourceKey33' => 'gd_tk_app_kjzc',
        'sourceKey72' => 'gd_tk_app_kjzc',
        'sourceKey89' => 'gd_tk_app_yhzp',
        'sourceKey90' => 'gd_tk_app_yhzp',
        'sourceKey87' => 'gd_tk_app_jjcy',
        'sourceKey88' => 'gd_tk_app_jjcy',
        'sourceKey35' => 'gd_tk_app_cpa',
        'sourceKey74' => 'gd_tk_app_cpa',
        'sourceKey2' => 'gd_tk_app_wx',
        'sourceKey77' => 'gd_tk_app_wx',
        'sourceKey79' => 'gd_tk_app_wx',
        'sourceKey86' => 'gd_tk_app_yqxcpa',
        'sourceKey43' => 'gd_tk_app_yqxcpa',
        'sourceKey80' => 'gd_tk_app_kjqsg',
        'sourceKey81' => 'gd_tk_app_kjqsg',
        'sourceKey91' => 'gd_tk_app_jrcy',
        'sourceKey92' => 'gd_tk_app_jrcy',
        'sourceKey76' => 'gd_tk_app_acca',
        'sourceKey47' => 'gd_tk_app_acca',
        'sourceKey37' => 'gd_tk_app_acca',
        'sourceKey21' => 'gd_tk_app_acca',
        'sourceKey93' => 'gd_tk_app_zjkjzc',
        'sourceKey94' => 'gd_tk_app_zjkjzc',
        'sourceKey95' => 'gd_tk_app_cpa_yx',
        'sourceKey96' => 'gd_tk_app_cpa_yx',
        'sourceKey16' => 'gd_tk_app_zqcy',
        'sourceKey32' => 'gd_tk_app_zqcy',
        'sourceKey52' => 'gd_tk_app_zqcy',
        'sourceKey71' => 'gd_tk_app_zqcy',
        'sourceKey11' => 'gd_tk_app_sws',
        'sourceKey27' => 'gd_tk_app_sws',
        'sourceKey57' => 'gd_tk_app_sws',
        'sourceKey66' => 'gd_tk_app_sws',
        'sourceKey84' => 'gd_tk_zkj',
        'sourceKey85' => 'gd_tk_zkj',

        // 'gd_tk_app_cfa' => [34,73], // app 题库cfa
        // 'gd_tk_app_kjcy' => [36,75], // app 题库会计从业
        // 'gd_tk_app_kjzc' => [33,72], // app 题库会计职称
        // 'gd_tk_app_yhzp' => [89,90], // app 题库银行招聘
        // 'gd_tk_app_jjcy' => [87,88], // app 题库基金从业
        // 'gd_tk_app_cpa' => [35,74], // app 题库cpa
        // 'gd_tk_app_wx' => [2,77,79], // app 题库网校
        // 'gd_tk_app_yqxcpa' => [43,86], // app 一起学cpa

        'gd_tk_app_cfa' => 'gdtkappcfa3333lei32xiao232peng412', //app 题库cfa  4b5ee04967807a7b76c5410330a97cebe2bb9a5b
        'gd_tk_app_kjcy' => 'gdtkappkjcy22lei32xiao232peng4190', //app 题库会计从业
        'gd_tk_app_kjzc' => 'gdtkappkjzc11lei32xiao232peng4180', //app 题库职称
        'gd_tk_app_yhzp' => 'gdtkappyhzp55lei32xiao231peng4170', //app 题库银行招聘
        'gd_tk_app_jjcy' => 'gdtkappjjcy66lei32xiao230peng4160', //app 题库基金从业
        'gd_tk_app_cpa' => 'gdtkappcpa77lei32xiao239peng41500', //app 题库cpa
        'gd_tk_app_wx' => 'gdtkappwx77lei32xiao238peng414000', //app 题库 网校中的题库
        'gd_tk_app_yqxcpa' => 'gdtkappyqxcpalei32xiao237peng412100', //app 题库 一起学cpa
        'gd_tk_app_kjqsg' => 'gdtkappkjqsglei32xiao239peng412000', //app  会计轻松过
        'gd_tk_app_jrcy' => 'gdtkappjrcylei32xiao240peng413000', // app 金融从业
        'gd_tk_app_acca' => 'gdtkappaccalei33xiao250peng414000', // app acca
        'gd_tk_app_nosource' => 'gdtkappnosourcelei32xiao237peng413', //app 题库 没有传source的通用
        'gd_tk_app_zjkjzc' => 'gdtkappzjkjzclei32xiao241peng414000', // app 中级会计职称
        'gd_tk_app_cpa_yx' => 'gdtkappcpayxlei34xiao251peng415000', //app cpa 营销版本1
        'gd_tk_app_zqcy' => 'gdtkappzqcylei35xiao252peng416000', // 证券从业
        'gd_tk_app_sws' => 'gdtkappswslei36xiao253peng417000', //app 税务师
        'gd_tk_zkj' => 'gdtkzkj11111111111111la23u4ozhenasda', //助考君
        'REST_SAVERTICKET_CONFIG' => [ //base活动发礼包
            'app_id' => 'gd_saverticket_partner',
            'app_secret' => 'ca6d93b43feae5b286629c0f0dab3178',
        ],
        'no_ask_course' => [2020, 2458, 2459, 2269],
    );

    /**
     * 获取常量值
     *
     * @param
     *            $key
     */
    public static function getConstant($key = '')
    {
        if (array_key_exists($key, self::$_allConstant)) {
            return self::$_allConstant[$key];
        } else {
            throw new \Exception('请先定义该常量，不存在！');
        }
    }

    /**
     * 根据uid获取用户的头像
     */
    public static function getUseravatarpath($uid, $size)
    {
        $avatar = self::getAvatar($uid, $size);
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $avatar)) {
            $avatar = self::getConstant('share_photo') . "/Uploads/avatar/default.jpg";
        }
        return $avatar;
    }

    /**
     * 根据uid获取用户的头像2
     */
    public static function getAvatar($uid, $size = 'small', $type = '')
    {
        $size = in_array($size, array('big', 'middle', 'small')) ? $size : 'small';
        $uid = abs(intval($uid));
        $uid = sprintf("%09d", $uid);
        $dir1 = substr($uid, 0, 3);
        $dir2 = substr($uid, 3, 2);
        $dir3 = substr($uid, 5, 2);
        $typeadd = $type == 'real' ? '_real' : '';
        return self::getConstant('share_photo') . '/Uploads/avatar/' . $dir1 . '/' . $dir2 . '/' . $dir3 . '/' . substr($uid, -2) . $typeadd . "_avatar_$size.jpg";
    }

    public static function etag($etag, $awayEtag, $notModifiedExit = true)
    {
//         header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
        //         header ("Pragma: no-cache");                          // HTTP/1.0
        //         header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
        if ($notModifiedExit && isset($_SERVER['HTTP_IF_NONE_MATCH']) && $etag == $_SERVER['HTTP_IF_NONE_MATCH']) {
            echo 2;
            header('Etag: ' . $etag);
            header('HTTP/1.1 304 Not Modfied');
            //exit();
        } else {
            header('ETag: ' . $awayEtag);
        }
    }

    /**
     * @desc 新的提交数据到erp
     * @since 2015.11.4
     * @author luozhen
     * @param string $orderId 订单id
     */
    public static function sendcrm($id)
    {
        $url = C('v_gaodun_com') . 'admin.php/Sendcrm/sendcrm_curl';
        $data = array();
        $data['order_id'] = self::format_orderId($id);
        $data = http_build_query($data);
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                "Content-Length: " . strlen($data) . "\r\n",
                'content' => $data,
            ),
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
    }

    public function format_orderId($orderId)
    {
        $str = str_replace('GAODUNECLASS_', "", $orderId);
        $arr = explode("_", $str);
        $str = $arr[0];
        return $str;
    }

    public static function rpcConstant($status)
    {
        $constant = 'success';
        switch ($status) {
            case hexdec('0x60000501'):
            case 502:
                $constant = 'severno';
                break;
            case hexdec('0x60000802'):
            case hexdec('0x60000601'):
                $constant = 'faile';
                break;
            case hexdec('0x60000703'):
                $constant = 'twoToFour';
                break;
            case hexdec('0x60000704'):
                $constant = 'threeToSix';
                break;
            case hexdec('0x60000706'):
                $constant = 'threeToThree';
                break;
            case hexdec('0x60000705'):
                $constant = 'EmailExistErr';
                break;
            case hexdec('0x60000710'):
                $constant = 'parameterError';
                break;
        }
        return $constant;
    }
}
