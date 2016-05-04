<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NHÍM THỦ LĨNH (contact@vinanat.vn)
 * @Copyright (C) 2014 Pa Software Solutions (http://vinanat.vn). All rights reserved
 * @Createdate Nov 18, 2014, 02:32:08 PM
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_slider' ) )
{
	function nv_block_config_slider( $module, $data_block, $lang_block )
	{
		global $site_mods, $nv_Cache;

		$html = '';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['catid'] . '</td>';
		$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_cat ORDER BY sort ASC';
		$list = $nv_Cache->db( $sql, '', $module );
		$html .= '<td>';
		foreach( $list as $l )
		{
			$xtitle_i = '';

			if( $l['lev'] > 0 )
			{
				for( $i = 1; $i <= $l['lev']; ++$i )
				{
					$xtitle_i .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
			}
			if( !isset($data_block['catid']) AND empty($data_block['catid']) ){
				$data_block['catid'] = array();
			}
			$html .= $xtitle_i . '<label><input type="checkbox" name="config_catid[]" value="' . $l['catid'] . '" ' . ( ( in_array( $l['catid'], $data_block['catid'] ) ) ? ' checked="checked"' : '' ) . '</input>' . $l['title'] . '</label><br />';
		}
		$html .= '</td>';
		$html .= '</tr>';
		
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['numrow'] . '</td>';
		$html .= '<td><input type="text" class="form-control w200" name="config_numrow" size="5" value="' . $data_block['numrow'] . '"/></td>';
		$html .= '</tr>';
		
        $html .= '<tr>';
        $html .= '<td>' . $lang_block['block_template'] . '</td>';
        $html .= '<td>';
        $block_template = array( 'block_flex' => $lang_block['block_flex'], 'block_bx' => $lang_block['block_bx'], 'block_skitter' => $lang_block['block_skitter'] );
        $html .= '<select name="config_block_template" class="form-control w100 pull-left">';
		foreach ($block_template as $key => $value) {
            $html .= '<option value="' . $key . '" ' . ($data_block['block_template'] == $key ? 'selected="selected"' : '') . '>' . $value . '</option>';
        }
		$html .= '</tr>';
		return $html;
	}

	function nv_block_config_slider_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config'] = array();
		$return['config']['catid'] = $nv_Request->get_array( 'config_catid', 'post', array() );
		$return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post', 0 );
		$return['config']['block_template'] = $nv_Request->get_string( 'config_block_template', 'post', 0 );
		return $return;
	}

	function nv_block_slider( $block_config )
	{
		global $module_array_cat, $module_info, $site_mods, $module_config, $global_config, $db, $nv_Cache, $blockID;
		$module = $block_config['module'];
		$show_no_image = $module_config[$module]['show_no_image'];

		if( empty( $block_config['catid'] ) ) return '';
		
		$catid = implode( ',', $block_config['catid'] );
		
		$db->sqlreset()
			->select( 'id, catid, title, homeimgfile, homeimgthumb, hometext,link, publtime' )
			->from( NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_rows' )
			->where( 'status= 1 AND catid IN(' . $catid . ')' )
			->order( 'publtime DESC' )
			->limit( $block_config['numrow'] );
		$list = $nv_Cache->db( $db->sql(), '', $module );

		if( ! empty( $list ) )
		{
			if( empty($block_config['block_template']) ){
				$block_config['block_template'] = 'block_flex';
			}
			$block_tpl = $block_config['block_template'];
			if( file_exists( NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $site_mods[$module]['module_file'] . '/'. $block_tpl . '.tpl' ) )
			{
				$block_theme = $module_info['template'];
			}
			else
			{
				$block_theme = 'default';
			}
			
			$xtpl = new XTemplate( $block_tpl . '.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $site_mods[$module]['module_file'] );
			$xtpl->assign( 'TEMPLATE', $module_info['template'] );
			$xtpl->assign( 'BLOCKID', $blockID );
			foreach( $list as $l )
			{
				if( $l['homeimgthumb'] == 1 )
				{
					$l['thumb'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/' . $l['homeimgfile'];
				}
				elseif( $l['homeimgthumb'] == 2 )
				{
					$l['thumb'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module . '/' . $l['homeimgfile'];
				}
				elseif( $l['homeimgthumb'] == 3 )
				{
					$l['thumb'] = $l['homeimgfile'];
				}
				elseif( ! empty( $show_no_image ) )
				{
					$l['thumb'] = NV_BASE_SITEURL . $show_no_image;
				}
				else
				{
					$l['thumb'] = '';
				}
				$xtpl->assign( 'ROW', $l );
				if( ! empty( $l['thumb'] ) ) $xtpl->parse( 'main.loop.img' );
				$xtpl->parse( 'main.loop' );
			}
			
			if( ! defined( 'FLEX' ) )
			{
				define( 'FLEX', true );
				$xtpl->parse( 'main.FLEX' );
			}
			
			if( ! defined( 'BX' ) )
			{
				define( 'BX', true );
				$xtpl->parse( 'main.BX' );
			}
			
			if( ! defined( 'SKITTER' ) )
			{
				define( 'SKITTER', true );
				$xtpl->parse( 'main.SKITTER' );
			}
			$xtpl->parse( 'main' );
			return $xtpl->text( 'main' );
		}
	}
}
if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name, $global_array_cat, $module_array_cat, $nv_Cache;
	$module = $block_config['module'];
	if( isset( $site_mods[$module] ) )
	{
		if( $module == $module_name )
		{
			$module_array_cat = $global_array_cat;
			unset( $module_array_cat[0] );
		}
		else
		{
			$module_array_cat = array();
			$sql = 'SELECT catid, parentid, title, alias, viewcat, subcatid,  inhome, groups_view FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_cat ORDER BY sort ASC';
			$list = $nv_Cache->db( $sql, 'catid', $module );
			
			foreach( $list as $l )
			{
				$module_array_cat[$l['catid']] = $l;
				$module_array_cat[$l['catid']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];
			}
		}
		$content = nv_block_slider( $block_config );
	}
}
