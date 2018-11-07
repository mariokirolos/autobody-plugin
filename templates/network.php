<div class="wrap">
	<h1><?php _e('Autobody Network Settings','autobody-plugin'); ?></h1>
	 <?php if ( $this->updated ) : ?>
        <div class="updated notice is-dismissible">
            <p><?php _e('Settings updated successfully!', 'autobody-plugin'); ?></p>
            </div>
    <?php endif; ?>
	<form method="POST" <?php echo admin_url('admin-post.php?action=Autobody_Network'); ?> >
		
		<table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><?php _e('Search','autobody-plugin'); ?></th>
                <td>
					<div class="ui-toggle">
						<input type='checkbox' id="autobody_search" name='autobody_search' value='1' <?php checked( $autobody_search, '1' ); ?> /><label for="autobody_search"><div></div></label>
					</div>
                    <p class="description"><?php _e('This checkbox will allow or disallow the option for all the websites at once, in order to remove certain website you will need to go to that website and disable it from there','my-plugin'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('OCR','autobody-plugin'); ?></th>
                <td>
					<div class="ui-toggle">
						<input type='checkbox' id="autobody_ocr" name='autobody_ocr' value='1' <?php checked( $autobody_ocr, '1' ); ?> /><label for="autobody_ocr"><div></div></label>
					</div>
                    <p class="description"><?php _e('This checkbox will allow or disallow the option for all the websites at once, in order to remove certain website you will need to go to that website and disable it from there','my-plugin'); ?></p>
                </td>
            </tr>
            
            <tr>
                <th scope="row"><?php _e('OCR API Key','autobody-plugin'); ?></th>
                <td>
					<div class="">
						<input type='text' id="autobody_ocr_api" name='autobody_ocr_api' value='<?php print $ocr_key; ?>' /><label for="Autobody_OCR"><div></div></label>
					</div>
                    <p class="description"><?php _e('This API Key will be used for all websites unless certain website used it\'s own'); ?></p>
                </td>
            </tr>

            
        </tbody>
    </table>


		<?php 
			wp_nonce_field('AutobodyNetwork_nonce', 'AutobodyNetwork_nonce');
			submit_button();
		?>


	</form>

</div>