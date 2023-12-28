<?php

/**
 * HFE_Default_Compat setup
 *
 * @package header-footer-elementor
 */

namespace HFE\Themes;

/**
 * Astra theme compatibility.
 */
class HFE_Default_Compat
{

	/**
	 *  Initiator
	 */
	public function __construct()
	{
		add_action('wp', [$this, 'hooks']);
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks()
	{
		if (hfe_header_enabled()) {
			// Replace header.php template.
			add_action('get_header', [$this, 'override_header']);

			// Display HFE's header in the replaced header.
			add_action('hfe_header', 'hfe_render_header');
		}

		if (hfe_footer_enabled() || hfe_is_before_footer_enabled()) {
			// Replace footer.php template.
			add_action('get_footer', [$this, 'override_footer']);
		}

		if (hfe_footer_enabled()) {
			// Display HFE's footer in the replaced header.
			add_action('hfe_footer', 'hfe_render_footer');
		}

		if (hfe_is_before_footer_enabled()) {
			add_action('hfe_footer_before', ['Header_Footer_Elementor', 'get_before_footer_content']);
		}

		if (hfe_single_post_enabled()) {
			// Replace template.
			add_filter('template_include', [$this, 'override_template']);
			// Display HFE's single post instead of single.php template
			add_action('hfe_single_post', 'hfe_render_single_post');
		}

		if (hfe_404_enabled()) {
			// Replace template.
			add_filter('template_include', [$this, 'override_template']);
			// Display HFE's 404 instead of 404.php template
			add_action('hfe_404', 'hfe_render_404');
		}
	}

	/**
	 * Function for overriding the header in the elmentor way.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function override_header()
	{
		require HFE_DIR . 'themes/default/hfe-header.php';
		$templates   = [];
		$templates[] = 'header.php';
		// Avoid running wp_head hooks again.
		remove_all_actions('wp_head');
		ob_start();
		locate_template($templates, true);
		ob_get_clean();
	}

	/**
	 * Function for overriding the footer in the elmentor way.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function override_footer()
	{
		require HFE_DIR . 'themes/default/hfe-footer.php';
		$templates   = [];
		$templates[] = 'footer.php';
		// Avoid running wp_footer hooks again.
		remove_all_actions('wp_footer');
		ob_start();
		locate_template($templates, true);
		ob_get_clean();
	}

	/**
	 * Function for overriding the default single post (single.php)
	 *
	 *
	 * @return void
	 */
	function override_template($template)
	{
		// Check if this is a single post request
		if (is_single()) {
			$custom_template = plugin_dir_path(__FILE__) . 'hfe-single-post.php';
		} elseif (is_404()) {
			$custom_template = plugin_dir_path(__FILE__) . 'hfe-404.php';
		}
		// Check if the custom template file exists
		if (file_exists($custom_template)) {
			return $custom_template;
		}
		return $template;
	}
}

new HFE_Default_Compat();
