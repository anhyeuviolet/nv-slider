<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NHÍM THỦ LĨNH (contact@vinanat.vn)
 * @Copyright (C) 2014 Pa Software Solutions (http://vinanat.vn). All rights reserved
 * @Createdate Nov 18, 2014, 02:32:08 PM
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
if( ! defined( 'NV_IS_AJAX' ) ) die( 'Wrong URL' );

$parentid = $nv_Request->get_int( 'parentid', 'get', 0 );

$contents = nv_show_cat_list( $parentid );

include NV_ROOTDIR . '/includes/header.php';
echo $contents;
include NV_ROOTDIR . '/includes/footer.php';