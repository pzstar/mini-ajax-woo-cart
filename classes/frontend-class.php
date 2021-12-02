<?php defined('ABSPATH') or die('No script please!!');

if ( !class_exists('MAJC_Frontend') ) 
{
    
  class MAJC_Frontend extends MAJC_Library{

    function __construct() {

      add_action( 'wp_head', array( $this, 'majc_menu' ) ); 

      add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'add_to_cart_fragments' ), 10, 1 );

      // Change The Quantiy of the Woocommerce Product
      add_action( 'wp_ajax_change_item_qty', array( $this, 'change_item_qty') );
      add_action( 'wp_ajax_nopriv_change_item_qty', array( $this, 'change_item_qty') );

      add_action( 'wp_ajax_add_coupon_code', array( $this, 'addCouponCode') );
      add_action( 'wp_ajax_nopriv_add_coupon_code', array( $this, 'addCouponCode') );

      add_action( 'wp_ajax_remove_coupon_code', array( $this, 'remove_coupon_code') );
      add_action( 'wp_ajax_nopriv_remove_coupon_code', array( $this, 'remove_coupon_code') );

      add_action( 'wp_ajax_get_refresh_fragments', array( $this, 'get_refreshed_fragments' ) );
      add_action( 'wp_ajax_nopriv_get_refresh_fragments', array( $this, 'get_refreshed_fragments' ) );

      add_action( 'wp_ajax_remove_item', array( $this, 'cart_remove_item') );
      add_action( 'wp_ajax_nopriv_remove_item', array( $this, 'cart_remove_item') );

      // Prevent Refresh from Adding Another Product in WooCommerce
      add_action('woocommerce_add_to_cart_redirect', array( $this, 'prevent_add_to_cart_on_redirect'));
    }

    private function checkNonce() {
      if ( isset( $_POST['wp_nonce'] ) && wp_verify_nonce($_POST['wp_nonce'], 'majc-frontend-ajax-nonce') )  
      {
        return 'true';
      }
      else {
        return 'false';
      }
    }

    function prevent_add_to_cart_on_redirect($url = false) {

         // If another plugin beats us to the punch, let them have their way with the URL
         if(!empty($url)) { return $url; }

         // Redirect back to the original page, without the 'add-to-cart' parameter.
         // We add the `get_bloginfo` part so it saves a redirect on https:// sites.
         return add_query_arg(array(), remove_query_arg('add-to-cart'));
         // return get_bloginfo('wpurl').add_query_arg(array(), remove_query_arg('add-to-cart'));

    }

    function change_item_qty() {

      if( $this->checkNonce == 'false' ) { return false; }

      $c_key = isset($_REQUEST['ckey']) ? sanitize_text_field($_REQUEST['ckey']) : null;
      $qty = isset($_REQUEST['qty']) ? sanitize_text_field($_REQUEST['qty']) : null;
      WC()->cart->set_quantity($c_key, $qty, true);
      WC()->cart->set_session();
      die();
    }

    public function remove_coupon_code() {

      if( $this->checkNonce == 'false' ) { return false; }

      $couponCode = isset($_POST['couponCode']) ? sanitize_text_field($_POST['couponCode']) : null;
      
      if( WC()->cart->remove_coupon( $couponCode ) ) {
        esc_html_e('Coupon Removed Successfully.', 'mini-ajax-cart');
      }

      WC()->cart->calculate_totals();
      WC()->cart->maybe_set_cart_cookies();
      WC()->cart->set_session();
      
      die();
    }

    public function addCouponResponse($response) {
      header( 'Content-Type: application/json' );
      echo json_encode( $response );

      WC()->cart->calculate_totals();
      WC()->cart->maybe_set_cart_cookies();
      WC()->cart->set_session();
    }

    public function addCouponCode() {

      if( $this->checkNonce == 'false' ) { return false; }

      $code = isset($_POST['couponCode']) ? sanitize_text_field($_POST['couponCode']) : null;
      $code = strtolower($code);

      /* Check if coupon code is empty */
      if( empty( $code ) || !isset( $code ) ) {

          $response = array(
              'result' => 'empty',
              'msg'    => esc_html__('Coupon Code Field is Empty!', 'mini-ajax-cart')
          );

          $this->addCouponResponse($response);

          exit();
      }

      /* Create an instance of WC_Coupon with our code */
      $coupon = new WC_Coupon( $code );
      $applied_coupons = WC()->cart->get_applied_coupons();

      if (in_array($code, $applied_coupons)) {

        $response = array(
            'result' => 'already applied',
            'msg'    => esc_html__('Coupon Code Already Applied.', 'mini-ajax-cart')
        );

        $this->addCouponResponse($response);  
      } 
      else if ( !$coupon->is_valid() ) {

        $response = array(
            'result' => 'not valid',
            'msg'    => esc_html__('Invalid code entered. Please try again.', 'mini-ajax-cart')
        );

        $this->addCouponResponse($response);
      } 
      else {
          
        WC()->cart->apply_coupon( $code );

        $response = array(
            'result' => 'success',
            'msg'    => esc_html__('Coupon Applied Successfully.', 'mini-ajax-cart')
        );

        $this->addCouponResponse($response);
        
        wc_clear_notices();
      }
      die();
    }


    public function add_to_cart_fragments ($fragments) {
      WC()->cart->calculate_totals();
      WC()->cart->maybe_set_cart_cookies();  
      global $woocommerce;
      ob_start();
      ?>
        <div class="majc-cart-item-wrap">
        <?php if ( ! WC()->cart->is_empty() ) { ?>
          <div class="majc-mini-cart">
            <?php 
              $items = WC()->cart->get_cart(); 
              foreach ($items as $itemKey => $itemVal) {
              ?>
                <div class="majc-cart-items" data-itemId="<?php echo esc_attr($itemVal['product_id']); ?>" data-cKey="<?php echo esc_attr($itemVal['key']); ?>">
                  <div class="majc-cart-items-inner">
                    <?php  
                    $product =  wc_get_product( $itemVal['data']->get_id() );
                      $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $itemVal['product_id'], $itemVal, $itemKey );
                      $getProductDetail = wc_get_product( $itemVal['product_id'] );
                    ?>
                    <div class="majc-item-img">
                      <?php echo $getProductDetail->get_image('thumbnail'); ?>
                    </div>

                    <div class="majc-item-desc">
                      <div class="majc-item-remove">
                        <?php  
                        echo apply_filters('woocommerce_cart_item_remove_link', 
                          sprintf('<a href="%s" class="majc-remove"  aria-label="%s" data-cart_item_id="%s" data-cart_item_sku="%s" data-cart_item_key="%s"><span class="icofont-close-line"></span></a>', 
                                            esc_url(wc_get_cart_remove_url($itemKey)), 
                                            esc_html__('Remove this item', 'mini-ajax-cart'),
                                            esc_attr( $product_id ),
                                            esc_attr( $product->get_sku() ),
                                            esc_attr( $itemKey )
                                            ), $itemKey);
                        ?>
                      </div>

                      <div class="majc-item-name">
                        <?php echo esc_html($product->get_name()); ?>
                      </div>

                      <div class="majc-item-qty">
                        <span class="majc-qty-minus majc-qty-chng">-</span>

                        <input type="number" name="majc-qty-input" class="majc-qty" step="1" min="0" max="14" value="<?php echo intval($itemVal['quantity']); ?>" placeholder="" inputmode="numeric">

                        <span class="majc-qty-plus majc-qty-chng">+</span>
                      </div>  

                      <div class="majc-item-price">
                        <?php 
                        $wc_product = $itemVal['data'];
                        echo WC()->cart->get_product_subtotal( $wc_product, $itemVal['quantity'] );
                        ?>
                      </div>
                    </div> <!-- majc-item-desc -->
                  </div> <!-- majc-cart-items-inner -->
                </div> <!-- majc-cart-items -->
              <?php 
              } // product foreach loop ends
            ?>
          </div> 
        <?php } else { ?>
          <h3 class="majc-empty-cart">
            <?php esc_html_e('The Cart is Empty', 'mini-ajax-cart'); ?>
          </h3>
        <?php } ?>
        </div> <!-- majc-cart-item-wrap -->
      <?php
      $cart_body_contents = ob_get_clean();
      $fragments['div.majc-cart-item-wrap'] = $cart_body_contents;

      // Update subtotal Amount
      $get_totals = WC()->cart->get_totals();
      $cart_total = $get_totals['subtotal'];
      $cart_discount = $get_totals['discount_total'];
      $final_subtotal = $cart_total - $cart_discount;
      $subtotal = "<div class='majc-subtotal-amount'>".get_woocommerce_currency_symbol().number_format($final_subtotal, 2)."</div>";
      $fragments['div.majc-subtotal-amount'] = $subtotal;
      
      // Update Total Amount
      $cartTotal = '<div class="majc-cart-total-amount">'.wc_price(WC()->cart->get_subtotal() + WC()->cart->get_subtotal_tax()).'</div>';
      $fragments['div.majc-cart-total-amount'] = $cartTotal;

      // Update Discount Amount
      $discountTotal = '<div class="majc-cart-discount-amount">'.wc_price( WC()->cart->get_cart_discount_total() + WC()->cart->get_cart_discount_tax_total() ).'</div>';
      $fragments['div.majc-cart-discount-amount'] = $discountTotal;

      // Update Applied Coupon
      $applied_coupons = WC()->cart->get_applied_coupons();
      ob_start();
      if( !empty($applied_coupons) ) {
      ?>
        
        <ul class='majc-applied-cpns'>
        <?php foreach($applied_coupons as $cpns ) { ?>
          <li class='' cpcode='<?php echo esc_attr($cpns); ?>'><?php echo esc_attr($cpns); ?> <span class='majc-remove-cpn icofont-close-line'></span></li>
        <?php } ?>
        </ul>
      <?php
      } else {
        echo '<ul class="majc-applied-cpns" style="display: none;"><li></li></ul>';
      }
      $cart_cpn = ob_get_clean();
      $fragments['ul.majc-applied-cpns'] = $cart_cpn;

      // Update the Items Count In the Cart
      $fragments['.majc-cart-qty-count'] = '<span class="majc-cart-qty-count">'.esc_html__('Quantity: ', 'mini-ajax-cart').WC()->cart->get_cart_contents_count().'</span>';
      $fragments['.majc-cart-items-count'] = '<span class="majc-cart-items-count">'.esc_html__('Items: ', 'mini-ajax-cart').sizeof( WC()->cart->get_cart() ).'</span>';

      // Cart Basket Items Count
      $fragments['.majc-item-count-wrap .majc-cart-item-count'] = '<span class="majc-cart-item-count">'.WC()->cart->get_cart_contents_count().'</span>';

      return $fragments;
    }

    public function majc_menu() {
      include MAJC_PATH . '/inc/frontend/flying-cart/flying-front.php'; 
    }

    public function get_refreshed_fragments () {

      if( $this->checkNonce == 'false' ) { return false; }

    	WC_AJAX::get_refreshed_fragments();
    }

    public function cart_remove_item () {

      if( $this->checkNonce == 'false' ) { return false; }

      ob_start();
      foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
          if($cart_item['product_id'] == $_POST['cart_item_id'] && $cart_item_key == $_POST['cart_item_key'] )
          {
              WC()->cart->remove_cart_item($cart_item_key);
          }
      }

      WC()->cart->calculate_totals();
      WC()->cart->maybe_set_cart_cookies();

      woocommerce_mini_cart();

      $mini_cart = ob_get_clean();

      // Fragments and mini cart are returned
      $data = array(
          'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
                  'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
              )
          ),
          'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
      );

      wp_send_json( $data );

      die();
    }
    
    public function getSuggestedItems($display_product_type, $selected_product_ids) {
    
      $type        = isset($display_product_type) ? esc_html($display_product_type) : 'up-sells';
      $items_count = 5;
      $title       = esc_html__( 'Products you may like', 'mini-ajax-cart' );

      $cart          = WC()->cart->get_cart();
      $cart_is_empty = WC()->cart->is_empty();

      $suggested_products = array();
      $exclude_ids        = array();

      if ( ! $cart_is_empty ) {
        foreach ( $cart as $cart_item ) {
          $exclude_ids[] = $cart_item['product_id'];
        }

        switch ( $type ) {
          case 'cross-sells':
            $suggested_products = WC()->cart->get_cross_sells();
          break;

          case 'up-sells':

            foreach ( $cart as $item ) {
              $upsellProduct = new WC_Product( $item['product_id'] );
              $suggested_products = $upsellProduct->get_upsell_ids();
            }
          break;

          case 'related':

            shuffle( $cart );

            foreach ( $cart as $cart_item ) {
              if ( count( $suggested_products ) >= $items_count ) {
                break;
              }

              $product_id         = $cart_item['variation_id'] ? $cart_item['variation_id'] : $cart_item['product_id'];
              $related_products   = wc_get_related_products( $product_id, $items_count, $exclude_ids );
              $suggested_products = array_merge( $suggested_products, $related_products );
            }
          break;

          case 'selected-product':
            $selected_product_ids = isset($selected_product_ids) && !empty($selected_product_ids) ? $selected_product_ids : '';

            if(!empty($selected_product_ids)) {
              $selected_product_ids = str_replace(" ", "", $selected_product_ids);
              $selected_product_ids = explode(",", $selected_product_ids);
              foreach($selected_product_ids as $id) {

                if ( count( $suggested_products ) >= $items_count ) {
                  break;
                }

                $suggested_products[] = intval($id);
              }
            }

          break;
        }
      }

      $suggested_products = array_diff($suggested_products, $exclude_ids);
      
      return $suggested_products;
    }

    function hide_show_pages( $pageid, $specific_page, $hide_show, $front, $blog, $single, $error, $search, $archive ) {

      $hide_flag = 0;
      $show_flag = 1;

      switch( $hide_show ) 
      {
        case 'show_in_pages':
          if(!in_array($pageid, $specific_page)){
            $hide_flag = 1;
          }

          if($front || $blog) {  
            if (is_front_page() && is_home()) {
              $hide_flag = 0;
            } else if (is_front_page()) {
              $hide_flag = 0;
            } else if (is_home()) {
              $hide_flag = 0;
            }
          }

          if($single){
            if(is_single() || is_page())
              $hide_flag = 0;   
          }

          if($error){
            if(is_404())
              $hide_flag = 0;
          }
          if($search){
            if(is_search())
              $hide_flag = 0;
          }
          if($archive){
            if(is_archive())
              $hide_flag = 0;
          }
        break;

        case 'hide_in_pages':
          if(in_array($pageid, $specific_page)){
            $hide_flag = 1;
          }

          if($front || $blog){  
            if(is_front_page() && is_home()) {
              $hide_flag += 1;
            } else if(is_front_page()) {
              $hide_flag += 1;
            } else if(is_home()) {
              $hide_flag += 1;
            }
          }

          if($single) {
            if(is_single() || is_page())
              $hide_flag += 1;    
          }

          if($error) {
            if(is_404())
              $hide_flag += 1;
          }
          if($search){
            if(is_search())
              $hide_flag += 1;
          }
          if($archive) {
            if(is_archive())
              $hide_flag += 1;
          }
        break;
      } // Switch End

      if($hide_flag > 0) {
        return '1';
      }
      if($show_flag == 0) {
        return '1';
      }
    }

    function hideOnScreenTypes($mobile_hide, $desktop_hide, $detect) {
      // Hide on mobile devices
      if( $detect->isMobile() || $detect->isTablet() ) {
        if(isset($mobile_hide)) {
          return '1';
        }
      }
      else {
        if(isset($desktop_hide)) { 
          return '1';
        }
      }
    }

    public function is_standard_font ( $font ) {
      $standard_fonts = ['Helvetica','Verdana','Arial','Times','Georgia','Courier','Trebuchet','Tahoma','Palatino'];
      if( in_array($font, $standard_fonts) ) {
        $flag = 'standard';
      } else {
        $flag = 'google';
      }
      return $flag;
    }

    function frontend_helper() {
      return MAJC_Frontend::get_instance();
    }
  
  }

  new MAJC_Frontend();
}