<?php

class Listify_Strings {

	public $strings;
	public $labels;
	public $domains;

	public function __construct() {
		if ( apply_filters( 'listify_use_custom_strings', true ) ) {
			add_action( 'after_setup_theme', array( $this, 'filters' ) );
		}
	}

	public function plugins_loaded() {
	}

	public function filters() {
		$this->labels = array(
			'singular' => get_theme_mod( 'label-singular', 'Listing' ),
			'plural' => get_theme_mod( 'label-plural', 'Listings' )
		);

		$this->strings = $this->get_strings();
		$this->domains = apply_filters( 'listify_gettext_domains', array(
			'listify',
			'wp-job-manager',
			'wp-job-manager-tags',
			'wp-job-manager-alerts',
			'wp-job-manager-locations',
			'wp-job-manager-wc-paid-listings',
			'wp-job-manager-simple-paid-listings',
			'jwapl'
		) );

		$this->translations = get_translations_for_domain( 'listify' );

		add_filter( 'gettext', array( $this, 'gettext' ), 0, 3 );
		add_filter( 'gettext_with_context', array( $this, 'gettext_with_context' ), 0, 4 );
		add_filter( 'ngettext', array( $this, 'ngettext' ), 0, 5 );

	}

	public function label($form, $slug = false) {
		$label = $this->labels[ $form ];

		if ( '' == $label && 'plural' == $form ) {
			$label = 'Listings';
		} elseif ( '' == $label && 'singular' == $form ) {
			$label = 'Listing';
		}

		if ( ! $slug ) {
			return $label;
		}

		return sanitize_title( $label );
	}

	private function translate_string( $string ) {
		$value = $string;
		$array = is_array( $value );
		
		$to_translate = $array ? $value[0] : $value;	

		$translated = $this->translate( $to_translate );

		if ( ! $translated ) {
			return $string;
		}

		if ( $array ) {
			$translated = vsprintf( $translated, $value[1] );
		}

		return $translated;
	}

	private function translate( $text ) {
		$translations = $this->translations->translate( $text );

		return $translations;
	}

	private function translate_plural( $single, $plural, $number ) {
		$translation = $this->translations->translate_plural( $single, $plural, $number );

		return $translation;
	}

	public function gettext( $translated, $original, $domain ) {
		if ( ! in_array( $domain, $this->domains ) ) {
			return $translated;
		}

		if ( isset( $this->strings[$domain][$original] ) ) {
			return $this->translate_string( $this->strings[$domain][$original] );
		} else {
			return $translated;
		}
	}

	public function gettext_with_context( $translated, $original, $context, $domain ) {
		if ( ! in_array( $domain, $this->domains ) ) {
			return $translated;
		}

		if ( isset( $this->strings[$domain][$original] ) ) {
			return $this->translate_string( $this->strings[$domain][$original] );
		} else {
			return $translated;
		}
	}

	public function ngettext( $original, $single, $plural, $number, $domain ) {
		if ( ! in_array( $domain, $this->domains ) ) {
			return $original;
		}

		if ( isset ( $this->strings[$domain][$single] ) ) {
			$base = $this->strings[$domain][$single];
			$single = $base[0];
			$plural = $base[1];

			return $this->translate_plural( $single, $plural, $number );
		} else {
			return $original;
		}
	}

