<?php
/**
 * Author: sarina
 * Date: 2014/12/27
 */
return array(

    //player.getRoleInfo.php
    'role_statistics' => 'Role creation statistics', 
    'role_statistics_title' => array(
        'Date [week]',
        'Registration amount',
        'Rolling servers registration',   
        'Total role amount',      
        'Rolling servers role',   
        'Rolling server rate',
        'Total creation rate',   
        'Creation rate',      
        'Platform',   
        'Server ID',
    ),

    //roleCreateByHour.list.php
    'role_statistics_hour' => 'Detailed statistics for role creation', 
    'role_statistics_hour_title' => array(
        'Time[hour]',
        'Registration amount',
        'Creation amount', 
    ),    
    'no_time_con' => 'No result. Please modify inquiry condition, and enter into the required searching time.', 

    //online.hour.php
    'player_distrubution_by_time' => 'Full-service player online distribution in time frame of current date', 
    'belong_paltform' => 'Subordinate platform',
    'default_three_server' => 'Default current three servers',
    'hostory_records' => 'History record',
    'time_online' => 'Time (hour sharp)',
    'date_online' => 'Time (Date)',
    'online_player_avg' => 'AVG Online persons',
    'online_player_max' => 'MAX Online persons',
    'active_total' => 'Active Total',

    //onlineDataByFifteenStep.chart.php
    'current_connect_server' => 'Current connecting server',
    'online_players' => 'Instant online persons',  
    'time_frame' => 'Time frame',  
    'all_server_online' => 'Online information of each service', 
    'online_data_day' => 'Current online date',  
    'max_data' => 'Maximum',  
    'min_data' => 'Minimum', 
    'average_data' => 'Mean', 
    'game_server' => 'Game server',  

    //onlineDataByHistory.chart.php
    'online_players_search' => 'Online & Active', 
    'day_max' => '【The maximum daily】',
    'day_avg' => '【The average daily】',
    'day_max_btn' => 'The maximum daily',
    'day_avg_btn' => 'The average daily',
    'query_time_no_result' => 'No data is displayed. Please modify the query conditions and enter the correct retrieval interval!',  
    'history_data' => 'Historical data distribution',
    'online_data_distribution' => 'Online data distribution',

    //online.sevenDayAvg.php
    'average_online' => 'Average number of online users in the past 7 days',
    'highest_online' => 'The highest number of online users in the past 7 days',   
    'all_server_online' => 'Statistic of the average number of online users in the past 7 days',  
    'all_server_highest_online' => 'Statistic of the highest number of online users in the past 7 days',     

    //monitor.playerSurvival.list.php
    'player_retention_rate' => 'Data monitoring [List of player retention rate]',  
    'player_survival_title' => array(
        'Date',
        'New Valid User',
        'Second day retention', 
        'Third day retention',
        'Fourth day retention',
        'Fifth day retention', 
        'Sixth day retention',
        'Seventh day retention',
        'Fifteen day retention', 
        'Server ID',
        'Server',
        'Platform',    
    ), 

    //monitor.playerActive.list.php
    'active_list' => 'Data monitoring [Active statistical list]',  
    'active_list_title' => array(
        'Date',  
        'Active population',
        'New Valid User',
        'Server ID',  
        'Server',  
        'Platform',  
    ),

    //monitor.playerLostLevel.list.php
    'export_data' => 'Export inquiry results', 
    'lost_level_rate'=> 'Lost level rate',
    'player_lost_level' => array(
        'Player level',
        'Player num',
        'lost rate',
        'Server',
        'Platform',
    ),   
    'online_hour_type_page'=> 'online_hour',
    'online_hour_type'=> array(
        'Date',  
        'Hour',  
        'Count',  
    ),
    'is_need_export' => 'Is it necessary to export the inquiry from list?',    

    //equipPurchaseHistory.list.php
    'equipPurchase_list' => 'Props purchase record', 
    'equipPurchase_statistics' => 'Props purchase statistics', 
    'type' => 'type', 
    'support' => 'icons',
    'gift' => 'token',                   
    'role_name' => 'Role name',
    'equip_name' => 'Props name',
    'buy_time' => 'Purchasing time',
    'equipPurchaseTitle' => array(
        'Goods name',
        'Player role',
        'Purchase quantity',
        'Consuming coins/token',
        'Server',
        'Current platform',
        'Purchasing time',      
    ),   

    //equipPurchaseHistoryCount.list.php 
    'equip_purchase_type' => 'Purchased props type', 
    'equipPurchaseCountTitle' => array(
        'Goods name',
        'Price',
        'Accumulated sales times',
        'Accumulated sales amount',
        'Total value [actual/theoretical value]',  
    ),  

    //equipFirstTimeBuyersCount.list.php
    'firstBuyCount' => 'Initial props purchase statistics【Popular】', 
    'firstBuyCountTitle' => array(
        'Name of props',
        'Number of buyers',
        'Total purchase quantity',
        'Total purchase amount',
        'Server ID',
        'Server',  
    ),  

    //recharge.list.php 764
    'recharge_details' => 'Recharge details', 
    'rechargeCount' => 'Recharge statistic analysis', 
    'userID' => 'Account ID', 
    'success' => 'Succeeded', 
    'failed' => 'Failed', 
    'rechargeList' => array(
        'Server',
        'Account ID',
        'Role name',
        'Order number',
        'recharge time',  
        'Recharge platform',
        'Recharge amount',
        'Points',
        'Class',
        'Platform',
        'Recharge state',  
    ), 

    //rechargeCount.list.php
    'rechargeCountTitle' => array(
        'Date',
        'New Payment Users',
        'Credit Points Purchasers',
        'VIP Purchasers',
        'Monthly Card Purchasers',
        'Total Recharge Amount',
        'New Server Amount (Dollars)',
        'Number of users who recharge',
        'Daily Credit Points ARPU',
        'Daily VIP ARPU',  
        'Daily Monthly Card ARPU',
        'Daily ARPU',  
        'Server',  
        'Number of users who recharge',
        'Payment Rate',
        'Payment Rate of New Users',
        'Daily ARPU of New Users'
    ),   
    'data_total' => 'Data summarization', 
    'rechargeTotal' => 'Total recharge amount (RMB)',     
    'totalPayRate' => 'Total Payment Rate',
    'titleTips' => array(
    		'Daily Recharge Users: The number of users who purchase Credit Points, VIP or Monthly Cards. (Remove duplicate data)',
    		'New Recharge Users: The number of users who use Credit Points, VIP and Monthly Cards for the first time. (Remove duplicate data)',
    		'Credit Points Purchasers: The number of users who purchase Credit Points. (Remove duplicate data)',
    		'VIP Purchasers: The number of users who purchase VIP. (Remove duplicate data)',
    		'Monthly Card Purchasers: The number of users who purchase Monthly Card. (Remove duplicate data)',
    		'Total Recharge Amount: Total amount of money spent to buy Credit Points + Total amount of money spent to buy VIP + Total amount of money spent to buy Monthly Cards',
    		'The number of users who recharge: Does not remove the duplicate data.',
    		'Daily Credit Points ARPU: Daily total amount of money spent for Credit Points/Daily number of users who purchase Credit Points',
    		'Daily VIP ARPU: Daily total amount of money spent for VIP/Daily number of users who purchase VIP',
    		'Daily Monthly Card ARPU: Daily total amount of money spent for Monthly Cards/Daily number of users who purchase Monthly Cards',
    		'Daily ARPU: Daily total amount of money spent/Daily number of users who spent money',
    		'Daily Payment Rate: Daily Payment Users/Daily Active Users',
            'Daily Payment Rate of New Users: New Recharge Users/New Users',
            'Daily ARPU of New Users: Daily total amount of money spent/New Users'
    ),

    'rechargeTotal' => 'rechargeTotal =>Total Payment Amount [Dollars]',
    //rechargeRanking.list.php
    'recharge_ranking'=> 'Recharge ranking',
    'rechargeCountAllSer' => 'Total Payment Statistic',
    
     'rechargeRankTitle' => array(
        'Role name',
        'Account ID',
        'Total recharge amount(RMB)',
        'Server',  
        'Recharge platform',
    ), 

    //vipcards.list.php
    'recharge_cards'=> 'Monthly VIP Card Detailed Statement',
    'cardsTitle' => array(
    		'Character Name',
    		'Account ID',
    		'Purchase Amount',
    		'Purchase Date',
    		'Expiration Date',
    		'Days Left',
    		'Category',
    		'Server',
    		'Purchase Status',
    ),
    'class' => 'Category',
    'classes' =>array( 'VIP Card','Monthly Card'),
    
    //onlineDataByServer
    'onlineDataByServer'=> 'Current Online',
    'onlineBySerTitle' => array(
    		'Server Name',
    		'Real-time Online',
    ),
    'online_total' => 'Total Online Users',
    
    //goldReceiveInfo.list.php
    'support_count' => 'coins collection statistics', 
    'goldReceiveTitle' => array(
        'coins collection limit',
        "Collector's role name",
        'Collection method [export source]',
        'Collection time',  
        'Located server',
    ), 
    'system_notice' => 'Gift in system bulletin',   
    'get_support_total' => 'Total amount of collected coins',   
    'get_support_people' => ' Total population of collected coins',   

    //PopularOutput.list.php
    'supportOutPut' => 'coins output statistics',   
    'giftOutPut' => 'Token output statistics',      
    'popularOutputTitle' => array(
        'Date',
        'Server ID',  
        'Server',
    ),    
    'support_limit' => 'Cumulative coins limit',

    //PopularExpend.list.php
    'support_gift_expend' => 'coins/token consumption statistics',   
    'giftOutPut' => 'Token output statistics', 
    
    //onlineTimeCount.list.php
    'online_time_count' => 'Online time statistics',             

    //userConversionRateByDay.list.php
    'userConversionRateByDayTitle' => array(
        'Time[hour]',
        'Server ID',  
        'Server',
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
    'gradeActive' => 'Active Level Statistic',
    'colorArr' => array(
        'Level range of this column: Lv.1-44',
        'Level range of this column: Lv.44-49',
        'Level range of this column: Lv.50-99',
    ),
    'gradeActiveTitle' => array(
        'Date',
        'Server ID',  
        'Server',
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
    'rechargePlayerLevel' => 'rechargePlayerLevel =>Recharge user level monitoring',
    'firstRechargeSurvival' => 'First day recharge users retention rate in 7 days',
    'view_offline_3day' => 'Only display payment users who have been offline for over 3 days.',
    'rechargePlayerLevelTitle' => array(
	    'Player Name',
	    'Total Payment Amount',
	    'Last Logout Time',
	    'Character level when logging off last time',
	    'Offline Time (Day)',
	    'Server ID',
	    'Server Name',
    ),
    //monitor.openDayRechargeUserSurvival.list.php
    'openDayRechargeUserSurvival_title' => array(
        'Date',
        'Daily PU Creations',
        'Next day retention',
        'Day 3 retention',
        'Day 4 retention',
        'Day 5 retention',
        'Day 6 retention',
        'Day 7 retention',
        'Day 15 retention',
        'Server ID',
        'Server',
        'Platform',
    ),

    
    
    /**********************new********************************************/
    //monitor.taskInfoList.list.php
    'taskInfoListTitle' => array(
    		'Quest ID',
    		'Quest Title',
    		'The number of quest-accepted players/The number of quest-completed players.',
    		'Quest churn rate',
    		'Server Name',
    		'Platform',
    ),
    
    //rechargeCountBySer.list.php
    'reBySer' => array(
    		'Server Name',
    		'Server opening time',
    		'Cumulative payment',
    		'This month payment',
    		'Yesterday payment',
    		'Today payment',
    		'Floating compared with the previous day',
            'Total Payment ARPU',
            'Total Payment ARPU of New Users'

    ), 
    'sumRes' => array(
    	'This month payment amount',
    	'Yesterday payment amount',
    	'Today payment amount',
    	'Floating compared with the previous day'
    ),
    
);
