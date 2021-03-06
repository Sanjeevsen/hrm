<?php

/*
Provides a reliable way of retrieving which projects have updates.
Written by Chris Jean for iThemes.com
Version 1.0.0

Version History
	1.0.0 - 2013-04-11 - Chris Jean
		Release ready
*/


class Ithemes_Updater_Packages {
	public static function flush() {
		unset( $GLOBALS['ithemes-updater-packages-all'] );
	}
	
	public static function get_full_details( $response = false ) {
		if ( false === $response ) {
			require_once( dirname( __FILE__ ) . '/api.php' );
			$response = Ithemes_Updater_API::get_package_details();
		}
		
		$packages = self::get_local_details();
		
		
		if ( is_wp_error( $response ) ) {
			$expiration = time() + 600;
			
			foreach ( $packages as $path => $data ) {
				$packages[$path]['status'] = 'error';
				
				$packages[$path]['error'] = array(
					'code'    => 'unknown',
					'type'    => $response->get_error_code(),
					'message' => $response->get_error_message(),
				);
			}
		}
		else {
			$expiration = time() + ( 12 * 3600 );
			
			foreach ( $packages as $path => $data ) {
				if ( empty( $response['packages'][$data['package']] ) )
					continue;
				
				$package = $response['packages'][$data['package']];
				
				if ( ! empty( $package['error'] ) ) {
					if ( in_array( $package['error']['type'], array( 'ITXAPI_License_Key_Unknown', 'ITXAPI_Updater_Missing_Legacy_Key' ) ) ) {
						$packages[$path]['status'] = 'unlicensed';
					}
					else {
						$packages[$path]['status'] = 'error';
						$packages[$path]['error'] = $package['error'];
					}
					
					continue;
				}
				
				$key_map = array(
					'status'     => 'status',
					'link'       => 'package-url',
					'ver'        => 'available',
					'used'       => 'used',
					'total'      => 'total',
					'user'       => 'user',
					'sub_expire' => 'expiration',
				);
				
				foreach ( $key_map as $old => $new ) {
					if ( isset( $package[$old] ) )
						$packages[$path][$new] = $package[$old];
				}
				
				if ( isset( $package['link_expire'] ) )
					$expiration = min( $expiration, $package['link_expire'] );
			}
		}
		
		
		$details = compact( 'packages', 'expiration' );
		
		return $details;
	}
	
	public static function get_local_details() {
		require_once( dirname( __FILE__ ) . '/keys.php' );
		
		
		$all_packages = self::get_all();
		$keys = Ithemes_Updater_Keys::get();
		
		$packages = array();
		
		foreach ( $all_packages as $file => $slug )
			$packages[$slug][] = $file;
		
		foreach ( $packages as $slug => $paths )
			$packages[$slug] = array_unique( $paths );
		
		
		$details = array();
		
		
		foreach ( $packages as $package => $paths ) {
			foreach ( $paths as $path ) {
				$plugin_path = preg_replace( '/^' . preg_quote( WP_PLUGIN_DIR, '/' ) . '/', '', $path );
				
				if ( $plugin_path != $path ) {
					$type = 'plugin';
					$rel_path = preg_replace( '|^[/\\\\]|', '', $plugin_path );
					
					$plugin_data = get_plugin_data( $path, false, false );
					$version = $plugin_data['Version'];
					$info_url = $plugin_data['PluginURI'];
				}
				else {
					$type = 'theme';
					$dir = basename( dirname( $path ) );
					$rel_path = "$dir/" . basename( $path );
					
					if ( function_exists( 'wp_get_theme' ) ) {
						$theme_data = wp_get_theme( $dir );
						
						$version = $theme_data->get( 'Version' );
						$info_url = $theme_data->get( 'ThemeURI' );
					}
					else {
						$theme_data = get_theme( $dir );
						
						$version = $theme_data['Version'];
						$info_url = '';
					}
				}
				
				
				$details[$rel_path] = array(
					'type'        => $type,
					'package'     => $package,
					'installed'   => $version,
					'info-url'    => $info_url,
					'key'         => isset( $keys[$package] ) ? $keys[$package] : '',
				);
			}
		}
		
		
		return $details;
	}
	
	public static function get_all() {
		if ( isset( $GLOBALS['ithemes-updater-packages-all'] ) )
			return $GLOBALS['ithemes-updater-packages-all'];
		
		
		$packages = array();
		
		
		// Compatibility fix for WP < 3.1 as the global var is empty by default
		if ( empty( $GLOBALS['wp_theme_directories'] ) )
			get_themes();
		
		$themes = search_theme_directories();
		
		if ( is_array( $themes ) ) {
			foreach ( $themes as $slug => $data ) {
				if ( ! file_exists( "{$data['theme_root']}/{$data['theme_file']}" ) )
					continue;
				
				$headers = get_file_data( "{$data['theme_root']}/{$data['theme_file']}", array( 'package' => 'iThemes Package' ), 'theme' );
				
				if ( empty( $headers['package'] ) )
					continue;
				
				$packages["{$data['theme_root']}/{$data['theme_file']}"] = $headers['package'];
			}
		}
		
		
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$plugins = get_plugins();
		
		foreach ( $plugins as $file => $data ) {
			if ( ! file_exists( WP_PLUGIN_DIR . "/$file" ) )
				continue;
			
			$headers = get_file_data( WP_PLUGIN_DIR . "/$file", array( 'package' => 'iThemes Package' ), 'plugin' );
			
			if ( empty( $headers['package'] ) )
				continue;
			
			$packages[WP_PLUGIN_DIR . "/$file"] = $headers['package'];
		}
		
		
		foreach ( $packages as $path => $package )
			$packages[$path] = strtolower( $package );
		
		
		$GLOBALS['ithemes-updater-packages-all'] = $packages;
		
		return $packages;
	}
}
