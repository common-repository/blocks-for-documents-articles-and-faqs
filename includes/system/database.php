<?php
namespace Echo_Doc_Blocks\Includes;

use WP_Error;

defined( 'ABSPATH' ) || exit();

/**
 * Base class for database access.
 * Based on EDD_DB class.
*/
abstract class Database {

	/**
	 * The name of KB database table
	 */
	protected $table_name;

	/**
	 * The name of the primary key column
	 */
	protected $primary_key;

	public function __construct() {}

	/**
	 * Get table columns
	 */
	public function get_column_format() {
		return array();
	}

	/**
	 * Default column values
	 */
	public function get_column_defaults() {
		return array();
	}

	/**
	 * Retrieve a row by the primary key
	 *
	 * @param $primary_key_value
	 *
	 * @param string $output - OBJECT, ARRAY_A, or ARRAY_N
	 * @return null|Object|array}WP_Error - row as an Object with properties as column names e.g. $result->ID
	 *                              - null if 0 records found
	 * - WP_Error on failure
	 */
	public function get_by_primary_key( $primary_key_value, $output=OBJECT ) {
        /** @var $wpdb Wpdb */
		global $wpdb;

		if ( empty($this->primary_key) ) {
			Logging::add_log("Primary key is empty", $this->primary_key);
			return new WP_Error('primary-key-empty', 'Primary key is empty');
		}

		if ( ! Utilities::is_positive_int($primary_key_value) ) {
			Logging::add_log("Primary key is not valid", $primary_key_value);
			return new WP_Error('primary-key-invalid', 'Primary key is not valid', $primary_key_value);
        }

		$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $this->table_name WHERE $this->primary_key = %s LIMIT 1;", $primary_key_value ), $output );
		if ( $result === null && ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: " . $wpdb->last_error, 'Primary Key: ' . $primary_key_value );
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

	/**
	 * Retrieve multiple rows by several primary keys.
	 *
	 * @param $primary_key_values - string of primary keys separated by comma
	 * @param string $select
	 * @param string $output - ARRAY_A | ARRAY_N | OBJECT | OBJECT_K
	 *
	 * @return array|null|WP_Error - column value
	 *                             - null if 0 records found
	 * - WP_Error on error
	 */
	public function get_rows_by_primary_keys( $primary_key_values, $select='*', $output=OBJECT ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$primary_key_values = implode( ",", wp_parse_id_list($primary_key_values) );
		$result = $wpdb->get_results( "SELECT " . $select . " FROM $this->table_name WHERE $this->primary_key IN ( " . $primary_key_values . " ) LIMIT 100;", $output );
		if ( ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: ", $wpdb->last_error );
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

	/**
	 * Retrieve a row by a specific value in a column
	 *
	 * @param $column
	 * @param $column_value
	 * @param string $output - ARRAY_A | ARRAY_N | OBJECT | OBJECT_K
	 *
	 * @return Object|array|WP_Error|null - row as an Object with properties as column names e.g. $result->ID
	 *                              - null if 0 records found
	 *                              - WP_Error on failure
	 */
	public function get_a_row_by_column_value( $column, $column_value, $output=OBJECT ) {
        /** @var $wpdb Wpdb */
		global $wpdb;

		$column = esc_sql( $column );
		$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $this->table_name WHERE $column = %s LIMIT 1;", $column_value ), $output );
		if ( $result === null && ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: " . $wpdb->last_error, 'Column - value: ' . $column . ' - ' . $column_value );
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

	/**
	 * Retrieve multiple rows by a specific value in a column
	 *
	 * @param $column
	 * @param $column_value
	 * @param string $output - ARRAY_A | ARRAY_N | OBJECT | OBJECT_K
	 * @return array|null|WP_Error - column value
	 *                             - null if 0 records found
	 * - WP_Error on error
	 */
	public function get_rows_by_column_value( $column, $column_value, $output = OBJECT ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$column = esc_sql( $column );
		$result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $this->table_name WHERE $column = %s LIMIT 500;", $column_value ), $output );
		if ( ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: ", $wpdb->last_error );
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

	/**
	 * Retrieve a row by a WHERE clause
	 *
	 * @param $where_data
	 *
	 * @return Object|WP_Error|null - row as an Object with properties as column names e.g. $result->ID
	 *                              - null if 0 records found
	 *                              - WP_Error on failure
	 */
	public function get_a_row_by_where_clause( array $where_data ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$values = array();
		$where = ' ';
		$first = true;
		foreach( $where_data as $column => $value ) {
			$format = $this->get_column_format();
			$where .= ($first ? '' : ' AND ') . esc_sql($column) . ' = ' . $format[$column];
			$values[] = $value;
			$first = false;
		}

		$result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $this->table_name WHERE {$where} LIMIT 1;", $values ) );
		if ( $result === null && ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: ", $wpdb->last_error );
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

	/**
	 * Retrieve multiple rows using a where clause
	 *
	 * @param $where_data
	 *
	 * @return array|WP_Error|null - column value
	 *                             - null if 0 records found
	 *                             - WP_Error on error
	 */
	public function get_rows_by_where_clause( array $where_data, $output = OBJECT ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$values = array();
		$where = ' ';
		$first = true;
		foreach( $where_data as $column => $value ) {
			$format = $this->get_column_format();
			$where .= ($first ? '' : ' AND ') . esc_sql($column) . ' = ' . $format[$column];
			$values[] = $value;
			$first = false;
		}

		$result = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $this->table_name WHERE {$where} LIMIT 500;", $values ), $output );
		if ( ! empty($wpdb->last_error) ) {
			Logging::add_log("DB failure: ", $wpdb->last_error);
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

	/**
	 * Get all records from the table. Limit 500.
	 *
	 * @return array|WP_Error|null - column value
	 *                             - null if 0 records found
	 *                             - WP_Error on error
	 */
	public function get_all_rows() {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$result = $wpdb->get_results( "SELECT * FROM $this->table_name LIMIT 500;" );
		if ( ! empty($wpdb->last_error) ) {
			Logging::add_log("DB failure: ", $wpdb->last_error);
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

    /**
     * Retrieve a specific column's value by the primary key
     *
     * @param $column
     * @param $primary_key
     *
     * @return string|WP_Error|null - column value
     *                              - null if 0 records found
     *                              - WP_Error on failure
     */
	public function get_column_value_by_primary_key( $column, $primary_key ) {
        /** @var $wpdb Wpdb */
		global $wpdb;

		if ( empty($this->primary_key) ) {
			return new WP_Error('primary-key-empty', 'Primary key is empty');
		}

		if ( ! Utilities::is_positive_int($primary_key) ) {
			Logging::add_log("Primary key is not valid", $primary_key);
			return new WP_Error('primary-key-invalid', 'Primary key is not valid', $primary_key);
		}

		$column = esc_sql( $column );
		$result = $wpdb->get_var( $wpdb->prepare( "SELECT $column FROM $this->table_name WHERE $this->primary_key = %s LIMIT 1;", $primary_key ) );
		if ( $result === null && ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: " . $wpdb->last_error, 'Column: ' . $column. ', Primary Key: ' . $primary_key );
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

    /**
     * Retrieve a specific column's value by the the specified column / value
     *
     * @param $select_column - returned column value
     * @param $column_name
     * @param $column_value
     *
     * @return string|WP_Error|null - column value
     *                              - null if 0 records found
     *                              - WP_Error on failure
     */
	public function get_column_value_by( $select_column, $column_name, $column_value ) {
        /** @var $wpdb Wpdb */
		global $wpdb;

		$select_column = esc_sql( $select_column );
		$column_name   = esc_sql( $column_name );
		$result = $wpdb->get_var( $wpdb->prepare( "SELECT $select_column FROM $this->table_name WHERE $column_name = %s LIMIT 1;", $column_value ) );
		if ( $result === null && ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: " . $wpdb->last_error, 'Select Column: ' . $select_column. ', Column - value: ' . $column_name . ' - ' . $column_value );
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

	/**
	 * Retrieve a specific column's value by the the specified column / value
	 *
	 * @param $select_column - returned column value
	 * @param $column_name
	 * @param $column_value
	 *
	 * @return array|WP_Error|null - column value
	 *                             - null if 0 records found
	 *                             - WP_Error on error
	 */
	public function get_column_values_by( $select_column, $column_name, $column_value ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$select_column = esc_sql( $select_column );
		$column_name   = esc_sql( $column_name );
		$result = $wpdb->get_results( $wpdb->prepare( "SELECT $select_column FROM $this->table_name WHERE $column_name = %s LIMIT 500;", $column_value ) );
		if ( ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: " . $wpdb->last_error, 'Select Column: ' . $select_column. ', Column - value: ' . $column_name . ' - ' . $column_value );
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

	/**
	 * Get record count for given range
	 *
	 * @param $kb_id
	 * @param $date_column_name
	 * @param $date_from
	 * @param $date_to
	 * @param string $where_condition
	 *
	 * @return int|WP_Error
	 */
	public function get_count_rows_range( $kb_id, $date_column_name, $date_from, $date_to, $where_condition='' ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$where_between = $wpdb->prepare(" {$date_column_name} between %s and %s {$where_condition}", $date_from, $date_to );
		$result = $wpdb->get_var( "SELECT count(*) FROM $this->table_name WHERE kb_id = {$kb_id} AND {$where_between};" );
		if ( $result === null && ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: " . $wpdb->last_error, $date_from . ' - ' . $date_to );
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return empty($result) ? 0 : (int) $result;
	}

	/**
	 * Retrieve multiple rows using a where clause
	 *
	 * @param $kb_id
	 * @param $date_column_name
	 * @param $date_from
	 * @param $date_to
	 * @param $order_by
	 * @param $group_by
	 * @param $limit
	 * @param string $where_condition
	 *
	 * @return array|null|WP_Error - column value
	 *                             - null if 0 records found
	 * - WP_Error on error
	 */
	public function get_rows_by_date_range( $kb_id, $date_column_name, $date_from, $date_to, $order_by, $group_by, $limit, $where_condition='' ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$where_between = $wpdb->prepare(" {$date_column_name} between %s and %s {$where_condition} ", $date_from, $date_to );
		$result = $wpdb->get_results( "SELECT *, count(*) as times FROM $this->table_name WHERE kb_id = {$kb_id} AND {$where_between}  GROUP BY {$group_by} ORDER BY {$order_by} LIMIT {$limit};" );
		if ( ! empty($wpdb->last_error) ) {
			Logging::add_log("DB failure: ", $wpdb->last_error);
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return $result;
	}

    /**
     * Insert a new row
     *
     * @param $data - Data to insert (in column => value pairs).
     *                Both $data columns and $data values should be "raw" (neither should be SQL escaped).
     *                Sending a null value will cause the column to be set to NULL - the corresponding format is ignored in this case.
     * @return int|WP_Error - inserted record ID
     */
    // KEEP PROTECTED to let implementation to handle security check
	protected function insert_record( $data ) { /** KEEP PROTECTED */
        /** @var $wpdb Wpdb */
		global $wpdb;

		// Set default values
		$data = wp_parse_args( $data, $this->get_column_defaults() );

		// Initialise column format array
		$column_formats = $this->get_column_format();

		// White list columns
		$data = array_intersect_key( $data, $column_formats );

		// Reorder $column_formats to match the order of columns given in $data
		$data_keys = array_keys( $data );
		$column_formats = array_merge( array_flip( $data_keys ), $column_formats );

		if ( false === $wpdb->insert( $this->table_name, $data, $column_formats ) ) {
			Logging::add_log("Could not insert record into " . $this->table_name . " table. Data to be inserted: ", $data);
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
        }

		return $wpdb->insert_id;
	}

    /**
     * Update a row
     *
     * @param $id - primary key or column value used in WHERE
     * @param array $data - Data to update (in column => value pairs).
     *                      Both $data columns and $data values should be "raw" (neither should be SQL escaped).
     *                      Sending a null value will cause the column to be set to NULL - the corresponding
     *                      format is ignored in this case.
     * @param string $column_name - used in the WHERE clause. default is the primary key
     *
     * @return bool|WP_Error - return WP_Error on error
     */
	// KEEP PROTECTED
	protected function update_record( $id, $data = array(), $column_name = '' ) {  /** KEEP PROTECTED */
        /** @var $wpdb Wpdb */
		global $wpdb;

		// Row ID must be a positive integer
		if ( ! Utilities::is_positive_int( $id ) ) {
			Logging::add_log("Row ID is not valid", $id);
			return new WP_Error('row-id-invalid', 'Row ID is not valid', $id);
		}

		if ( empty( $column_name ) ) {
			$column_name = $this->primary_key;
		}

		// Initialise column format array
		$column_formats = $this->get_column_format();

		// White list columns
		$data = array_intersect_key( $data, $column_formats );

		// Reorder $column_formats to match the order of columns given in $data
		$data_keys = array_keys( $data );
		$column_formats = array_merge( array_flip( $data_keys ), $column_formats );

		if ( false === $wpdb->update( $this->table_name, $data, array( $column_name => $id ), $column_formats ) ) {
			Logging::add_log("Could not update record in " . $this->table_name . " table. Row id: " . $id . ". Data to be inserted: ", $data);
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return true;
	}

	/**
	 * If record exist then UPDATE it otherwise INSERT it.
	 *
	 * @param $primary_key_value
	 * @param $data
	 *
	 * @return bool|WP_Error
	 */
	// KEEP PROTECTED
	protected function upsert_record( $primary_key_value, $data ) {

		if ( empty($this->primary_key) ) {
			return new WP_Error('primary-key-empty', 'Primary key is empty');
		}

		$record = $this->get_by_primary_key( $primary_key_value );
		if ( is_wp_error( $record) ) {
			Logging::add_log("Cannot get by primary key: ", $primary_key_value);
			return $record;
		}

		// if no record found (or error occurred), INSERT the record
		if ( empty($record) ) {
			$result = $this->insert_record( array($this->primary_key => $primary_key_value) + $data );
			return is_wp_error($result) ? $result : $result > 0;
		} else {
			return $this->update_record( $primary_key_value, $data );
		}
	}

    /**
     * Delete a row identified by the primary key
     *
     * @param int $primary_key
     *
     * @return bool|WP_Error
     */
	// KEEP PROTECTED
	protected function delete_record( $primary_key = 0 ) {
        /** @var $wpdb Wpdb */
		global $wpdb;

		if ( empty($this->primary_key) ) {
			return new WP_Error('primary-key-empty', 'Primary key is empty');
		}

		// Row ID must be positive integer
        if ( ! Utilities::is_positive_int( $primary_key ) ) {
	        Logging::add_log("Row ID is not valid", $primary_key);
	        return new WP_Error('primary-key-invalid', 'Primary key is not valid', $primary_key);
        }

		if ( false === $wpdb->query( $wpdb->prepare( "DELETE FROM $this->table_name WHERE $this->primary_key = %d", $primary_key ) ) ) {
			Logging::add_log("Could not delete record in " . $this->table_name . " table. Row id: " . $primary_key);
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return true;
	}

	/**
	 * Delete a row identified by the primary key and a column value
	 *
	 * @param int $primary_key
	 * @param $column_name
	 * @param $column_value
	 *
	 * @return bool|WP_Error
	 */
	// KEEP PROTECTED
	protected function delete_record_by_primary_key_and_column( $primary_key, $column_name, $column_value ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		if ( empty($this->primary_key) ) {
			return new WP_Error('primary-key-empty', 'Primary key is empty');
		}

		// Row ID must be positive integer
		if ( ! Utilities::is_positive_int( $primary_key ) ) {
			Logging::add_log("Row ID is not valid", $primary_key);
			return new WP_Error('primary-key-invalid', 'Primary key is not valid', $primary_key);
		}

		$column_name = esc_sql( $column_name );
		if ( false === $wpdb->query( $wpdb->prepare( "DELETE FROM $this->table_name WHERE $this->primary_key = %d AND $column_name = %d", $primary_key, $column_value ) ) ) {
			Logging::add_log("Could not delete record in " . $this->table_name . " table. Row id: " . $primary_key);
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return true;
	}

	/**
	 * Delete a row identified by the primary key
	 *
	 * @param $column_name
	 * @param $column_value
	 * @return bool|WP_Error - return WP_Error on error
	 */
	// KEEP PROTECTED
	protected function delete_record_by_column_value( $column_name, $column_value ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$column_name = esc_sql( $column_name );
		if ( false === $wpdb->query( $wpdb->prepare( "DELETE FROM $this->table_name WHERE $column_name = %d", $column_value ) ) ) {
			Logging::add_log("Could not delete records in " . $this->table_name . " table. Column $column_name and value $column_value");
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return true;
	}

	/**
	 * Delete multiple rows using a where clause
	 *
	 * @param $where_data
	 * @return bool|WP_Error - return WP_Error on error
	 */
	// KEEP PROTECTED
	protected function delete_rows_by_where_clause( array $where_data ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		$values = array();
		$where = ' ';
		$first = true;
		foreach( $where_data as $column => $value ) {
			$format = $this->get_column_format();
			$where .= ($first ? '' : ' AND ') . esc_sql($column) . ' = ' . $format[$column];
			$values[] = $value;
			$first = false;
		}

		if ( false === $wpdb->query( $wpdb->prepare( "DELETE FROM $this->table_name WHERE {$where} LIMIT 500;", $values ) ) ) {
			Logging::add_log("Could not delete records in " . $this->table_name . " table. Where is {$where}");
			return new WP_Error('db-failure', 'DB failure', $wpdb->last_error);
		}

		return true;
	}

	/**
	 * Check if the given table exists
     *
	 * @param  string $table The table name
	 * @return bool          If the table name exists
	 */
	public function table_exists( $table ) {
        /** @var $wpdb Wpdb */
		global $wpdb;

		$table = sanitize_text_field( $table );
		return $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE '%s'", $table ) ) === $table;
	}

	/**
	 * Check if the table was ever installed
	 *
	 * @return bool Returns if the customers table was installed and upgrade routine run
	 */
	public function installed() {
		return $this->table_exists( $this->table_name );
	}

	public function getTableName() {
		return $this->table_name;
	}
}
