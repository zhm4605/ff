<?php
/**
 * Author: sarina
 * Date: 2014/12/24
 * Time: 16:03
 */
return array(
	
	//sysMail.add.php
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
	'start_t_n' => 'Start time should be later than the current time',
	'last createTime' => 'The last create role time',
	'Full service players' => 'Full service players',
	'Conditions' => 'Conditional choice',
	'Select all/Select none'	=>	'Select all/Select none',	

	'player_name' => 'player',
	'send_time' => 'send time',
	'send_mail' => 'send mail',
	'send' => 'Send',
	'Send results' => 'Send results',
				
	//executeTask.list.php
	'not_complete' => 'Uncompleted',
	'complete' => 'Completed',
	'user_name' => 'Account Name',
	'execute' => 'Complete',
	'executeTaskTitle' => array(
			'Quest ID',
			'Quest Name',
			'Receiving Time',
			'Completion Time',
			'Account Name',
			'Quest Status',
			'Server'
	),
	'input_username' => 'Please input an account name to search!',
	
	
	
	
		
    //auction.list.php
    'auction_start_time' => 'Start time of auction',
    'auction_end_time' => 'End time of auction',
    'discount' => 'Discount proportion',
    'operator' => 'Operator',
    'login_ip' => 'IP address',
    'auction_list' => 'Soul auction record',
    'add_auction' => 'Add soul auction',
    'success' => 'succeeded',
    'failed' => 'failed',

    //auction.form.php
    'start_time_notice' => 'Please select the exact start time [which should be larger than the previous end time. The activity time should not overlap]',
    'this_discount' => 'Discount in this auction',
    'pre_end_time_notice' => 'Check the end time of previous activity to avoid the overlapping of activity time',
    'integer' => 'Please enter a decimal between 0 and 1',

    //rechargeActivity.list.php
    'recharge_list' => 'Recharge activity',
    'add_recharge' => 'Add recharge activity',
    'recharge_type' => 'recharge type',
    'activity_title' => 'Activity title',
    'activity_desc' => 'Activity description',
    'activity_label' => 'Activity tag',
    'recharge_gave_gift' => 'Send gift after multiple recharge',
    'set_privilege' => 'Recharge privilege set for operation',

    //rechargeActivity.form.php
    'push_to_server' => 'Push to server',
    'push_to_all_server' => 'Push to all servers',
    'select_server' => 'Please select the target servers for pushing [multi-choice]',

    'reward'=>'Reward',
    'rewardID'=>'Rewards Item ID',
    'reward_num'=>'Rewards amount',
    'reward_num_notice'=>'Please enter into the item ID and quantity of rewards',
    'add_reward' => 'Add rewards item',
    'rewardID_not_exist' => 'No reward ID',

    'activity_type' => 'Activity type',
    'activity_intro' => 'Activity explanation',
    'activity_type_notice' => 'Please determine the activity type',
    'start_time' => 'Start time for activity',
    'end_time' => 'End time for activity',
    'label_type' => array(
        'Time-limited offer',
        'Service release offer',
        'Holiday offer',
        'Everyday first recharge',
        'Accumulate recharge rewards',
    ),
    'action_type' => 'Behavior type',
    'recharge' => 'recharge',
    'consume' => 'consumption',
    'get_type_name' => 'Collection method',
    'get_type' => array(
        'Collect only once during the activity',
        'Collect only once everyday',
        'Collect once when meeting requirements',
    ),   
    'get_type_notice' => 'Please be clear about collection method',
    'mark_type_name' => 'Record method',
    'mark_type' => array(
        'Total',
        'Single',
    ),   
    'mark_type_notice' => 'Please be clear about the record metod of activity data',
    'recharge_num' => 'recharge amount',
    'join_activity_num' => 'Recharge amount for operation activities',
    'activity_reward' => 'Rewards for operation activities',
    'total_reward'=>'Accumulate recharge rewards',
    'recharge_limit'=>'Recharge limit',
    'recharge_limit_notice'=>'Please enter into the limit that accumulative recharge should reach, as well as the reward item ID and amount',
    'max_num' => 'Less than or equal to 255',


    //operation.giveOutRedEnvelope.form.php

    'online_dis_time'=>'Online Time',
    'start_dis_time'=>'Start Time',
    'end_dis_time'=>'Closing Time',
    'offline_dis_time'=>'Offline Time',
    'isClose' =>'You cannot restart after closing. Are you sure you want to close?',

    //operation.giveOutRedEnvelope.form.php

    'online_dis_time'=>'Online Time',
    'start_dis_time'=>'Start Time',
    'end_dis_time'=>'Closing Time',
    'offline_dis_time'=>'Offline Time',


    //gameactive.add.php
    'active_add_title'=>'Add',
    'active_AreaCharge'=>'Payment Event',
    'active_AreaSpend'=>'Consumption Event',
    'active_input_name'=>'Event Name',
    'active_input_show_time'=>'Event Online Time',
    'active_input_begin_time'=>'Event Opening Time',
    'active_input_end_time'=>'Event Closing Time',
    'active_award'=>'Event Reward',
    'active_input_award_AreaCharge_value'=>'Reward Limit',
    'active_input_award_AreaSpend_value'=>'Consumption Limit',
    'active_input_radio_normal_item'=>'General Item',
    'active_input_radio_faction_item'=>'Sub-faction Item',
    'active_input_servers'=>'Server Push',
    'active_add_input_items'=>'Add Item',
    'active_reward_num'=>'Quantity',
    'active_reward_type'=>'reward type',
    'active_reward_type_item'=>'Item',
    'active_reward_type_equip'=>'Equipment',
    'active_reward_type_chip'=>'Chip',
    'active_reward_level'=>'reward level',
    
    
    'Enclosure'=>'Enclosure',
    'keywords' => 'keywords',
    
    //注释
    'keyNotes' => array(
    		'Federation Player',
    		'Klingon player',
    		'Level ≧ n. Example: -LV[20] means Lv.20 or higher level players',
    		'Level ≤ n',
    		'Registration date is later than date. Example: -REG[2014-12-09 12:00] means players whose registration dates are later than 2014-12-09 12:00',
    		'Registration date earlier than date',
    		'Expand keyword combination, relation is and',
    ),
    
    
    
    
    

    'input_please' => 'Please input',
    'max_length' => 'Max length is 30',
    'begin_t_n' => 'Opening time should be later than the online time.',
    'end_t_n' => 'End time should be later than the opening time.',
    'show_t_n' => 'Online time should be later than the current time.',
    'time_interleaved' => 'There is a similar event during this time.',
    'limit_number' => 'Please input an integer amount.',
    'id_num_notile'=>'Please input ID, quantity and level with numbers. [Chip level 1-9]',
    'please_add_award'=>'Please add a reward item.',
    'id_notExist'=>'Reward ID does not exist',
    'equipNumNotice'=>'Up to 4 reward items',
    'back_active_data' => 'Back to event data',
        
    //active.list.php
    'active_name' => 'Event Name',
    'active_start_time' => 'Opening Time',
    'acTitle' => array(
    		'Order ID',
    		'Event Name',
    		'Online Time',
    		'Opening Time',
    		'Deadline',
    		'Server ID',
    		'Status'
    ),

    //activeData.list.php
    'acDataTitle' => array(
    		'Order ID',
    		'Event Name',
    		'Overall participants',
    		'Overall claims',
    		'Daily Details',
    ),
    'view' => 'View',
     
    //activeAward.list.php
    'activeAward' => array(
    		'Order ID',
    		'Bracket (amount)',
    		'The number of participants',
    ),
    'activity_details' => 'Event Details',
    'back_list' => 'Back to List',
    'next_step' => 'Next Step',
    
    'please choice'	=>	'Please select the option to delete',
    
);
