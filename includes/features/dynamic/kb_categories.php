<?php
namespace Echo_Doc_Blocks\Includes\Features\Dynamic;

use  Echo_Doc_Blocks\Includes\Utilities;
use  Echo_Doc_Blocks\Includes\kb\KB_Handler;
use  Echo_Doc_Blocks\Includes\kb\KB_Utilities;
use Echo_Doc_Blocks\Includes\System\Logging;
use Echo_Doc_Blocks\Includes\Utilities_Plugin;

defined( 'ABSPATH' ) || exit();

/**
 * Dynamic block for KB Categories
 */
class KB_Categories {
	
	public static function get_default_fields() {
			return array(
			
				'block_id' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'blockType' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'templateId' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'kb_id' => array(
					'default' => 1,
					'type' => 'number'
				),
				
				'title_toggle' => array(
					'type' => 'boolean',
					'default' => true
				),
				
				'title_text' => array(
					'default' => __( 'Categories', 'blocks-for-documents-articles-and-faqs' ),
					'type' => 'string'
				),

				'title_level' => array(
					'default' => 3,
					'type' => 'number'
				),
				
				'title_HTMLTag' => array(
					'type' => 'string',
					'default' => 'h3'
				),
				
				'title_color' => array(
					'type' => 'string',
					'default' => ''
				),
				
				'title_padding' => array(
					'default' => array(
						'top' => 0,
						'right' => 0,
						'bottom' => 15,
						'left' => 0,
					),
					'type' => 'object'
				),
				
				'title_background' => array(
					'type' => 'string',
					'default' => ''
				),
				
				'title_typography' => array(
					'default' => array(
						'decoration' => "",
						'family' => "",
						'letterSpacingDesktop' => 0,
						'letterSpacingMobile' => 0,
						'letterSpacingTablet' => 0,
						'lineHeightDesktop' => 1,
						'lineHeightMobile'  => 1,
						'lineHeightTablet'  => 1,
						'lineHeightUnit' => "em",
						'sizeDesktop' => 28,
						'sizeMobile' => 28,
						'sizeTablet' => 28,
						'sizeUnit' => "px",
						'style' => "",
						'transform' => "",
						'weight' => "",
					),
					'type' => 'object'
				),
				
				'categories_filter' => array(
					'default' => 'all',
					'type' => 'string'
				),
				
				'categories_ids_text' => array(
					'default' => '',
					'type' => 'string'
				),

				'list_paddingTopBottom' => array(
					'default' => 10,
					'type' => 'number'
				),
				
				'list_alignment' => array(
					'default' => 'left',
					'type' => 'string'
				),
				
				'icon_position' => array(
					'type' => 'string',
					'default' => 'icon-first'
				),
		
				'list_borderBottomToggle' => array(
					'default' => false,
					'type' => 'boolean'
				),
				
				'list_borderStyle' => array(
					'default' => 'solid',
					'type' => 'string'
				),
				
				'list_borderWidth' => array(
					'default' => 1,
					'type' => 'number'
				),
				
				'list_borderColor' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'icon_color' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'icon_colorHover' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'icon_size' => array(
					'default' => 14,
					'type' => 'number'
				),
				
				'icon_padding' => array(
					'default' => array(
						'top' => 0,
						'right' => 0,
						'bottom' => 0,
						'left' => 0,
					),
					'type' => 'object'
				),
				
				'icon_margin' => array(
					'default' => array(
						'top' => 0,
						'right' => 0,
						'bottom' => 0,
						'left' => 0,
					),
					'type' => 'object'
				),
				
				'text_color' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'text_colorHover' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'text_indent' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'text_typography' => array(
					'default' => array(
						'decoration' => "",
						'family' => "",
						'letterSpacingDesktop' => 0,
						'letterSpacingMobile' => 0,
						'letterSpacingTablet' => 0,
						'lineHeightDesktop' => 1,
						'lineHeightMobile' => 1,
						'lineHeightTablet' => 1,
						'lineHeightUnit' => "em",
						'sizeDesktop' => 16,
						'sizeMobile' => 16,
						'sizeTablet' => 16,
						'sizeUnit' => "px",
						'style' => "",
						'transform' => "",
						'weight' => "",
					),
					'type' => 'object'
				),
				
				'advancedMarginTop' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedMarginRight' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedMarginBottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedMarginLeft' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedPaddingTop' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedPaddingRight' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedPaddingBottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedPaddingLeft' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedZIndex' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedClass' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedBorderType' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedBorderWidthTop' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderWidthRight' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderWidthBottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderWidthLeft' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderColor' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedBorderRadius' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBoxShadow' => array(
					'default' => array(
						'blur' => 0,
						'color' => '',
						'position' => '',
						'spread' => 0,
						'x' => 0,
						'y' => 0,
					),
					'type' => 'object'
				),

				'hideOnDesktop' => array(
					'default' => false,
					'type' => 'boolean'
				),
				
				'hideOnMobile' => array(
					'default' => false,
					'type' => 'boolean'
				),
				
				'hideOnTablet' => array(
					'default' => false,
					'type' => 'boolean'
				),

			);
	}
	
