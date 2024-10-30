<?php
namespace Echo_Doc_Blocks\Includes;

use Echo_Doc_Blocks\Includes\features\templates\Templates_DB;
use Echo_Doc_Blocks\Includes\features\presets\Presets;
use Echo_Doc_Blocks\Includes\features\dynamic\KB;
use WP_Error;

defined( 'ABSPATH' ) || exit();

/**
 * Various utility functions
 */
class Utilities_Plugin {

    static $epbl_blocks_identifiers = array(
        'Section Heading' => 'section-heading',
        'Info Box' => 'info-box',
        'Multiple Lists' => 'multiple-lists',
        'Text Image' => 'text-image',
        'Text Video' => 'text-video'
    );

    /**
     * Validate block name.
     *
     * @param $block_name
     *
     * @return bool
     */
    public static function is_echo_block_name_valid( $block_name ) {
        if ( empty( $block_name) || ! is_string( $block_name) ) {
            return false;
        }
        return in_array( $block_name, self::$epbl_blocks_identifiers);
    }

    /**
     * For given block return its presets.
     *
     * @param $block_name
     * @return array|null
     */
    public static function get_block_presets( $block_name ) {
        $presets_class = Presets::get_block_preset_class( $block_name );
        return empty($presets_class) ? null : $presets_class->get_all_presets();
    }

    /**
     * Get templates for given block type
     * @param $block_name
     * @return array|WP_Error
     */
    public static function get_block_templates( $block_name ) {

        $handle = new Templates_DB();
        $block_templates = $handle->get_templates_for_block( $block_name );
        if ( is_wp_error($block_templates) ) {
            return $block_templates;
        }

        return $block_templates;
    }

    /**
     * Return preset or template.
     *
     * @param $id
     * @param $block_type
     * @param $block_name
     * @return null|array
     */
    public static function get_preset_template( $id, $block_type, $block_name ) {

        $preset_template = null;
        if ( $block_type == 'preset' ) {
            $presets_class = Presets::get_block_preset_class( $block_name );
            $preset_template = empty($presets_class) ? null : $presets_class->get_preset( $id );
            if ( empty($preset_template) ) {
                return null;
            }

        } else if ( $block_type == 'template' ) {
            $handle = new Templates_DB();
            $preset_template = $handle->get_template( $id );
            if ( is_wp_error($preset_template) || empty($preset_template) ) {
                return null;
            }
        }

        return $preset_template;
    }

    /**
     * Get presets and templates attributes
     *
     * @param $id - template or preset ID
     * @param $block_type
     * @param $block_name
     *
     * @return array|null - null on error or empty field
     */
    public static function get_attributes( $id, $block_type, $block_name ) {

        $attributes = null;
        if ( $block_type == 'preset' ) {
            $list = self::get_block_presets( $block_name );
            $attributes =  empty($list) || empty($list[$id]['attributes']) ? null : $list[$id]['attributes'];

        } else if ( $block_type == 'template' ) {
            $handle = new Templates_DB();
            $template = $handle->get_template( $id );
            if ( is_wp_error($template) ) {
                return null;
            }
            if (  empty($template) ) {
                return array();
            }
            $attributes = $template['attributes'];
        }

        return $attributes;
    }

    /**
     * Get non template attributes
     * @param $block_name
     * @return array|null
     */
    public static function get_non_template_attributes( $block_name ) {
        $presets_class = Presets::get_block_preset_class( $block_name );
        return empty($presets_class) ? null : $presets_class->get_non_template_attribute_names();
    }

    /**
     * Remove attributes that template should not set.
     * @param $block_name
     * @param $attributes
     */
    public static function remove_non_template_attributes( $block_name, &$attributes ) {
        $non_template_attributes = Utilities_Plugin::get_non_template_attributes( $block_name );
        if ( empty($non_template_attributes) ) {
            return;
        }

        foreach( $non_template_attributes as $non_template_attribute => $value ) {
            if ( ! isset($attributes[$non_template_attribute]) ) {
                continue;
            }

            unset($attributes[$non_template_attribute]);
        }
    }

	/**
	 * Show error message only for admins if KB is not active
	 */
	public static function get_kb_error_message() {
		if ( current_user_can('administrator') ) {
			return '<div style="text-align: center;">' .
			       __( 'This KB block requires the Echo Knowledge Base plugin. Please install the plugin ', 'blocks-for-documents-articles-and-faqs' ) . KB::get_kb_plugin_install_link() . '.</div>';
		} else {
			return '';
		}
	}

	/**
	 * Show error message only for admins if KB is on post instead of page
	 */
	public static function get_kb_post_error_message() {
		if ( current_user_can('administrator') ) {
			return '<div style="text-align: center;">' .
			       __( 'This Knowledge Base Block is only intended to be used on pages and not posts or articles.', 'blocks-for-documents-articles-and-faqs' ) . '</div>';
		} else {
			return '';
		}
	}
}
