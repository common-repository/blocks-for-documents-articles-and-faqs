<?php
namespace Echo_Doc_Blocks\Includes\features\templates;

use Echo_Doc_Blocks\Includes\Database;
use Echo_Doc_Blocks\Includes\System\Logging;
use Echo_Doc_Blocks\Includes\Utilities;

defined( 'ABSPATH' ) || exit();

/**
 * CRUD for block templates data
 *
 * @property string primary_key
 * @property string table_name
 */
class Templates_DB extends Database  {

    /**
     * Get things started
     *
     * @access  public
     */
    public function __construct() {
        /** @var $wpdb Wpdb */
        global $wpdb;

        $this->table_name  = $wpdb->prefix . 'epbl_block_templates';
        $this->primary_key = 'template_id';
    }

    /**
     * Get columns and formats
     *
     * @access  public
     */
    public function get_column_format() {
        return array(
            'template_id'           => '%d',
            'template_name'         => '%s',
            'template_description'  => '%s',
            'template_group'        => '%s',
	        'state'                 => '%s',
            'version'               => '%d',
            'block_name'            => '%s',
            'user_id'               => '%d',
            'date_created'          => '%s',
            'date_updated'          => '%s',
			'attributes'            => '%s'
        );
    }

    /**
     * Get default column values
     *
     * @access  public
     */
    public function get_column_defaults() {
        return array(
            'template_name'         => 'Template Name...',
	        'template_description'  => '',
            'template_group'        => '',
            'state'                 => '',
            'version'               => 1,
	        'user_id'               => '',
	        'date_created'          => date( 'Y-m-d H:i:s' ),
	        'date_updated'          => date( 'Y-m-d H:i:s' ),
        );
    }

    /**
     * Get templates for given block type
     * @param $block_name
     * @return array|WP_Error
     */
    public function get_templates_for_block( $block_name ) {

        $block_templates = parent::get_rows_by_column_value( 'block_name', $block_name, 'ARRAY_A' );
        if ( is_wp_error($block_templates) ) {
            Logging::add_log("Failed to get templates.", 'Block name: ' . $block_name);
            return $block_templates;
        }

        // no templates found
        if ( $block_templates === null ) {
            return array();
        }

        $block_templates_final = array();
        foreach( $block_templates as $block_template ) {

            $current_attributes = maybe_unserialize( $block_template['attributes'] );
            if ( $current_attributes === false ) {
                Logging::add_log("Could not unserialize attributes");
	            return new WP_Error('serilization-error', 'Could not unserialize attributes for ' . $block_name);
            }
	        $block_template['attributes'] = $current_attributes;

	        $template_id = empty($block_template['template_id']) ? 1 : $block_template['template_id'];
            $block_templates_final[$template_id] = $block_template;
        }

        return $block_templates_final;
    }

	/**
	 * Get template.
	 * @param $template_id
	 * @return null|array
	 */
	public function get_template( $template_id ) {
		$template = $this->get_by_primary_key( $template_id, 'ARRAY_A' );
		if ( is_wp_error($template) || empty($template) ) {
			return null;
		}

		$template['attributes'] = maybe_unserialize($template['attributes']);

		return $template;
	}

	/**
	 * Get several templates.
	 * @param $all_template_ids
	 * @return null|array
	 */
	public function get_templates( $all_template_ids ) {

		$select = ' template_id, template_name, block_name, attributes ';
		$templates = $this->get_rows_by_primary_keys( $all_template_ids, $select, 'ARRAY_A' );
		if ( is_wp_error($templates) ) {
			return null;
		}

		$templates = empty($templates) ? array() : $templates;
		foreach( $templates as $key => $template ) {
			$templates[$key]['attributes'] = maybe_unserialize($template['attributes']);
		}

		return $templates;
	}

	/**
	 * Update template record.
	 *
	 * @param $template_id
	 * @param $block_name
	 * @param $attributes
	 * @return bool|WP_Error
	 */
    public function update_template_attributes( $template_id, $block_name, $attributes ) {

	    $result = $this->validate_template_params( $template_id, $block_name );
		if ( is_wp_error($result) ) {
			return $result;
		}

	    $result = $this->validate_template_attributes( $block_name, $attributes );
		if ( is_wp_error($result) ) {
			return $result;
		}

	    $serialized_attributes = maybe_serialize($attributes);
	    if ( empty($serialized_attributes) ) {
		    return new WP_Error('serilization-error', 'Could not unserialize attributes for template ' . $template_id);
	    }

	    $result = parent::update_record( $template_id, array( 'attributes' => $serialized_attributes) );
		return $result;
    }

	/**
	 * Update template name and description.
	 *
	 * @param $template_id
	 * @param $block_name
	 * @param $new_template_name
	 * @param $new_template_description
	 * @return bool|WP_Error
	 */
	public function update_template_name_description( $template_id, $block_name, $new_template_name, $new_template_description ) {

		$result = $this->validate_template_params( $template_id, $block_name );
		if ( is_wp_error($result) ) {
			return $result;
		}

		$result = $this->validate_template_name_description( $new_template_name, $new_template_description );
		if ( is_wp_error($result) ) {
			return $result;
		}

		$result = parent::update_record( $template_id, array('template_name' => $new_template_name, 'template_description' => $new_template_description) );
		return $result;
	}

