<?php
namespace Echo_Doc_Blocks\Includes\Features\Dynamic;

use  Echo_Doc_Blocks\Includes\Utilities;
use  Echo_Doc_Blocks\Includes\kb\KB_Handler;
use  Echo_Doc_Blocks\Includes\kb\KB_Utilities;
use  Echo_Doc_Blocks\Includes\Utilities_Plugin;

defined( 'ABSPATH' ) || exit();

/**
 * Dynamic block for KB Recent Articles
 */
class KB_Recent_Articles {
	
	public static function get_default_fields() {
			return array(
			
				'advancedBorderColor' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedBorderRadius' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderType' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedBorderWidthBottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderWidthLeft' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderWidthRight' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderWidthTop' => array(
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

				'advancedClass' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedMarginBottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedMarginLeft' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedMarginRight' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedMarginTop' => array(
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
				
				'advancedPaddingRight' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedPaddingTop' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedZIndex' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'articleText_BorderColor' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'articleText_BorderRadius' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_BorderWidthBottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_BorderWidthLeft' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_BorderWidthRight' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_BorderWidthTop' => array(
					'default' => 0,
					'type' => 'number'
				),
			
				'articleText_backgroundColor' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'articleText_backgroundColorHover' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'articleText_borderType' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'articleText_color' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'articleText_colorHover' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'articleText_margin_bottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_margin_left' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_margin_right' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_margin_top' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_padding_bottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_padding_left' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_padding_right' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'articleText_padding_top' => array(
					'default' => 0,
					'type' => 'number'
				),

				'articleText_typography' => array(
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

				'blockType' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'block_id' => array(
					'default' => '',
					'type' => 'string'
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
				
				'icon_color' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'icon_colorHover' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'icon_margin_bottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'icon_margin_left' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'icon_margin_right' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'icon_margin_top' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'icon_padding_bottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'icon_padding_left' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'icon_padding_right' => array(
					'default' => 5,
					'type' => 'number'
				),
				
				'icon_padding_top' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'icon_position' => array(
					'default' => 'icon-first',
					'type' => 'string'
				),
				
				'icon_size' => array(
					'default' => 16,
					'type' => 'number'
				),
				
				'kb_id' => array(
					'default' => 1,
					'type' => 'number'
				),
				
				'list_alignment' => array(
					'default' => 'flex-start',
					'type' => 'string'
				),
				
				'list_layout' => array(
					'default' => 'col',
					'type' => 'string'
				),
				
				'nof' => array(
					'default' => 5,
					'type' => 'number'
				),
				
				'order_by' => array(
					'default' => 'date',
					'type' => 'string'
				),
				
				'templateId' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'title_HTMLTag' => array(
					'default' => 'h3',
					'type' => 'string'
				),
				
				'title_backgroundColor' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'title_color' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'title_level' => array(
					'default' => 3,
					'type' => 'number'
				),
					
				'title_padding_bottom' => array(
					'default' => 5,
					'type' => 'number'
				),
				
				'title_padding_left' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'title_padding_right' => array(
					'default' => 5,
					'type' => 'number'
				),
				
				'title_padding_top' => array(
					'default' => 5,
					'type' => 'number'
				),
				
				'title_text' => array(
					'default' => __( 'Recent Articles', 'blocks-for-documents-articles-and-faqs' ),
					'type' => 'string'
				),
				
				'title_toggle' => array(
					'default' => true,
					'type' => 'boolean'
				),
				
				'title_typography' => array(
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
				
			);
	}
	
	public function __construct()  {
		add_action( 'init', array( $this, 'register_recent_articles' ) );
	}
	
	public function register_recent_articles() {
		register_block_type( 'echo-document-blocks/kb-articles', array(
			'attributes' => self::get_default_fields(),
			'render_callback' => array( $this, 'render_recent_articles' )
		) );
	}
	/**
	 * Render the widget output on the frontend.
	 *
	 */
	public function render_recent_articles( $block_attributes, $content ) {
		
		if ( ! Utilities::is_kb_plugin_active() ) {
			return Utilities_Plugin::get_kb_error_message();
		}
		
		ob_start(); 
		
		$result = $this->execute_search( $block_attributes['kb_id'], intval($block_attributes['nof']), $block_attributes['order_by'] );
		
		$title                  = $block_attributes['title_text'];
	    $title_html_tag         = $block_attributes['title_HTMLTag'];
	    $title_active           = $block_attributes['title_toggle'];
	    $layout                 = $block_attributes['list_layout'];
	    $article_icon_loc       = $block_attributes['icon_position'];
		$advancedClass       = $block_attributes['advancedClass'];
		$block_id = $block_attributes['block_id'];   ?>
		
		<div id="epbl-kb-article-list-container-<?php echo $block_id; ?>" class="epbl-kb-article-list-container epbl-kb-article-list--<?php echo $layout . ' epbl-kb-article-list--' . $article_icon_loc; ?>  <?php echo $advancedClass; ?>">
			<div class="epbl-kb-article-list__inner"><?php
				
				if ( $title_active ) {
				    echo '<' . $title_html_tag . ' class="epbl-kb-article-list-title" >' . $title . '</' . $title_html_tag . '>';
			    }
				
		        if ( empty($result) ) {
		            echo esc_html__( 'Coming Soon', 'creative-addons-for-elementor' );
		        } else { ?>
		            <ul class="epbl-kb-article-list-items-container"><?php
		            foreach( $result as $article ) {

		                $article_url = get_permalink( $article->ID );
		                if ( empty($article_url) || is_wp_error( $article_url )) {
		                    continue;
		                }

			            // get article icon filter if applicable
			            $article_title_icon = 'epbl-recent-articles-icon ep_font_icon_document';
			            if ( has_filter( 'eckb_single_article_filter' ) ) {
				            $article_title_icon_filter = apply_filters( 'eckb_article_icon_filter', '', $article->ID );
				            $article_title_icon = empty( $article_title_icon_filter ) ? $article_title_icon : 'epbl-recent-articles-icon ' . $article_title_icon_filter . '';
			            } 
						
						$article_title_icon = Utilities::replace_icons_name($article_title_icon); ?>
						
			            <!-- List Item -->
			            <li id="<?php echo 'epbl-article-'.$article->ID; ?>" class="epbl-kb-article-list-items__item">
		                    <a href="<?php echo esc_url( $article_url ); ?>">
			                    <span class="epbl-kb-article-list-items__item__icon"><i aria-hidden="true" class="epblfa <?php echo $article_title_icon; ?>"></i></span>
			                    <span class="epbl-kb-article-list-items__item__text"><?php echo esc_html( $article->post_title ); ?></span>
		                    </a>
		                </li> <?php 
		            } ?>
					</ul><?php
		        } ?>
			</div>

		</div>		<?php
		
		return ob_get_clean();
	}
	
	/**
     * Call WP query to get matching terms (any term OR match)
     *
     * @param $kb_id
     * @param $nof_articles
     * @param $orderby
     * @return array
     */
    private function execute_search( $kb_id, $nof_articles, $orderby ) {

	    $post_status_search = KB_Utilities::is_amag_on( true ) ? array('publish', 'private') : array('publish');

        $result = array();
        $search_params = array(
            'post_type' => KB_Handler::get_post_type( $kb_id ),
            'post_status' => $post_status_search,
            'ignore_sticky_posts' => true,      // sticky posts will not show at the top
            'posts_per_page' => KB_Utilities::is_amag_on( true ) ? -1 : $nof_articles,  // limit search results
            'no_found_rows' => true,            // query only posts_per_page rather than finding total nof posts for pagination etc.
            'orderby' => $orderby,
            'order'   => 'DESC'
        );

        $found_posts = new \WP_Query( $search_params );
        if ( ! empty($found_posts->posts) ) {
            $result = $found_posts->posts;
            wp_reset_postdata();
        }

	    // for Access Manager we query all and then we need to limit the number of articles per widget parameter
	    if ( KB_Utilities::is_amag_on( true ) && count($result) > $nof_articles ) {
		    $result = array_splice($result, 0, $nof_articles);
	    }

        return $result;
    }

}