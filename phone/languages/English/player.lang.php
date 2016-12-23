<?php
/**
 * Author: sarina
 * Date: 2014/12/25
 * Time: 14:03
 */
return array(
    'amount' => 'Amount',
	
	//player.userFreeze.php / 426
	'player_freeze'=>'Specified player silent/freeze',
	'freeze_list'=>'Player silent/freeze list',
	'player_role_name'=>'player’s role name',
	'server_role_name'=>'Role name under current server',
	'select_GM'=>'Select GM instruction',
	'select_GM_label'=> array(
			'Normal',
			'Silent',
			'Account disabled',
	),
	'select_GM_notice'=>'Please select the operating instruction',
	'brig_reason'=>'Confinement reason',
	'brig_end_time'=>'Confinement deadline',
	'brig_end_time_notice'=>'Pick up the exact deadline [keeping it blank means the permanent confinement]',
	'Operation Type' => 'Operation Type',
	'By character name' => 'By character name',
	'By account' => 'By account',	
	'Operation Target' => 'Operation Target',	
	'delete masages'	=>	'Whether delete mails sent by this user at the same time',
	'Yes' => 'Yes',
	'No' => 'No',
		
		
	
	//player.userFreeze.list.php
	'brig_handle'=>'Confinement operation',
	'brig_add_time'=>'Add time',
	'forever'=>'Permanent',

    //player.getRoleInfo.php
    'type_label' => array(
        'By role name',
        'By platform account'
    ),
    'player_account'=>'Player’s platform account',
    'player_role'=>'Player’s role name',
    'platform_account'=>'Platform account',
    'role_name'=>'Role name',
    'query_by'=>'By',
    'query_player_info'=>'Query player information',
    'platform_belong'=>'Subordinate platform',

    //player.RoleInfoSingleList.php
    'roleID' => 'Role ID',
    'paltformID' => 'Platform ID',
    'role_name' => 'Role name',
    'role_level' => 'Role level',
    'role_respect' => 'Role prestige',
    'money' => 'Money',
    'grain' => 'Forage',
    'support' => 'coins',
    'redif' => 'Reservist',
    'gift' => 'Token',
    'exploit' => 'Feat',
    'belong_camp' => 'Subordinate platform',
    'battle_info' => 'Battle information',
		
	'tbTitle' => array(
			'Player Name',
			'Platform Account ID',
			'Faction ID',
			'Level',
			'Fleet coordination',
			'Rank',
			'Honor',
			'Medal',
			'Credit Card',
			'Creation Time',
			'Online or offline',
			'VIP Level',
	),
	'Item' => 'Item Info',
	'Skill' => 'Skill Info',
	'Captain' => 'Captain Info',
	'Building' => 'Planetoid Info',
	'Equip' => 'Equipment Info',
	'Material' => 'Resource Info',
	'rechargeLog' => 'Payment Info',
	'vip' => 'VIP Info',
	'monthCard' => 'Monthly Card Info',
	'consumer' => 'Consumption Info',
	'rechargeInfo' => 'Payment Info',
	'view' => 'View',
	
    //player.roleInfoList.list.php
    'all_player_list' => 'Information list of full-service players',
    'export_respect' => 'Export the first 100 of the current prestige points',
    'export_is_need' => 'Do you need to export the query result out of the list?',

    //player.getCityInfo.php
    'area_info_type' => array(
        'Single city information',
        'Camp city list',
        "Camp's city list",
    ),
    'select_area' => array(
        'Please select the specific camp:',
        'Please select the specific city:',
    ),
    'area_type' => array(
        'Camp:',
        'City:',
    ),
    'factionList' => array(
        'State Wei',
        'State Shu',
        'State Wu',
        'Others'
    ),
    'searching' => 'Querying...',

    //player.showCityList.php
    'showCityTitle' => array(
        'City',
        'Camp',
        'Castellan',
        'Scale',
    ),

    //player.getMassInfo.php
    'query_by_army' => 'Query the information of legion created by the player by the role name.',
    'input_role_name' => 'Please enter the role name of the player',
    'query_by_role' => 'Querying the legion information of the player by the player’s role name',

    //player.massInfoList.php
     'massInfoTitle' => array(
        'Subordinate player',
        'Legion governor',
        'Lieutenant 1',
        'Lieutenant 2',
        'Legion level',
        'Legion experience value',
        'Legion arms',
        'Legion skill1',
        'Legion skill2',
        'Legion skill3',
        'Legion skill4',
        'Legion skill5',
        'Legion skill6',
        'Legion status',
    ), 

     //DataMonitorByPay.list.php
    'monitor_data' => 'Data monitoring',
    'monitor_data_pay' => 'Data monitoring [Fortune]',
    'monitor_data_item' => 'Data monitoring [Equipment]',
    'monitor_data_recharge' => 'Data monitoring [Recharge]',
    'type' => 'Type',
    'object' => 'Object',
    'action' => 'Action',
    'expend' => 'Consumption',
    'get' => 'Gotten',
    'input_role_name' => 'Action description',
    'monitorByPay' => array(
        'Action Description',       
        'Amount',
        'Action Time',
        'Receive/Consume',
        'Type',
        'Platform',
    ),
    'IC' => 'Credit',

    //DataMonitorByEquip.list.php
    'equip_name' => 'Name of props',
    'monitorByEquip' => array(
    		'Character Name',
    		'Item Name',
    		'Receive/Consume (Method)',
    		'Quantity',
    		'Action Time',
    		'Platform',
    ),

    //DataMonitorByRecharge.list.php
    'user_name' => 'Name of user',
    'monitorByRecharge' => array(
        "User name",
        "Role name",
        "Recharge Amount",
        "Class",
        "Recharge time",
        "Recharge state"
    ),
    'rechargeTotal' => 'Total recharge amount (RMB)',

    //prop.list.php
    'send_equip_history' => 'Record of distribution',
    'send_equip' => 'Give props',
    'send_project' => 'Project issuance',
    'player_name' => 'Player name',
    'operator' => 'Operator',
    'send_time' => 'Issuance time',
    'login_ip' => 'IP address',
    'success' => 'Succeeded',
    'failed' => 'Failed',

    //player.addProperty.php     
    'role_equip' => 'Give props to specified players',
    'input_equip_num' => 'Please enter ID and the quantity of props',
    'send_object' => 'Sending object',
    'send_object_notice' => '(Required field. The role name of one player is listed each line)',
    'emailTitle' => 'Email title',
    'emailTitle_notice' => 'Please enter Email title',
    'send_object_not' => 'Please enter send object',
    'emailTitle_length' => 'Email title less than 100',
    'emailContent' => 'Email content',
    'emailContent_notice' => 'Please enter Email content',
    'sendEquip' => 'Give',

    'reward'=>'Prop',
    'rewardID'=>'Prop ID',
    'reward_num'=>'Quantity',
    'reward_num_notile'=>'Enter the name and quantity of props. The quantity must be numeric',
    'add_reward' => 'Add an item',
    'rewardID_not_exist' => 'Prop ID does not exist',



    //player.addRoleActionDictionary.form.php
    'dictionary_list'=>'Dictionary list and maintenance',
    'add_dictionary'=>'Increase the dictionary entries',
    'specific_action'=>' Specific action and behavior',
    'eg_action'=>'For example:[PayMallShowcase]',

    'action_desc'=>'An action named as',
    'eg_action_desc'=>' For example [PayMallShowcase] ，named as[Flash sale]',
    'action_statistics'=>'Whether the behavior Action is included in the asset flow statistics',
    'action_statistics_label'=> array(
        'No statistics',
        'Separate statistics of behavior corresponding to Action',
        'Statistics of consumption type that the Action belongs to',
    ),   
    'action_affect'=>'Behavior Action can bring',
    'action_affect_label'=> array(
        'No attribution',
        'coins gotten',
        'Token gotten',
        'Asset consumed',
    ),   
    'action_affect_notice'=>'For example, both [PayTechAccelerate|Technology Acceleration] and [PayEventAccelerate:Upgrade Building Acceleration ] belong to [Consumption Asset Item]. However, [PayInward:Event:Upgrade] can get the asset popularity, and [PayInward:EventUpgrade] can get the asset token',
    'action_cate'=>'Attribution statistical category of behavior Action[consumption assets]',
    'action_cate_title'=> array(
        'No attribution',
        'Mall consumption',
        'Acceleration consumption',
        'Grid-opening consumption',
        'Vintage consumption',
        'Talk consumption',
        'Lottery consumption',
        'Inheritance consumption',
        'Soul auction consumption',
        'Buying frequency',
    ),  
    'action_cate_notice'=>'For example, both [PayTechAccelerate|Technology Acceleration] and [PayEventAccelerate:Upgrade Building Acceleration] are attributed to [acceleratioin consumption]',

    //player.payActionDict.php
    'specific_action_title'=> array(
        'Action module type',
        'Action description name',
        'Action statistical attribution',
        'Action statistical category',
    ), 

);
