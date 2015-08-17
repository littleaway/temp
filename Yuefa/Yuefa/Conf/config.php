<?php
return array(
    /* 数据库配置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '121.40.63.135', // 服务器地址
    'DB_NAME'   => 'yf', // 数据库名
    'DB_USER'   => 'yuefa', // 用户名
    'DB_PWD'    => '31415926',//'1008',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'yf_', // 数据库表前缀
    'TMPL_PARSE_STRING'=>array(
    	'__STATIC__'=>__ROOT__.'/Public/yf/static',
    	'__IMG__'=>__ROOT__.'/Public/yf/images',
    	'__CSS__'=>__ROOT__.'/Public/yf/css',
    	'__JS__'=>__ROOT__.'/Public/yf/js',
    	),
    'UPLOAD_SITEIMG_QINIU' => array( 
                'maxSize' => 10 * 1024 * 1024,//文件大小
                'rootPath' => './',
                'saveName' => array('uniqid', ''),
                'driver' => 'Qiniu',
                'driverConfig' => array(
                        'secrectKey' => '8cQUzhqnC16TOaWmv1PD45kclbR3NhDPkIgvtfCX', 
                        'accessKey' => '60-HnwghUEV4ftVMvp5M-P9hLuJXf39NcMZWIQTf',
                        'domain' => 'lemoner.qiniudn.com',
                        'bucket' => 'lemoner', 
                ),
                ),
);