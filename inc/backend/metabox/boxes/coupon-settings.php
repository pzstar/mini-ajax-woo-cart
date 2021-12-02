<div id="coupon-settings" class="tab-content" style="display: none;">
	<div class="majc-settings-field-wrap">
		<h2><?php esc_html_e('Coupon Settings', 'mini-ajax-cart'); ?></h2>

		<div class="majc-settings-field">
			<label><?php esc_html_e('Enable Coupon Field', 'mini-ajax-cart'); ?></label>

			<div class="majc-settings-input-field">
				<input type="checkbox" name="majc_settings[coupon][enable]" <?php if(isset($coupon['enable'])) { checked( $coupon['enable'], 'on', true ); } ?>>
			</div>
		</div>

		<div class="majc-settings-field">
			<label><?php esc_html_e('Apply Coupon Button Label', 'mini-ajax-cart'); ?></label>

			<div class="majc-settings-input-field">
				<input type="text" name="majc_settings[coupon][button_text]" value="<?php echo isset($coupon['button_text']) ? esc_html($coupon['button_text']) : null; ?>">
			</div>
		</div>

		<div class="majc-settings-field">
			<label><?php esc_html_e('Promo Code Placeholder', 'mini-ajax-cart'); ?></label>

			<div class="majc-settings-input-field">
				<input type="text" name="majc_settings[coupon][promocode_placeholder]" value="<?php echo isset($coupon['promocode_placeholder']) ? esc_html($coupon['promocode_placeholder']) : null; ?>">
			</div>
		</div>
	</div>
</div>