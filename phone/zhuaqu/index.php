

<?php

      $html = file_get_contents("https://magboss.pl/home/index/lang/en");

     echo $html;

?>

<script type="text/javascript">
	
	$(function(){

		

		window.category = [];
		
		$('.parentlist>.dropdown-submenu>a').each(function(index, el) {
			var arr = {};
			var cat = $(el).text();
			arr.name = cat.match(/(.*)\(/)[1];
			arr.count = cat.match(/\((\S*)\)/)[1];

			//子目录
			arr.sub = [];
			var $childlist = $(el).parent().find('.childlist');
			if($childlist.length)
			{
				//loop($childlist.find('.dropdown-menu'));
				var list = [];
				$childlist.find('.dropdown-submenu>a').each(function(i, sub) {
					var sub_text = $(sub).text();
					var arr_sub = {};
					arr_sub.name = sub_text.match(/(.*)\(/)[1];
					arr_sub.count = sub_text.match(/\((\S*)\)/)[1];
					
					arr_sub.sub = loop($(sub).parent().find('.dropdown-menu>li>a'));

					list.push(arr_sub);
				});
				arr.sub = list;
			}
			else
			{
				var $child = $(el).parent().find('.dropdown-menu');
				if($child.length)
				{
					arr.sub = loop($child.find('li>a'));
				}
			}
			window.category.push(arr);
		});
	})

	function loop($items)
	{
		var list = [];
		$items.each(function(i,sub){
			var sub_text = $(sub).text();
			var arr_sub = {};
			arr_sub.name = sub_text.match(/(.*)\(/)[1];
			arr_sub.count = sub_text.match(/\((\S*)\)/)[1];
			list.push(arr_sub);
		})
		return list;
	}
</script>