	public function __construct()  {
		add_action( 'init', array( $this, 'register_kb_categories' ) );
	}
	
	public function register_kb_categories() {
		register_block_type( 'echo-document-blocks/kb-categories', array(
			'attributes' => self::get_default_fields(),
			'render_callback' => array( $this, 'render_kb_categories' )
		) );
	}
	
	public function render_kb_categories( $block_attributes, $content ) {
		
		if ( ! Utilities::is_kb_plugin_active() ) {
			return Utilities_Plugin::get_kb_error_message();
		}
		
		ob_start(); 
	
		$categories_filter = empty($block_attributes['categories_filter']) ? 'all' : $block_attributes['categories_filter'];
		$kb_id =  empty($block_attributes['kb_id']) ? KB_Handler::DEFAULT_KB_ID : $block_attributes['kb_id'];
		$kb_config = KB_Utilities::get_kb_config( $kb_id );
		
		if ( empty($kb_config['section_head_category_icon_location']) || $kb_config['section_head_category_icon_location'] == 'no_icons' ) {
			$categories_icons = false;
		} else {
			$categories_icons = Utilities::get_kb_option( $kb_id, KB_Handler::CATEGORIES_ICONS, array(), true );
		}
		
		$alignmentClass = empty($block_attributes['list_alignment']) ? '' : 'epbl-kb-categories-align-' . $block_attributes['list_alignment'];
		$tag = $block_attributes['title_HTMLTag'];
		$category_title = $block_attributes['title_text'];
		$advancedClass = $block_attributes['advancedClass'];
		$block_id = $block_attributes['block_id'];		
		$icon_position = $block_attributes['icon_position']; 
		$show_title = $block_attributes['title_toggle']; ?>
		
		<div id="epbl-kb-categories-container-<?php echo $block_id; ?>" class="epbl-kb-categories-container <?php echo $advancedClass; ?> <?php echo $alignmentClass; ?>">

			<div class="epbl-kb-cat-list__inner"><?php

				if ( $show_title ) echo '<' . $tag . ' class="epbl-kb-cat-list-title" >' . $category_title . '</'.$tag.'>';

				$terms = $this->execute_search( $kb_id, $categories_filter, $this->retrieve_category_ids( $block_attributes['categories_ids_text'] ) );

				if ( empty($terms) ) {
		            echo esc_html__( 'Coming Soon', 'blocks-for-documents-articles-and-faqs' );

		        } else { ?>

						<ul class="epbl-kb-cat-list-items-container">			        <?php
						   foreach( $terms as $category ) {
								$category_Level = 'epbl-kb-cat-list-item__item--level-' . $category->level;
								$category_url = get_term_link( $category );
								if ( empty($category_url) || is_wp_error( $category_url ) ) {
									continue;
								} ?>

								<!-- List Item -->
								<li id="<?php echo 'epbl-cat-' . $category->term_id; ?>" class="epbl-kb-cat-list-item__item <?php echo $category_Level; ?>">
									<a href="<?php echo esc_url( $category_url ); ?>">
										<?php if ( $categories_icons && $icon_position == 'icon-first' ) $this->show_category_icon( $category->term_id, $categories_icons ); ?>
									   <span class="epbl-kb-cat-list-items__item__text"><?php echo esc_html( $category->name ); ?></span>
									   <?php if ( $categories_icons && $icon_position == 'icon-last' ) $this->show_category_icon( $category->term_id, $categories_icons ); ?>
									</a>
								</li>           <?php
						   }       ?>
						</ul>			        <?php

		        }       ?>
			</div>

		</div>		<?php
		return ob_get_clean();
	}
	
