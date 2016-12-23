<?php
/**
 * Author: sarina
 * Date: 2014/12/27
 */
return array(

    //player.getRoleInfo.php
    'role_statistics' => '角色创建统计', 
    'role_statistics_title' => array(
        '日期[星期]',
        '注册数量',
        '滚服注册数量',   
        '总角色数',      
        '滚服角色数',   
        '滚服率',
        '总创建率',   
        '新用户创建率',      
        '平台',   
        '服务器ID',
    ),

    //roleCreateByHour.list.php
    'role_statistics_hour' => '角色创建统计详细', 
    'role_statistics_hour_title' => array(
        '时间[小时]',
        '注册数量',
        '创建数量', 
    ),    
    'no_time_con' => '没有结果，请修改查询条件，输入需要检索的时间。', 

    //online.hour.php
    'player_distrubution_by_time' => '全服玩家当日时段在线分布', 
    'belong_paltform' => '所属平台',
    'default_three_server' => '默认当前平台下最近三台服务器',
    'hostory_records' => '历史记录',
    'time_online' => '时间(整点)',
    'date_online' => '时间(日期)',
    'online_player_avg' => '平均在线',
    'online_player_max' => '最高在线',
    'active_total' => '活跃统计',

    //onlineDataByFifteenStep.chart.php
    'current_connect_server' => '当前连接服务器',
    'online_players' => '即时在线人数',  
    'time_frame' => '时段',  
    'all_server_online' => '各服在线信息', 
    'online_data_day' => '当日在线数据',  
    'max_data' => '最大值',  
    'min_data' => '最小值', 
    'average_data' => '平均值', 
    'game_server' => '游戏服务器',  

    //onlineDataByHistory.chart.php
    'online_players_search' => '在线数据 & 活跃统计',
    'day_max' => '【每日最大值】',
    'day_avg' => '【每日平均值】',
    'day_max_btn' => '每日最大值',
    'day_avg_btn' => '每日平均值',           
    'query_time_no_result' => '没有数据，请修改查询条件,正确填入检索时间区间！',  
    'history_data' => '历史数据分布',
    'online_data_distribution' => '在线数据分布',

    //online.sevenDayAvg.php
    'average_online' => '过往七天各服平均在线数据',
    'highest_online' => '过往七天各服最高在线数据',   
    'all_server_online' => '全服过往七天平均在线数据统计',  
    'all_server_highest_online' => '全服过往七天最高在线数据统计',     

    //monitor.playerSurvival.list.php
    'player_retention_rate' => '数据监控[玩家留存率列表]',  
    'player_survival_title' => array(
        '日期',
        '新增有效用户',
        '次日留存', 
        '三日留存',
        '四日留存',
        '五日留存', 
        '六日留存',
        '七日留存',
        '十五日留存', 
        '服务器ID',
        '服务器',
        '平台',    
    ), 

    //monitor.playerActive.list.php
    'active_list' => '数据监控[活跃统计列表]',  
    'active_list_title' => array(
        '日期',  
        '活跃人数',
        '新增用户',
        '服务器ID',  
        '服务器',  
        '平台',  
    ),

    //monitor.playerLostLevel.list.php
    'export_data' => '导出查询结果', 
    'lost_level_rate'=> '等级流失率',
    'player_lost_level' => array(
        '玩家等级',       
        '人数',
        '流失率',
        '服务器',
        '平台',
    ),   
    'online_hour_type_page'=> '整点在线',
    'online_hour_type'=> array(
        '日期',  
        '小时段',  
        '人数',  
    ),
    'is_need_export' => '需要将查询导出列表？',    

    //equipPurchaseHistory.list.php
    'equipPurchase_list' => '商城道具购买记录列表', 
    'equipPurchase_statistics' => '商城道具购买记录统计', 
    'type' => '类型', 
    'support' => '民心',
    'gift' => '礼券',
    'role_name' => '角色名',
    'equip_name' => '道具名',
    'buy_time' => '购买时间',
    'equipPurchaseTitle' => array(
        '商品名称',
        '玩家角色',
        '购买数量',
        '消费民心/礼券',
        '服务器',
        '所在平台',
        '购买时间',      
    ),   

    //equipPurchaseHistoryCount.list.php 
    'equip_purchase_type' => '购买道具消耗类型', 
    'equipPurchaseCountTitle' => array(
        '商品名称',
        '单价',
        '累计销售次数',
        '累计销售数量',
        '总价值[实际值/理论值]',  
    ),  

    //equipFirstTimeBuyersCount.list.php
    'firstBuyCount' => '商城商品初次购买统计【民心】', 
    'firstBuyCountTitle' => array(
        '道具名称',
        '购买人数',
        '购买总数',
        '消耗总额',
        '服务器ID',
        '服务器',  
    ),  

    //recharge.list.php 764
    'recharge_details' => '付费明细列表', 
    'rechargeCount' => '付费统计分析', 
    'userID' => '账户ID', 
    'success' => '成功', 
    'failed' => '失败', 
    'rechargeList' => array(
        '服务器',
        '账户ID',
        '角色名',
        '订单号',
        '付费时间',  
        '付费平台',
        '付费金额',
        '钻石',
        '类型',  
        '平台',  
        '付费状态',  
    ), 

    //rechargeCount.list.php
    'rechargeCountTitle' => array(
        '日期',
        '新增付费人数',
        '钻石购买人数',
        '一元礼包购买人数',
        '月卡购买人数',
        '付费总金额',
        '滚服金额(元)',
        '付费人次',
        '钻石日ARPU',
        'VIP日ARPU',  
        '月卡日ARPU',
        '日ARPU',  
        '服务器',  
        '付费人数',
        '付费率',
        '新增付费率',
        '日注册ARPU'
    ),   
    'data_total' => '数据汇总',
    'totalPayRate' => '总付费率',
    'titleTips' => array(
    	'日付费人数：有过购买钻石、购买VIP和购买月卡3种行为中任意一种的用户，即算为付费用户（去重）',
    	'新增付费人数：新增加的，第一次有付费行为(包含钻石、vip和月卡)的人数（去重）',
    	'钻石购买人数：付费行为中，只要包含有钻石购买的，即计算在内（去重）',
    	'VIP购买人数：付费行为中，只要包含有VIP购买的，即计算在内（去重）',
    	'月卡购买人：付费行为中，只要包含有月卡购买的，即计算在内（去重）',
    	'付费总金额：购买钻石的总金额+购买VIP的总金额+购买月卡的总金额',
    	'付费人次：付费人数不去重',
    	'钻石日ARPU：日购买钻石的总金额/日购买钻石人数',
    	'VIP日ARPU：日购买VIP的总金额/日VIP购买人数',
    	'月卡日ARPU：日购买月卡的总金额/日月卡购买人数',
    	'日ARPU：日付费总金额/日付费人数',
    	'日付费率：日付费人数/日活跃人数 ',
        '新增付费率：日新增付费人数/日新增人数',
        '日注册ARPU：日付费金额/日新增人数'
    ),

    'rechargeTotal' => '付费总额[元]',
    'rechargeCountAllSer' => '全服付费统计',
    
    //rechargeRanking.list.php
    'recharge_ranking'=> '付费排行',
     'rechargeRankTitle' => array(
        '角色名',
        '账户ID',
        '付费总金额(元)',
        '服务器',  
        '付费平台',
    ),   
    
    //vipcards.list.php
    'recharge_cards'=> 'VIP卡月卡明细列表',
    'cardsTitle' => array(
    		'角色名',
    		'账户ID',
    		'购买金额',
    		'购买时间',
    		'到期时间',
    		'剩余天数',
    		'类型',
    		'服务器',
    		'购买状态',    		
    ),
    'class' => '类型',
    'classes' =>array( 'VIP卡','月卡'),
    
    //onlineDataByServer
    'onlineDataByServer'=> '服务器当前在线',
    'onlineBySerTitle' => array(
    		'服务器名',
    		'即时在线',
    ),
    'online_total' => '总在线', 
     

    //goldReceiveInfo.list.php
    'support_count' => '民心领取统计', 
    'goldReceiveTitle' => array(
        '领取民心额度',
        '领取人角色名',
        '领取方式[产出来源]',
        '领取时间',  
        '所在服务器',
    ), 
    'system_notice' => '系统公告赠送',   
    'get_support_total' => '领取民心总额[个]',   
    'get_support_people' => ' 领取民心总人数',   

    //PopularOutput.list.php
    'supportOutPut' => '民心产出统计',   
    'giftOutPut' => '礼券产出统计',      
    'popularOutputTitle' => array(
        '日期',
        '服务器ID',  
        '服务器',
    ),    
    'support_limit' => '累计游戏内钻石额度',

    //PopularExpend.list.php
    'support_gift_expend' => '民心/礼券消耗统计',   
    'giftOutPut' => '礼券产出统计',

    //onlineTimeCount.list.php
    'online_time_count' => '在线时长统计',   

       
    //userConversionRateByDay.list.php
    'userConversionRateByDayTitle' => array(
        '时间[小时]',
        '服务器ID',  
        '服务器',
    ), 

    //auctionlog.list.php
    'auctionlog' => '神魂竞拍信息',  
    'trading_time' => '成交时间',  
    'auctionlogTitle' => array(
        '将魂名',
        '竞拍次数',
        '成交价(民心)',
        '成交时间',
        '归属玩家',
        '服务器',
    ),    

    //gradeActiveInfo.list.php
    'gradeActive' => '等级完成活跃值统计',
    'colorArr' => array(
        '此颜色栏目等级范围1-44级',
        '此颜色栏目等级范围44-49级',
        '此颜色栏目等级范围50-99级',
    ),
    'gradeActiveTitle' => array(
        '日期',
        '服务器ID',  
        '服务器',
    ),  

    //nationalWarInfo.list.php
    'nationalWar' => '国战信息统计',      
    'belong_camp' => '所属阵营',  
    'nationalWarTitle' => array(
        '时间[日期]',    
        '阵营',
         '参战兵力&nbsp;/&nbsp; 阵亡兵力',
        '使用增援令次数',
        '使用突袭令次数',
        '拥有城市',
        '服务器ID',
        '服务器',
    ),

    //bugGoodsBehaviorLimitSet.form.php

    'add_limit_rule'=>'道具报警规则设置',
    'add_limit_rule_list'=>'报警规则列表',
    'gift_gold_rule'=>'民心礼券报警规则设置',
    
    'itemID'=>'道具ID',
    'limitType'=>'类型',
    'limitTypeArr'=>array('道具','民心礼卷'),
    'limit_rule_val'=>'限值规则',
    'singleMAX'=>'单次峰值触发',
    'dayMAX'=>'日累计值触发',
    'rule_val'=>'限制额度',
    



    //bugGoodsBehaviorLimitSetList.list.php
    'monitor_item'=>'被监控的商品',
    'monitor_rule_type'=>'监控触发类型',
    'rule_max_num'=>'达到记录触发值',
    'shutdown'=>'关闭',



    //abnormal_equip.list.php
    'abnormal_equip_list'=>'道具增量异常列表',
    //abnormal_equip.list.php abnormal_gift_gold.list.php
//    'abnormal_equip_list'=>'道具增量异常',
    'ab_equip_tab'=> array(
    	'编号',
    	'玩家名称',
    	'道具名称',
    	'道具数量',
    	'获得时间',
    	'获得途径',
        '所在服务器',
        '规则',
        '触发值',
        '日累计',
    ),
    'rule_type_text' => '规则',
    'rule_type' => array(
    	1=>'单次获取异常',
    	2=>'日累计获取异常',
    ),
    'play_name' => '玩家名',
    'item_name' => '道具名',  
    'data_type' => '类型',  
    'gold' => '民心',
    'gift' => '礼券',
    'abnormal_gift_support' => '民心礼券异常',   
    'record_source_text' => '数据来源',
    'record_source' => array('民心礼券记录','道具记录'),
    
    
    //    monitor.levelWarningSet.form.php
    'add_level_limit_rule_list'=>'级别波动异常设置List',
    'add_level_limit_rule'=>'级别波动异常设置',

    //monitor.levelWarning.list.php
    'levelWarning'=>'等级波动异常',

    'levelWarning_nav'=>array(
        '排名',
        '玩家姓名[RoleID]',
        '玩家阵营',
        '玩家等级',
        '玩家威望',
        '昨日排名',
        '排名变化',
        '服务器ID',
        '服务器',
    ),
    
    //rechargePlayerLevel.list.php
    'rechargePlayerLevel' => '付费用户等级监控',
    'firstRechargeSurvival' => '首日充用户7日留存',
    'view_offline_3day' => '只显示离线超过3天的付费用户',
    'rechargePlayerLevelTitle' => array(
	    '玩家角色名',
	    '累计付费额度',
	    '最后一次下线时间',
	    '最后下线时角色等级',
	    '离线时间(天)',
	    '服务器ID',
	    '服务器名',
    ),

    //monitor.openDayRechargeUserSurvival.list.php
    'openDayRechargeUserSurvival_title' => array(
        '日期',
        '当日付费用户创建数',
        '次日留存',
        '三日留存',
        '四日留存',
        '五日留存',
        '六日留存',
        '七日留存',
        '十五日留存',
        '服务器ID',
        '服务器',
        '平台',
    ),
    
    
    /**********************new********************************************/
    //monitor.taskInfoList.list.php
    'taskInfoListTitle' => array(
    		'任务ID',
    		'任务标题',
    		'接到任务人数/完成任务人数',
    		'任务流失率',
    		'服务器名',
    		'平台',
    ),
    
    //rechargeCountBySer.list.php
    'reBySer' => array(
    		'服务器名',
    		'开服时间',
    		'累计付费',
    		'本月付费',
    		'昨日付费',
    		'今日付费',
    		'较前一日浮动',
            '累计付费ARPU',
            '累计注册ARPU',
    ), 
    'sumRes' => array(
    	'本月付费总额',
    	'昨日付费总额',
    	'今日付费总额',
    	'较前一日浮动'
    ),


);
