<?php
/**
Theme Designed By: Kitwp.com
 */
// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'wp_nav_menu_item_custom_fields', 'paradox_add_megamenu_fields', 10, 4 );
function paradox_add_megamenu_fields( $item_id, $item, $depth, $args ) { ?>
	<div class="clear"></div>
	<div class="paradox-mega-menu-options">
		<p class="field-megamenu-status description description-wide">
			<label for="edit-menu-item-megamenu-status-<?php echo $item_id; ?>">
				<input type="checkbox" id="edit-menu-item-megamenu-status-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-status" name="menu-item-paradox-megamenu-status[<?php echo $item_id; ?>]" value="enabled" <?php checked( $item->paradox_megamenu_status, 'enabled' ); ?> />
				<strong><?php esc_html_e( 'فعالسازی مگامنو', 'paradox' ); ?></strong>
			</label>
		</p>

		<p class="field-megamenu-columns description description-wide">
			<label for="edit-menu-item-megamenu-columns-<?php echo $item_id; ?>">
				<?php esc_html_e( 'تعداد ستون های مگامنو', 'paradox' ); ?>
				<select id="edit-menu-item-megamenu-columns-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-columns" name="menu-item-paradox-megamenu-columns[<?php echo $item_id; ?>]">
					<option value="auto" <?php selected( $item->paradox_megamenu_columns, 'auto' ); ?>><?php esc_html_e( 'خودکار', 'paradox' ); ?></option>
					<option value="1" <?php selected( $item->paradox_megamenu_columns, '1' ); ?>>1</option>
					<option value="2" <?php selected( $item->paradox_megamenu_columns, '2' ); ?>>2</option>
					<option value="3" <?php selected( $item->paradox_megamenu_columns, '3' ); ?>>3</option>
					<option value="4" <?php selected( $item->paradox_megamenu_columns, '4' ); ?>>4</option>
				</select>
			</label>
		</p>


	</div><!-- .paradox-mega-menu-options-->
<?php }

/**
 * Display field type icon
 *
 * @since  1.0.0
 *
 * @param  string $selected The selected icon
 */