	/**
	 * Insert a new template record
	 *
	 * @param $block_name
	 * @param $template_name
	 * @param $template_description
	 * @param $template_group
	 * @param $attributes
	 * @return int|WP_Error - return new template ID or error
	 */
    public function insert_template_record( $block_name, $template_name, $template_description, $template_group, $attributes ) {

	    $attributes['blockType'] = 'template';

	    $result = $this->validate_template_attributes( $block_name, $attributes );
		if ( is_wp_error($result) ) {
			return $result;
		}

	    $result = $this->validate_template_name_description( $template_name, $template_description );
		if ( is_wp_error($result) ) {
			return $result;
		}

        $serialized_attributes = maybe_serialize($attributes);
        if ( empty($serialized_attributes) ) {
	        return new WP_Error( 'serilization-error', 'Could not unserialize attributes for template ' . $template_name );
        }

        $current_user = Utilities::get_current_user();
        $user_id = empty($current_user->ID) ? '' : $current_user->ID;

        // insert the record
	    $record = array('template_name' => $template_name, 'template_description' => $template_description, 'template_group' => $template_group,
			            'block_name' => $block_name, 'user_id' => $user_id, 'attributes' => $serialized_attributes);
        $template_id = parent::insert_record( $record );
        if ( is_wp_error($template_id) || empty($template_id) ) {
	        return new WP_Error('template-insert', 'Could not insert template for ID ' . $template_id);
        }

        // update attributes with the new template ID
	    $attributes['templateId'] = $template_id;
	    $result = $this->update_template_attributes( $template_id, $block_name, $attributes );
	    if ( is_wp_error($result) || empty($result) ) {
		    return new WP_Error('template-insert', 'Could not update template for ID ' . $template_id);
	    }

        return $template_id;
    }

	/**
	 * Delete given template.
	 *
	 * @param $template_id
	 * @param $block_name
	 *
	 * @return bool|WP_Error
	 */
    public function delete_template( $template_id, $block_name ) {

	    $result = $this->validate_template_params( $template_id, $block_name );
		if ( is_wp_error($result) ) {
			return $result;
		}

    	$result = $this->delete_record_by_primary_key_and_column( $template_id, 'block_name', $block_name );
	    if ( is_wp_error($result) || empty($result) ) {
		    return new WP_Error('template-delete', 'Could not delete template (2) for ID ' . $template_id);
	    }

	    return $result;
    }

	private function validate_template_params( $template_id, $block_name ) {

		// first double check template ID
		$template = $this->get_by_primary_key( $template_id, ARRAY_A );
		if ( is_wp_error($template) || empty($template) ) {
			return new WP_Error('template-validate-param', 'Could not find template with ID ' . $template_id);
		}

		if ( $template['template_id'] != $template_id ) {
			return new WP_Error('template-validate-param', 'Mismatching template IDs ' . $template['template_id']  . ' vs ' . $template_id);
		}

		if ( $template['block_name'] != $block_name ) {
			return new WP_Error('template-validate-param', 'Mismatching template IDs ' . $template['block_name']  . ' vs ' . $block_name);
		}

		return true;
	}

	private function validate_template_attributes( $block_name, $attributes ) {

		$defaults = Presets::get_the_block_defaults( $block_name );
		if ( empty($defaults) ) {
 			return new WP_Error('template-validate-attributes', 'Could not find default attributes for block name ' . $block_name);
		}

		if ( array_diff_key($attributes, $defaults) || array_diff_key($attributes, $defaults) ) {
			return new WP_Error('template-validate-attributes', 'Error occured (33) for block name ' . $block_name);
		}

		return true;
	}

	private function validate_template_name_description( $template_name, $template_description ) {

		if ( empty( $template_name ) || strlen( $template_name ) > 100 ) {
			return new WP_Error('template-validate-name', 'Template name cannot be empty or longer than 100 characters ' . $template_name);
		}

		if ( strlen( $template_description ) > 250 ) {
			return new WP_Error('template-validate-name', 'Template description cannot be longer than 250 characters ' . $template_description);
		}

		return true;
	}

    /**
     * Create the table
     *
     * @access  public
     */
    public function create_table() {
	    global $wpdb;

	    $collate = $wpdb->has_cap( 'collation' ) ? $wpdb->get_charset_collate() : '';

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $sql = "CREATE TABLE " . $this->table_name . " (
	                template_id             INT(20) NOT NULL AUTO_INCREMENT,
	                template_name           VARCHAR(100) NOT NULL,
	                template_description    VARCHAR(500) NOT NULL,
	                template_group          VARCHAR(100) NOT NULL,
	                state                   VARCHAR(50) NOT NULL,
	                version                 INT(20) NOT NULL,
	                block_name              VARCHAR(50) NOT NULL,
   	                user_id                 INT(20) NOT NULL,
	                date_created            datetime NOT NULL,
	                date_updated            datetime NOT NULL,
   	                attributes              TEXT NOT NULL,
	                PRIMARY KEY  (template_id),
	                KEY ix_epbl_template_id (template_id),
	                KEY ix_epbl_block_name (block_name),
	                KEY ix_epbl_user_id (user_id)
		) " . $collate . ";";

        dbDelta( $sql );
    }
}