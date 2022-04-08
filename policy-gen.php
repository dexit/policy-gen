<?php
/**
 * Plugin Name: Policy Gen
 * Plugin URI: https://github.com/dexit/policy-gen
 * Description: Generates terms pages
 * Version: 1.3.1
 * Author: Rihards 'dExIT' Mantejs
 * Author URI: https://github.com/dexit
 */


class CompanyProfile {
	private $company_profile_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'company_profile_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'company_profile_page_init' ) );
	}

	public function company_profile_add_plugin_page() {
		add_menu_page(
			'Company Profile', // page_title
			'Company Profile', // menu_title
			'manage_options', // capability
			'company-profile', // menu_slug
			array( $this, 'company_profile_create_admin_page' ), // function
			'dashicons-lightbulb', // icon_url
			2 // position
		);
	}

	public function company_profile_create_admin_page() {
		$this->company_profile_options = get_option( 'company_profile_option_name' ); ?>

		<div class="wrap">
			<h2>Company Profile</h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'company_profile_option_group' );
					do_settings_sections( 'company-profile-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function company_profile_page_init() {
		register_setting(
			'company_profile_option_group', // option_group
			'company_profile_option_name', // option_name
			array( $this, 'company_profile_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'company_profile_setting_section', // id
			'Settings', // title
			array( $this, 'company_profile_section_info' ), // callback
			'company-profile-admin' // page
		);

		add_settings_field(
			'legal_name_0', // id
			'Legal Name', // title
			array( $this, 'legal_name_0_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);
		
		add_settings_field(
			'policy_date_90', // id
			'Policy Date', // title
			array( $this, 'policy_date_90_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'company_reg_1', // id
			'Company Reg', // title
			array( $this, 'company_reg_1_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'contact_email_2', // id
			'Contact Email', // title
			array( $this, 'contact_email_2_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'company_website_3', // id
			'Company Website', // title
			array( $this, 'company_website_3_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'primary_phone_4', // id
			'Primary Phone', // title
			array( $this, 'primary_phone_4_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'secondary_phone_5', // id
			'Secondary Phone', // title
			array( $this, 'secondary_phone_5_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'company_address_6', // id
			'Company Address', // title
			array( $this, 'company_address_6_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'facebook_7', // id
			'Facebook', // title
			array( $this, 'facebook_7_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'linked_in_8', // id
			'Linked In', // title
			array( $this, 'linked_in_8_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'instagram_9', // id
			'Instagram', // title
			array( $this, 'instagram_9_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'twitter_10', // id
			'Twitter', // title
			array( $this, 'twitter_10_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);

		add_settings_field(
			'justgive_11', // id
			'JustGive', // title
			array( $this, 'justgive_11_callback' ), // callback
			'company-profile-admin', // page
			'company_profile_setting_section' // section
		);
	}

	public function company_profile_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['legal_name_0'] ) ) {
			$sanitary_values['legal_name_0'] = sanitize_text_field( $input['legal_name_0'] );
		}

		if ( isset( $input['policy_date_90'] ) ) {
			$dated2 = new DateTime($input['policy_date_90']);
			$sanitary_values['policy_date_90'] = sanitize_text_field( $dated2->format('d/m/Y') );
		}
		if ( isset( $input['company_reg_1'] ) ) {
			$sanitary_values['company_reg_1'] = sanitize_text_field( $input['company_reg_1'] );
		}

		if ( isset( $input['contact_email_2'] ) ) {
			$sanitary_values['contact_email_2'] = sanitize_text_field( $input['contact_email_2'] );
		}

		if ( isset( $input['company_website_3'] ) ) {
			$sanitary_values['company_website_3'] = sanitize_text_field( $input['company_website_3'] );
		}

		if ( isset( $input['primary_phone_4'] ) ) {
			$sanitary_values['primary_phone_4'] = sanitize_text_field( $input['primary_phone_4'] );
		}

		if ( isset( $input['secondary_phone_5'] ) ) {
			$sanitary_values['secondary_phone_5'] = sanitize_text_field( $input['secondary_phone_5'] );
		}

		if ( isset( $input['company_address_6'] ) ) {
			$sanitary_values['company_address_6'] = esc_textarea( $input['company_address_6'] );
		}

		if ( isset( $input['facebook_7'] ) ) {
			$sanitary_values['facebook_7'] = sanitize_text_field( $input['facebook_7'] );
		}

		if ( isset( $input['linked_in_8'] ) ) {
			$sanitary_values['linked_in_8'] = sanitize_text_field( $input['linked_in_8'] );
		}

		if ( isset( $input['instagram_9'] ) ) {
			$sanitary_values['instagram_9'] = sanitize_text_field( $input['instagram_9'] );
		}

		if ( isset( $input['twitter_10'] ) ) {
			$sanitary_values['twitter_10'] = sanitize_text_field( $input['twitter_10'] );
		}

		if ( isset( $input['justgive_11'] ) ) {
			$sanitary_values['justgive_11'] = sanitize_text_field( $input['justgive_11'] );
		}

		return $sanitary_values;
	}

	public function company_profile_section_info() {
		
	}

	public function legal_name_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[legal_name_0]" id="legal_name_0" value="%s">',
			isset( $this->company_profile_options['legal_name_0'] ) ? esc_attr( $this->company_profile_options['legal_name_0']) : ''
		);
	}
	public function policy_date_90_callback() {
		if($this->company_profile_options['policy_date_90']) {
			$mehed = $this->company_profile_options['policy_date_90'];
		}else{
			$mehed = 'No date set';
		}
		printf(
			'<input class="regular-text datepicker" type="date" name="company_profile_option_name[policy_date_90]" id="policy_date_90" value="%s"><br><b> Current:</b> '. $mehed . '',
			isset( $this->company_profile_options['policy_date_90'] ) ? esc_attr( $this->company_profile_options['policy_date_90']) : ''
		);
	}
	public function company_reg_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[company_reg_1]" id="company_reg_1" value="%s">',
			isset( $this->company_profile_options['company_reg_1'] ) ? esc_attr( $this->company_profile_options['company_reg_1']) : ''
		);
	}

	public function contact_email_2_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[contact_email_2]" id="contact_email_2" value="%s">',
			isset( $this->company_profile_options['contact_email_2'] ) ? esc_attr( $this->company_profile_options['contact_email_2']) : ''
		);
	}

	public function company_website_3_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[company_website_3]" id="company_website_3" value="%s">',
			isset( $this->company_profile_options['company_website_3'] ) ? esc_attr( $this->company_profile_options['company_website_3']) : ''
		);
	}

	public function primary_phone_4_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[primary_phone_4]" id="primary_phone_4" value="%s">',
			isset( $this->company_profile_options['primary_phone_4'] ) ? esc_attr( $this->company_profile_options['primary_phone_4']) : ''
		);
	}

	public function secondary_phone_5_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[secondary_phone_5]" id="secondary_phone_5" value="%s">',
			isset( $this->company_profile_options['secondary_phone_5'] ) ? esc_attr( $this->company_profile_options['secondary_phone_5']) : ''
		);
	}

	public function company_address_6_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="company_profile_option_name[company_address_6]" id="company_address_6">%s</textarea>',
			isset( $this->company_profile_options['company_address_6'] ) ? esc_attr( $this->company_profile_options['company_address_6']) : ''
		);
	}

	public function facebook_7_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[facebook_7]" id="facebook_7" value="%s">',
			isset( $this->company_profile_options['facebook_7'] ) ? esc_attr( $this->company_profile_options['facebook_7']) : ''
		);
	}

	public function linked_in_8_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[linked_in_8]" id="linked_in_8" value="%s">',
			isset( $this->company_profile_options['linked_in_8'] ) ? esc_attr( $this->company_profile_options['linked_in_8']) : ''
		);
	}

	public function instagram_9_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[instagram_9]" id="instagram_9" value="%s">',
			isset( $this->company_profile_options['instagram_9'] ) ? esc_attr( $this->company_profile_options['instagram_9']) : ''
		);
	}

	public function twitter_10_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[twitter_10]" id="twitter_10" value="%s">',
			isset( $this->company_profile_options['twitter_10'] ) ? esc_attr( $this->company_profile_options['twitter_10']) : ''
		);
	}

	public function justgive_11_callback() {
		printf(
			'<input class="regular-text" type="text" name="company_profile_option_name[justgive_11]" id="justgive_11" value="%s">',
			isset( $this->company_profile_options['justgive_11'] ) ? esc_attr( $this->company_profile_options['justgive_11']) : ''
		);
	}

}
	$company_profile = new CompanyProfile();
