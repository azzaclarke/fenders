
<?php

// Get Full Request
$main_full_request = $_SERVER[REQUEST_URI];

// Clean out first and end slash and dots from main URI seg
$main_page_req = parse_url($main_full_request )['path'];
$main_page_req = strtolower($main_full_request);
$main_page_req = ltrim($main_page_req, '/');
$main_page_req = rtrim($main_page_req, '/');
$main_page_req = str_replace('.', '', $main_page_req );

// Create Settings
// ---------------------------------

define('DEBUG', true);
define('PAGE_REQUEST', $main_page_req . '.php');
define('PAGE_REQUEST_TRIM', $main_page_req);

define('PAGE_HEADER', 'private_includes/templates/page/header.php');
define('PAGE_FOOTER', 'private_includes/templates/page/footer.php');

define('PAGE_404', 'pages/404.php');
define('PAGE_HOME', 'pages/home.php');
define('PAGE_PRODUCT', 'private_includes/templates/product/product.php');


// Page Routing
// ---------------------------------

// Header
include_once(PAGE_HEADER);

// Main Body
$main_target_page = 'pages/' . PAGE_REQUEST;

if( PAGE_REQUEST_TRIM == '' ) {
    include_once(PAGE_HOME);
}
else if ( $main_product = get_product_from_uri(PAGE_REQUEST_TRIM) !== false ){
    include_once(PAGE_PRODUCT);
}
else if ( file_exists( $main_target_page ) ) {
    include_once($main_target_page);
}
else {
    include_once(PAGE_404);
}

// Footer
include_once(PAGE_FOOTER);

// Functions
// ---------------------------------

function get_product_from_uri( $uri_string ) {
    return false;
}