	/**
	 * STYLE tab for this widget
	 * @param $attributes
	 * @return array
	 */
	private function retrieve_category_ids( $attributes ) {

	    $in_category_ids = empty( $attributes ) ? '' : Utilities::sanitize_comma_separated_ints( $attributes );

	    // get articles for each category
	    $category_ids = array();
	    foreach( explode(',', $in_category_ids) as $category_id ) {

		    if ( Utilities::is_positive_int( $category_id ) ) {
			    $category_ids[] = $category_id;
		    }
	    }

	    return $category_ids;
    }
	
	/**
	 * Call WP query to get matching terms (any term OR match)
	 *
	 * @param $kb_id
	 * @param $filter
	 * @param string $category_ids
	 *
	 * @return array
	 */
    private function execute_search( $kb_id, $filter, $category_ids='' ) {

	    if ( empty($category_ids) ) {
	    	if ( $filter == 'all' ) {
			    $args = array(
				    'orderby'    => 'name',
				    'hide_empty' => false  // if 'hide_empty' then do not return categories with no articles
			    );
		    } else {
			    $args = array(
				    'parent'     => 0,
				    'orderby'    => 'name',
				    'hide_empty' => false  // if 'hide_empty' then do not return categories with no articles
			    );
		    }
	    } else {
	    	$args = array(
			    'orderby'    => 'name',
			    'include'    => $category_ids
	        );
	    }

	    $terms = get_terms( KB_Handler::get_category_taxonomy_name( $kb_id ), $args );
	    if ( is_wp_error( $terms ) ) {
		    Logging::add_log( 'cannot get terms for kb_id', $kb_id, $terms );
		    return array();
	    } else if ( empty($terms) || ! is_array($terms) ) {
		    return array();
	    }
		
		$terms = array_values($terms); // rearrange array keys
		$terms = $this->sort_categories( $terms, $kb_id );
		
		if ( $filter == 'all' ) {
			$terms = $this->add_levels_to_categories( $terms, $kb_id );
		}
		
	    return $terms;   
    }
	