if ( is_admin() )

/* 
 * Retrieve this value with:
 * $company_profile_options = get_option( 'company_profile_option_name' ); // Array of All Options
 * $legal_name_0 = $company_profile_options['legal_name_0']; // Legal Name
 * $policy_date_90 = $company_profile_options['policy_date_90']; // Policy Date
 * $company_reg_1 = $company_profile_options['company_reg_1']; // Company Reg
 * $contact_email_2 = $company_profile_options['contact_email_2']; // Contact Email
 * $company_website_3 = $company_profile_options['company_website_3']; // Company Website
 * $primary_phone_4 = $company_profile_options['primary_phone_4']; // Primary Phone
 * $secondary_phone_5 = $company_profile_options['secondary_phone_5']; // Secondary Phone
 * $company_address_6 = $company_profile_options['company_address_6']; // Company Address
 * $facebook_7 = $company_profile_options['facebook_7']; // Facebook
 * $linked_in_8 = $company_profile_options['linked_in_8']; // Linked In
 * $instagram_9 = $company_profile_options['instagram_9']; // Instagram
 * $twitter_10 = $company_profile_options['twitter_10']; // Twitter
 * $justgive_11 = $company_profile_options['justgive_11']; // JustGive
 */

if ( is_admin() ) {
 if ( ! function_exists( 'legal_menu_config' ) ) {
	  function legal_menu_config() {
			// Check if the menu exists
			$menu_name1   = 'LegalMenu';
			$menu_exists1 = wp_get_nav_menu_object( $menu_name1 );

			// If it doesn't exist, let's create it.
			if ( ! $menu_exists1 ) {
				$menu_id = wp_create_nav_menu($menu_name1);

				// Set up default menu items
				//  
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'  =>  __( 'Terms & Conditions', 'oxylegal' ),
					'menu-item-url'    => '/terms/', 
					'menu-item-status' => 'publish'
				) );
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'   =>  __( 'Privacy Policy', 'oxylegal' ),
					'menu-item-classes' => 'home',
					'menu-item-url'     => '/privacy/', 
					'menu-item-status'  => 'publish'
				) );

				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'  =>  __( 'Cookies Policy', 'oxylegal' ),
					'menu-item-url'    => '/cookies/', 
					'menu-item-status' => 'publish'
				) );
			}

        }
        add_action( 'init', 'legal_menu_config' );
        
}
 if ( ! function_exists( 'legal_page_config' ) ) {
	  function legal_page_config() {
// Product Title
$post_titles = array('Cookies','Privacy','Terms');
	 foreach($post_titles as $post_title){
		// Add Product
		$new_post = array(
			'post_title' => $post_title,
			'post_slug' => strtolower($post_title),
			'post_type' => 'page',
			'post_staus' => 'publish', 
			'post_author' => 1,
			'post_template' => 'elementor_header_footer',
			'post_content' => '[oxy_'. strtolower($post_title) .']',
			'post_excerpt' => $post_title.' Page'
		);

		// Catch post ID
		if(post_exists( $post_title ) > 0){
			// post already exists quitting
		}else{
			$post_ide = wp_insert_post( $new_post );
			if($post_ide) {
				$updated_post = array(
					'ID'            =>      $post_ide,
					'post_status'   =>      'publish', // Now it's public
				);
				wp_update_post($updated_post);
				}
		}
	}

        }
	 require_once ABSPATH . '/wp-admin/includes/post.php';
        add_action( 'init', 'legal_page_config' );
        
}
	}
 add_shortcode('oxy_terms', 'terms_policy_func');
