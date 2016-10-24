  <?php
/* class to add new options to the network admin settings screen */
class GMFAdminSettings {

    private static $instance;
    /**
     * Get active object instance
     *
     * @since 1.0
     *
     * @access public
     * @static
     * @return object
     */
    public static function get_instance() {

        if ( ! self::$instance )
            self::$instance = new GMFAdminSettings();

        return self::$instance;
    }

    /**
     * Class constructor.  Includes constants, includes and init method.
     *
     * @since 1.0
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->init();
    }

    /**
     * Run action and filter hooks.
     *
     * @since 1.0
     *
     * @access private
     * @return void
     */
    private function init() {
        //Adds settings to Network Settings
        add_filter( 'wpmu_options'       , array( $this, 'show_network_settings' ) );
        add_action( 'update_wpmu_options', array( $this, 'save_network_settings' ) );

    }

    public static function save_network_settings() {
      foreach ( $_POST['panelField'] as $name => $value ) {
        update_site_option( $name, stripslashes($value)) ;
      }
    }

    public static function show_network_settings() {
      $settings = self::get_network_settings();
      ?>
      <script type="text/javascript">
        function buildUpload(id) {
          tb_show('', '../media-upload.php?type=image&TB_iframe=true');

          window.send_to_editor = function( html ){
            imgurl = jQuery( 'img', html ).attr( 'src' );
            jQuery( '#'+id+'_image' ).val(imgurl);
            jQuery('#'+id+'_pimg').attr("src",imgurl);
            tb_remove();
          }

          return false;
        }
      </script>
      <h3><?php _e( 'Network Panel Settings' ); ?></h3>
      <table id="menu" class="form-table">
        <?php
        foreach ($settings as $setting) {
          ?>
        <tr>
          <th><?php echo $setting['panel'];?></th>
          <td>
            <table width="100%">
              <?php
              foreach($setting['panelData'] as $panelData){ ?>
                <tr valign="top">
                  <td width="20%">
                    <?php echo $panelData['desc']; ?>
                  </td>
                  <td>
                    <?php if($panelData['type']=='textarea'){ ?>
                      <textarea name="panelField[<?php echo $panelData['id']; ?>]" rows="4" cols="50"><?php echo get_site_option( $panelData['id'] ) ;?></textarea>
                    <?php }elseif($panelData['type']=='image'){ ?>
                      <img id="<?php echo $panelData['id']; ?>_pimg"  class="user-preview-image" src="<?php echo esc_attr( get_site_option( $panelData['id'] ) ); ?>">
                      <br/>
                      <input type="text" name="panelField[<?php echo $panelData['id']; ?>]" id="<?php echo $panelData['id']; ?>_image" value="<?php echo esc_attr( get_site_option( $panelData['id'] ) ); ?>" class="regular-text" />
                      <input type='button' class="button-primary uploadImage" onClick="buildUpload('<?php echo $panelData['id']; ?>')" value="Upload Image" />
                    <?php }else{  ?>
                      <input type="<?php echo $panelData['type'];?>" name="panelField[<?php echo $panelData['id']; ?>]" value="<?php echo esc_attr( get_site_option( $panelData['id'] ) ); ?>" />
                    <?php }?>
                  </td>
                </tr>
                <?php
              }
              ?>
            </table>
          </td>
          <?php
        }
      ?>
      </table>

      <?php
    }

    public static function get_network_settings() {

        $settings[] = array('panel'=> __('What is Maker Faire?'),
            'panelData' =>
              array(
                array(
                  'id'   => 'what-is-makerfaire',
                  'name' => __( 'Text' ),
                  'desc' => __( 'Text' ),
                  'type' => 'textarea',
                  'size' => 'regular'
                )
              )
        );

        $settings[] = array('panel'=> __('Find Out More'),
            'panelData' =>
              array(
                array(
                  'id'   => 'find-out-more-img1',
                  'name' => __( 'Image #1' ),
                  'desc' => __( 'Image #1' ),
                  'std'  => '5',
                  'type' => 'image'
                ),
                array(
                  'id'   => 'find-out-more-url1',
                  'name' => __( 'URL #1' ),
                  'desc' => __( 'URL for Image #1' ),
                  'std'  => '5',
                  'type' => 'text'
                ),
                array(
                  'id'   => 'find-out-more-img2',
                  'name' => __( 'Image #2' ),
                  'desc' => __( 'Image #2' ),
                  'std'  => '5',
                  'type' => 'image'
                ),
                array(
                  'id'   => 'find-out-more-url2',
                  'name' => __( 'URL #2' ),
                  'desc' => __( 'URL for Image #2' ),
                  'std'  => '5',
                  'type' => 'text'
                )
              )
            );
        $settings[] = array('panel'=> __('Footer'),
            'panelData' =>
              array(
                array(
                  'id'   => 'footer-text',
                  'name' => __( 'Text' ),
                  'desc' => __( 'Text' ),
                  'type' => 'textarea',
                  'size' => 'regular'
                )
              )
        );

        return apply_filters( 'plugin_settings', $settings );
    }
}

GMFAdminSettings::get_instance();
