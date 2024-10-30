<?php
namespace Echo_Doc_Blocks\Includes\features\templates;

use Echo_Doc_Blocks\Includes\features\frontend\Page_Assets;

defined( 'ABSPATH' ) || exit();

/**
 * Displays the Template Manager
 *
 * @copyright   Copyright (C) 2019, Echo Plugins
 */
class Template_Manager_View {

	private $presets = array();
	private $templates = array();

	public function __construct() {
		add_action( 'admin_head', array( $this, 'print_stylesheet' ), 80 );
	}

	/**
	 * Display Template Manager page.
	 *
	 * @return bool
	 */
	public function display_template_manager() {

		// load default
		$selected_block_name = 'section-heading';
		$this->load_selected_block_type( $selected_block_name );    ?>

		<div class="epbl-template-manager-container" data-block-name="<?php echo $selected_block_name; ?>" data->

			<!-- Top Banner -->
			<div class="epbl-tm-top-banner">
				<div class="epbl-tm-top-banner__inner">
					<h1>Template Manager</h1>
					<p>This is where you will edit all your templates, for more information on template and how they work see our online documentation <a href="#">( here )</a></p>
					<div class="epbl-tm-top-banner__inner_logo">
						<img src="<?php echo ECHO_BLOCKS_ASSETS_URL . 'images/epbl-rocket-fire-smoke-svg-logo.svg'; ?>" >
					</div>
				</div>
				<img class="epbl-tm-top-banner__image" src="<?php echo ECHO_BLOCKS_ASSETS_URL . 'images/epbl-background.svg'; ?>" >
			</div>

			<!-- Block Types Selection -->
			<div class="epbl-tm-block-type-selection">
				<ul>					<?php
					$count = 0;
					foreach( Utilities_Blocks::$epbl_blocks_identifiers as $block_name => $block_id ) {
						Template_Manager_Help::display_block_type_buttons( $block_name, $block_id, $count );
						$count++;
					}					?>
				</ul>
			</div>

			<!-- Tab Navigation -->
			<div class="epbl-tm-tab-nav-container">
				<ul>
					<li id="preset" class="epbl-active-tab"><span class="epbl-tab-icon epbl epbl-cube"></span>Presets</li>
					<li id="template"><span class="epbl-tab-icon epbl epbl-linode"></span>My Templates</li>
				</ul>
			</div>

			<!-- Tab Panels -->
			<div class="epbl-tm-panel-container">
				<div id="epbl-tm-preset-panel" class="epbl-tm-panel epbl-active-panel">
					<?php $this->display_preset_panel(); ?>
				</div>
				<div id="epbl-tm-template-panel" class="epbl-tm-panel">
					<?php $this->display_template_panel( $selected_block_name ); ?>
				</div>
			</div>

			<div id="epbl-ajax-in-progress" class="" style="display:none;"></div>
			<input type="hidden" id="_wpnonce_epbl_template_manager_action" name="_wpnonce_epbl_template_manager_action" value="<?php echo wp_create_nonce( "_wpnonce_epbl_template_manager_action" ); ?>"/>

			<!-- Dialog Used for Renaming Template -->			<?php
			Template_Manager_Help::dialog_box_form( array(
				'id'    => 'epbl_tm_template_name_change_dialog',
				'type'  => 'success',
				'title' => 'Rename Template',
				//'body'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever  since the 1500s. ',
				'form_inputs' => array(
						0 => '<label class="epbl-tm-text-label">Template Name</label>         <input type="text" id="epbl_tm_template_name" name="epbl_tm_template_name" value=""/>',
						1 => '<label class="epbl-tm-text-label">Template Description</label>  <input type="text" id="epbl_tm_template_description" name="epbl_tm_template_description" value=""/>',
						//3 => '<input type="radio" id="huey" name="drone" value="huey" checked>      <label class="epbl-tm-radio-label" for="huey">Huey</label>',
						//4 => '<input type="radio" id="dewey" name="drone" value="dewey">            <label  class="epbl-tm-radio-label" for="dewey">Dewey</label>',
				),
				'accept_label' => 'Rename'
			));

			Template_Manager_Help::dialog_box_confirmation( 'epbl_tm_delete_template_confirmation', 'epbl_tm_accept_delete_template', 'Delete Template?', '
											Any existing blocks that use this template will revert to last know block settings.', 'Delete' );     ?>

		</div>      <?php

		return true;
	}

	/**
	 * Get presets and templates for given block. Also get CSS if necessary.
	 * @param $block_name
	 * @return array - empty on error
	 */
	public function load_selected_block_type( $block_name ) {

		$found_presets = Utilities_Blocks::get_block_presets( $block_name );
		if ( empty($found_presets) ) {
			return array();
		}
		$this->presets = $found_presets;

		$found_templates = Utilities_Blocks::get_block_templates( $block_name );
		if ( is_wp_error($found_templates) ) {
			return array();
		}
		$this->templates = $found_templates;

		return array_merge( $this->presets, $this->templates );
	}

	/**
	 * Display PRESETS panel
	 */
	public function display_preset_panel() {

		$group_names = Template_Manager_Help::get_presets_template_group_names( $this->presets );
		$selected_group = empty($group_names[0]) ? 'Basic' : $group_names[0];

		// output group selectors
		$this->get_group_selectors( $group_names );

		// show group presets
		foreach( $this->presets as $preset ) {

			$this_group_name = empty($preset['group']) ? 'Basic' : strtok($preset['group'], ":::"); 			?>

			<section class="epbl-tm-section-preset epbl-tm-preset-template" style="<?php echo ($this_group_name == $selected_group ? '' : 'display:none;'); ?>"
			         data-group-name="<?php echo $this_group_name; ?>" data-template-id="<?php echo $preset['template_id']; ?>" data-template-type="preset">

				<div class="epbl-tm-section-preset__inner">
					<div class="epbl-tm-section-preset__header">
						<div class="epbl-tm-section-preset__header__info">
							<div class="epbl-tm-section-preset__header__info__name">
								<?php echo $preset['template_name'];?>
								<div class="epbl-tm-section-preset__header__info__config epbl epbl-cog"></div>
							</div>

							<div class="epbl-tm-section-preset__header__info__disc">
								<span class="epbl epbl-tm-section-preset__infoIcon epbl-info-circle" aria-hidden="true"></span><?php echo $preset['template_description'];?>
							</div>
						</div>

						<div class="epbl-tm-section-preset__header__controls">
							<div class="epbl-tm-section-preset__header__controls__copy"><a href="">Copy to Templates</a></div>
						</div>
					</div>

					<div class="epbl-tm-section-preset__preview">
						<div class="epbl-tm-section-preset__preview__inner">
							<?php echo $this->output_block_html( $preset ); ?>
						</div>
					</div>

				</div>

			</section>				<?php
		}
	}

	/**
	 * DISPLAY TEMPLATES panel
	 *
	 * @param $selected_block_name
	 */
	public function display_template_panel( $selected_block_name ) {

		$group_names = Template_Manager_Help::get_presets_template_group_names( $this->templates );
		$selected_group = empty($group_names[0]) ? 'Basic' : $group_names[0];

		// output group selectors
		// TODO FUTURE $this->get_group_selectors( $group_names );

		// hide template to copy when preset is copied
		$hidden_section = array('block_name' => $selected_block_name, 'template_id' => 0, 'template_name' => 'unknown', 'template_description' => 'unknown', 'uuid' => '');
		$this->output_template_section( $selected_block_name, $hidden_section, $selected_group, false );

		// output all existing templates
		foreach( $this->templates as $template ) {
			$this->output_template_section( $selected_block_name, $template, $selected_group );
		}

		if ( empty($this->templates) ) { ?>

			<div class="epbl-tm-no-heading-message">
				<h1>No Templates created</h1>
				<p>Oops you don't have any templates made. What are templates? Great question.</p>
				<p>Templates allow you to create one set of Block settings that you can use across your whole website and they stay the same, if you change the template settings they all change across the website. Pretty cool right? </p>
				<p>To learn more about our templates and how to use them, checkout our resources below on getting started. We highly recommned you read over those tutorials.</p>
				<p>Why use templates?</p>
				<ol>
					<li>It's great for content that you want to have consistant.</li>
					<li>Way easier to maintain then having to change every page / post / article manually.</li>
				</ol>
			</div>			<?php

			Template_Manager_Help::info_panels( array(
					0 => array(
						'title'         => 'Blocks Documentation',
						'icon'          => 'epbl-book',
						'body_content'  => 'Comprehensive documentation for configuring and using Echo Knowledge Base plugin.',
						'btn_text_1'    => 'Read Documentation',
						'btn_url_1'     => 'https://www.echoplugins.com/documentation/',
					),
					1 => array(
						'title'         => 'Need Some Help?',
						'icon'          => 'epbl-life-ring',
						'body_content'  => 'If you encounter an issue or have a question, please submit your request below.',
						'btn_text_1'    => 'Contact Us',
						'btn_url_1'     => 'https://www.echoplugins.com/documentation/',
					),
					2 => array(
						'title'         => 'Getting Started',
						'icon'          => 'epbl-map-signs',
						'body_content'  => 'Learn the basic structure of KB and how to get started.',
						'btn_text_1'    => 'Getting Started',
						'btn_url_1'     => 'https://www.echoplugins.com/documentation/',
					),
				)
			);

		};
	}

	/**
	 * Output Template preview bock.
	 *
	 * @param $block_name
	 * @param $template
	 * @param $selected_group
	 * @param bool|true $is_visible
	 */
	private function output_template_section( $block_name,  $template, $selected_group, $is_visible=true ) {

		$this_group_name = empty($template['group']) ? 'Basic' : strtok($template['group'], ":::");
		$reload_url_base =Template_Manager_Help::get_template_edit_url();
		$url_params = '&block_name=' . $block_name . '&template_id=' . $template['template_id'];    ?>

		<section class="epbl-tm-section-template epbl-tm-preset-template epbl-tm-template-counter" style="<?php echo ($this_group_name == $selected_group && $is_visible ? '' : 'display:none;'); ?>" data-template-id="<?php echo $template['template_id'];?>"
		         data-group-name="<?php echo $this_group_name; ?>" data-template-type="template">

			<div class="epbl-tm-section-template__inner">
				<div class="epbl-tm-section-template__header">
					<div class="epbl-tm-section-template__header__info">
						<div class="epbl-tm-section-template__header__info__name">
							<?php echo $template['template_name']; ?>
							<div class="epbl-tm-section-template__header__info__config epbl epbl-cog"></div>
						</div>
						<div class="epbl-tm-section-template__header__info__disc">
							<span class="epbl epbl-tm-section-template__infoIcon epbl-info-circle" aria-hidden="true"></span><?php echo $template['template_description']; ?>
						</div>
						<div class="epbl-tm-section-template__header__info__date">Last Modified: <?php echo 'Sept 29. 2019';?></div>
					</div>
					<div class="epbl-tm-section-template__header__controls">
						<div class="epbl-tm-section-template__header__controls__delete"><a href="#">Delete</a></div>
						<div class="epbl-tm-section-template__header__controls__rename"><a href="#">Rename</a></div>
						<div class="epbl-tm-section-template__header__controls__copy"><a href="#">Copy</a></div>
						<div class="epbl-tm-section-template__header__controls__edit">
							<?php echo '<a class="epbl-template-edit-url" href="' . $reload_url_base . $url_params . '" target="_blank"> Edit</a>'; ?>
						</div>
					</div>
				</div>

				<div class="epbl-tm-section-template__preview">
					<div class="epbl-tm-section-template__preview__inner">
						<?php echo $this->output_block_html( $template ); ?>
					</div>
				</div>

			</div>

		</section>				<?php
	}

	/**
	 * Output block-specific HTML
	 *
	 * @param $block
	 * @return string
	 */
	private function output_block_html( $block ) {

		$post_content = '';
		$uuid = ( empty($block['attributes']['blockType']) || $block['attributes']['blockType'] == 'preset' ? 'p' : 't' ) . $block['template_id'];

		switch ( $block['block_name'] ) {
			case 'section-heading':
				$post_content = Template_Manager_Help::output_section_heading_html( $uuid );
				break;
			case 'info-box':
				$post_content = Template_Manager_Help::output_info_box_html( $uuid , $block );
				break;
			case 'multiple-list':
				$post_content = Template_Manager_Help::output_multiple_list_box_html( $uuid , $block );
				break;
			case 'text-image':
				$post_content = Template_Manager_Help::output_text_image_box_html( $uuid , $block );
				break;
			case 'text-video':
				$post_content = Template_Manager_Help::output_text_video_box_html( $uuid , $block );
				break;
		}

		return $post_content;
	}

	/**
	 * Handle user selection of Preset Groups
	 * @param $group_names
	 */
	private function get_group_selectors( $group_names ) {

		$group_names = array(
				0 => array( 'id' => 'basic',    'name' => 'Basic'   ),
				1 => array( 'id' => 'standard', 'name' => 'Standard'),
				2 => array( 'id' => 'complex',  'name' => 'Complex' ),
		);		?>

		<div class="epbl-tm-preset-group-link-nav-container">
			<h4>Preset Groups:</h4>
			<p>Each Preset group will look different.</p>
			<ul> <?php

				$count = 1;
				foreach( $group_names as $group ) {
					$active_class = '';
					if ( $count == 1 ) {
						$active_class = 'epbl-active-group-nav';
					}       ?>
					<li class="<?php echo $active_class; ?>">
						<span id="<?php echo $group['id'] ?>" class="epbl-preset-group-link"><?php echo $group['name'] ?></span>
					</li>				<?php
					$count++;
				}   ?>
			</ul>
		</div>		<?php
	}

	/**
	 * Print the stylesheet in header.
	 */
	public function print_stylesheet() {

		// after user changes block type, run this:
		foreach( Utilities_Blocks::$epbl_blocks_identifiers as $block_name => $block_id ) {
			$this->load_selected_block_type( $block_id );

			if ( empty($this->presets) ) {
				continue;
			}

			// add stylesheets for needed presets and templates to the page
			$list = array_merge( $this->templates, $this->presets );
			foreach( $list as $item ) {

				$uuid = ( $item['attributes']['blockType'] == 'preset' ? 'p' : 't' ) . $item['template_id'];
				$handler = new Page_Assets();
				$resources = $handler->get_epbl_block_resources( 'echo-document-blocks/' . $block_id, $item['attributes'], $uuid );
				$css = $resources['css'];
				if ( empty($css) ) {
					Template_Manager_Help::dialog_box_status( array('type' => 'error', 'title' => 'Error occurred', 'body' => 'Could not find CSS') );
					return;
				}

				ob_start(); ?>
				<style type="text/css" media="all" id="epbl-style-frontend"><?php echo $css['desktop']; ?></style>  <?php
				ob_end_flush();
			}
		}
	}
}