function terms_policy_func( $atts = array() ){
$company_profile_options = get_option( 'company_profile_option_name' ); // Array of All Options
$legal_name_0 = $company_profile_options['legal_name_0']; // Legal Name
	// set up default parameters
    extract(shortcode_atts(array(
	 'company_name' => $legal_name_0
    ), $atts));
$tncs ='
   <p><strong>Terms &amp; Conditions</strong><br> Your use of this website is subject to this Disclaimer and Copyright Statement. By using this website you agree to the terms and conditions and Copyright Statement. If you do not agree with them please do not use this website. The information contained in this website is provided in good faith but no warranty, representation, statement or undertaking is given either regarding such information or regarding any information in (or any software at) any other website connected with this website through any hypertext or other links (including any warranty, representation, statement or undertaking that any information or the use of any such information either in this website or any other website complies with any local or national laws or the requirements of any regulatory or statutory bodies) and any warranty, representation, statement or undertaking whatsoever that may be expressed or implied by statute, custom or otherwise is hereby expressly excluded. The use of this website and any information on this website or any other website (or of any software at any other site) is entirely at the risk of the user. Under no circumstances shall '.$company_name.' or any of its subsidiaries be liable for any costs, losses, expenses or damages (whether direct or indirect, consequential, special, economic or financial including any losses of profits) whatsoever that may be incurred through the use of any information contained in this website or in any other website. Nothing contained in this website shall be deemed to be either any advice of a financial nature to act or not to act in any way whatsoever or any invitation to invest or deal in any form of investment including shares, bonds, ADSs or securities. This website may contain inaccurate information. '.$company_name.' is under no responsibility to update or correct any such information or to even maintain this website. '.$company_name.' reserves its right to change any information or any part of this website without notice.</p>
   <p><strong>Copyright Statement</strong><br> Copyright on all of the images on this web site are owned by '.$company_name.' or by others and used under licence, in accordance with the terms of the Copyright Designs and Patents Act 1988.</p>';
   
   return $tncs;
}

