<?php

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wordpress/moviedatabase/wp-load.php' );

$searchType = $_POST['searchType'];
$search = !empty($_POST['search']) ? $_POST['search'] : '';

$results = [];

if ($searchType === 'search')
    $results = $wpdb->get_results("SELECT * FROM mw_posts WHERE post_type = 'movie' AND post_title LIKE '%" . $search . "%'");

$count = count($results);

for ($i = 0; $i < $count; $i++) {

    $pdfID = $results[$i]->meta_value;
    $results[$i]->pdflink = get_the_guid($pdfID);
}

echo json_encode($results);
