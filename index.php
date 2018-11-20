<?php
add_shortcode('crcontact', 'crcontact_func');
function crcontact_func($atts, $content = null) { // New function parameter $content is added!
    extract(shortcode_atts(array(
      'textblock' => 'Textblock',
   ), $atts));
  
    $output ="<div class='wpb_column grve-column-1-4' style='padding-top: 45px !important;padding-bottom: 0px !important;padding-left: 0px !important;'>
                        <div class='grve-element grve-box-icon grve-align-center' style='margin-bottom: 0px;'>
                                <a href='mailto:r.seitz@concrete-rudolph.de' target=' _blank'>
                                        <div class='grve-icon grve-medium grve-simple grve-no-shape grve-color-primary-3 fa fa-user'></div>
                                </a>
                                <div class='grve-box-content'>  </div>
                        </div>
                </div>
                <div class='wpb_column grve-column-1-2' style='padding-top: 30px !important;padding-bottom: 30px !important;padding-left: 0px !important;'>
                        <div class='cr_container grve-element grve-text cr_light'>
                                <h4><span style='color: #999999;'>Haben Sie Fragen zu unseren Produkten?<br /> +49 · 8384 · 8210 · 21</span></h4>
                        </div>
                </div>
                <div class='wpb_column grve-column-1-4' style='padding-top: 45px !important;padding-bottom: 0px !important;'>
                        <div class='cr_container grve-element grve-text cr_light'>
                                <h3 style='text-align: center;'><span style='color: #a1a5a7;'><a style='color: #a1a5a7;' href='mailto:r.seitz@concrete-rudolph.de' target='_blank'>KONTAKT</a></span></h3>
                        </div>
                </div>";
    return $output;
}

/* Ausgabe Frontend: Box1 - Box mit Bild (unten) */
add_shortcode("box_1", "renderShortcode");
function renderShortcode($atts) {
    $a = shortcode_atts(array(
        'title' => 'Title',
        'textblock' => 'Textblock',
        'link' => 'Link',
        'image'   => 'Image',
        'hoehe'   => 'Hoehe',
        'klasse'   => 'cr_wo_box2',
        'einblenden'   => 'cr_vis',
   ), $atts);

    $raw_image = new WP_Query(array('post_type' => 'attachment', 'attachment_id' => $a['image']));
    $image_url = $raw_image->posts[0]->guid;


    $img = wp_get_attachment_image_src($a["image"], "large");
    $imgSrc = $img[0];
    $href = vc_build_link($a['link']);

    $output = "
				<div class='grve-element grve-text {$a['klasse']}'>
				<div class='cr_triangle'></div>
					<h3>{$a['title']}</h3>
					<div class='cr_textblock_inner' style='height:{$a['hoehe']};'>
						{$a['textblock']}
					</div>
					<a class='cr_boxlink_more {$a['einblenden']}' href='{$href['url']}' title='{$a['title']}'>mehr</a>
				
				</div>
				<div class='grve-element grve-box grve-align-left grve-animated-item fadeInUp animated cr_bildunten'>
					<div class='grve-media cr_box_media_down'>
						<a href='{$href['url']}' title='{$a['title']}'><img alt='{$a['title']}' src='{$imgSrc}'></a>
					</div>
				</div>
				<div class='clear'></div>
				";
    return $output;
}