add_shortcode('oxy_privacy', 'privacy_policy_func');
function privacy_policy_func( $atts = array() ){
	$company_profile_options = get_option( 'company_profile_option_name' ); // Array of All Options

$legal_name_0 = $company_profile_options['legal_name_0']; // Legal Name
$policy_date_90 = $company_profile_options['policy_date_90']; // Policy Date
$company_reg_1 = $company_profile_options['company_reg_1']; // Company Reg
$contact_email_2 = $company_profile_options['contact_email_2']; // Contact Email
$company_website_3 = $company_profile_options['company_website_3']; // Company Website
$primary_phone_4 = $company_profile_options['primary_phone_4']; // Primary Phone
$company_address_6 = $company_profile_options['company_address_6']; // Company Address
	// set up default parameters
    extract(shortcode_atts(array(
     'last_updated' => $policy_date_90,
	 'company_name' => $legal_name_0,
	 'website' => $company_website_3,
	 'address' => $company_address_6,
	 'phone' =>  $primary_phone_4,
	 'email' =>  $contact_email_2
	 
    ), $atts));
$privacy ='
   <p><b>'.$company_name.' Privacy Statement – ('.$last_updated.')</span></b></p>
   <p><b>Introduction</span></b></p>
   <p>This privacy statement explains the personal data we collect, why we collect it, who we share it with, how we use it and how we protect it.</span></p>
   <p><b>Personal data we collect directly from you</span></b></p>
   <p>When we collect personal data directly from you through our website, our email newsletter, on social media platforms, on landing pages, from surveys, conferences and over the phone, we use the data you provide for the following purposes:</span></p>
   <ul>
      <li>
         To fulfil our contract with you or your employer to provide you with services you have requested, and in particular: –
         <ul>
            <li>Maintaining our own records and databases</span></li>
            <li>Monitoring use of our products and services to ensure usage is in accordance with our terms and conditions of use</span></li>
            <li>Informing our business customers and prospective customers about our products and services</span></li>
            <li>Service providers that help determine your location based on your IP address in order to customise certain products to your location</span></li>
            <li>Publicly available sources</span></li>
            <li>Information generated by your usage of our products and services</span></li>
            <li>Information generated by the use of cookies on our website (see our separate Cookies Policy)</span></li>
            <li>Name and contact data, including first and last name, job title, email address, work postal address, work phone and if provided mobile ‘phone and similar contact data</span></li>
            <li>Demographic, including country, city and preferred language</span></li>
         </ul>
      </li>
   </ul>
   <ul>
      <li>
         For our own legitimate interests in: –
         <ul>
            <li>To issue credentials, including passwords to allow you to access and operate your account</span></li>
            <li>To contact you about your subscription and to provide customer support services to you</span></li>
            <li>To carry out credit checks, to invoice you or your employer for any services you subscribe to and to collect payments due</span></li>
         </ul>
      </li>
   </ul>
   <p><b>Other sources of personal data</span></b></p>
   <ul>
      <li>
         We also receive personal data from other sources which include:</span>
         <ul>
            <li>Service providers that help determine your location based on your IP address in order to customise certain products to your location</span></li>
            <li>Publicly available sources</span></li>
            <li>Information generated by your usage of our products and services</span></li>
            <li>Information generated by the use of cookies on our website (see our separate Cookies Policy)</span></li>
         </ul>
      </li>
   </ul>
   <ul>
      <li>
         The data we collect in this way includes the following:</span>
         <ul>
            <li>Name and contact data, including first and last name, job title, email address, work postal address, work phone and if provided mobile ‘phone and similar contact data</span></li>
            <li>Demographic, including country, city and preferred language</span></li>
         </ul>
      </li>
   </ul>
   <ul>
      <li>
         We use this personal data for the following purposes: –</span>
         <ul>
            <li>For our own legitimate interests in monitoring usage of our services and improving the service provided to our customers;</span></li>
            <li>Sending journalists press releases of interest</span></li>
            <li>Informing relevant prospective customers about our products and services</span></li>
         </ul>
      </li>
   </ul>
   <p><b>Who has access to your personal data?</span></b></p>
   <p>We do not sell your personal information to third party companies. With the exception that we do collect the name, position and email of senior industry personnel for publication in our paid-for services.</span></p>
   <ul>
      <li>
         We transfer personal data to the following categories of recipients: –</span>
         <ul>
            <li>Companies who we appoint under contract to host our services</span></li>
            <li>Companies or individuals who we appoint to provide services to us which include processing personal data</span></li>
            <li>Actual or potential business partners who need access to personal data to evaluate or carry out a business relationship or to conclude a transaction with us</span></li>
         </ul>
      </li>
   </ul>
   <p><b>Security and Safeguards</span></b></p>
   <p>The safeguards we have put in place to ensure that our contractors and other third parties keep your personal data secure and confidential and use it only as authorised by us are as follows: –</span></p>
   <ul>
      <li>We require all third parties to whom we disclose personal data to enter into a contract with us that includes confidentiality obligations</span></li>
      <li>We carry out such due diligence as is reasonably necessary in relation to the technical and organisation measures used by our suppliers to ensure that personal data is processed securely</span></li>
      <li>We may use data processors located outside the European Economic Area only after taking such steps as are required to ensure that personal data they process on our behalf receives protection equivalent to that provided in the EEA. Our processors are either certified as compliant with the EU-U.S. Privacy Shield Framework where they are located in the USA or have entered into an agreement with us containing the model clauses approved by the European Commission as providing contractual protection equivalent to that provided by the data protection regulations applicable in the EEA. To learn more about the Privacy Shield program, please visit www.privacyshield.gov</span></li>
   </ul>
   <p><b>Retention period for personal data</span></b></p>
   <p>We retain personal data for the following periods: –</span></p>
   <p>For customers’ users we retain data while we are contracted. Post termination we will retain information in the same way as other prospective customers as follows.</p>
   <p>For prospective customers we retain data for up to three years post receipt, renewed consent or customer contract termination.</span></p>
   <p>For recipients of our e-news service we retain required personal data while they are receiving the service. Bouncing (invalid) emails and related personal details are retained for up to one year.</span></p>
   <p>After that time, unless there is a need to retain that data for purposes connected with protecting our interests or those of third parties we will erase all data other than that needed to comply with our statutory obligations.</span></p>
   <p><b>Identity of the data controller</span></b></p>
   <p>The person who is the data controller and responsible for deciding how personal data is processed and for what purpose at '.$company_name.', a company registered in England and Wales with its registered office '.$address.'. The individual responsible for data protection at '.$company_name.' is the Data Protection Officer.</span></p>
   <p><b>Your rights</span></b></p>
   <p>You have the following rights in relation to your personal data;</span></p>
   <ul>
      <li>You have the right at any time to withdraw that consent at any time by using the ‘unsubscribe’ button at the bottom of one of our marketing emails or by replying to the email</span></li>
      <li>You have the right to update and correct the personal information we hold about you. You also have the right to request from us all personal information that we hold that relates to you, to request restriction of the processing of that data and to request that we delete that data or object to continued processing where it is excessive or no longer required for the purpose for which it was collected. Where allowed by applicable law there may be an administrative charge for supply of copies of data and we may also require you to provide us with appropriate identification before we comply with this request. You may also have the right to data portability</span></li>
      <li>If you have a complaint about the way in which we use your personal information you have the right to complain to the Information Commissioner www.ico.gov.uk</span></li>
   </ul>
   <p><b>Changes to this Privacy Policy</span></b></p>
   <p>This Privacy Statement will be updated from time to time to reflect changes in our business.</p>
   <p><b>Contacting us</span></b></p>
   <p>If you have any questions about anything in this Privacy Statement, please contact us at the below email, mail or telephone number.</span></p>
   <p>The Data Protection Officer<br> </span>'.$company_name.'<br> '.$address.'</p>
   <p>Tel: <a href="tel:'.$phone.'">'.$phone.'</a> <br> Email: <a href="mailto:'.$email.'">'.$email.'</a></p>';
   return $privacy;
}

