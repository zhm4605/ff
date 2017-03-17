

<?php

      $html = file_get_contents("https://magboss.pl/category/show/1989/lang/en");

     echo $html;

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title></title>
  <script type="text/javascript" src="/dll/dll.js"></script>
<link href="/public/js/jquery.ui/jquery-2.0.3.min.js" rel="stylesheet"/></head>

<body>
	
	<iframe id='out' src='https://magboss.pl/category/show/1989/lang/en'>
	</iframe>
	
	<script type="text/javascript">
	
	$(function(){
		window.category = [];
		$("#out").contents().find('.childlist a.active').parent().find('.childlist a').each(function(index, el) {
			var arr = {};
			var cat = $(el).text();
			arr.name = cat.match(/(.*)\(/)[1];
			arr.count = cat.match(/\((\S*)\)/)[1];
			var href = $(el).attr('href');
			arr.category = href.match(/show\/(.*)/)[1];

			window.category.push(arr);
		});

		
		/*
		window.category = [];
		
		$('.parentlist>.dropdown-submenu>a').each(function(index, el) {
			var arr = {};
			var cat = $(el).text();
			arr.name = cat.match(/(.*)\(/)[1];
			arr.count = cat.match(/\((\S*)\)/)[1];
			var href = $(el).attr('href');
			arr.category = href.match(/show\/(.*)/)[1];

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
					var href = $(sub).attr('href');
					arr_sub.category = href.match(/show\/(.*)/)[1];
					
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

		console.log(window.category);
		setTimeout(function(){
			$.ajax({
      url:"/zhuaqu/zz/",
      dataType:"json",
      type: "post",
      data:window.category,
      success:function(msg)
      {
        console.log(msg);
      },
      error:function(msg){
        console.log(msg);
        document.body.innerHTML = msg.responseText;
      }
    })
		},1000)*/
		
	})

	function loop($items)
	{
		var list = [];
		$items.each(function(i,sub){
			var sub_text = $(sub).text();
			var arr_sub = {};
			arr_sub.name = sub_text.match(/(.*)\(/)[1];
			arr_sub.count = sub_text.match(/\((\S*)\)/)[1];

			var href = $(sub).attr('href');
			arr_sub.category = href.match(/show\/(.*)/)[1];
			list.push(arr_sub);
		})
		return list;
	}


	/*
		$(function(){

		$('.childlist a.active',document.frames('out').document).each(function(index, el) {
			var arr = {};
			var cat = $(el).text();
			arr.name = cat.match(/(.*)\(/)[1];
			arr.count = cat.match(/\((\S*)\)/)[1];
			var href = $(el).attr('href');
			arr.category = href.match(/show\/(.*)/)[1];

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
					var href = $(sub).attr('href');
					arr_sub.category = href.match(/show\/(.*)/)[1];
					
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

		
		/*
		window.category = [];
		
		$('.parentlist>.dropdown-submenu>a').each(function(index, el) {
			var arr = {};
			var cat = $(el).text();
			arr.name = cat.match(/(.*)\(/)[1];
			arr.count = cat.match(/\((\S*)\)/)[1];
			var href = $(el).attr('href');
			arr.category = href.match(/show\/(.*)/)[1];

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
					var href = $(sub).attr('href');
					arr_sub.category = href.match(/show\/(.*)/)[1];
					
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
	*/
</script>

</body>
</html>

