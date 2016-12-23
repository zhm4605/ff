<?php
/**
 * Author: sarina
 * Date: 2014/12/24
 * Time: 16:03
 */
return array(
		
	//sysMail.add.php
    'role_equip' => '指定玩家发放道具',  
    'input_equip_num' => '请输入道具ID和数量',   
    'send_object' => '发送对象',  
    'send_object_notice' => '(必填，每行1个玩家的角色名)',  
    'emailTitle' => '邮件标题',  
    'emailTitle_notice' => '请输入邮件标题',    
    'send_object_not' => '请输入发送对象',
    'emailTitle_length' => '邮件标题最大长度为100',  
    'emailContent' => '邮件内容',        
    'emailContent_notice' => '请输入邮件内容', 
    'sendEquip' => '发放',     

    'reward'=>'道具',
    'rewardID'=>'道具ID',
    'reward_num'=>'数量',
    'reward_num_notile'=>'请输入道具ID和数量且必须为数字',
    'add_reward' => '添加项目',
    'rewardID_not_exist' => '道具ID不存在',
	'start_t_n' => '开始时间必须晚于当前时间',
	'last createTime' => '最晚创角时间',
	'Full service players' => '全服玩家',		
	'Conditions' => '条件选择',
	'Select all/Select none'	=>	'全选/全不选',	
	
	'player_name' => '玩家',
	'send_time' => '发送时间',
	'send_mail' => '发送信件',
	'send' => '发送',
	'Send results' => '发送结果',
				
    //executeTask.list.php
    'not_complete' => '未完成',
    'complete' => '已完成',
    'user_name' => '账户名',
    'execute' => '完成',
    'executeTaskTitle' => array(
    		'任务ID',
    		'任务名称',
    		'接收时间',
    		'完成时间',
    		'账户名',
    		'任务状态',
    		'服务器'
    ),
    'input_username' => '请输入账户名查询！',
    
    
		
    //auction.list.php	
    'auction_start_time' => '竞拍开始时间', 
    'auction_end_time' => '竞拍结束时间', 
    'discount' => '折扣比例', 
    'operator' => '操作人', 
    'login_ip' => '登陆ip', 
    'auction_list' => '将魂拍卖记录列表',
    'add_auction' => '新增将魂拍卖',
    'success' => '成功',
    'failed' => '失败',  

    //auction.form.php
    'start_time_notice' => '请选择确切的开始时间[应当大于上一次结束时间，活动时间不得重叠交叉]', 
    'this_discount' => '本次竞拍折扣',  
    'pre_end_time_notice' => '请检查上一次活动结束时间，避免活动时间交叉', 
    'integer' => '请输入0-1之间的小数',  

    //rechargeActivity.list.php
    'recharge_list' => '付费活动列表', 
    'add_recharge' => '添加付费活动',  
    'recharge_type' => '付费类型', 
    'activity_title' => '活动标题',  
    'activity_desc' => '活动描述', 
    'activity_label' => '活动标签',  
    'recharge_gave_gift' => '累计付费返送礼包',  
    'set_privilege' => '运营设定付费优惠',  

    //rechargeActivity.form.php
    'push_to_server' => '推送到服务器',  
    'push_to_all_server' => '推送到全部服务器',  
    'select_server' => '请选择要推送到的目标服务器[可以多选]',

    'reward'=>'奖励',
    'rewardID'=>'奖励ID',
    'reward_num'=>'奖励数量',
    'reward_num_notice'=>'请输入奖励的itemID和数量且必须为数字',
    'add_reward' => '添加奖励项目',
    'rewardID_not_exist' => '奖励ID不存在',

    'activity_type' => '活动类型',  
    'activity_intro' => '活动说明', 
    'activity_type_notice' => '请明确活动类型',   
    //'start_time' => '活动开始时间',
    //'end_time' => '活动结束时间',
    'label_type' => array(
        '限时特惠',
        '开服特惠',
        '节日特惠',
        '每日首充',
        '本次活动为累计付费返礼',      
    ),
    'action_type' => '行为类型',   
    'recharge' => '付费',
    'consume' => '消费',  
    'get_type_name' => '领取方式',   
    'get_type' => array(
        '活动时间内只允许领取一次',
        '每日只允许领取一次',
        '达到一次条件即可领取一次',   
    ),   
    'get_type_notice' => '请明确领取方式',  
    'mark_type_name' => '记录方式',   
    'mark_type' => array(
        '累计',
        '单次',  
    ),   
    'mark_type_notice' => '请明确活动数据记录方式', 
    'recharge_num' => '付费数量', 
    'join_activity_num' => '参与运营活动的付费数量', 
    'activity_reward' => '运营活动奖励', 
    'total_reward'=>'累计付费奖励',
    'recharge_limit'=>'付费限值',
    'recharge_limit_notice'=>'请输入累计付费需要达到的限值及奖励的itemID和数量且必须是数字',
    'max_num' => '小于等于255',


    //operation.giveOutRedEnvelope.form.php

    'online_dis_time'=>'上线时间',
    'start_dis_time'=>'开始时间',
    'end_dis_time'=>'结束时间',
    'offline_dis_time'=>'下线时间',
    'isClose' =>'关闭后不可重启,是否确认关闭？',

    //operation.giveOutRedEnvelope.form.php

    'online_dis_time'=>'上线时间',
    'start_dis_time'=>'开始时间',
    'end_dis_time'=>'结束时间',
    'offline_dis_time'=>'下线时间',



    //gameactive.add.php
    'active_add_title'=>'添加',
    'active_AreaCharge'=>'付费活动',
    'active_AreaSpend'=>'消费活动',
    'active_input_name'=>'活动名称',
    'active_input_show_time'=>'活动上线时间',
    'active_input_begin_time'=>'活动开启时间',
    'active_input_end_time'=>'活动关闭时间',
    'active_award'=>'活动奖励',
    'active_input_award_AreaCharge_value'=>'奖励额度',
    'active_input_award_AreaSpend_value'=>'消费额度',
    'active_input_radio_normal_item'=>'通用物品',
    'active_input_radio_faction_item'=>'分阵营物品',
    'active_input_servers'=>'服务器推送',
    'active_add_input_items'=>'添加物品',
    'active_reward_num'=>'数量',
    'active_reward_type'=>'类型',
    'active_reward_type_item'=>'道具',
    'active_reward_type_tool'=>'渔具',
    'active_reward_type_fish'=>'鱼苗',
	'active_reward_type_power'=>'体力',
	'active_reward_type_gold'=>'金币',
	'active_reward_type_diamond'=>'钻石',
	'active_reward_type_exp'=>'繁荣度',
    'active_reward_level'=>'等级',
    'active_reward_type_box'=>'宝箱',
    
    'Enclosure'=>'附件',
    'keywords' => '关键字',

    
    
    //注释
    'keyNotes' => array(
    	'联邦玩家',
	    '克林贡玩家',
	    '等级大于等于n，例如-LV[20]表示等级在20以上的玩家',
	    '等级小于等于n',
	    '注册时间晚于date，例如-REG[2014-12-09 12:00]表示注册时间晚于2014-12-09 12:00的玩家',
	    '注册时间早于date',
	    '扩展关键字组合，相互间的关系为and',
    ),
    
    
    
    
    'input_please' => '请输入',
    'max_length' => '最大长度为30',
    'begin_t_n' => '开启时间必须晚于上线时间',
    'end_t_n' => '结束时间必须晚于开启时间',
    'show_t_n' => '上线时间必须晚于当前时间',
    'time_interleaved' => '该时间段内已有同类型活动',
    'limit_number' => '请输入额度且必须为正数',
    'id_num_notile'=>'请输入ID、数量、等级且必须为数字',
    'please_add_award'=>'请添加奖励项目且物品不能为空',
    'id_notExist'=>'奖励ID不存在',
    'equipNumNotice'=>'奖励物品最多4个',
    'back_active_data' => '返回活动数据',
    
    //active.list.php
    'active_name' => '活动名称',
    'active_start_time' => '开启时间',
    'acTitle' => array(
    	'序号',
    	'活动名称',
    	'上线时间',
    	'开启时间',
    	'截止时间',
    	'服务器ID',
    	'状态'
     ),
    
    //activeData.list.php
    'acDataTitle' => array(
     		'序号',
     		'活动名称',
     		'总参与人数',
     		'总领取次数',
     		'每日详情',    		
     ),  
     'view' => '查看',
     
     //activeAward.list.php
     'activeAward' => array(
     		'序号',
     		'档次(金额)',
     		'参与人数',
     ),
     'activity_details' => '活动详情',
     'back_list' => '返回列表',
     'next_step' => '下一步',
     
     
     'please choice'	=>	'请选择要删除的选项',
     

);
