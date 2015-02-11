<?php 
//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();
	
	//first delete options
	delete_option('spt_ews_cache');
	delete_option('spt_ews_quality');
	delete_option('spt_ews_loader');
	//then delete cache directory
	$upload_dir = wp_upload_dir();
	$cache_dir = $upload_dir['basedir']."/spt-easy-website-screenshots-cache/"; // set cache directory for screenshots
	$files = glob($cache_dir . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (!is_dir($file)) {
            unlink($file);
        }
    }
    rmdir($cache_dir);	

?>