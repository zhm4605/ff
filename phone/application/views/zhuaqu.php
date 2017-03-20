
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title></title>
  <script type="text/javascript" src="/public/jquery.min.js"></script>
</head>

<body>
	
		<div id="good-container">
			<?php echo $html ;?>
		</div>

	<script type="text/javascript">

	$(function(){
		get_good($('#good-container'));
	});

	/*
	document.getElementById('out').onload = function(){
		console.log('aa');
		window.category = {};
		$("#out").contents().find('#categories .dropdown-submenu a.active').parent().find('.childlist .dropdown-submenu>a').each(function(index, el) {
			var href = $(el).attr('href');
			var cat = href.match(/show\/(.*)/)[1];

			var list = loop($(el).parent().find('.dropdown-menu a'));
			window.category[cat] = list;
		});

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

	};*/

	function get_good($con)
	{

		var good = {};


		var $good = $con.find('.product-page');

		good.name = $good.find('h1[itemprop=name]').text();
		//good.pic_url = $good.find('[itemprop=image]').attr('src');

		var $details = $good.find('.detail-important tbody tr');

		var $price_origin = $($details[0]).find('td s').length?$($details[0]).find('td s'):$($details[0]).find('td span');
		//good.price_origin = $($details[0]).find('td span').text();
		good.price_origin = get_pure_price($price_origin.text());

		var $price_min = $($($details[1]).find('td')[1]).find('s').length?$($($details[1]).find('td')[1]).find('s'):$($($details[1]).find('td')[1]);
		//good.price_min = $($($details[1]).find('td')[1]).text();
		good.price_min = get_pure_price($price_min.text());

		//分段价格
		var $price_table =$good.find('.product-price-table ');
		good.piecewise_price = {};
		$price_table.find('tbody tr').each(function(i,el){
			var duan = $($(el).find('td')[0]).text();
			var cross = get_pure_price($($(el).find('td')[1]).text());
			var nnet = get_pure_price($($(el).find('td')[2]).text());
			good.piecewise_price[duan]=[cross,nnet];
		})

		//产品参数
		good.import_id = $good.find('[itemprop=sku]').text();
		good.pid = $good.find('[itemprop=mpn]')?$good.find('[itemprop=mpn]').text():'';
		good.brand = $good.find('[itemprop=brand] span').text();
		good.model = $good.find('[itemprop=model]').text();
		good.weight = $good.find('meta[itemprop=weight]').attr('content');
		var $params = $($good.find('.product-params')[2]);

		if($params.find('tbody tr:last-child .detail').text()=='Wrapping')
		{
			good.wrapping = $($params.find('tbody tr:last-child td')[1]).text();
		};
		
		//图片
		var $imgs = $good.find('#gallery-'+good.import_id).find('a');
		good.pics = [];
		$imgs.each(function(i,el){
			good.pics.push(
				{
					'thumbnail':$(el).find('img').attr('data-src')?$(el).find('img').attr('data-src'):$(el).find('img').attr('src'),
					'url':$(el).attr('href'),
				}
			);
		})

		//产品分类
		var $cat = $con.find('.breadcrumb li:last-child a');
		var href = $cat.attr('href');
		good.category = href.match(/show\/(.*)/)[1];

		//产品描述
		good.description = $good.find('div[itemprop=description]').html();
		//511
		console.log(good);
		$.ajax({
      url:"http://www.shop.com/zhuaqu/good/",
      type: "post",
      dataType:"json",
      data:good,
      success:function(msg)
      {
        console.log(msg);
        go_next();
      },
      error:function(msg){
        console.log(msg);
        window.location.reload();
        //go_next();
        //document.body.innerHTML = msg.responseText;
      }
    });

    setTimeout(function(){
    	window.location.reload();
    },120000);
	}

	function go_next()
	{
		var page = window.location.search.match(/=(.*)/)[1];
    if(page<2500)
    {
    	window.location.href='/zhuaqu/?page='+(parseInt(page)+1);
    }
	}

	function get_pure_price(price)
	{
		//
		price = price.replace(' ','');
		return parseFloat(price.match(/(.*)\s{1,}E/)[1].replace(',','.'));
	}

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
</script>-->

</body>
</html>

