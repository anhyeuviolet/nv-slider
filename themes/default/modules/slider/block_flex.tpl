<!-- BEGIN: main -->
<!-- BEGIN: FLEX -->
<link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/slider/plugins/flex/flexslider.css" type="text/css" media="all" rel="stylesheet" />
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/slider/plugins/flex/jquery.flexslider.js"></script>
<!-- END: FLEX -->
<div class="block-{BLOCKID}-slider rel">
	<ul class="slides">  
	<!-- BEGIN: loop -->
		<li>
			<a href="{ROW.link}"><img src="{ROW.thumb}" class="img-responsive"/></a>
			<p class="flex-caption">{ROW.title}</p>
		</li>
	<!-- END: loop -->
	</ul>
</div>

<script>
$(window).load(function() {
  $('.block-{BLOCKID}-slider').flexslider({
    animation: "slide",
	controlNav: false,
	keyboard: true,
	directionNav: true
  });
});
</script>
<!-- END: main -->
