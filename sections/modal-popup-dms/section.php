<?php
/*
Section: Modal PopUp DMS
Author: MrFent
Author URI: http://www.MrFent.com
Demo: http://modal-popup-dms.MrFent.com
Description: Display an automatic PopUp window anywhere on your DMS website
Class Name: ModalPopUpDMS
Version: 1.0.0
Filter: component
PageLines: true
v3: true
*/

class ModalPopUpDMS extends PageLinesSection {
	
	function section_opts(){
		
		$opts = array(
			array(
				'type'					=> 'multi',
				'title' 				=> __( 'Modal Setup', 'modal-popup-dms' ),
				'opts'					=> array(
					array(
						'key'			=> 'mp_header_text',
						'type'			=> 'text',
						'label'			=> __( 'PopUp Header', 'modal-popup-dms' ),
					),
					array(
						'key'			=> 'mp_body_text',
						'type'			=> 'textarea',
						'help' 			=> __( 'You can use HTML and shortcodes', 'modal-popup-dms' ),
						'label'			=> __( 'PopUp Body', 'modal-popup-dms' ),
					),
					array(
						'key'			=> 'mp_page_id',
						'type'			=> 'select',
						'help' 			=> __( 'This will override the "<strong>PopUp Body</strong>" setting', 'modal-popup-dms' ),
						'label'			=> __( 'Select a page to use for your content instead', 'modal-popup-dms' ),
						'opts'			=> $this->get_pages_for_popup()
						),
					array(
						'key'			=> 'mp_remove_auto_formatting',
						'type'			=> 'check',
						'label'			=> __( 'Remove Auto Formatting', 'modal-popup-dms' )
						),
					array(
						'key'			=> 'mp_delay',	
						'type' 			=> 'text',
						'help' 			=> __( 'Set the PopUp delay. (How long after the page loads before the PopUp appears)<br /><br /><strong>Default Delay is 500 milliseconds</strong>', 'modal-popup-dms' ),
						'label'			=> __( 'Delay (In milliseconds)', 'modal-popup-dms' )
						),
					array(
						'key'			=> 'mp_width',
						'type' 			=> 'text',				
						'label'			=> __( 'Width % (Optional)', 'modal-popup-dms' )
						),
					array(
						'key'			=> 'mp_disable_automation',
						'type'			=> 'check',
						'help' 			=> __( 'This will prevent your PopUp from appearing automatically when the page loads. If checked, you must provide a <a href="http://modal-popup-dms.mrfent.com/extras/" target="_blank">manual trigger</a> to make the PopUp appear', 'modal-popup-dms' ),
						'label'			=> __( 'Disable Automation', 'modal-popup-dms' )
						))),
			array(
				'type'					=> 'multi',
				'title' 				=> __( 'Cookie Setup', 'modal-popup-dms' ),
				'opts'					=> array(
					array(
						'key'			=> 'welcome',			
						'type'			=> 'template',
						'title' 		=> __( 'Instructions', 'modal-popup-dms' ),
						'template'		=> __( '<div class="help-block">Set cookie expiration (Default is 1 hour)</div>', 'modal-popup-dms' ),
					),
					array(
						'key'			=> 'mp_expire_days',
						'type' 			=> 'text',
						'label'			=> __( 'Days', 'modal-popup-dms' )
					),
					array(
						'key'			=> 'mp_expire_hours',
						'type' 			=> 'text',
						'label'			=> __( 'Hours', 'modal-popup-dms' )
					),
					array(
						'key'			=> 'mp_expire_minutes',
						'type' 			=> 'text',
						'label'			=> __( 'Minutes', 'modal-popup-dms' )
					),			
					array(
						'key'			=> 'welcome',			
						'type'			=> 'template',
						'title' 		=> __( 'Instructions', 'modal-popup-dms' ),
						'template'		=> '<hr /><hr />'
					),				
					array(
						'key'			=> 'mp_session_cookie',
						'type'			=> 'check',
						'help' 			=> __( 'This will override any expiration times set above, and will make the cookie expire when the browser is closed', 'modal-popup-dms' ),
						'label'			=> __( 'Make Session Cookie instead', 'modal-popup-dms' )
						),
					array(
						'key'			=> 'mp_cookie_name',
						'type' 			=> 'text',				
						'help' 			=> __( 'Set a custom cookie name when you want to have different Modal PopUps on other pages of your website', 'modal-popup-dms' ),
						'label'			=> __( 'Custom Cookie Name (Optional)','modal-popup-dms' )
						),
					array(
						'key'			=> 'mp_cookie_check',
						'type'			=> 'check',
						'help' 			=> __( 'Modal PopUp will check to see if a browser accepts cookies. If cookies are disabled, by default the PopUp will not appear. This setting will override that, meaning that if your visitor has cookies disabled, the PopUp <strong><em>will</em></strong> appear every time the page is visited or refreshed.', 'modal-popup-dms' ),
						'label'			=> __( 'Force PopUp on browsers that have cookies disabled', 'modal-popup-dms' )
						))),
			array(
				'type'					=> 'multi',
				'title' 				=> __( 'Close Button', 'modal-popup-dms' ),
				'opts'					=> array(
					array(
						'key'			=> 'mp_close_button_class',
						'type'			=> 'select',
						'label'			=> __( 'Select Button Color', 'modal-popup-dms' ),
						'default'		=>	'btn-primary',
						'opts'			=> array(
						'btn-reverse'	=> array("name" => __( 'Grey', 'modal-popup-dms' )),
						'btn-primary'	=> array("name" => __( 'Dark Blue', 'modal-popup-dms' )),
						'btn-info'		=> array("name" => __( 'Light Blue', 'modal-popup-dms' )),
						'btn-success'	=> array("name" => __( 'Green', 'modal-popup-dms' )),
						'btn-warning'	=> array("name" => __( 'Orange', 'modal-popup-dms' )),
						'btn-important'	=> array("name" => __( 'Red', 'modal-popup-dms' )),
						'btn-inverse'	=> array("name" => __( 'Black', 'modal-popup-dms' )),										
						)),	
					array(
						'key'			=> 'mp_close_button_text',
						'type' 			=> 'text',
						'label' 		=> __( 'Button Text (Default is "Close")', 'modal-popup-dms' )
						),
					array(
						'key'			=> 'mp_button_alignment',
						'type' 			=> 'select',
						'label' 		=> __( 'Button Alignment', 'modal-popup-dms' ),
						'default'		=> 'right',
						'opts'			=> array(
								'right'	=> array("name" => __( 'Right', 'modal-popup-dms' )),
								'left'	=> array("name" => __( 'Left', 'modal-popup-dms' )),
								'center'=> array("name" => __( 'Center', 'modal-popup-dms' ))												
						)))),
			array(
				'type'					=> 'multi',
				'title' 				=> __( 'Call to Action Button', 'modal-popup-dms' ),
				'opts'					=> array(
					array(
						'key'			=> 'mp_add_action_button',
						'type'			=> 'check',
						'label'			=> __( 'Add Call to Action Button', 'modal-popup-dms' )
						),	
					array(
						'key'			=> 'mp_action_button_class',
						'type'			=> 'select',
						'label'			=> __( 'Select Button Color', 'modal-popup-dms' ),
						'default'		=> 'btn-reverse',
						'opts'			=> array(
						'btn-reverse'	=> array("name" => __( 'Grey', 'modal-popup-dms' )),
						'btn-primary'	=> array("name" => __( 'Dark Blue', 'modal-popup-dms' )),
						'btn-info'		=> array("name" => __( 'Light Blue', 'modal-popup-dms' )),
						'btn-success'	=> array("name" => __( 'Green', 'modal-popup-dms' )),
						'btn-warning'	=> array("name" => __( 'Orange', 'modal-popup-dms' )),
						'btn-important'	=> array("name" => __( 'Red', 'modal-popup-dms' )),
						'btn-inverse'	=> array("name" => __( 'Black', 'modal-popup-dms' )),										
						)),	
					array(
						'key'			=> 'mp_action_button_text',
						'type' 			=> 'text',
						'label' 		=> __( 'Button Text (Default is "Learn More")', 'modal-popup-dms' )
						),
					array(
						'key'			=> 'mp_action_button_url',
						'type' 			=> 'text',
						'label' 		=> __( 'Button Link URL (Don&#39;t forget to add "http://")', 'modal-popup-dms' )
						),
					array(
						'key'			=> 'mp_action_button_target',
						'type'			=> 'check',
						'label'			=> __( 'Open link in new window', 'modal-popup-dms' )
						),
					array(
						'key'			=> 'mp_button_swap',
						'type'			=> 'check',
						'label'			=> __( 'Swap button position', 'modal-popup-dms' )
						))),
			array(
				'type'					=> 'multi',
				'title' 				=> __( 'Modal PopUp Colors', 'modal-popup-dms' ),
				'opts'					=> array(	
					array(
						'key'			=> 'mp_header_background_color',		
						'type'			=> 'color',
						'label' 		=> __( 'Header Background', 'modal-popup-dms' ),	
						'default'		=> ''					
						),
					array(	
						'key'			=> 'mp_body_background_color',		
						'type'			=> 'color',
						'label' 		=> __( 'Body Background', 'modal-popup-dms' ),	
						'default'		=> ''					
						),
					array(	
						'key'			=> 'mp_footer_background_color',		
						'type'			=> 'color',	
						'label' 		=> __( 'Footer Background', 'modal-popup-dms' ),
						'default'		=> ''					
						),		
					array(	
						'key'			=> 'mp_header_text_color',		
						'type'			=> 'color',	
						'label' 		=> __( 'Header Text', 'modal-popup-dms' ),	
						'default'		=> ''				
						),
					array(	
						'key'			=> 'mp_body_text_color',		
						'type'			=> 'color',	
						'label' 		=> __( 'Body Text', 'modal-popup-dms' ),	
						'default'		=> ''
						),
					array(		
						'key'			=> 'mp_backdrop_color',		
						'type'			=> 'color',
						'label' 		=> __( 'Backdrop', 'modal-popup-dms' ),	
						'help'			=> __( 'You can change the default dark backdrop to any color you want, but note that this will also change the backdrop color of any regular modals that you may have on this page/post.'),
						'default'		=> ''
						))));
		return $opts;
	}
	function section_scripts() {
		if ( !$this->opt('mp_disable_automation' ))
		wp_enqueue_script( 'modal-popup-jquery-cookie',$this->base_url . '/jquery.cookie.js', array( 'jquery' ) );
	}
	function section_head(){
		$modal_popup_width_percentage = str_replace(array(' '), array(), ($this->opt('mp_width')) ? $this->opt('mp_width') : '');
		$modal_popup_width_percentage = preg_replace(array('/[^0-9]/'), array(''), $modal_popup_width_percentage );
		$modal_popup_margin_percentage = (100 - $modal_popup_width_percentage) / 2;
		if($this->opt('mp_width')){$ModalPopupWidth = sprintf( '@media (min-width: 768px) {#ModalPopUp.modal {width:%s%s;left:auto;margin-left:%s%s;}}', $modal_popup_width_percentage, '%', $modal_popup_margin_percentage, '%' );}else{$ModalPopupWidth ='';}
		$modal_popup_body_background_color = str_replace(array('#'), array(), ($this->opt('mp_body_background_color')) ? $this->opt('mp_body_background_color') : 'ffffff');
		if($this->opt('mp_body_background_color')){$modal_popup_body_background_css = sprintf( '#ModalPopUp .modal-body {background-color:#%s;}', $modal_popup_body_background_color );}else{$modal_popup_body_background_css ='';}
		$modal_popup_footer_background_color = str_replace(array('#'), array(), ($this->opt('mp_footer_background_color')) ? $this->opt('mp_footer_background_color') : 'F2F2F2');
		if($this->opt('mp_footer_background_color')){$modal_popup_footer_background_css = sprintf( '#ModalPopUp .modal-footer {background-color:#%s;border-top-color:#%s;box-shadow:inset 0 1px 0 #%s;}', $modal_popup_footer_background_color, $modal_popup_footer_background_color, $modal_popup_body_background_color );}else{$modal_popup_footer_background_css ='';}
		$modal_popup_header_background_color = str_replace(array('#'), array(), ($this->opt('mp_header_background_color')) ? $this->opt('mp_header_background_color') : 'ffffff');
		if($this->opt('mp_header_background_color')){$modal_popup_header_background_css = sprintf( '#ModalPopUp .modal-header {background-color:#%s;border-color:#%s;}', $modal_popup_header_background_color, $modal_popup_footer_background_color );}else{$modal_popup_header_background_css ='';}
		$modal_popup_header_text_color = str_replace(array('#'), array(), ($this->opt('mp_header_text_color')) ? $this->opt('mp_header_text_color') : '000000');
		if($this->opt('mp_header_text_color')){$modal_popup_header_text_css = sprintf( '#ModalPopUp .modal-header h1 {color:#%s;}', $modal_popup_header_text_color );}else{$modal_popup_header_text_css ='';}
		$modal_popup_body_text_color = str_replace(array('#'), array(), ($this->opt('mp_body_text_color')) ? $this->opt('mp_body_text_color') : '777777');
		if($this->opt('mp_body_text_color')){$modal_popup_body_text_css = sprintf( '#ModalPopUp .modal-body, #ModalPopUp .modal-body h1, #ModalPopUp .modal-body h2, #ModalPopUp .modal-body h3, #ModalPopUp .modal-body h4, #ModalPopUp .modal-body h5, #ModalPopUp .modal-body h6 {color:#%s;}', $modal_popup_body_text_color );}else{$modal_popup_body_text_css ='';}
		$modal_popup_backdrop_color = str_replace(array('#'), array(), ($this->opt('mp_backdrop_color')) ? $this->opt('mp_backdrop_color') : '000000');
		if($this->opt('mp_backdrop_color')){$modal_popup_backdrop_css = sprintf( '.modal-backdrop {background-color:#%s;}', $modal_popup_backdrop_color );}else{$modal_popup_backdrop_css ='';}
		$modal_popup_style = sprintf( '<style>%s%s%s%s%s%s%s</style>', $ModalPopupWidth, $modal_popup_header_background_css, $modal_popup_body_background_css, $modal_popup_footer_background_css, $modal_popup_header_text_css, $modal_popup_body_text_css, $modal_popup_backdrop_css );
		if($this->opt('mp_width') || $this->opt('mp_header_background_color') || $this->opt('mp_body_background_color') || $this->opt('mp_footer_background_color') || $this->opt('mp_header_text_color') || $this->opt('mp_body_text_color') || $this->opt('mp_backdrop_color')){echo $modal_popup_style;}
	}
	function section_template(){
		echo __( '<div class="alert pl-editor-only"><strong>Admin Notice:</strong><br />This is the placeholder for your Modal PopUp section. Visitors will not see this.</div>', 'modal-popup-dms' );

		$modal_popup_post_id = ($this->opt('mp_page_id')) ? $this->opt('mp_page_id') : '1';
		$modal_popup_queried_post = get_post($modal_popup_post_id);
		$modal_popup_delay = str_replace(array(' '), array(), ($this->opt('mp_delay')) ? $this->opt('mp_delay') : '500');
		$modal_popup_delay = preg_replace(array('/[^0-9]/'), array(''), $modal_popup_delay );
		if($this->opt('mp_expire_days') || $this->opt('mp_expire_minutes')){$default_expire_hours = 0;}else{$default_expire_hours = 1;}
		$modal_popup_expire_days = ( $this->opt('mp_expire_days') ) ? $this->opt('mp_expire_days') : 0;
		$modal_popup_expire_days = preg_replace(array('/[^0-9.]/'), array(''), $modal_popup_expire_days );
		$modal_popup_expire_hours = ( $this->opt('mp_expire_hours') ) ? $this->opt('mp_expire_hours') : $default_expire_hours;
		$modal_popup_expire_hours = preg_replace(array('/[^0-9.]/'), array(''), $modal_popup_expire_hours );
		$modal_popup_expire_minutes = ( $this->opt('mp_expire_minutes') ) ? $this->opt('mp_expire_minutes') : 0;
		$modal_popup_expire_minutes = preg_replace(array('/[^0-9.]/'), array(''), $modal_popup_expire_minutes );
		$modal_popup_expire_mode_front = sprintf( 'var date = new Date();
			var days = %s; 
			var hours = %s; 
			var minutes = %s; 
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000) + (hours * 60 * 60 * 1000) + (minutes * 60 * 1000));	
			', $modal_popup_expire_days, $modal_popup_expire_hours, $modal_popup_expire_minutes );
		$modal_popup_expire_mode_back = 'expires: date, ';
		$modal_popup_cookie_name = str_replace(array(' '), array('_'), ($this->opt('mp_cookie_name')) ? $this->opt('mp_cookie_name') : 'Cookie');
		$modal_popup_cookie = 'Modal_PopUp_' . $modal_popup_cookie_name;			
		$modal_popup_cookie_check_front = "jQuery.cookie('MP_Cookie_Test', 'Check_if_cookies_are_enabled', { path: '/' }); if(jQuery.cookie('MP_Cookie_Test') != null) {";
		$modal_popup_cookie_check_back = "} jQuery.removeCookie('MP_Cookie_Test', { path: '/' });";
		$modal_popup_close_button_class = ($this->opt('mp_close_button_class')) ? $this->opt('mp_close_button_class') : 'btn-primary';
		$modal_popup_close_button_text = ($this->opt('mp_close_button_text')) ? $this->opt('mp_close_button_text') : 'Close';
		$close = sprintf( '<button class="btn %s" data-dismiss="modal" aria-hidden="true">%s</button>', $modal_popup_close_button_class, $modal_popup_close_button_text);
 		$modal_popup_action_button_url = ($this->opt('mp_action_button_url')) ? $this->opt('mp_action_button_url') : '#';
		$modal_popup_action_button_class = ($this->opt('mp_action_button_class')) ? $this->opt('mp_action_button_class') : 'btn-reverse';
		$model_popup_action_button_text = ($this->opt('mp_action_button_text')) ? $this->opt('mp_action_button_text') : 'Learn More';
		if ($this->opt('mp_action_button_target')) { $target_blank = ' target="_blank"'; }else{ $target_blank = ''; }
		$call = sprintf( '<a href="%s" class="btn %s"%s>%s</a>', $modal_popup_action_button_url, $modal_popup_action_button_class, $target_blank, $model_popup_action_button_text );
		$modal_popup_button_alignment = ($this->opt('mp_button_alignment')) ? $this->opt('mp_button_alignment') : 'right';
		$modal_popup_footer = sprintf( '<div class="modal-footer" style="text-align: %s;">', $modal_popup_button_alignment );		
		$default_header_text = __( 'Modal Popup', 'modal-popup-dms' );
		if ((!$this->opt('mp_header_text')) && ($this->opt('mp_page_id'))) 	
		$default_header_text = apply_filters('the_title', $modal_popup_queried_post->post_title);					
		$modal_header = ($this->opt('mp_header_text')) ? $this->opt('mp_header_text') : $default_header_text;		
		if ($this->opt('mp_page_id')) {		
		$modal_body = apply_filters('the_content', $modal_popup_queried_post->post_content);
		if ($this->opt('mp_remove_auto_formatting'))
		$modal_body = do_shortcode($modal_popup_queried_post->post_content);

		} else {
		$default_body_text = __( '<div class="row"><div class="span7"><h6 style="font-size:16px;">You can easily create your own Modal PopUps in the DMS Section Options.</h6><h6 style="font-size:16px;">Just enter a title, some content, and then configure your other options, such as Cookie Setup, Call to Action button, and Color Control.</h6><h6 style="font-size:16px;">You can also use a page for your PopUp content if you prefer. Just select your page from the drop-down, and that page&#39;s content will appear in your PopUp.</h6>&nbsp;<p style="text-align:center;">[pl_button type="inverse" link="http://modal-popup-dms.mrfent.com" target="blank" size="large"]Learn More <em class="icon-chevron-sign-right"></em>[/pl_button]</p></div><div class="span5"><p style="text-align:center;"><em style="font-size:245px; color:#3c99ff;" class="icon-pagelines"></em></p></div></div>', 'modal-popup-dms' );
		$modal_body = ($this->opt('mp_body_text')) ? wpautop($this->opt('mp_body_text')) : do_shortcode($default_body_text);
		if ($this->opt('mp_remove_auto_formatting')) 	
		$modal_body = ($this->opt('mp_body_text')) ? $this->opt('mp_body_text') : do_shortcode($default_body_text);
		}
		if ( !$this->opt('mp_disable_automation' )) {?>
		<script type = "text/javascript">
		<?php if ( !$this->opt('mp_cookie_check' )) {echo $modal_popup_cookie_check_front;} ?>
		if(jQuery.cookie('<?php echo $modal_popup_cookie; ?>') == null) { 
		jQuery(document).ready(function(){
			setTimeout(function(){
			jQuery('#ModalPopUp').modal('show');
		},<?php echo $modal_popup_delay?>);
		});	
		<?php if (!$this->opt('mp_session_cookie')){echo $modal_popup_expire_mode_front;} ?>
jQuery.cookie('<?php echo $modal_popup_cookie; ?>', 'Modal_Popup_for_DMS', { <?php if (!$this->opt('mp_session_cookie')){echo $modal_popup_expire_mode_back;} ?>path: '/' });
		}
		<?php if ( !$this->opt('mp_cookie_check') ) {echo $modal_popup_cookie_check_back;} ?>
		</script>
		<?php } ?>
		<script type='text/javascript'>
			jQuery(document).ready(function(){
				jQuery('.modal').appendTo(jQuery('body'));
				jQuery('#ModalPopUp .modal-body').css({ 'max-height': ((jQuery(window).height()) - 337) + 'px' });
				jQuery(window).resize(function () {
					jQuery('#ModalPopUp .modal-body').css({ 'max-height': ((jQuery(window).height()) - 337) + 'px' });
				});
			});
		</script> 
		<?php printf( '<div id="ModalPopUp" class="modal hide fade"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h1>%s</h1></div><div class="modal-body">%s</div><div class="modal-footer" style="text-align: %s;">', $modal_header, $modal_body, $modal_popup_button_alignment );
					if ($this->opt('mp_add_action_button') && $this->opt('mp_button_swap')) echo $call;
					echo $close;
					if ($this->opt('mp_add_action_button') && !$this->opt('mp_button_swap')) echo $call;?></div></div><?php 
	}	
	function get_pages_for_popup(){
		$args = array(	'sort_order' => 'ASC',
						'sort_column' => 'post_title');
		$pages = get_pages($args);
		$out = array();
		foreach ($pages as $page) {
			$out[$page->ID] = array('name' => $page->post_title);
		}
		return $out;
	}
}