add_shortcode('oxy_cookies', 'cookies_policy_func');
function cookies_policy_func( $atts = array() ){
$company_profile_options = get_option( 'company_profile_option_name' ); // Array of All Options
$legal_name_0 = $company_profile_options['legal_name_0']; // Legal Name
$policy_date_90 = $company_profile_options['policy_date_90']; // Policy Date
$company_website_3 = $company_profile_options['company_website_3']; // Company Website

	// set up default parameters
    extract(shortcode_atts(array(
     'last_updated' => $policy_date_90,
	 'company_name' => $legal_name_0,
	 'website' => $company_website_3
	 
    ), $atts));
$cookies ='
   <p></span><b>'.$company_name.' Cookies Policy –</b><strong>v1 Last updated: '.$last_updated.'</span></strong></p>
   <p>'.$company_name.' (“us”, “we”, or “our”) uses cookies on the '.$website.' website (the “Service”). By using the Service, you consent to the use of cookies.</span></p>
   <p>Our Cookies Policy explains what cookies are, how we use cookies, how third-parties we may partner with may use cookies on the Service, your choices regarding cookies and further information about cookies.</span></p>
   <p><b>What are cookies</span></b></p>
   <p>Cookies are small pieces of text sent to your web browser by a website you visit. A cookie file is stored in your web browser and allows the Service or a third-party to recognize you and make your next visit easier and the Service more useful to you.</span></p>
   <p>Cookies can be “persistent” or “session” cookies. Persistent cookies remain on your personal computer or mobile device when you go offline, while session cookies are deleted as soon as you close your web browser.</span></p>
   <p><b>How '.$company_name.' uses cookies</span></b></p>
   <p>When you use and access the Service, we may place a number of cookies files in your web browser.</span></p>
   <p>We use cookies for the following purposes:</span></p>
   <ul>
      <li>To enable certain functions of the Service</span></li>
      <li>To provide analytics</span></li>
      <li>To store your preferences</span></li>
   </ul>
   <p>We use both session and persistent cookies on the Service and we use different types of cookies to run the Service:</span></p>
   <ul>
      <li>Essential cookies. We may use essential cookies to authenticate users and prevent fraudulent use of user accounts.</span></li>
      <li>Preferences cookies. We may use preferences cookies to remember information that changes the way the Service behaves or looks, such as the “remember me” functionality of a registered user or a user’s language preference.</span></li>
      <li>Analytics cookies. We may use analytics cookies to track information how the Service is used so that we can make improvements. We may also use analytics cookies to test new advertisements, pages, features or new functionality of the Service to see how our users react to them.</span></li>
   </ul>
   <p><b>Third-party cookies</span></b></p>
   <p>In addition to our own cookies, we may also use various third-parties cookies to report usage statistics of the Service, deliver advertisements on and through the Service, and so on.</span></p>
   <p><b>What are your choices regarding cookies</span></b></p>
   <p>If you’d like to delete cookies or instruct your web browser to delete or refuse cookies, please visit the help pages of your web browser.</span></p>
   <p>Please note, however, that if you delete cookies or refuse to accept them, you might not be able to use all of the features we offer, you may not be able to store your preferences, and some of our pages might not display properly.</span></p>
   <ul>
      <li>For the Chrome web browser, please visit this page from Google: https://support.google.com/accounts/answer/32050</span></li>
      <li>For the Internet Explorer web browser, please visit this page from Microsoft: http://support.microsoft.com/kb/278835</span></li>
      <li>For the Firefox web browser, please visit this page from Mozilla: https://support.mozilla.org/en-US/kb/delete-cookies-remove-info-websites-stored</span></li>
      <li>For the Safari web browser, please visit this page from Apple: https://support.apple.com/kb/PH21411?locale=en_US</span></li>
      <li>For any other web browser, please visit your web browser’s official web pages.</span></li>
   </ul>
   <p><b>Where can you find more information about cookies</span></b></p>
   <p>You can learn more about cookies and the following third-party websites:</span></p>
   <p>AllAboutCookies: http://www.allaboutcookies.org/<br> </span>Network Advertising Initiative: http://www.networkadvertising.org/</span></p>
   <p></p>';
   return $cookies;
}