// Dont duplicate me!
if( ! class_exists( 'paradoxFrontendWalker' ) ) {
	class paradoxFrontendWalker extends Walker_Nav_Menu {

		/**
		 * @var string $menu_megamenu_status are we currently rendering a mega menu?
		 */
		private $menu_megamenu_status = "";

		/**
		 * @var string $menu_megamenu_width use full width mega menu?
		 */
		private $menu_megamenu_width = "";

		/**
		 * @var int $num_of_columns how many columns should the mega menu have?
		 */
		private $num_of_columns = 0;

		/**
		 * @var int $max_num_of_columns mega menu allow for 6 columns at max
		 */
		private $max_num_of_columns = 6;

		/**
		 * @var int $total_num_of_columns total number of columns for a single megamenu?
		 */
		private $total_num_of_columns = 0;

		/**
		 * @var int $num_of_rows number of rows in the mega menu
		 */
		private $num_of_rows = 1;

		/**
		 * @var array $submenu_matrix holds number of columns per row
		 */
		private $submenu_matrix = array();

		/**
		 * @var float $menu_megamenu_columnwidth how large is the width of a column?
		 */
		private $menu_megamenu_columnwidth = 0;

		/**
		 * @var array $menu_megamenu_rowwidth_matrix how large is the width of each row?
		 */
		private $menu_megamenu_rowwidth_matrix = array();

		/**
		 * @var float $menu_megamenu_maxwidth how large is the overall width of a column?
		 */
		private $menu_megamenu_maxwidth = 0;

		/**
		 * @var string $menu_megamenu_title should a colum title be displayed?
		 */
		private $menu_megamenu_title = '';

		/**
		 * @var string $menu_megamenu_inner_title should a colum title be displayed?
		 */
		private $menu_megamenu_innertitle = '';

		/**
		 * @var string $menu_megamenu_widget_area should one column be a widget area?
		 */
		private $menu_megamenu_widget_area = '';

		/**
		 * @var string $menu_megamenu_newlabel should a colum new label be displayed?
		 */
		private $menu_megamenu_newlabel = '';

		/**
		 * @var string $menu_megamenu_hotlabel should a colum hot label be displayed?
		 */
		private $menu_megamenu_hotlabel = '';

		/**
		 * @var string $menu_megamenu_salelabel should a colum sale label be displayed?
		 */
		private $menu_megamenu_salelabel = '';

		/**
		 * @var string $menu_megamenu_icon does the item have an icon?
		 */
		private $menu_megamenu_icon = '';

		/**
		 * @var string $menu_megamenu_thumbnail does the item have a thumbnail?
		 */
		private $menu_megamenu_thumbnail = '';

		/**
		 * Sets the overall width of the megamenu wrappers
		 *
		 */
		private function set_megamenu_max_width() {
			global $smof_data;
			$smof_data=array('site_width'=>'1100','megamenu_max_width'=>'1100');

			// Set overall width of megamenu
			$site_width = (int) str_replace( 'px', '', $smof_data['site_width'] );
			$megamenu_max_width = (int) str_replace( 'px', '', $smof_data['megamenu_max_width'] );
			//$site_width = (int) str_replace( 'px', '', 1100);
			//$megamenu_max_width = (int) str_replace( 'px', '', 1100 );
			$megmanu_width = 0;

			// Site width in px
			if ( strpos( $smof_data['site_width'], 'px' ) !== false ) {
				if ( $site_width > $megamenu_max_width &&
					 $megamenu_max_width > 0
				) {
					$megamenu_width = $megamenu_max_width;
				} else {
					$megamenu_width = $site_width;
				}
			// Site width in %
			} else {
				$megamenu_width = $megamenu_max_width;
			}
			$this->menu_megamenu_maxwidth = $megamenu_width;
		}

		/**
		 * @see Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );

			if( $depth === 0 && $this->menu_megamenu_status == "enabled" ) {
				// set overall width of megamenu
				if( ! $this->menu_megamenu_maxwidth ) {
					$this->set_megamenu_max_width();
				}

				$output .= "\n{first_level}\n";
				$output .= "\n$indent<div class=\"paradox-megamenu-holder\" {megamenu_final_width}>\n<ul class='paradox-megamenu {megamenu_border}'>\n";
			} elseif( $depth >= 2 && $this->menu_megamenu_status == "enabled" ) {
				$output .= "\n$indent<ul class=\"sub-menu deep-level\">\n";
			} else {
				$output .= "\n$indent<ul class=\"sub-menu\">\n";
			}
		}

		/**
		 * @see Walker::end_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			global $smof_data;
			$smof_data=array('site_width'=>'1100','megamenu_max_width'=>'1100');

			$indent = str_repeat( "\t", $depth );
			$row_width = '';

			if( $depth === 0  && $this->menu_megamenu_status == "enabled" ) {

				$output .= "\n</ul>\n</div><div style='clear:both;'></div>\n</div>\n</div>\n";

				if( $this->total_num_of_columns < $this->max_num_of_columns ) {
					$col_span = " col-span-" . $this->total_num_of_columns * 2;
				} else {
					$col_span = " col-span-" . $this->max_num_of_columns * 2;
				}

				if ( $this->menu_megamenu_width == "fullwidth" ) {
					$col_span = " col-span-12 paradox-megamenu-fullwidth";
					// overall megamenu wrapper width in px is max width for fullwidth megamenu
					$wrapper_width = $this->menu_megamenu_maxwidth;
				} else {
					// calc overall megamenu wrapper width in px
					$wrapper_width = max( $this->menu_megamenu_rowwidth_matrix ) * $this->menu_megamenu_maxwidth;
				}

				if($this->menu_megamenu_thumbnail !=""){
					$output = str_replace( "{first_level}", "<div class='paradox-megamenu-wrapper {paradox_columns} columns-".$this->total_num_of_columns . $col_span . "' data-maxwidth='" . $this->menu_megamenu_maxwidth . "' style=background-image:url('". $this->menu_megamenu_thumbnail ."')><div class='row'>", $output );
				}else{
						$output = str_replace( "{first_level}", "<div class='paradox-megamenu-wrapper {paradox_columns} columns-".$this->total_num_of_columns . $col_span . "' data-maxwidth='" . $this->menu_megamenu_maxwidth . "' ><div class=''>", $output );
				}

				$output = str_replace( "{megamenu_final_width}", sprintf( 'style="width:%spx;" data-width="%s"', $wrapper_width, $wrapper_width ), $output );

				if ( $this->total_num_of_columns > $this->max_num_of_columns ) {
					$output = str_replace( "{megamenu_border}","paradox-megamenu-border", $output );
				} else {
					$output = str_replace( "{megamenu_border}","", $output );
				}

				foreach($this->submenu_matrix as $row => $columns) {
					$layout_columns = 12 / $columns;
					if( $columns == '5' ) {
						$layout_columns = 2;
					}

					if( $columns < $this->max_num_of_columns ) {
						$row_width = "style=\"width:" . $columns / $this->max_num_of_columns * 100 . "%!important;\"";
					}

					$output = str_replace( "{row_width_".$row."}", $row_width, $output);

					if( ( $row - 1 ) * $this->max_num_of_columns + $columns < $this->total_num_of_columns ) {
						$output = str_replace( "{row_number_".$row."}", "paradox-megamenu-row-columns-" . $columns . " paradox-megamenu-border", $output);
					} else {
						$output = str_replace( "{row_number_".$row."}", "paradox-megamenu-row-columns-" . $columns, $output);
					}
					$output = str_replace( "{current_row_".$row."}", "paradox-megamenu-columns-".$columns. " col-md-" . $layout_columns , $output );

					$output = str_replace( "{paradox_columns}", sprintf( 'paradox-columns-%s columns-per-row-%s', $columns, $columns ), $output );
				}
			} else {
				$output .= "$indent</ul>\n";
			}
		}

		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $smof_data;
			$smof_data=array('site_width'=>'1100','megamenu_max_width'=>'1100');

			$item_output = $class_columns = '';
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			/* set some vars */
			if( $depth === 0 ) {

				$this->menu_megamenu_status = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_status', true );
				$this->menu_megamenu_width = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_width', true);
				$allowed_columns = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_columns', true );
				$this->menu_megamenu_thumbnail = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_thumbnail', true);
				if( $allowed_columns != "auto" ) {
					$this->max_num_of_columns = $allowed_columns;
				}
				$this->num_of_columns = $this->total_num_of_columns = 0;
				$this->num_of_rows = 1;
				$this->menu_megamenu_rowwidth_matrix = array();
				$this->menu_megamenu_rowwidth_matrix[$this->num_of_rows] = 0;
			}

			$this->menu_megamenu_title = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_title', true);
			$this->menu_megamenu_innertitle = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_innertitle', true);
			$this->menu_megamenu_widgetarea = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_widgetarea', true);
			$this->menu_megamenu_newlabel = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_newlabel', true);
			$this->menu_megamenu_hotlabel = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_hotlabel', true);
			$this->menu_megamenu_salelabel = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_salelabel', true);
			$this->menu_megamenu_icon = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_icon', true);
			$this->menu_megamenu_thumbnail = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_thumbnail', true);

			/* we are inside a mega menu */
			if( $depth === 1 && $this->menu_megamenu_status == "enabled" ) {

				if( get_post_meta( $item->ID, '_menu_item_paradox_megamenu_columnwidth', true) ) {
					$this->menu_megamenu_columnwidth = get_post_meta( $item->ID, '_menu_item_paradox_megamenu_columnwidth', true);
				} else {
					if ( $this->menu_megamenu_width == "fullwidth" ) {
						$this->menu_megamenu_columnwidth = 100 / $this->max_num_of_columns . '%';
					} else {
						$this->menu_megamenu_columnwidth = '20.6666%';
					}
				}

				$this->num_of_columns++;
				$this->total_num_of_columns++;

				/* check if we need to start a new row */
				if( $this->num_of_columns > $this->max_num_of_columns ) {
					$this->num_of_columns = 1;
					$this->num_of_rows++;

					// start new row width calculation
					$this->menu_megamenu_rowwidth_matrix[$this->num_of_rows] =  floatval( $this->menu_megamenu_columnwidth ) / 100;

					$output .= "\n</ul>\n<ul class=\"paradox-megamenu paradox-megamenu-row-".$this->num_of_rows." {row_number_".$this->num_of_rows."}\" {row_width_".$this->num_of_rows."}>\n";
				} else {
					$this->menu_megamenu_rowwidth_matrix[$this->num_of_rows] +=  floatval( $this->menu_megamenu_columnwidth ) / 100;
				}

				$this->submenu_matrix[$this->num_of_rows] = $this->num_of_columns;

				if( $this->max_num_of_columns < $this->num_of_columns ) {
					$this->max_num_of_columns = $this->num_of_columns;
				}

				$title = apply_filters( 'the_title', $item->title, $item->ID );

				if( !(
						( empty( $item->url ) || $item->url == "#" || $item->url == 'http://' )  &&
						$this->menu_megamenu_title == 'disabled'
					)
				) {
					$heading = do_shortcode($title);
					$link = '';
					$link_closing = '';

					if( ! empty( $item->url ) &&
						$item->url != "#" &&
						$item->url != 'http://'
					) {
						$link = '<a href="' . $item->url . '">';
						$link_closing = '</a>';
					}

					/* check if we need to set an image */
					$title_enhance = '';
					if ( ! empty( $this->menu_megamenu_thumbnail ) ) {
						$title_enhance = '<span class="paradox-megamenu-icon"><img src="' . $this->menu_megamenu_thumbnail . '" alt="thumbnail image"></span>';
					} elseif( ! empty( $this->menu_megamenu_icon ) ) {
						$title_enhance = '<span class="paradox-megamenu-icon"><i class="fa glyphicon ' . $this->menu_megamenu_icon .'"></i></span>';
					} else
					if($this->menu_megamenu_title == 'disabled') {
						$title_enhance = '<span class="caret-arrow"></span>';
					}

					$heading = sprintf( '%s%s%s%s', $link, $title_enhance, $title, $link_closing );

					if( $this->menu_megamenu_title != 'disabled' ) {
						$item_output .= "<div class='paradox-megamenu-title'>" . $heading . "</div>";
					} else {
						$item_output .= $heading;
					}
				}

				if( $this->menu_megamenu_widgetarea &&
					is_active_sidebar( $this->menu_megamenu_widgetarea )
				) {
					$item_output .= '<div class="paradox-megamenu-widgets-container second-level-widget">';
					ob_start();
						dynamic_sidebar( $this->menu_megamenu_widgetarea );

					$item_output .= ob_get_clean() . '</div>';
				}

				$class_columns  = ' {current_row_'.$this->num_of_rows.'}';

			} else if( $depth === 2 && $this->menu_megamenu_widgetarea && $this->menu_megamenu_status == "enabled" ) {

				if( is_active_sidebar( $this->menu_megamenu_widgetarea ) ) {
					$item_output .= '<div class="paradox-megamenu-widgets-container third-level-widget">';
					ob_start();
						dynamic_sidebar( $this->menu_megamenu_widgetarea );

					$item_output .= ob_get_clean() . '</div>';
				}

			} else {

				$atts = array();
				$atts['title']  = ! empty( $item->attr_title )	? 'title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$atts['target'] = ! empty( $item->target )		? 'target="' . esc_attr( $item->target	 ) .'"' : '';
				$atts['rel']	= ! empty( $item->xfn )			? 'rel="'	. esc_attr( $item->xfn		) .'"' : '';
				$atts['url']	= ! empty( $item->url )		 ? 'href="'   . esc_attr( $item->url		) .'"' : '';
				$attributes = implode( ' ', $atts );

				$item_output .= $args->before;
				/* check if ne need to set an image */
				if( $this->menu_megamenu_innertitle == 'enabled' && $this->menu_megamenu_status == "enabled") {
					$item_output .= "<div class='paradox-megamenu-title'>";
				}
				if ( ! empty( $this->menu_megamenu_thumbnail ) ) {
					$item_output .= '<a ' . $attributes . '><span class="paradox-megamenu-icon"><img src="' . $this->menu_megamenu_thumbnail . '" alt="thumbnail image"></span>';
				} elseif( ! empty( $this->menu_megamenu_icon ) ) {
					$item_output .= '<a ' . $attributes . '><span class="paradox-megamenu-icon text-menu-icon"><i class="fa glyphicon ' . $this->menu_megamenu_icon .'"></i></span>';
				} else
				if ( $depth !== 0 && $this->menu_megamenu_status == "enabled") {
					$item_output .= '<a ' . $attributes . '><span class="caret-arrow"></span>';
				} else {
					$item_output .= '<a '. $attributes .'>';
				}

				if( ! empty( $this->menu_megamenu_icon ) && $this->menu_megamenu_status == "enabled" ) {
					$item_output .=  '<span class="menu-text">';
				}

				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) ;

				if( ! empty( $this->menu_megamenu_icon ) && $this->menu_megamenu_status == "enabled" ) {
					$item_output .=  '</span>';
				}

				if($this->menu_megamenu_newlabel == "enabled" || $this->menu_megamenu_hotlabel == "enabled" || $this->menu_megamenu_salelabel == "enabled"){
					$item_output .=  '<span class="paradox-menu-label">';
					if( $this->menu_megamenu_newlabel == "enabled") {
						$item_output .=  '<span class="paradox-menu-newlabel">'.esc_attr__('New','paradox').'</span>';
					}
					if( $this->menu_megamenu_hotlabel == "enabled" ) {
						$item_output .=  '<span class="paradox-menu-hotlabel">'.esc_attr__('Hot','paradox').'</span>';
					}
					if( $this->menu_megamenu_salelabel == "enabled" ) {
						$item_output .=  '<span  class="paradox-menu-salelabel">'.esc_attr__('Sale','paradox').'</span>';
					}
					$item_output .=  '</span>';
				}

				if( $depth === 0 && $args->has_children ) {
					$item_output .= ' <span class="caret-arrow"></span></a>';
				} else {
					$item_output .= '</a>';
				}
				if( $this->menu_megamenu_innertitle == 'enabled' && $this->menu_megamenu_status == "enabled") {
					$item_output .= "</div>";
				}
				$item_output .= $args->after;

			}

			/* check if we need to apply a divider */
			if ( $this->menu_megamenu_status != "enabled" && ( ( strcasecmp( $item->attr_title, 'divider' ) == 0) ||
				 ( strcasecmp( $item->title, 'divider' ) == 0 ) )
			) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else {

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$class_names = '';
				$column_width = '';
				$classes = empty( $item->classes ) ? array() : ( array ) $item->classes;
				$classes[] = 'menu-item-' . $item->ID;

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );


				if( $depth === 0 && $args->has_children ) {
					if( $this->menu_megamenu_status == "enabled" ) {
						$class_names .= ' paradox-megamenu-menu';
					} else {
						$class_names .= ' paradox-dropdown-menu';
					}
				}

				if ( $depth === 1 ) {
					if( $this->menu_megamenu_status == "enabled" ) {
						$class_names .= ' paradox-megamenu-submenu';

						if ( $this->menu_megamenu_width != "fullwidth" ) {
							$width = $this->menu_megamenu_maxwidth * floatval( $this->menu_megamenu_columnwidth ) / 100;
							$column_width = sprintf( 'style="width:%spx;max-width:%spx;" data-width="%s"', $width, $width, $width );
						}
					} else {
						$class_names .= ' paradox-dropdown-submenu';
					}
				}

				$class_names = $class_names ? ' class="' . esc_attr( $class_names ). $class_columns . '"' : '';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= sprintf( '%s<li %s %s %s >', $indent, $id, $class_names, $column_width );

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}

		/**
		 * @see Walker::end_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Page data object. Not used.
		 * @param int $depth Depth of page. Not Used.
		 */
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</li>\n";
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @param object $element Data object
		 * @param array $children_elements List of elements to continue traversing.
		 * @param int $max_depth Max depth to traverse.
		 * @param int $depth Depth of current element.
		 * @param array $args
		 * @param string $output Passed by reference. Used to append additional content.
		 * @return null Null on failure with no changes to parameters.
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element )
				return;

			$id_field = $this->db_fields['id'];

			// Display this element.
			if ( is_object( $args[0] ) )
			   $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a manu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 *
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'manage_options' ) ) {

				extract( $args );

				$fb_output = null;

				return $fb_output;
			}
		}
	}  // end paradoxFrontendWalker() class
}

