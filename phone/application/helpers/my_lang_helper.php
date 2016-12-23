<?php
$default_app = 'welcome';
$app = isset($_REQUEST['app']) ? preg_replace('/(\W+)/', '', $_REQUEST['app']) : $default_app;
define('APP', $app);

/**
 *    语言项管理
 *
 *    @author   sarina
 *    @param    none
 *    @return   void
 */
class MY_Lang
{

	/**
	 *    获取指定键的语言项
	 *
	 *    @param     none
	 *    @return    mixed
	 */
	static function &get($key = '')
	{
		if (MY_Lang::_valid_key($key) == false)
		{
			return $key;
		}
		$vkey = $key ? strtokey("{$key}", '$GLOBALS[\'VERNELANG\']') : '$GLOBALS[\'VERNELANG\']';
        $tmp = eval('if(isset(' . $vkey . '))return ' . $vkey . ';else{ return $key; }');
		return $tmp;
	}

	/**
	 * 验证key的有效性
	 *
	 * @param string $key
	 * @return bool
	 */
	static function _valid_key($key)
	{
		if (strpos($key, ' ') !== false)
		{
			return false;
		}
		#TODO: 暂时只判断是否含有空格
		return true;
	}


	/**
	*    加载指定的语言项至全局语言数据中
	*
	*    @param    none
	*    @return    void
	*/
	static function load($lang_file)
	{
		static $loaded = array();
		$old_lang = $new_lang = array();
		$file_md5 = md5($lang_file);
		if (!isset($loaded[$file_md5]))
		{
			$new_lang = MY_Lang::fetch($lang_file);
			$loaded[$file_md5] = $lang_file;
		}
		else
		{
			return;
		}
		$old_lang =& $GLOBALS['VERNELANG'];
		if (is_array($old_lang))
		{
			$new_lang = array_merge($old_lang, $new_lang);
		}
		$GLOBALS['VERNELANG'] = $new_lang;
	}

    /**
     *    获取一个语言文件的内容
     *
     *    @param     string $lang_file
     *    @return    array
     */
     static function fetch($lang_file)
     {
//		 echo $lang_file;echo "====";
         $lang = is_file($lang_file) ? include($lang_file) : array();
		 return $lang;
//         return MY_Lang::fetch_dyn($lang, $lang_file);
     }

     /**
      * 从动态位置获得语言配置
      * @param unknown $lang
      * @param unknown $lang_file
      * @return multitype:
      */
     static function fetch_dyn($lang, $lang_file)
     {
         static $hasapc = null;
         $ci =& get_instance();
         // 检测环境，若是production模式，则开启apc缓存
         if (defined('ENVIRONMENT') && ENVIRONMENT == 'production' && is_null($hasapc)) {
             $hasapc = function_exists('apc_fetch');
         }
         // 若$lang是数组，且不为空时，则认定具有覆盖的可能
         if (is_array($lang) && !empty($lang)) {
             $db_lang = false;
             // 从apc缓存获取
             if ($hasapc) {
      	        $db_lang = apc_fetch("lang." . md5($lang_file));
             }
             // 若结果为false（注意：是全等号），则从数据库加载
             if ($db_lang === false) {
                 $res = $ci->db->from('language')->where('filename', basename($lang_file))->where('lang', LANG)->get();
                 $db_lang = array();
                 // 迭代生成覆盖用的数据
                 foreach ($res->result_array() as $item) {
                     // 产生keys，分隔符为"|"
                     $keys = explode("|", $item['key']);
                     // 若keys为空，表示这条设定不合法，直接进入下一跳
                     if (count($keys) == 0) continue;
                     // keys[0]为rootkey
                     $rootkey = array_shift($keys);
                     // 若rootkey
                     if (!isset($db_lang[$rootkey])) {
                         $db_lang[$rootkey] = count($keys) > 0 ? array() : null;
                     }
                     // 依层次生成
                     $tmp =& $db_lang[$rootkey];
                     for ($i = count($keys), $j = 0; $i > 0; $i--, $j++) {
                         // $i不是最后一层时，为数组 （当前层已存在时，使用当前层的数组，否则使用一个新的空数组）
                         // $i为最后一层时，为NULL
                         $tmp[$keys[$j]] = $i > 1 ? (isset($tmp[$keys[$j]]) ? $tmp[$keys[$j]] : array()) : null;
                         // 重定义引用关系，逐层递进
                         $tmp =& $tmp[$keys[$j]];
                     }
                     // 注入数据
                     $tmp = $item['value'];
                     // unset掉tmp，以免后续逻辑对tmp的引用产生意外操作
                     unset($tmp);
                 }
                 if ($hasapc) {
                     apc_store("lang." . md5($lang_file), $db_lang);
                 }
             }
             $lang = array_replace_recursive($lang, $db_lang);
         }
         return $lang;
     }
}

function lang_file($file)
{
	return ROOT_PATH . '/languages/' . LANG . '/' . $file . '.lang.php';
}


/**
 *    将default.abc类的字符串转为$default['abc']
 *
 *    @author    Garbin
 *    @param     string $str
 *    @return    string
 */
function strtokey($str, $owner = '')
{
	if (!$str)
	{
		return '';
	}
	if ($owner)
	{
		return $owner . '[\'' . str_replace('.', '\'][\'', $str) . '\']';
	}
	else
	{
		$parts = explode('.', $str);
		$owner = '$' . $parts[0];
		unset($parts[0]);
		return strtokey(implode('.', $parts), $owner);
	}
}



?>