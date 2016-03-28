/**
 * @Project NUKEVIET 4.x
 * @Author Pa Software Solutions.Ltd  (contact@3sacmau.vn)
 * @Copyright (C) 2014 Pa Software Solutions.Ltd. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 5/8/2014 07:25
 */
<!-- BEGIN: main -->

<link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/jspa/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />

	<script type="text/javascript" language="javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/jspa/jquery.easing.1.3.js"></script>
	<script type="text/javascript" language="javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/jspa/jquery.skitter.min.js"></script>
<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			$('.box_skitter_large').skitter({
				theme: 'clean',
				numbers_align: 'center',
				progressbar: true, 
				dots: true, 
				preview: true
			});
		});
	</script>

	
<div class="box_skitter box_skitter_large">
					<ul>  <!-- BEGIN: loop -->
						<li><a href="{ROW.link}"><img src="{ROW.thumb}" class="circles" /></a><div class="label_text"><p>{ROW.title}</p></div></li><!-- END: loop -->
				</ul>
				</div>

<!-- END: main -->