add_shortcode('oxy_company', 'policy_func2022');
function policy_func2022( $atts = array() ){
	
 $company_profile_options = get_option( 'company_profile_option_name' ); // Array of All Options
 $legal_name = $company_profile_options['legal_name_0']; // Legal Name
 $policy_date = $company_profile_options['policy_date_90']; // Policy Date
 $regno = $company_profile_options['company_reg_1']; // Company Reg
 $email = $company_profile_options['contact_email_2']; // Contact Email
 $website = $company_profile_options['company_website_3']; // Company Website
 $primary_phone = $company_profile_options['primary_phone_4']; // Primary Phone
 $secondary_phone = $company_profile_options['secondary_phone_5']; // Secondary Phone
 $company_address = $company_profile_options['company_address_6']; // Company Address
 $facebook = $company_profile_options['facebook_7']; // Facebook
 $linked_in = $company_profile_options['linked_in_8']; // Linked In
 $instagram = $company_profile_options['instagram_9']; // Instagram
 $twitter = $company_profile_options['twitter_10']; // Twitter
 $justgive = $company_profile_options['justgive_11']; // JustGive

		// set up default parameters
    extract(shortcode_atts(array(
     'data' => 'none'
	 
    ), $atts));

	$resultSwitch = $atts['data'];
	if($resultSwitch == 'none'){
		return 'No Data Selected';
	}elseif($resultSwitch == 'name'){
		return $legal_name;
	}elseif($resultSwitch == 'date'){
		return $policy_date;
	}elseif($resultSwitch == 'reg'){
		return $regno;
	}elseif($resultSwitch == 'email'){
		return $email;
	}elseif($resultSwitch == 'web'){
		return $website;
	}elseif($resultSwitch == 'phone1'){
		return $primary_phone;
	}elseif($resultSwitch == 'phone2'){
		return $secondary_phone;
	}elseif($resultSwitch == 'address'){
		return $company_address;
	}elseif($resultSwitch == 'facebook'){
		return $facebook;
	}elseif($resultSwitch == 'linkedin'){
		return $linked_in;
	}elseif($resultSwitch == 'twitter'){
		return $twitter;
	}elseif($resultSwitch == 'instagram'){
		return $instagram;
	}elseif($resultSwitch == 'justgive'){
		return $justgive;
	}else {
		return 'Please provide a data="dataname". ';
	}
}
?>
