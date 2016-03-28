<!-- BEGIN: main -->
<ul class="bxslider-{BLOCKID}">
<!-- BEGIN: loop -->
	<li>
		<a href="{ROW.link}"><img class="img-responsive" src="{ROW.thumb}" title="{ROW.title}"/></a>
	</li>
<!-- END: loop -->
</ul>
<script type="text/javascript">
$(document).ready(function(){
  $('.bxslider-{BLOCKID}').bxSlider({
	pager: false,
	captions: true
  });
});
</script>
<!-- BEGIN: BX -->
<link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/slider/plugins/bxslider/jquery.bxslider.css" type="text/css" media="all" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/slider/plugins/bxslider/jquery.bxslider.min.js"></script>
<!-- END: BX -->
<!-- END: main -->