/* Ausgabe Frontend: Box2 - Box mit Bild (rechts) */
add_shortcode("box_2", "renderShortcode2");
function renderShortcode2($atts) {
    $a = shortcode_atts(array(
        'title' => 'Title',
        'textblock' => 'Textblock',
        'link' => 'Link',
        'image'   => 'Image',
        'klasse'   => 'cr_wo_box2',
        'einblenden'   => 'cr_vis',
   ), $atts);

    $raw_image = new WP_Query(array('post_type' => 'attachment', 'attachment_id' => $a['image']));
    $image_url = $raw_image->posts[0]->guid;


    $img = wp_get_attachment_image_src($a["image"], "large");
    $imgSrc = $img[0];
    $href = vc_build_link($a['link']);

    if ((strpos($href['url'], 'http') === false) || (strpos($href['url'], '//') === false)) {
        $location = '/'.ICL_LANGUAGE_CODE;
    }

    if ($href['title'] !== '' && $href['title']) {
        $hTitle = $href['title'];
    } else {
        $hTitle = 'mehr';
    }

    if ($href['target'] !== '' && $href['target']) {
        $target = 'target="'.$href['target'].'"';
    } else {
        $target = '';
    }

    $output = "
    		<div class='cr_lebo cr_textlinks grve-element grve-text {$a['klasse']}'>
    		<div class='cr_triangle'></div>
    			
    			<div class='cr_textlinks_inner'>
    				<h3>{$a['title']}</h3>
    				<div class='cr_textblock_inner'>
    					{$a['textblock']}
    				</div>
    				<a class='cr_boxlink_more {$a['einblenden']}' href='{$location}{$href['url']}' {$target} title='{$a['title']}'>".__($hTitle)."</a>
    			</div>
    			
    			<div class='grve-element grve-box grve-align-left grve-animated-item fadeInUp animated cr_bildrechts'>
    				<div class='grve-media'>";
    /* if link visible -> show image link  */

    if(isset($a['einblenden'])){
            if ($a['einblenden'] != 'cr_none') {
                    $output .= "<a href='{$href['url']}' title='{$a['title']}'><img alt='{$a['title']}' src='{$imgSrc}'></a>";}
            else { 
                    $output .= "<img alt='{$a['title']}' src='{$imgSrc}'>"; }}

    $output .= "
    					
    				</div>
    			</div>
    		
    		</div>
    		<div class='clear'></div>
    	
    		";

    return $output;
}

/* Ausgabe Frontend: Box4 - Box mit Bild (links) */
add_shortcode("box_4", "renderShortcode4");
function renderShortcode4($atts) {
    $a = shortcode_atts(array(
        'title' => 'Title',
        'textblock' => 'Textblock',
        'link' => 'Link',
        'image'   => 'Image',
        'klasse'   => 'cr_wo_box2',
        'einblenden'   => 'cr_vis',
   ), $atts);

    $raw_image = new WP_Query(array('post_type' => 'attachment', 'attachment_id' => $a['image']));
    $image_url = $raw_image->posts[0]->guid;


    $img = wp_get_attachment_image_src($a["image"], "large");
    $imgSrc = $img[0];
    $href = vc_build_link($a['link']);

    if ((strpos($href['url'], 'http') === false) || (strpos($href['url'], '//') === false)) {
        $location = '/'.ICL_LANGUAGE_CODE;
    }

    if ($href['title'] !== '' && $href['title']) {
        $hTitle = $href['title'];
    } else {
        $hTitle = 'mehr';
    }

    if ($href['target'] !== '' && $href['target']) {
        $target = 'target="'.$href['target'].'"';
    } else {
        $target = '';
    }

    

    $output = "<div class='cr_lebo cr_textlinks grve-element grve-text {$a['klasse']}'>";

    $output .= "<div class='grve-element grve-box grve-align-left grve-animated-item fadeInUp animated cr_bildlinks'>
                <div class='grve-media'>";
                /* if link visible -> show image link  */

                if(isset($a['einblenden'])){
                        if ($a['einblenden'] != 'cr_none') {
                                $output .= "<a href='{$href['url']}' title='{$a['title']}'><img alt='{$a['title']}' src='{$imgSrc}'></a>";}
                        else { 
                                $output .= "<img alt='{$a['title']}' src='{$imgSrc}'>"; }}
            $output .= " </div></div>
            <div class='cr_triangle'></div>
                
            <div class='cr_textlinks_inner'>
                <h3>{$a['title']}</h3>
                <div class='cr_textblock_inner'>
                    {$a['textblock']}
                </div>
                <a class='cr_boxlink_more {$a['einblenden']}' href='{$location}{$href['url']}' {$target} title='{$a['title']}'>".__($hTitle)."</a>
            </div>
            </div>
            <div class='clear'></div>";

    return $output;
}

