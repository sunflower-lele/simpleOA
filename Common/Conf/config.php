<?php
return array(
	//'配置项'=>'配置值'
	 /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'db_oa',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tp_',    // 数据库表前缀


    //跟踪信息
    'SHOW_PAGE_TRACE'       =>  'true',
    //开启字段映射
    // 'READ_DATA_MAP'         =>  'true',//反向映射

    //设置动态加载的文件
    'LOAD_EXT_FILE'         =>   'phpinfo',

    //RBAC权限控制
    'RBAC_ROLES'            =>    array(
                        1   =>    '高层领导',
                        2   =>     '中层领导',
                        3   =>     '普通职员'

        ),
    //权限数组
    'RBAC_AUTHS'            => array(
                    'auth1' => array('*/*'),//通配符
                    'auth2' => array('email/*' , 'knowledge/*'),
                    'auth3' => array('email/*')

        )
);