<?php
if ( ! function_exists('cortex_mce_editor_buttons') ) {
	function cortex_mce_editor_buttons( $buttons ) {

	    array_unshift( $buttons, 'styleselect' );
	    return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'cortex_mce_editor_buttons' );

if( ! function_exists('cortex_mce_before_init') ) {
	function cortex_mce_before_init( $settings ) {

	    $style_formats = array(
		    array(
				'title' => __('Theme Font Colors', 'cortex'),
				'items' => array(
				array(
					'title' => 'Accent Color',
					'inline'	=> 'span',
					'classes' => 'accent-color-text',
					'wrapper' => true
					),
				array(
					'title' => 'Dark Color',
					'inline'	=> 'span',
					'classes' => 'dark-color-text',
					'wrapper' => true
					),
				array(
					'title' => 'Light Color',
					'inline'	=> 'span',
					'classes' => 'light-color-text',
					'wrapper' => true
					),
				array(
					'title' => 'First Color',
					'inline'	=> 'span',
					'classes' => 'headline-color-text',
					'wrapper' => true
					),
				array(
					'title' => 'Second Color',
					'inline'	=> 'span',
					'classes' => 'secondary-color-text',
					'wrapper' => true
					),
				array(
					'title' => 'Third Color',
					'inline'	=> 'span',
					'classes' => 'third-color-text',
					'wrapper' => true
					) //end items
				) //end child menu
		    ), //end theme font colors
		    array(
		    	'title' => __('Theme Typography','cortex'),
		    	'items' => array(
				array(
		            'title' => 'Primary Font h1',
					'inline'	=> 'span',
		            'classes' => 'h1',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Primary Font h2',
					'inline'	=> 'span',
		            'classes' => 'h2',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Primary Font h3',
					'inline'	=> 'span',
		            'classes' => 'h3',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Primary Font h4',
					'inline'	=> 'span',
		            'classes' => 'h4',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Primary Font h5',
					'inline'	=> 'span',
		            'classes' => 'h5',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Primary Font h6',
					'inline'	=> 'span',
		            'classes' => 'h6',
		            'wrapper'		=> true
		            ),
				array(
		            'title' => 'Secondary Font h1',
					'inline'	=> 'span',
		            'classes' => 'subheading h1',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font h2',
					'inline'	=> 'span',
		            'classes' => 'subheading h2',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font h3',
					'inline'	=> 'span',
		            'classes' => 'subheading h3',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font h4',
					'inline'	=> 'span',
		            'classes' => 'subheading h4',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font h5',
					'inline'	=> 'span',
		            'classes' => 'subheading h5',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font h6',
					'inline'	=> 'span',
		            'classes' => 'subheading h6',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Accent Color h1',
					'inline'	=> 'span',
		            'classes' => 'subheading h1 accent-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Accent Color h2',
					'inline'	=> 'span',
		            'classes' => 'subheading h2 accent-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Accent Color h3',
					'inline'	=> 'span',
		            'classes' => 'subheading h3 accent-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Accent Color h4',
					'inline'	=> 'span',
		            'classes' => 'subheading h4 accent-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Accent Color h5',
					'inline'	=> 'span',
		            'classes' => 'subheading h5 accent-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Accent Color h6',
					'inline'	=> 'span',
		            'classes' => 'subheading h6 accent-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font First Color h1',
					'inline'	=> 'span',
		            'classes' => 'subheading h1 headline-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font First Color h2',
					'inline'	=> 'span',
		            'classes' => 'subheading h2 headline-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font First Color h3',
					'inline'	=> 'span',
		            'classes' => 'subheading h3 headline-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font First Color h4',
					'inline'	=> 'span',
		            'classes' => 'subheading h4 aheadline-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font First Color h5',
					'inline'	=> 'span',
		            'classes' => 'subheading h5 headline-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font First Color h6',
					'inline'	=> 'span',
		            'classes' => 'subheading h6 headline-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Second Color h1',
					'inline'	=> 'span',
		            'classes' => 'subheading h1 secondary-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Second Color h2',
					'inline'	=> 'span',
		            'classes' => 'subheading h2 secondary-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Second Color h3',
					'inline'	=> 'span',
		            'classes' => 'subheading h3 secondary-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Second Color h4',
					'inline'	=> 'span',
		            'classes' => 'subheading h4 secondary-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Second Color h5',
					'inline'	=> 'span',
		            'classes' => 'subheading h5 secondary-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Second Color h6',
					'inline'	=> 'span',
		            'classes' => 'subheading h6 secondary-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ), //end child item
		        array(
		            'title' => 'Secondary Font Third Color h1',
					'inline'	=> 'span',
		            'classes' => 'subheading h1 third-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Third Color h2',
					'inline'	=> 'span',
		            'classes' => 'subheading h2 third-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Third Color h3',
					'inline'	=> 'span',
		            'classes' => 'subheading h3 third-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Third Color h4',
					'inline'	=> 'span',
		            'classes' => 'subheading h4 third-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Third Color h5',
					'inline'	=> 'span',
		            'classes' => 'subheading h5 third-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ),
		        array(
		            'title' => 'Secondary Font Third Color h6',
					'inline'	=> 'span',
		            'classes' => 'subheading h6 third-color-text',
		            'block'	=> 'span',
		            'wrapper'		=> true
		            ) //end child item
		        ) //end child menu
		    ), //end typography
		    array(
		    	'title' => __('Large Buttons','cortex'),
		    	'items' => array(
					array(
			            'title' => 'Default/Accent',
			            'block' => 'a',
			            'classes' => 'btn btn-lg btn-default',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Primary',
			            'block' => 'a',
			            'classes' => 'btn btn-lg btn-primary',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Success',
			            'block' => 'a',
			            'classes' => 'btn btn-lg btn-success',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Info',
			            'block' => 'a',
			            'classes' => 'btn body-color-text btn-lg btn-info',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Warning',
			            'block' => 'a',
			            'classes' => 'btn btn-lg btn-warning',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Danger',
			            'block' => 'a',
			            'classes' => 'btn btn-lg btn-danger',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Link',
			            'block' => 'a',
			            'classes' => 'btn btn-lg btn-link',
			            'wrapper' => true
			        ), //end child item
			    ) //end child menu
			), //end large buttons
		    array(
		    	'title' => __('Medium Buttons','cortex'),
		    	'items' => array(
					array(
			            'title' => 'Default/Accent',
			            'block' => 'a',
			            'classes' => 'btn btn-md btn-default',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Primary',
			            'block' => 'a',
			            'classes' => 'btn btn-md btn-primary',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Success',
			            'block' => 'a',
			            'classes' => 'btn btn-md btn-success',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Info',
			            'block' => 'a',
			            'classes' => 'btn body-color-text btn-md btn-info',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Warning',
			            'block' => 'a',
			            'classes' => 'btn btn-md btn-warning',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Danger',
			            'block' => 'a',
			            'classes' => 'btn btn-md btn-danger',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Link',
			            'block' => 'a',
			            'classes' => 'btn btn-md btn-link',
			            'wrapper' => true
			        ), //end child item
			    ) //end child menu
			), //end md buttons
		    array(
		    	'title' => __('Small Buttons','cortex'),
		    	'items' => array(
					array(
			            'title' => 'Default/Accent',
			            'block' => 'a',
			            'classes' => 'btn btn-sm btn-default',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Primary',
			            'block' => 'a',
			            'classes' => 'btn btn-sm btn-primary',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Success',
			            'block' => 'a',
			            'classes' => 'btn btn-sm btn-success',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Info',
			            'block' => 'a',
			            'classes' => 'btn body-color-text btn-sm btn-info',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Warning',
			            'block' => 'a',
			            'classes' => 'btn btn-sm btn-warning',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Danger',
			            'block' => 'a',
			            'classes' => 'btn btn-sm btn-danger',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Link',
			            'block' => 'a',
			            'classes' => 'btn btn-sm btn-link',
			            'wrapper' => true
			        ), //end child item
			    ) //end child menu
			), //end sm buttons
		    array(
		    	'title' => __('Mini Buttons','cortex'),
		    	'items' => array(
					array(
			            'title' => 'Default/Accent',
			            'block' => 'a',
			            'classes' => 'btn btn-xs btn-default',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Primary',
			            'block' => 'a',
			            'classes' => 'btn btn-xs btn-primary',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Success',
			            'block' => 'a',
			            'classes' => 'btn btn-xs btn-success',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Info',
			            'block' => 'a',
			            'classes' => 'btn body-color-text btn-xs btn-info',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Warning',
			            'block' => 'a',
			            'classes' => 'btn btn-xs btn-warning',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Danger',
			            'block' => 'a',
			            'classes' => 'btn btn-xs btn-danger',
			            'wrapper' => true
			        ), //end child item
					array(
			            'title' => 'Link',
			            'block' => 'a',
			            'classes' => 'btn btn-xs btn-link',
			            'wrapper' => true
			        ), //end child item
			    ) //end child menu
			), //end xs buttons
	    	array(
		    	'title'	=> 'Action Link',
		    	'selector' => 'a',
		    	'classes' => 'action-link'
	    	), //end action link
			array(
		    	'title'	=> 'Image Lightbox Popup',
		    	'selector' => 'a',
		    	'classes' => 'cortex-popup'
	    	), //end popup
			array(
		    	'title'	=> 'YouTube/Vimeo/Maps Lightbox Popup',
		    	'selector' => 'a',
		    	'classes' => 'cortex-popup-video'
	    	), //end popup
	    	array(
		    	'title'	=> 'Light Font',
		    	'selector' => 'span',
		    	'classes' => 'light',
		    	'wrapper' => true
	    	), //end light
	    	array(
		    	'title'	=> 'Heavy Font',
		    	'selector' => 'span',
		    	'classes' => 'heavy',
		    	'wrapper' => true
	    	), //end heavy
	    );

	    $settings['style_formats'] = json_encode( $style_formats );

	    return $settings;
	}
}
add_filter( 'tiny_mce_before_init', 'cortex_mce_before_init' );
?>