add_shortcode("box_3", "renderShortcode3");
function renderShortcode3($atts) {
    $a = shortcode_atts(array(
    'title' => 'Title',
    'textblock' => 'Textblock',
    'link' => 'Link',
    'image'   => 'Image',
    'klasse'   => 'cr_wo_box2',
    'einblenden'   => 'cr_vis',

   ), $atts);

    $raw_image = new WP_Query(array('post_type' => 'attachment', 'attachment_id' => $a['image']));
    $image_url = $raw_image->posts[0]->guid;


    $img = wp_get_attachment_image_src($a["image"], "large");
    $imgSrc = $img[0];
    $href = vc_build_link($a['link']);

    $location = '/'.ICL_LANGUAGE_CODE;

    $output = "
        <div class='grve-element grve-text {$a['klasse']}'>
            <div class='cr_triangle'></div>
                    <div class='cr_text_bildhinten'>
                    <h3>{$a['title']}</h3>
                    <div class='cr_textblock_inner'>
                            {$a['textblock']}
                    </div>
                    <a class='cr_boxlink_more {$a['einblenden']}' href='{$location}{$href['url']}' title='{$a['title']}'>".__('mehr')."</a>		
            </div>
            
            <div class='grve-animated-item fadeInUp animated cr_bildhinten'>
                    <div class='grve-media'>
                            <a href='{$href['url']}' title='{$a['title']}'><img alt='{$a['title']}' src='{$imgSrc}'></a></div>
                    </div>
            </div>
        <div class='clear'></div>";

      return $output;
}


add_action('vc_before_init', 'your_name_integrateWithVC');

function your_name_integrateWithVC() {
   vc_map(array(
        "name" => __("Kontakt - Produktfragen", "my-text-domain"),
        "description" => __("Kontaktanfrage mit Icon und Email", 'Meine Shortcodes'),      
        "base" => "crcontact",
        "class" => "",
        "category" => __('Meine Shortcodes', 'Meine Shortcodes'),
        "params" => array(
                array(
                    "type" => "textarea_html",
                    "heading" => __("Texbereich", "Meine Shortcodes"),
                    "param_name" => "textblock",
                    "description" => __("Bitte Text eingeben", "Meine Shortcodes"),
                    "value" => __("Haben Sie Fragen zu unseren Produkten?<br /> +49 · 8384 · 8210 · 21", 'Meine Shortcodes'),
                    "admin_label" => true,
               ),
     )
  ));
}

/* Eingabe Backend für: Box1 - Box mit Bild (unten) */
vc_map(array(
    "name" => __("Box mit Bild (unten)", 'Meine Shortcodes'),
    "description" => __("Eine Textbox mit Bild und Verlinkung", 'Meine Shortcodes'),
    "base" => "box_1",
    "icon" => plugins_url('assets/icons/icon.png', __FILE__), 
    "category" => __('Meine Shortcodes', 'Meine Shortcodes'),
    "params" => array(

					
                    array(
                            "type" => "textfield",
                            "heading" => __("Titel", "Meine Shortcodes"),
                            "param_name" => "title",
                            "description" => __("Bitte Titel eingeben", "Meine Shortcodes"),
                            "value" => __("Lorem Ipsum Dolr it", 'Meine Shortcodes'),
                            "admin_label" => true,
                   ),
                    
                        array(
                            "type" => "textarea_html",
                            "heading" => __("Texbereich", "Meine Shortcodes"),
                            "param_name" => "textblock",
                            "description" => __("Bitte Text eingeben", "Meine Shortcodes"),
                            "value" => __("Lorem Ipsum Dolr it", 'Meine Shortcodes'),
                            "admin_label" => true,
                   ),
                    
					array(
                            "type" => "textfield",
                            "heading" => __("Höhe des Textfeldes", "Meine Shortcodes"),
                            "param_name" => "hoehe",
                            "description" => __("Bitte Höhe des Textbereiches eingeben; Z.B. 300px. (wenn Feld leer, dann Auto-Höhe)", "Meine Shortcodes"),
                            "value" => __("", 'Meine Shortcodes'),
                            "admin_label" => true,
                   ),
												
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Bild", 'Meine Shortcodes'),
                        "param_name" => "image",
                        "description" => __("Bitte immer eine feste Größe verwenden", 'Meine Shortcodes')
                   ),               

                    array(
                        "type" => "dropdown",
                        "value"       => array(
                        'Ohne Stil'   => '',
         				'Box mit Rand'   => 'cr_box',
				        'Box ohne Rand'   => 'cr_wo_box',
				
				      	),
				      
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Klasse", 'Meine Shortcodes'),
                        "param_name" => "klasse",
                        "description" => __("Klasse", 'Meine Shortcodes')
                   ),
                    
					                            /* Dropdown-Menu um Verlinkung ein und auszublenden */
                  array(
                        "type" => "dropdown",
                        "value"       => array(
                        'Ja'   => '',
         				'Nein'   => 'cr_none',
				
				      	),
				      
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Verlinkung einblenden?", 'Meine Shortcodes'),
                        "param_name" => "einblenden",
                        "description" => __("Einblenden", 'Meine Shortcodes')
                   ),
                    /* / Dropdown-Menu um Verlinkung ein und auszublenden */
                    
                    array(
                        "type" => "vc_link",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Verlinkung", 'Meine Shortcodes'),
                        "param_name" => "link",
                        "description" => __("Verlinkung", 'Meine Shortcodes')
                   ),


           )
));

