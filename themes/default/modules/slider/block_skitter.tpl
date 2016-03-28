<!-- BEGIN: main -->
<!-- BEGIN: SKITTER -->
<link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/slider/plugins/skitter/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/slider/plugins/skitter/jquery.easing.1.3.js"></script>
<script type="text/javascript" language="javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/slider/plugins/skitter/jquery.skitter.min.js"></script>
<!-- END: SKITTER -->
<div class="box_skitter box_skitter_large-{BLOCKID}">
	<ul class="{BLOCKID}">
	<!-- BEGIN: loop -->
		<li>
			<a href="{ROW.link}"><img class="circles" src="{ROW.thumb}"/></a>
			<div class="label_text">
				<p>{ROW.title}</p>
			</div>
		</li>
	<!-- END: loop -->
	</ul>
</div>
<script type="text/javascript" language="javascript">
	$(document).ready(function() {
		$(".box_skitter_large-{BLOCKID}").skitter({
			theme: "clean", 
 			numbers_align: "center", 
 			focus: true, 
			dot: true,
			numbers: true
		});
	});
</script>
<!-- END: main -->