	// sort as in the KB config
	private function sort_categories( $terms, $kb_id ) {
		$sorted_terms = array();
		
		$category_seq_data = Utilities::get_kb_option( $kb_id, KB_Handler::KB_CATEGORIES_SEQ_META, array(), true );
		if ( empty($category_seq_data) ) {
			return $terms;
		}
		
		foreach ( $category_seq_data as $id_1 => $lvl2 ) {
			$sorted_terms[$id_1] = false;
			
			if ( $lvl2 ) {
				foreach ( $lvl2 as $id_2 => $lvl3 ) {
					$sorted_terms[$id_2] = false;
					
					if ( $lvl3 ) {
						foreach ( $lvl3 as $id_3 => $lvl4 ) {
							$sorted_terms[$id_3] = false;
							
							if ( $lvl4 ) {
								foreach ( $lvl4 as $id_4 => $lvl5 ) {
									$sorted_terms[$id_4] = false;
									
									if ( $lvl5 ) {
										foreach ( $lvl5 as $id_5 => $lvl6 ) {
											$sorted_terms[$id_5] = false;
											
											if ( $lvl6 ) {
												foreach ( $lvl6 as $id_6 => $lvl7 ) {
													$sorted_terms[$id_6] = false;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		} 
		
		foreach ( $terms as $term ) {
			if ( isset( $sorted_terms[$term->term_id] ) ) {
				$sorted_terms[$term->term_id] = $term;
			}
		}
		
		// remove not used categories 
		foreach ( $sorted_terms as $term_id => $term ) {
			if ( ! $term ) {
				unset( $sorted_terms[$term_id] );
			}
		}
		
		return $sorted_terms;
	}
	
	private function add_levels_to_categories( $terms, $kb_id ) {
		$new_terms = array();
		
		// add ancestors to all categories 
		foreach ( $terms as $category ) {
			$category->ancestors = get_ancestors( $category->term_id, KB_Handler::get_category_taxonomy_name( $kb_id ) );
		}
		// build new array with all accentors
		foreach ( $terms as $category ) {
			$new_terms[$category->term_id] = array(
				'name' => $category->name,
				'ancestors' => get_ancestors( $category->term_id, KB_Handler::get_category_taxonomy_name( $kb_id ) )
			);
		}

		foreach ( $new_terms as $term_id => $category ) {
			
			$have_parent = false;
			
			foreach ( $category['ancestors'] as $ancestor_id ) {
				if ( isset( $new_terms[$ancestor_id] ) ) {
					$new_terms[$ancestor_id]['children'][$term_id] = &$new_terms[$term_id];
					$have_parent = true;
					break;
				}
			}
			
			// if we are here - there no ancestors in current list for the current article - null it
			if ( !$have_parent ) {
				$category['ancestors'] = array();
			}
			
		}
		
		// now we have a tree and we should show it like a list.
		$list_with_depth = array();
		
		foreach ( $new_terms as $term_id => $category ) {
			// level 0
			if ( empty( $category['ancestors'] ) ) {
				foreach ( $terms as $tid => $term ) {
					if ( $term->term_id == $term_id ) {
						$term->level = 0;
						$list_with_depth[] = $term;
						unset( $terms[$tid] );
					}
				}
				
				if ( ! empty( $category['children'] ) ) {
					// level 1
					foreach ( $category['children'] as $id_1 => $category_1 ) {
						foreach ( $terms as $tid => $term ) {
							if ( $term->term_id == $id_1 ) {
								$term->level = 1;
								$list_with_depth[] = $term;
								unset( $terms[$tid] );
							}
						}
						
						// level 2
						if ( ! empty( $category_1['children'] ) ) {
							foreach ( $category_1['children'] as $id_2 => $category_2 ) {
								//var_dump($category_2);
								foreach ( $terms as $tid => $term ) {
									if ( $term->term_id == $id_2 ) {
										$term->level = 2;
										$list_with_depth[] = $term;
										unset( $terms[$tid] );
									}
								}
								
								// level 3
								if ( ! empty( $category_2['children'] ) ) {
									foreach ( $category_2['children'] as $id_3 => $category_3 ) {
										foreach ( $terms as $tid => $term ) {
											if ( $term->term_id == $id_3 ) {
												$term->level = 3;
												$list_with_depth[] = $term;
												unset( $terms[$tid] );
											}
										}
										
										// level 4
										if ( ! empty( $category_3['children'] ) ) {
											foreach ( $category_3['children'] as $id_4 => $category_4 ) {
												foreach ( $terms as $tid => $term ) {
													if ( $term->term_id == $id_4 ) {
														$term->level = 4;
														$list_with_depth[] = $term;
														unset( $terms[$tid] );
													}
												}
												
												// level 5
												if ( ! empty( $category_4['children'] ) ) {
													foreach ( $category_4['children'] as $id_5 => $category_5 ) {
														foreach ( $terms as $tid => $term ) {
															if ( $term->term_id == $id_5 ) {
																$term->level = 5;
																$list_with_depth[] = $term;
																unset ( $terms[$tid] );
															}
														}
														
														// level 6 - not now
														
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}

		return $list_with_depth;
	}

	/**
	 * Display KB Category icon based on existing configuration.
	 * @param $term_id
	 * @param $categories_icons
	 */
	private function show_category_icon( $term_id, $categories_icons ) {
		$icon = KB_Handler::get_category_icon( $term_id, $categories_icons );
		if ( empty($icon['type']) ) {
			return;
		}

		if ( $icon['type'] == 'font' ) {		
			$icon['name'] = Utilities::replace_icons_name($icon['name']);
		?>
			<span class="epbl-kb-cat-list-items__item__icon"><i aria-hidden="true" class="epblfa <?php echo $icon['name']; ?>"></i></span><?php
		} else { ?>
			<span class="epbl-kb-cat-list-items__item__icon"><img src="<?php echo $icon['image_thumbnail_url']; ?>"></span><?php 
		}
	}
	
}