/* Eingabe Backend für: Box 2 - Box mit Bild (rechts) */
vc_map(array(
    "name" => __("Box mit Bild (rechts)", 'Meine Shortcodes'),
    "description" => __("Eine Textbox mit Bild und Verlinkung2", 'Meine Shortcodes'),
    "base" => "box_2",
    "icon" => plugins_url('assets/icons/icon.png', __FILE__), 
    "category" => __('Meine Shortcodes', 'Meine Shortcodes'),
    "params" => array(

					
                    array(
                            "type" => "textfield",
                            "heading" => __("Titel", "Meine Shortcodes"),
                            "param_name" => "title",
                            "description" => __("Bitte Titel eingeben", "Meine Shortcodes"),
                            "value" => __("Lorem Ipsum Dolr it", 'Meine Shortcodes'),
                            "admin_label" => true,
                   ),
                    
					array(
                            "type" => "textarea_html",
                            "heading" => __("Texbereich", "Meine Shortcodes"),
                            "param_name" => "textblock",
                            "description" => __("Bitte Text eingeben", "Meine Shortcodes"),
                            "value" => __("Lorem Ipsum Dolr it", 'Meine Shortcodes'),
                            "admin_label" => true,
                   ),
												
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Bild", 'Meine Shortcodes'),
                        "param_name" => "image",
                        "description" => __("Bitte immer eine feste Größe verwenden", 'Meine Shortcodes')
                   ),               

  

                    array(
                        "type" => "dropdown",
                        "value"       => array(
                        'Ohne Stil'   => '',
         				'Box mit Rand'   => 'cr_box',
				        'Box ohne Rand'   => 'cr_wo_box',
				
				      	),
				      
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Klasse", 'Meine Shortcodes'),
                        "param_name" => "klasse",
                        "description" => __("Klasse", 'Meine Shortcodes')
                   ),
                    
                    /* Dropdown-Menu um Verlinkung ein und auszublenden */
                  array(
                        "type" => "dropdown",
                        "value"       => array(
                        'Ja'   => '',
         				'Nein'   => 'cr_none',
				
				      	),
				      
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Verlinkung einblenden?", 'Meine Shortcodes'),
                        "param_name" => "einblenden",
                        "description" => __("Einblenden", 'Meine Shortcodes')
                   ),
                    /* / Dropdown-Menu um Verlinkung ein und auszublenden */
                    
                    array(
                        "type" => "vc_link",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Verlinkung", 'Meine Shortcodes'),
                        "param_name" => "link",
                        "description" => __("Verlinkung", 'Meine Shortcodes')
                   ),


           )
));