	private function get_strings() {
		$strings = array(
			'wp-job-manager' => array(
				'Job' => $this->label( 'singular' ),
				'Jobs' => $this->label( 'plural' ),
				'job' => utf8_uri_encode( sprintf( _x( '%s', 'the singular "listing" label used in permalinks". only transalte this if you are using Polylang and need to force the slugs to remain in a single language.' ), $this->label( 'singular', true ) ) ),
				'jobs' => utf8_uri_encode( sprintf( _x( '%s', 'the plural "listing" label used in permalinks". only transalte this if you are using Polylang and need to force the slugs to remain in a single language.' ), $this->label( 'plural', true ) ) ),

				'Job Listings' => $this->label( 'plural' ),

				'Job category' => array(
					__( '%s Category', 'listify' ), 
					array( $this->label( 'singular' ) )
				),
				'Job categories' => array(
					__( '%s Categories', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Job Categories' => array(
					__( '%s Categories', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'job-category' => array(
					__( '%s-category', 'listify' ), 
					array( $this->label( 'singular', true ) )
				),

				'Job type' => array(
					__( '%s Type', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Job types' => array(
					__( '%s Types', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Job Types' => array(
					__( '%s Types', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'job-type' => array(
					__( '%s-type', 'listify' ),
					array( $this->label( 'singular', true ) )
				),

				'Jobs will be shown if within ANY selected category' => array(
					__( '%s will be shown if within ANY selected category', 'listify' ), 
					array( $this->label( 'plural' ) )
				),
				'Jobs will be shown if within ALL selected categories' => array(
					__( '%s will be shown if within ALL selected categories', 'listify' ),
					array( $this->label( 'plural' ) )
				),

				'Application email' => __( 'Contact Email', 'listify' ),
				'Application email/URL' => __( 'Contact Email/URL', 'listify' ),
				'Application Email' => __( 'Contact Email', 'listify' ),
				'Application URL' => __( 'Contact URL', 'listify' ),
				'Application Email or URL' => __( 'Contact email/URL', 'listify' ),
				'Position filled?' => __( 'Listing filled?', 'listify' ),
				'A video about your company' => __( 'A video about your listing', 'listify' ),

				'Job Submission' => array(
					__( '%s Submission', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Submit Job Form Page' => array(
					__( 'Submit %s Form Page', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Job Dashboard Page' => array(
					__( '%s Dashboard Page', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Job Listings Page' => array( 
					__( '%s Page', 'listify' ),
					array( $this->label( 'plural' ) )
				),

				'Add a job via the back-end' => array(
					__( 'Add a %s via the back-end', 'listify' ),
					array( $this->label( 'singular', true ) )
				),
				'Add a job via the front-end' => array(
					__( 'Add a %s via the front-end', 'listify' ), 
					array( $this->label( 'singular', true ) )
				),
				'Find out more about the front-end job submission form' => array(
					__( 'Find out more about the front-end %s submission form', 'listify' ),
					array( $this->label( 'singular', true ) )
				),
				'View submitted job listings' => array(
					__( 'View submitted %s listings', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Add the [jobs] shortcode to a page to list jobs' => array(
					__( 'Add the [jobs] shortcode to a page to list %s', 'listify' ),
					array( $this->label( 'plural', true ) )
				),
				'View the job dashboard' => array(
					__( 'View the %s dashboard', 'listify' ), 
					array( $this->label( 'singular', true ) )
				),
				'Find out more about the front-end job dashboard' => array(
					__( 'Find out more about the front-end %s dashboard', 'listify' ), 
					array( $this->label( 'singular', true ) )
				),

				'Company name' => __( 'Company name', 'listify' ),
				'Company website' => __( 'Company website', 'listify' ),
				'Company tagline' => __( 'Company tagline', 'listify' ),
				'Brief description about the company' => __( 'Brief description about the company', 'listify' ),
				'Company Twitter' => __( 'Company Twitter', 'listify' ),
				'Company logo' => __( 'Company logo', 'listify' ),
				'URL to the company logo' => __( 'URL to the company logo', 'listify' ),
				'Company video' => __( 'Company video', 'listify' ),

				'WP Job Manager Add-ons' => __( 'WP Job Manager Add-ons', 'listify' ),
				'Settings' => __( 'Settings', 'listify' ),
				'Add-ons' => __( 'Add-ons', 'listify' ),
				'Approve %s' => __( 'Approve %s', 'listify' ),
				'Expire %s' => __( 'Expire %s', 'listify' ),
				'%s approved' => __( '%s approved', 'listify' ),
				'%s expired' => __( '%s expired', 'listify' ),
				'Select category' => __( 'Select category', 'listify' ),
				'Position' => __( 'Title', 'listify' ),
				'%s updated. View' => __( '%s updated. View', 'listify' ),
				'Custom field updated.' => __( 'Custom field updated.', 'listify' ),
				'Custom field deleted.' => __( 'Custom field deleted.', 'listify' ),
				'%s updated.' => __( '%s updated.', 'listify' ),
				'%s restored to revision from %s' => __( '%s restored to revision from %s', 'listify' ),
				'%s published. View' => __( '%s published. View', 'listify' ),
				'%s saved.' => __( '%s saved.', 'listify' ),
				'%s submitted. Preview' => __( '%s submitted. Preview', 'listify' ),
				'M j, Y @ G:i' => __( 'M j, Y @ G:i', 'listify' ),
				'%s draft updated. Preview' => __( '%s draft updated. Preview', 'listify' ),
				'Type' => __( 'Type', 'listify' ),
				'Posted' => __( 'Posted', 'listify' ),
				'Expires' => __( 'Expires', 'listify' ),
				'Categories' => __( 'Categories', 'listify' ),
				'Featured?' => __( 'Featured?', 'listify' ),
				'Filled?' => __( 'Filled?', 'listify' ),
				'Status' => __( 'Status', 'listify' ),
				'Actions' => __( 'Actions', 'listify' ),
				'ID: %d' => __( 'ID: %d', 'listify' ),
				'M j, Y' => __( 'M j, Y', 'listify' ),
				'by a guest' => __( 'by a guest', 'listify' ),
				'by %s' => __( 'by %s', 'listify' ),
				'Approve' => __( 'Approve', 'listify' ),
				'View' => __( 'View', 'listify' ),
				'Edit' => __( 'Edit', 'listify' ),
				'Delete' => __( 'Delete', 'listify' ),
				'Listings Per Page' => __( 'Listings Per Page', 'listify' ),
				'How many listings should be shown per page by default?' => __( 'How many listings should be shown per page by default?', 'listify' ),
				'Filled Positions' => __( 'Filled Positions', 'listify' ),
				'Hide filled positions' => __( 'Hide filled positions', 'listify' ),
				'If enabled, filled positions will be hidden.' => __( 'If enabled, filled positions will be hidden.', 'listify' ),
				'Enable categories for listings' => __( 'Enable categories for listings', 'listify' ),
				'Multi-select Categories' => __( 'Multi-select Categories', 'listify' ),
				'Enable category multiselect by default' => __( 'Enable category multiselect by default', 'listify' ),
				'Category Filter Type' => __( 'Category Filter Type', 'listify' ),
				'Account Required' => __( 'Account Required', 'listify' ),
				'Submitting listings requires an account' => __( 'Submitting listings requires an account', 'listify' ),
				'Account Creation' => __( 'Account Creation', 'listify' ),
				'Allow account creation' => __( 'Allow account creation', 'listify' ),
				'Account Role' => __( 'Account Role', 'listify' ),
				'Approval Required' => __( 'Approval Required', 'listify' ),
				'New submissions require admin approval' => __( 'New submissions require admin approval', 'listify' ),
				'If enabled, new submissions will be inactive, pending admin approval.' => __( 'If enabled, new submissions will be inactive, pending admin approval.', 'listify' ),
				'Allow Pending Edits' => __( 'Allow Pending Edits', 'listify' ),
				'Submissions awaiting approval can be edited' => __( 'Submissions awaiting approval can be edited', 'listify' ),
				'Listing Duration' => __( 'Listing Duration', 'listify' ),
				'Application Method' => __( 'Contact Method', 'listify' ),
				'Choose the contact method for listings.' => __( 'Choose the contact method for listings.', 'listify' ),
				'Email address or website URL' => __( 'Email address or website URL', 'listify' ),
				'Email addresses only' => __( 'Email addresses only', 'listify' ),
				'Website URLs only' => __( 'Website URLs only', 'listify' ),
				'Pages' => __( 'Pages', 'listify' ),
				'Settings successfully saved' => __( 'Settings successfully saved', 'listify' ),
				'--no page--' => __( '--no page--', 'listify' ),
				'Select a page…' => __( 'Select a page…', 'listify' ),
				'Save Changes' => __( 'Save Changes', 'listify' ),
				'Setup' => __( 'Setup', 'listify' ),
				'Skip this step' => __( 'Skip this step', 'listify' ),
				'All Done!' => __( 'All Done!', 'listify' ),
				'Location' => __( 'Location', 'listify' ),
				'e.g. "London"' => __( 'e.g. "London"', 'listify' ),
				'Leave this blank if the location is not important' => __( 'Leave this blank if the location is not important', 'listify' ),
				'URL or email which applicants use to apply' => __( 'URL or email which applicants use for contact', 'listify' ),
				'URL to the company video' => __( 'URL to the company video', 'listify' ),
				'Position filled?' => __( 'Position filled?', 'listify' ),
				'Feature this listing?' => __( 'Feature this listing?', 'listify' ),
				'yyyy-mm-dd' => __( 'yyyy-mm-dd', 'listify' ),
				'Posted by' => __( 'Posted by', 'listify' ),
				'%s Data' => __( '%s Data', 'listify' ),
				'Use file' => __( 'Use file', 'listify' ),
				'Upload' => __( 'Upload', 'listify' ),
				'Add file' => __( 'Add file', 'listify' ),
				'Guest user' => __( 'Guest user', 'listify' ),
				'Showing %s' => __( 'Showing %s', 'listify' ),
				'Showing all %s' => __( 'Showing all %s', 'listify' ),
				'located in &ldquo;%s&rdquo;' => __( 'located in &ldquo;%s&rdquo;', 'listify' ),
				'No results found' => __( 'No results found', 'listify' ),
				'Query limit reached' => __( 'Query limit reached', 'listify' ),
				'Geocoding error' => __( 'Geocoding error', 'listify' ),
				'Employer' => __( 'Employer', 'listify' ),
				'Search %s' => __( 'Search %s', 'listify' ),
				'All %s' => __( 'All %s', 'listify' ),
				'Parent %s' => __( 'Parent %s', 'listify' ),
				'Parent %s:' => __( 'Parent %s:', 'listify' ),
				'Edit %s' => __( 'Edit %s', 'listify' ),
				'Update %s' => __( 'Update %s', 'listify' ),
				'Add New %s' => __( 'Add New %s', 'listify' ),
				'New %s Name' => __( 'New %s Name', 'listify' ),
				'Add New' => __( 'Add New', 'listify' ),
				'Add %s' => __( 'Add %s', 'listify' ),
				'New %s' => __( 'New %s', 'listify' ),
				'View %s' => __( 'View %s', 'listify' ),
				'No %s found' => __( 'No %s found', 'listify' ),
				'No %s found in trash' => __( 'No %s found in trash', 'listify' ),
				'This is where you can create and manage %s.' => __( 'This is where you can create and manage %s.', 'listify' ),
				'Expired' => array(
					__( 'Expired', 'listify' ),
					__( 'Expired (%s)', 'listify' )
				),
				'Invalid ID' => __( 'Invalid ID', 'listify' ),
				'This position has already been filled' => __( 'This position has already been filled', 'listify' ),
				'%s has been filled' => __( '%s has been filled', 'listify' ),
				'This position is not filled' => __( 'This position is not filled', 'listify' ),
				'%s has been marked as not filled' => __( '%s has been marked as not filled', 'listify' ),
				'%s has been deleted' => __( '%s has been deleted', 'listify' ),
				'Job Title' => sprintf( __( '%s Name', 'listify' ), $this->label( 'singular' ) ),
				'Date Posted' => __( 'Date Posted', 'listify' ),
				'Date Expires' => __( 'Date Expires', 'listify' ),
				'Load more listings' => sprintf( __( 'Load More %s', 'listify' ), $this->label( 'plural' ) ),
				'Recent %s' => __( 'Recent %s', 'listify' ),
				'Keyword' => __( 'Keyword', 'listify' ),
				'Number of listings to show' => __( 'Number of listings to show', 'listify' ),
				'Invalid listing' => __( 'Invalid listing', 'listify' ),
				'Save changes' => __( 'Save changes', 'listify' ),
				'Your changes have been saved.' => __( 'Your changes have been saved.', 'listify' ),
				'View &rarr;' => __( 'View →', 'listify' ),
				'Submit Details' => __( 'Submit Details', 'listify' ),
				'Preview' => __( 'Preview', 'listify' ),
				'Done' => __( 'Done', 'listify' ),
				'you@yourdomain.com' => __( 'you@yourdomain.com', 'listify' ),
				'http://' => __( 'http://', 'listify' ),
				'Enter an email address or website URL' => __( 'Enter an email address or website URL', 'listify' ),
				'Description' => __( 'Description', 'listify' ),
				'Enter the name of the company' => __( 'Enter the name of the company', 'listify' ),
				'Website' => __( 'Website', 'listify' ),
				'Tagline' => __( 'Tagline', 'listify' ),
				'Briefly describe your company' => __( 'Briefly describe your company', 'listify' ),
				'Video' => __( 'Video', 'listify' ),
				'A link to a video about your company' => __( 'A link to a video about your company', 'listify' ),
				'Twitter username' => __( 'Twitter username', 'listify' ),
				'@yourcompany' => __( '@yourcompany', 'listify' ),
				'Logo' => __( 'Logo', 'listify' ),
				'%s is a required field' => __( '%s is a required field', 'listify' ),
				'%s is invalid' => __( '%s is invalid', 'listify' ),
				'Please enter a valid application email address' => __( 'Please enter a valid contact email address', 'listify' ),
				'Please enter a valid application URL' => __( 'Please enter a valid application URL', 'listify' ),
				'Please enter a valid application email address or URL' => __( 'Please enter a valid contact email address or URL', 'listify' ),
				'You must be signed in to post a new listing.' => __( 'You must be signed in to post a new listing.', 'listify' ),
				'Submit Listing' => __( 'Submit Listing', 'listify' ),
				'Edit listing' => __( 'Edit listing', 'listify' ),
				'\%s\ (filetype %s) needs to be one of the following file types: %s' => __( '\%s\ (filetype %s) needs to be one of the following file types: %s', 'listify' ),
				'Your account' => __( 'Your account', 'listify' ),
				'You are currently signed in as <strong>%s</strong>.' => __( 'You are currently signed in as %s.', 'listify' ),
				'Sign out' => __( 'Sign out', 'listify' ),
				'Have an account?' => __( 'Have an account?', 'listify' ),
				'Sign in' => __( 'Sign in', 'listify' ),
				'optionally' => __( 'optionally', 'listify' ),
				'You must sign in to create a new listing.' => __( 'You must sign in to create a new listing.', 'listify' ),
				'Your email' => __( 'Your email', 'listify' ),
				'(optional)' => __( '(optional)', 'listify' ),
				'%s ago' => __( '%s ago', 'listify' ),
				'No more results found.' => __( 'No more results found.', 'listify' ),
				'Posted %s ago' => __( 'Posted %s ago', 'listify' ),
				'This position has been filled' => __( 'This position has been filled', 'listify' ),
				'This listing has expired' => __( 'This listing has expired', 'listify' ),
				'remove' => __( 'remove', 'listify' ),
				'or' => __( 'or', 'listify' ),
				'Maximum file size: %s.' => __( 'Maximum file size: %s.', 'listify' ),
				'Apply using webmail:' => __( 'Apply using webmail:', 'listify' ),
				'To apply for this job please visit the following URL: <a href=\"%1$s\" target=\"_blank\">%1$s &rarr;</a>' => __( 'To contact this listing owner please visit the following URL: <a href=\"%1$s\" target=\"_blank\">%1$s %rarr;</a>' ),

				'Apply for job' => array(
					__( 'Contact %s', 'listify' ), 
					array( $this->label( 'singular' ) )
				),

				'You need to be signed in to manage your listings.' => __( 'You need to be signed in to manage your listings.', 'listify' ),
				'You do not have any active listings.' => __( 'You do not have any active listings.', 'listify' ),
				'Mark not filled' => __( 'Mark not filled', 'listify' ),
				'Mark filled' => __( 'Mark filled', 'listify' ),
				'Relist' => __( 'Relist', 'listify' ),
				'Keywords' => __( 'What are you looking for?', 'listify' ),
				'Category' => __( 'Category', 'listify' ),
				'Any category' => __( 'All categories', 'listify' ),
				'Company Details' => __( 'Company Details', 'listify' ),
				'%s submitted successfully. Your listing will be visible once approved.' => __( '%s submitted successfully. Your listing will be visible once approved.', 'listify' ),
				'Draft' => __( 'Draft', 'listify' ),
				'Preview' => __( 'Preview', 'listify' ),
				'Pending approval' => __( 'Pending approval', 'listify' ),
				'Pending payment' => __( 'Pending payment', 'listify' ),
				'Active' => __( 'Active', 'listify' ),
				'Reset' => __( 'Reset', 'listify' ),
				'RSS' => __( 'RSS', 'listify' ),
				'Your email address isn’t correct.' => __( 'Your email address isn’t correct.', 'listify' ),
				'This email is already registered, please choose another one.' => __( 'This email is already registered, please choose another one.', 'listify' ),
				'Choose a category&hellip;' => __( 'Choose a category&hellip;', 'listify' ),
				'Inactive' => __( 'Inactive', 'listify' ),
				'Application via \%s\ listing on %s' => __( 'Application via \%s\ listing on %s', 'listify' ),
				'Anywhere' => __( 'Anywhere', 'listify' ),
				'Are you sure you want to delete this listing?' => __( 'Are you sure you want to delete this listing?', 'listify' ),
				'Your listings are shown in the table below.' => __( 'Your listings are shown in the table below.', 'listify' ),
				'Listing Expires' => __( 'Listing Expires', 'listify' ),
				'If you don&rsquo;t have an account you can %screate one below by entering your email address/username. Your account details will be confirmed via email.' => __( 'If you don&rsquo;t have an account you can %screate one below by entering your email address/username. Your account details will be confirmed via email.', 'listify' ),
				'To apply for this job please visit the following URL: <a href="%1$s" target="_blank">%1$s &rarr;</a>' => __( 'To contact this listing owner please visit the following URL: <a href="%1$s" target="_blank">%1$s &rarr;</a>', 'listify' ),
				'To apply for this job <strong>email your details to</strong> <a class="job_application_email" href="mailto:%1$s%2$s">%1$s</a>' => __( 'To contact this listing <strong>email your details to</strong> <a class="job_application_email" href="mailto:%1$s%2$s">%1$s</a>', 'listify' )
			),
			'wp-job-manager-tags' => array(
				'Job Tags' => array(
					__( '%s Tags', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Job tags' => array(
					__( '%s Tags', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'job-tag' => array(
					__( '%s-tag', 'listify' ),
					array( $this->label( 'singular', true ) )
				),
				'Comma separate tags, such as required skills or technologies, for this job.' => '',
				'Choose some tags, such as required skills or technologies, for this job.' => __( 'Add tags such as available amenities', 'listify' ),
				'Filter by tag:' => __( 'Filter by tag:', 'listify' ),
				'tagged' => __( 'tagged', 'listify' ),
				'Jobs will be shown if within ALL chosen tags' => __( 'Listings will be shown if within ALL chosen tags', 'listify' ),
				'Jobs will be shown if within ANY chosen tag' => __( 'Listings will be shown if within ANY chosen tags', 'listify' ),

				'Maximum Job Tags' => array(
					__( 'Maximum %s Tags', 'listify' ),
					array( $this->label( 'singular' ) )
				)
			),
			'wp-job-manager-locations' => array(
				'Job Regions' => array(
					__( '%s Regions', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Job Region' => array(
					__( '%s Region', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'job-region' => array(
					__( '%s-region', 'listify' ),
					array( $this->label( 'singular', true ) )
				),
				'Display a list of job regions.' => array(
					__( 'Display a list of %s regions.', 'listify' ), 
					array( $this->label( 'singular', true ) )
				)
			),
			'wp-job-manager-wc-paid-listings' => array(
				'Choose a package before entering job details' => sprintf( __( 'Choose a package before entering %s details', 'listify' ), $this->label( 'singular' ) ),
				'Choose a package after entering job details' => sprintf( __( 'Choose a package after entering %s details', 'listify' ), $this->label( 'singular' ) ),
				'Choose a package' => __( 'Choose a package', 'listify' ),
				'Purchase Package:' => __( 'Purchase Package:', 'listify' ),
				'Listing Details &rarr;' => __( 'Listing Details &rarr;', 'listify' ),
				'%s job posted out of %d' => array(
					__( '%s listing posted out of %d', 'listify' ),
					__( '%s listings posted out of %d', 'listify' )
				),
				'%s job posted' =>  array(
					__( '%s listing posted', 'listify' ),
					__( '%s listings posted', 'listify' )
				),
				'%s for %s job' => array(
					__( '%s for %s listing', 'listify' ),
					__( '%s for %s listings', 'listify' )
				),
				'Job Package' => array(
					__( '%s Package', 'listify' ), 
					array( $this->label( 'singular' ) )
				),
				'Job Package Subscription' => array(
					__( '%s Package Subscription', 'listify' ), 
					array( $this->label( 'singular' ) )
				),
				'Job Listing' => array(
					__( '%s', 'listify' ), 
					array( $this->label( 'singular' ) )
				),
				'Job listing limit' => array(
					__( '%s limit', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Job listing duration' => array(
					__( '%s duration', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'The number of days that the job listing will be active.' => array(
					__( 'The number of days that the %s will be active', 'listify' ),
					array( $this->label( 'singular', true ) )
				),
				'Feature job listings?' => array(
					__( 'Feature %s?', 'listify' ), 
					array( $this->label( 'singular', true ) )
				),
				'Feature this job listing - it will be styled differently and sticky.' => array(
					__( 'Feature this %s -- it will be styled differently and sticky.', 'listify' ), 
					array( $this->label( 'singular', true ) )
				),
				'My Job Packages' => array(
					__( 'My %s Packages', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Jobs Remaining' => array(
					__( '%s Remaining', 'listify' ),
					array( $this->label( 'plural' ) )
				)
			),
			'wp-job-manager-simple-paid-listings' => array(
				'Job #%d Payment Update' => __( '#%d Payment Update', 'listify' )
			),
			'wp-job-manager-alerts' => array(
				'Jobs matching your "%s" alert:' => __( 'Results for your "%s" alert:', 'listify' ),
				'Job Alert Results Matching "%s' => __( 'Results Matching "%s', 'listify' ),
				'No jobs were found matching your search. Login to your account to change your alert criteria' => __( 'No results were found matching your search. Login to your account to change your alert criteria', 'listify' ),
				'This job alert will automatically stop sending after %s.' => __( 'This alert will automatically stop sending after %s.', 'listify' ),
				'No jobs found' => array(
					__( 'No %s found', 'listify' ),
					array( $this->label( 'plural', true ) )
				),
				'Optionally add a keyword to match jobs against' => array(
					__( 'Optionally add a keyword to match %s against', 'listify' ),
					array( $this->label( 'plural', true ) )
				),
				'Job Type' => array(
					__( '%s Type', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Job Region' => array(
					__( '%s Region', 'listify' ),
					array( $this->label( 'singular' ) )
				),
				'Any job type' => array(
					__( 'Any %s type', 'listify' ), 
					array( $this->label( 'singular', true ) )
				),
				'Job Type:' => array(
					__( '%s Type:', 'listify' ), 
					array( $this->label( 'singular' ) )
				),
				'Your job alerts are shown in the table below. Your alerts will be sent to %s.' => __( 'Your alerts are shown in the table below. The alerts will be sent to %s.', 'listify' ),
				'Alert me to jobs like this' => sprintf( __( 'Alert me of %s like this', 'listify' ), $this->label( 'plural', true ) ),
			),
			'jwapl' => array(
				'Job Package' => array(
					__( '%s Package', 'listify' ), 
					array( $this->label( 'singular' ) )
				),
				'Job Package Subscription' => array(
					__( '%s Package Subscription', 'listify' ), 
					array( $this->label( 'singular' ) )
				)
			)
		);

		$this->strings = apply_filters( 'listify_strings', $strings );

		return $this->strings;
	}

}

$GLOBALS[ 'listify_strings' ] = new Listify_Strings();