// Don't duplicate me!
if( ! class_exists( 'paradoxCoreMegaMenus' ) ) {

	class paradoxCoreMegaMenus extends Walker_Nav_Menu {

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker_Nav_Menu::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int	$depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker_Nav_Menu::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int	$depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Start the element output.
		 *
		 * @see Walker_Nav_Menu::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int	$depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 * @param int	$id	 Not used.
		 */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth, $wp_registered_sidebars;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			ob_start();
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = get_the_title( $original_object->ID );
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid';
				/* translators: %s: title of menu item which is invalid */
				$title = sprintf( esc_html__( '%s (Invalid)', 'paradox'), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( esc_html__('%s (Pending)', 'paradox'), $item->title );
			}

			$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

			$submenu_text = '';
			if ( 0 == $depth )
				$submenu_text = 'style="display: none;"';

			?>
			<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode( ' ', $classes ); ?>">
			<div class="menu-item-bar">
				<div class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="
							<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action'    => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>
							" class="item-move-up" aria-label="<?php esc_attr_e( 'Move up' ); ?>">&#8593;</a>
							|
							<a href="
							<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action'    => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>
							" class="item-move-down" aria-label="<?php esc_attr_e( 'Move down' ); ?>">&#8595;</a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" href="
																	<?php
																	echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
																	?>
						" aria-label="<?php esc_attr_e( 'Edit menu item' ); ?>"><span class="screen-reader-text"><?php _e( 'Edit' ); ?></span></a>
					</span>
				</div>
			</div>

			<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if ( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e( 'URL' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-wide">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e( 'Navigation Label' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="field-title-attribute field-attr-title description description-wide">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Title Attribute' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new tab' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e( 'CSS Classes (optional)' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode( ' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php _e( 'Link Relationship (XFN)' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( 'Description' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e( 'The description will be displayed in the menu if the current theme supports it.' ); ?></span>
					</label>
				</p>
				
				<?php do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args ); ?>

				<fieldset class="field-move hide-if-no-js description description-wide">
					<span class="field-move-visual-label" aria-hidden="true"><?php _e( 'Move' ); ?></span>
					<button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php _e( 'Up one' ); ?></button>
					<button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php _e( 'Down one' ); ?></button>
					<button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
					<button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
					<button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php _e( 'To the top' ); ?></button>
				</fieldset>

				<div class="menu-item-actions description-wide submitbox">
					<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php
							/* translators: %s: original title */
							printf( __( 'Original: %s' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' );
							?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="
																						<?php
																						echo wp_nonce_url(
																							add_query_arg(
																								array(
																									'action'    => 'delete-menu-item',
																									'menu-item' => $item_id,
																								),
																								admin_url( 'nav-menus.php' )
																							),
																							'delete-menu_item_' . $item_id
																						);
																						?>
					"><?php _e( 'Remove' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="
					<?php
					echo esc_url(
						add_query_arg(
							array(
								'edit-menu-item' => $item_id,
								'cancel'         => time(),
							),
							admin_url( 'nav-menus.php' )
						)
					);
					?>
						#menu-item-settings-<?php echo $item_id; ?>"><?php _e( 'Cancel' ); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
		}

	} // end paradoxCoreMegaMenus() class

}


// Don't duplicate me!
if( ! class_exists( 'paradoxMegaMenu' ) ) {

	/**
	 * Class to manipulate menus
	 *
	 * @since 3.4
	 */
	class paradoxMegaMenu{

		function __construct() {

			add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_fields' ), 10, 3 );

			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'add_custom_fields' ) );
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_data_to_menu' ) );

		} // end __construct();


		/**
		 * Function to replace normal edit nav walker for paradox core mega menus
		 *
		 * @return string Class name of new navwalker
		 */
		function add_custom_fields() {

			return 'paradoxCoreMegaMenus';

		}

		/**
		 * Add the custom fields menu item data to fields in database
		 *
		 * @return void
		 */
		function save_custom_fields( $menu_id, $menu_item_db_id, $args ) {

			$field_name_suffix = array( 'status', 'width', 'columns', 'columnwidth', 'title', 'innertitle', 'newlabel', 'hotlabel', 'salelabel', 'widgetarea', 'icon', 'thumbnail' );

			foreach ( $field_name_suffix as $key ) {
				if( !isset( $_REQUEST['menu-item-paradox-megamenu-'.$key][$menu_item_db_id] ) ) {
					$_REQUEST['menu-item-paradox-megamenu-'.$key][$menu_item_db_id] = '';
				}

				$value = $_REQUEST['menu-item-paradox-megamenu-'.$key][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_paradox_megamenu_'.$key, $value );
			}
		}

		/**
		 * Add custom fields data to the menu
		 *
		 * @return object Add custom fields data to the menu object
		 */
		function add_data_to_menu( $menu_item ) {

			$menu_item->paradox_megamenu_status = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_status', true );

			$menu_item->paradox_megamenu_width = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_width', true );

			$menu_item->paradox_megamenu_columns = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_columns', true );

			$menu_item->paradox_megamenu_columnwidth = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_columnwidth', true );

			$menu_item->paradox_megamenu_title = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_title', true );

			$menu_item->paradox_megamenu_innertitle = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_innertitle', true );

			$menu_item->paradox_megamenu_newlabel = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_newlabel', true );

			$menu_item->paradox_megamenu_hotlabel = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_hotlabel', true );

			$menu_item->paradox_megamenu_salelabel = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_salelabel', true );

			$menu_item->paradox_megamenu_widgetarea = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_widgetarea', true );

			$menu_item->paradox_megamenu_icon = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_icon', true );

			$menu_item->paradox_megamenu_thumbnail = get_post_meta( $menu_item->ID, '_menu_item_paradox_megamenu_thumbnail', true );

			return $menu_item;

		}

	} // end paradoxMegaMenu() class

}
$paradoxMegaMenu = new paradoxMegaMenu();