/* Eingabe Backend für: Box 3 - Box mit Hintergrundbild */
vc_map(array(
    "name" => __("Box mit Hintergrundbild", 'Meine Shortcodes'),
    "description" => __("Eine Textbox mit Bild und Verlinkung", 'Meine Shortcodes'),
    "base" => "box_3",
    "icon" => plugins_url('assets/icons/icon.png', __FILE__), 
    "category" => __('Meine Shortcodes', 'Meine Shortcodes'),
    "params" => array(

					
                    array(
                            "type" => "textfield",
                            "heading" => __("Titel", "Meine Shortcodes"),
                            "param_name" => "title",
                            "description" => __("Bitte Titel eingeben", "Meine Shortcodes"),
                            "value" => __("Lorem Ipsum Dolr it", 'Meine Shortcodes'),
                            "admin_label" => true,
                   ),
                    
					array(
                            "type" => "textarea_html",
                            "heading" => __("Texbereich", "Meine Shortcodes"),
                            "param_name" => "textblock",
                            "description" => __("Bitte Text eingeben", "Meine Shortcodes"),
                            "value" => __("Lorem Ipsum Dolr it", 'Meine Shortcodes'),
                            "admin_label" => true,
                   ),
												
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Bild", 'Meine Shortcodes'),
                        "param_name" => "image",
                        "description" => __("Bitte immer eine feste Größe verwenden", 'Meine Shortcodes')
                   ),               

                    array(
                        "type" => "dropdown",
                        "value"       => array(
                        'Ohne Stil'   => '',
         				'Box mit Rand (Mit Hintergrundbild)'   => 'cr_box',
				        'Box ohne Rand'   => 'cr_wo_box',
				
				      	),
				      
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Klasse", 'Meine Shortcodes'),
                        "param_name" => "klasse",
                        "description" => __("Klasse", 'Meine Shortcodes')
                   ),
                    
						                            /* Dropdown-Menu um Verlinkung ein und auszublenden */
                  array(
                        "type" => "dropdown",
                        "value"       => array(
                        'Ja'   => '',
         				'Nein'   => 'cr_none',
				
				      	),
				      
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Verlinkung einblenden?", 'Meine Shortcodes'),
                        "param_name" => "einblenden",
                        "description" => __("Einblenden", 'Meine Shortcodes')
                   ),
                    /* / Dropdown-Menu um Verlinkung ein und auszublenden */
                    
                    array(
                        "type" => "vc_link",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Verlinkung", 'Meine Shortcodes'),
                        "param_name" => "link",
                        "description" => __("Verlinkung", 'Meine Shortcodes')
                   ),


           )
));

/* Eingabe Backend für: Box 4- Box mit Bild (links) */
vc_map(array(
    "name" => __("Box mit Bild (links)", 'Meine Shortcodes'),
    "description" => __("Eine Textbox mit Bild und Verlinkung2", 'Meine Shortcodes'),
    "base" => "box_4",
    "icon" => plugins_url('assets/icons/icon.png', __FILE__), 
    "category" => __('Meine Shortcodes', 'Meine Shortcodes'),
    "params" => array(

                    
                    array(
                            "type" => "textfield",
                            "heading" => __("Titel", "Meine Shortcodes"),
                            "param_name" => "title",
                            "description" => __("Bitte Titel eingeben", "Meine Shortcodes"),
                            "value" => __("Lorem Ipsum Dolr it", 'Meine Shortcodes'),
                            "admin_label" => true,
                   ),
                    
                    array(
                            "type" => "textarea_html",
                            "heading" => __("Texbereich", "Meine Shortcodes"),
                            "param_name" => "textblock",
                            "description" => __("Bitte Text eingeben", "Meine Shortcodes"),
                            "value" => __("Lorem Ipsum Dolr it", 'Meine Shortcodes'),
                            "admin_label" => true,
                   ),
                                                
                    array(
                        "type" => "attach_image",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Bild", 'Meine Shortcodes'),
                        "param_name" => "image",
                        "description" => __("Bitte immer eine feste Größe verwenden", 'Meine Shortcodes')
                   ),               

  

                    array(
                        "type" => "dropdown",
                        "value"       => array(
                        'Ohne Stil'   => '',
                        'Box mit Rand'   => 'cr_box',
                        'Box ohne Rand'   => 'cr_wo_box',
                
                       ),
                      
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Klasse", 'Meine Shortcodes'),
                        "param_name" => "klasse",
                        "description" => __("Klasse", 'Meine Shortcodes')
                   ),
                    
                    /* Dropdown-Menu um Verlinkung ein und auszublenden */
                  array(
                        "type" => "dropdown",
                        "value"       => array(
                        'Ja'   => '',
                        'Nein'   => 'cr_none',
                
                       ),
                      
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Verlinkung einblenden?", 'Meine Shortcodes'),
                        "param_name" => "einblenden",
                        "description" => __("Einblenden", 'Meine Shortcodes')
                   ),
                    /* / Dropdown-Menu um Verlinkung ein und auszublenden */
                    
                    array(
                        "type" => "vc_link",
                        "holder" => "div",
                        "class" => "",
                        "heading" => __("Verlinkung", 'Meine Shortcodes'),
                        "param_name" => "link",
                        "description" => __("Verlinkung", 'Meine Shortcodes')
                   ),


           )
));

