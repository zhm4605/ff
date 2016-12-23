<?php
/**
 * Author: sarina
 * Date: 2014/12/25
 * Time: 14:03
 */
return array(
    'amount' => '数量', 
		
	//player.userFreeze.php / 426
	'player_freeze'=>'指定玩家禁言/冻结',
	'freeze_list'=>'玩家禁言/冻结列表',
	'player_role_name'=>'指定玩家角色名称',
	'server_role_name'=>'当前服务器下角色名',
	'select_GM'=>'选择GM指令',
	'select_GM_label'=> array(
			'正常',
			'禁言',
			'禁号',
	),
	'select_GM_notice'=>'请选择操作指令',
	'brig_reason'=>'禁闭原因',
	'brig_end_time'=>'禁闭为止时间',
	'brig_end_time_notice'=>'拾取准确的为止时间[当为空时视为永久禁闭]',
	'Operation Type' => '操作类型',
	'By character name' => '根据角色名',
	'By account' => '根据平台账号',
	'Operation Target' => '操作对象',
	'delete masages'	=>	'是否删除该用户所发信件',	
	'Yes' => '是',	
	'No' => '否',
		
		
	
	//player.userFreeze.list.php
	'brig_handle'=>'禁闭操作',
	'brig_add_time'=>'添加时间',
	'forever'=>'永久',

    //player.getRoleInfo.php
    'type_label' => array(
        '通过角色名称',
        '通过平台账号'
    ),
    'player_account'=>'玩家平台账号',
    'player_role'=>'玩家角色名称',
    'platform_account'=>'平台账号',
    'role_name'=>'角色名称',
    'query_by'=>'正在通过',
    'query_player_info'=>'查询玩家情报',
    'platform_belong'=>'所属平台',

    //player.RoleInfoSingleList.php
    'roleID' => '角色ID',
    'paltformID' => '平台ID',
    'role_name' => '角色名称',
    'role_level' => '角色等级',
    'role_respect' => '角色威望',
    'money' => '金钱',
    'grain' => '粮草',
    'support' => '民心',
    'redif' => '预备兵',
    'gift' => '礼券',
    'exploit' => '功勋',
    'belong_camp' => '所属阵营',
    'battle_info' => '战役信息',		

	'tbTitle' => array(
			'玩家名',
			'平台账户ID',
			'阵营ID',
			'等级',
			'舰队坐标',
			'军衔',
			'荣誉',
			'功勋',
			'信用卡',
			'创建时间',
			'是否在线',
			'VIP等级',
	),
	'Item' => '道具信息',
	'Skill' => '技能信息',
	'Captain' => '舰长信息',
	'Building' => '星球信息',		
	'Equip' => '装备信息',
	'Material' => '资源信息',
	'rechargeLog' => '付费记录',
	'vip' => 'VIP信息',
	'monthCard' => '月卡信息',
	'consumer' => '消费信息',
	'rechargeInfo' => '付费信息',	
	'view' => '查看',	


    //player.roleInfoList.list.php
    'all_player_list' => '全服玩家信息列表',
    'export_respect' => '导出当前服威望值前1百',
    'export_is_need' => '需要将查询导出列表？',

    //player.getCityInfo.php
    'area_info_type' => array(
        '单个城市情报',
        '阵营城市列表',
        '阵营所在城市列表',
    ),
    'select_area' => array(
        '请选择具体阵营:',
        '请输入具体城市:',
    ),
    'area_type' => array(
        '阵营:',
        '城市:',
    ),
    'factionList' => array(
        '魏国',
        '蜀国',
        '吴国',
        '其它'
    ),
    'searching' => '正在查询',

    //player.showCityList.php
    'showCityTitle' => array(
        '城市',
        '阵营',
        '城主',
        '规模',
    ),

    //player.getMassInfo.php
    'query_by_army' => '通过玩家角色名称查询该玩家所创建的军团信息',
    'input_role_name' => '请输入玩家角色名称',
    'query_by_role' => '正在通过玩家角色名称查询玩家军团情报',

    //player.massInfoList.php
     'massInfoTitle' => array(
        '所属玩家',
        '军团都督',
        '副将1',
        '副将2',
        '军团等级',
        '军团经验值',
        '军团兵种',
        '军团技能1',  
        '军团技能2',  
        '军团技能3',  
        '军团技能4',  
        '军团技能5', 
        '军团技能6',  
        '军团状态',  
    ), 

     //DataMonitorByPay.list.php
    'monitor_data' => '数据监控',
    'monitor_data_pay' => '货币明细',
    'monitor_data_item' => '数据监控[道具类]',
    'monitor_data_recharge' => '充值明细',
    'type' => '类型',
    'object' => '对象',
    'action' => '动作',
    'expend' => '消耗',
    'get' => '获取',
    'input_role_name' => '行为描述',   
    'monitorByPay' => array(
        '行为描述',       
        '金额',
        '行为时间',
        '获得/消耗',
        '种类',
        '平台',
    ),
    'IC' => '钻石',

    //DataMonitorByEquip.list.php
    'equip_name' => '道具名称',
    'monitorByEquip' => array(
    		'角色名',
    		'道具名称',
    		'获得/消耗(途径)',
    		'数量',
    		'行为时间',
    		'平台',   		
    ),

    //DataMonitorByRecharge.list.php
    'user_name' => '账户名称',
    'monitorByRecharge' => array(
        "账户名",
        "角色名",
        "付费金额",
        "类型",
        "付费时间",
        "付费状态"
    ),
    'rechargeTotal' => '付费总额[元]',

    //prop.list.php
    'send_equip_history' => '发放道具历史',
    'send_equip' => '发放道具', 
    'send_project' => '发放项目',      
    'player_name' => '玩家名称',  
    'operator' => '操作人',  
    'send_time' => '发放时间',  
    'login_ip' => '登陆ip',  
    'success' => '成功',  
    'failed' => '失败', 

    //player.addProperty.php     
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
 

    //player.addRoleActionDictionary.form.php
    'dictionary_list'=>'字典列表和维护',
    'add_dictionary'=>'增加字典项',
    'specific_action'=>' 具体行为动作Action',        
    'eg_action'=>'比如这样的一个[PayMallShowcase]',

    'action_desc'=>'动作Action中文描述',
    'eg_action_desc'=>' 比如这样的一个[PayMallShowcase] ，中文描述为[限时抢购]',    
    'action_statistics'=>'行为Action是否归入资产流统计',  
    'action_statistics_label'=> array(
        '不统计', 
        '以Action对应的行为单独统计', 
        '已Action所属的消耗类型统计', 
    ),   
    'action_affect'=>'行为Action能够带来',  
    'action_affect_label'=> array(
        '没有归属', 
        '获得民心', 
        '获得礼券', 
        '消耗资产',
    ),   
    'action_affect_notice'=>'比如[PayTechAccelerate|科技加速][PayEventAccelerate:Upgrade修筑加速]都归属于[消耗资产项] 而[PayInward:Event:Upgrade]能获得资产民心[PayInward:EventUpgrade]能获得资产礼券',      
    'action_cate'=>'行为Action[消耗资产]归属统计类别',  
    'action_cate_title'=> array(
        '没有归属', 
        '商城消耗', 
        '加速消耗',       
        '开格消耗', 
        '酿酒消耗',
        '清谈消耗', 
        '抽奖消耗', 
        '传承消耗',       
        '将魂拍卖消耗', 
        '购买次数消耗',       
    ),  
    'action_cate_notice'=>'比如[PayTechAccelerate|科技加速][PayEventAccelerate:Upgrade修筑加速]都归属于[加速消耗]', 

    //player.payActionDict.php
    'specific_action_title'=> array(
        'Action模块类型', 
        'Action描述名称', 
        'Action统计归属',       
        'Action统计类别',     
    ),
    //player.getRoleOriginalInfo.list.php
    'role_original_info' => array(
        '角色名',
        '渔场等级'
    )

);
