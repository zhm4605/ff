
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title></title>
  <script type="text/javascript" src="/public/jquery.min.js"></script>
</head>
<body>

<script type="text/javascript">

  $(function(){
    window.list = [];
    $('.product-list').each(function(i,el){
      var href = $(el).find('.product-title').attr('href');
      window.list.push(href);
    });

    console.log(list.length);

    $.ajax({
      url:"/zhuaqu/all_url/",
      dataType:"json",
      type: "post",
      data:{list:window.list},
      success:function(msg)
      {
        console.log(msg);
      },
      error:function(msg){
        console.log(msg);
        document.body.innerHTML = msg.responseText;
      }
    })

  });

  
</script>
</body>
</html>