/**
 * Message Box Shortcode
 */

if(!function_exists('grve_message_box_shortcode')) {

	function grve_message_box_shortcode($atts, $content) {

		$output = $data = $el_class = '';

		extract(
			shortcode_atts(
				array(
					'icon' => 'exclamation-circle',
					'icon_color' => 'white',
					'bg_color' => 'green',
					'remove_close' => '',
					'animation' => '',
					'animation_delay' => '200',
					'margin_bottom' => '', 
					'el_class' => '',
					'einblenden'   => 'cr_vis',
					'link'   => '#',
					'hoehe_feld' => '',
					'remove_icon' => '',
					
				),
				$atts
			)
		); 
		
		
		/* der Linkbuilder */
		$href = vc_build_link(esc_attr($link));
		
		/* / der Linkbuilder */
		$message_box_classes = array('grve-element', 'grve-message');

		array_push($message_box_classes, 'grve-bg-' . $bg_color);

		if (!empty($animation)) {
			array_push($message_box_classes, 'grve-animated-item');
			array_push($message_box_classes, $animation);
			$data = ' data-delay="' . esc_attr($animation_delay) . '"';
		}

		if (!empty ($el_class)) {
			array_push($message_box_classes, $el_class);
		}

		$message_box_class_string = implode(' ', $message_box_classes);

		$style = grve_osmosis_vce_build_margin_bottom_style($margin_bottom);

		$output .= '<div class="' . esc_attr($message_box_class_string) . '" style="height:'. $hoehe_feld. 'px;' . $style . '"' . $data . '>';
		$output .= '  <i class="'. $remove_icon. ' '. $icon_color. ' grve-icon fa fa-'. $icon. '"></i>';
		$output .= '  <p>' . do_shortcode($content) . '</p><a href="' . esc_attr($href['url']) . '"     class="cr_mes_li '  . esc_attr($einblenden) . ' ">mehr;</a>';     
		if ('yes' != $remove_close) { 
			$output .= '  <i class="grve-close grve-icon-close"></i>';
		}
		$output .= '</div>	';   

		return $output;
	}
	add_shortcode('grve_message_box', 'grve_message_box_shortcode');

}
/**
 * Add shortcode to Visual Composer
 */

