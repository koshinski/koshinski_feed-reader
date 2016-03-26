<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Koshinski_feed_reader
 * @subpackage Koshinski_feed_reader/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Koshinski_feed_reader
 * @subpackage Koshinski_feed_reader/admin
 * @author     Your Name <email@example.com>
 */
class Koshinski_feed_reader_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	
	public $textdomain;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->textdomain = 'koshinski-feed-reader';

		add_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'return_7200' ) );
		add_action( 'wp_dashboard_setup', array( $this, 'dashboard_setup' ) );
		
	}
	
	public function return_7200( $seconds ){
		return 7200;
	}
	public function dashboard_setup(){
		wp_add_dashboard_widget( 'dashboard-reader', __( 'News from Kleinwerkstatt', $this->textdomain ), array( $this, 'dashboard_content' ) );
	}
	public function dashboard_content(){
		$feed = fetch_feed( 'http://www.kleinwerkstatt.com/feed/' );
		$visible = false;
		$hiddenClass = ' koshinski-invisible';
		$dateFormat = get_option('date_format');
		
		if( ! is_wp_error( $feed ) ){
			$maxitems = $feed->get_item_quantity( 5 );
			$items = $feed->get_items( 0, $maxitems );
			if( count($items) > 0 ){
				$visible = true;
				$hiddenClass = '';
			}
			echo '<div class="rss-widget"><ul class="'.$this->textdomain.$hiddenClass.'">';
			foreach( $items as $item ){
				?>
				<li>
					<a class="rsswidget" href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a>
					<span class="rss-date"><?php echo $item->get_date($dateFormat); ?></span>
					<div class="rssSummary"><?php echo $item->get_description(); ?></div>
				</li>
				<?php
			}
			echo '</ul></div>';
		}else{
			?><p><?php _e( 'Unable to fetch News.', $this->textdomain ); ?></p><?php
		}
	}

	
	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}


	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Koshinski_feed_reader_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Koshinski_feed_reader_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/koshinski-feed-reader-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Koshinski_feed_reader_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Koshinski_feed_reader_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 /*
			wird aktuell nicht benötigt
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/koshinski-feed-reader-admin.js', array( 'jquery' ), $this->version, false );

	}

}
