<?php
/*
Template Name: Email Newsletter
*/

$SiteURL = "http://www.greencandledance.com/";
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>// Green Candle Dance Company</title>
</head>
<body>
<center>

<!-- pseudo body table -->
<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="99%">
	<tbody>
		<tr>
			<td align="center">

<!-- wrapper table for email -->
<table border="0" cellpadding="0" cellspacing="0" bgcolor="" width="545" style="">
	<tbody>
		<tr>
			<td align="center">
            
            <p>
            Link to the web version <a style="color:#6ecae1;" href="" target="_blank">here</a>
            </p>
            <p>
            You're receiving this email because you signed up for our mailing list. If you don't want to receive emails from us any more, you can unsubscribe at the bottom of this email.
            </p>


<!-- start of email -->
			<table border="0" cellpadding="0" cellspacing="0" bgcolor="transparent" width="545">
				<tbody>
				<tr>
					<td style="padding: 0px 0px 0px 10px; width="545" height="100"><img src="http://79.170.40.49/greencandledance.com/wp-content/uploads/2012/02/logo.png" alt="Green Candle Dance Company" width="175" height="105" /></td>

				</tr>
				<tr>
					<td width="545" valign="top" bgcolor="#ffffff">


<!-- email content goes here -->

<?php query_posts('showposts=4&cat=10');
	if (have_posts()) : $i=1;
		while (have_posts()) : the_post();

			$ImageThumbURL = get_post_meta($post->ID, "image thumbnail", $single);
			$ExploreLinkIcon = get_post_meta($post->ID, "explore link icon", $single);
			$Excerpt = get_the_excerpt();
			$Excerpt = str_replace('<p>', '', $Excerpt);
			$Excerpt = str_replace('</p>', '', $Excerpt);

			if ($ImageThumbURL) {
				$featurethumb = "<img src=\"".$ImageThumbURL."\" width=\"210\" height=\"150\"  />";
			}

			if ($ExploreLinkIcon) {
				switch($ExploreLinkIcon) {
					case "blue":
						$LinkIcon = "btn-explore-blue.jpg";
						break;
					case "grey":
						$LinkIcon = "btn-explore-gray.jpg";
						break;
					case "red";
						$LinkIcon = "btn-explore-red.jpg";
						break;
				}
			}

?>

<table border="0" cellpadding="0" cellspacing="10" bgcolor="transparent" width="545">
	<tbody>
	
		<tr>
			<td align="left" width="350" height="100" valign="top">

				<table border="0" cellpadding="0" cellspacing="0" bgcolor="transparent" width="525">
					<tbody>
					<tr>
						<td align="left" width="210" height="150" valign="top">
							<?php echo $featurethumb; ?>
						</td>

						<td align="left" width="315" height="150" valign="top">
							<p style="color:#3D464E;font-family: Helvetica,sans-serif;font-size:12px;text-transform:uppercase;font-weight:bold;margin-left:0;margin-right:0;padding-left:10px;padding-right:10px;margin-top:0;margin-bottom:0;padding-top:10px;padding-bottom:10px;">
							<?php echo get_the_title(); ?>
							</p>
							<p style="color:#888F97;font-family: Helvetica,sans-serif;font-size:12px;line-height:14px;margin-left:0;margin-right:0;padding-left:10px;padding-right:10px;margin-top:0;margin-bottom:0;padding-top:10px;padding-bottom:10px;">
								<?php echo $Excerpt; ?>
							</p>
						</td>

					</tr>

					</tbody>
				</table>

			</td>
		</tr>
				
	</tbody>
	
</table>

<?php
	$featurethumb = "";
	endwhile;
endif; ?>

<!-- footer table -->
<table border="1" cellpadding="0" cellspacing="10" bgcolor="#2e576b" width="549">
	<tbody>
		<tr>
			<td align="left" width="525" height="90" valign="top">

<p>
Links here.
</p>

			
		</tr>
	</tbody>
</table>



<!-- content ends -->


					</td>
				</tr>
				</tbody>
			</table>



<p> Green Candle Dance Company
<br>
London, E2 6HG<br>
020 7739 7722<br>
<a href="mailto:communications@greencandledance.com" target="_blank">communications@greencandledance.com</a>
</p>

<p>
&copy; 2013 Green Candle Dance Company. All rights reserved.</p>



			</td>
		</tr>

	</tbody>
</table>
<!-- close wrapper table for email -->


			</td>
		</tr>
	</tbody>
</table>
<!-- close pseudo body table -->

</center>
</body>
</html>