vc_map(array(
	"name" => __("Message Box", "grve-osmosis-vc-extension"),
	"description" => __("Info text with icons", "grve-osmosis-vc-extension"),
	"base" => "grve_message_box",
	"class" => "",
	"icon"      => "icon-wpb-grve-message-box",
	"category" => __("Content", "js_composer"),
	"params" => array(
		array(
			"type" => "grve_icon",
			"heading" => __('Icon', "grve-osmosis-vc-extension"),
			"param_name" => "icon",
			"value" => 'exclamation-circle',
			"description" => __("Select an icon.", "grve-osmosis-vc-extension"),
			"admin_label" => true,
		), 
						array(
			"type" => "dropdown",
			"heading" => __("Farbe Icon", "grve-osmosis-vc-extension"), 
			"param_name" => "icon_color",
			"value" => array(
			__("Weiss", "grve-osmosis-vc-extension") => 'white',
				__("Primary 1", "grve-osmosis-vc-extension") => 'primary-1',
				__("Primary 2", "grve-osmosis-vc-extension") => 'primary-2',
				__("Primary 3", "grve-osmosis-vc-extension") => 'primary-3',
				__("Primary 4", "grve-osmosis-vc-extension") => 'primary-4',
				__("Primary 5", "grve-osmosis-vc-extension") => 'primary-5',
				__("Primary 6", "grve-osmosis-vc-extension") => 'primary-6', 
					
			),
			"description" => __("Farbe des Icons.", "grve-osmosis-vc-extension"),
			"admin_label" => true,
		),
		array(
			"type" => "textarea_html",
			"heading" => __("Text zur Eingabe", "grve-osmosis-vc-extension"),
			"param_name" => "content",
			"value" => "Sample Text", 
			"description" => __("Enter your content.", "grve-osmosis-vc-extension"),
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"heading" => __("Background Color", "grve-osmosis-vc-extension"), 
			"param_name" => "bg_color",
			"value" => array(
				__("Primary 1", "grve-osmosis-vc-extension") => 'primary-1',
				__("Primary 2", "grve-osmosis-vc-extension") => 'primary-2',
				__("Primary 3", "grve-osmosis-vc-extension") => 'primary-3',
				__("Primary 4", "grve-osmosis-vc-extension") => 'primary-4',
				__("Primary 5", "grve-osmosis-vc-extension") => 'primary-5',
				__("Primary 6", "grve-osmosis-vc-extension") => 'primary-6',
				__("Green", "grve-osmosis-vc-extension") => 'green',
				__("Orange", "grve-osmosis-vc-extension") => 'orange',
				__("Red", "grve-osmosis-vc-extension") => 'red4',
				__("Blue", "grve-osmosis-vc-extension") => 'blue',
				__("Aqua", "grve-osmosis-vc-extension") => 'aqua', 
				__("Purple", "grve-osmosis-vc-extension") => 'purple',
				__("Black", "grve-osmosis-vc-extension") => 'black',
				__("Grey", "grve-osmosis-vc-extension") => 'grey',
				__("White", "grve-osmosis-vc-extension") => 'white',  
			),
			"description" => __("Background color of the box.", "grve-osmosis-vc-extension"),
			"admin_label" => true,
		),
		                 array(
                                    "type" => "textfield",
                                    "heading" => __("Höhe Feld in px", "Meine Shortcodes"),
                                    "param_name" => "hoehe_feld",
                                    "description" => __("Bitte Höhe in px eingeben (Nur für Größen oberhalb von 1280px)", "Meine Shortcodes"),
                                    "value" => __("", 'Meine Shortcodes'),
                                    "admin_label" => true,
                           ),
		array(
			"type" => 'checkbox',
			"heading" => __("Remove Close Button", "grve-osmosis-vc-extension"),
			"param_name" => "remove_close",
			"value" => Array(__("If selected, close button will be removed ", "grve-osmosis-vc-extension") => 'yes'),
		),
				array(
			"type" => 'checkbox',
			"heading" => __("Icon ausblenden", "grve-osmosis-vc-extension"),
			"param_name" => "remove_icon",
			"value" => Array(__("Icon wird ausgeblendet", "grve-osmosis-vc-extension") => 'remove_yes'),
		),
			/* Dropdown-Menu um Verlinkung ein und auszublenden */
      array(
            "type" => "dropdown",
            "value"       => array(
            'Ja'   => '',
			'Nein'   => 'cr_none',
	
	      	),
	      
            "holder" => "div",
            "class" => "",
            "heading" => __("Verlinkung einblenden?", 'Meine Shortcodes'),
            "param_name" => "einblenden",
            "description" => __("Einblenden", 'Meine Shortcodes')
       ),
        /* / Dropdown-Menu um Verlinkung ein und auszublenden */ 
        
        array(
            "type" => "vc_link",
            "holder" => "div",
            "class" => "",
            "heading" => __("Verlinkung", 'Meine Shortcodes'),
            "param_name" => "link",
            "description" => __("Verlinkung", 'Meine Shortcodes')
       ),/*		
		$grve_vce_add_animation,
		$grve_vce_add_animation_delay,
		$grve_vce_add_margin_bottom,
		$grve_vce_add_el_class,*/
	)
));
