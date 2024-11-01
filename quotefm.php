<html>

<?php
/*
Plugin Name: QUOTE.fm Recommendations
Plugin URI: http://internetbibel.org/
Description: A Plugin that shows your QUOTE.fm recommendations
Version: 1.0
Author: Din Bisevac
Author URI: http://internetbibel.org/
Min WP Version: 2.5
Max WP Version: 3.3.1
*/
?>
<head>
	<link rel="stylesheet" type="text/css" href="quotefm.css">
</head>
<body>
<?php
function shortcode_quotefm($atts) {
	$meinusername = ($atts['username'] ? $atts['username'] : 'uarrr');
$api = file_get_contents('https://quote.fm/api/recommendation/listByUser/?username=' . $meinusername);

$obj=json_decode($api);

$name = $_POST["url"];
$avatar = $obj->entities[0]->user->avatar;
$usernames = $obj->entities[0]->user->username;
$bio = $obj->entities[0]->user->bio;


 $quotefm = '



<section>

<h1>Recommendations von ' . $meinusername . '.</h1>
<div class="profile">
	<span><img src="' .$avatar . '" class="avatar" style="width: 14%;"></span>
	<span class="info" style="float: right; width: 84%;">
		<span style="margin-bottom: 10px;">' . $usernames . '</span></br>
		
		<span style="color: #969696">' . $bio . '</span>
	</span>
</div>

</br>

</section></br>';


foreach($obj->entities as $quote) {
$recommendation = $quote->id;
$quotes = $quote->quote;
$username = $quote->user->username;
$comments = $quote->commentCount;
$url = $quote->article_id;
$quotefm .= '



<div class="container">
	<a href="http://www.quote.fm/article/' . $url . '"><div class="quote"  style="border: 1px solid #F2F2F2; padding: 14px;">' . $quotes . '</br></a></br>Kommentare: ' . $comments . '</div>
</div></br>

	';
 	}  

return $quotefm;
}
add_shortcode('quotefm', 'shortcode_quotefm');

?>
</body>
</html>