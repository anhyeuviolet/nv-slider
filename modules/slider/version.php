<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NHÍM THỦ LĨNH (contact@vinanat.vn)
 * @Copyright (C) 2014 Pa Software Solutions (http://vinanat.vn). All rights reserved
 * @Createdate Nov 18, 2014, 02:32:08 PM
 */

if( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$module_version = array(
	'name' => 'Pa slider', // Tieu de module
	'modfuncs' => 'main,rss', // Cac function co block
	'is_sysmod' => 0, // 1:0 => Co phai la module he thong hay khong
	'virtual' => 1, // 1:0 => Co cho phep ao hao module hay khong
	'version' => '4.1.00', // Phien ban cua modle
	'date' => 'Tu, 218 Nov 2014 00:00:00 GMT', // Ngay phat hanh phien ban
	'author' => 'Pa Software Solutions (contact@vinanat.vn)', // Tac gia
	'note' => '', // Ghi chu
	'uploads_dir' => array( $module_name)
);