<?php
/* 
	Ad Loader Component Sidebar
	Purpose: Load PYMNTS promotional ads at top of page. Reference ACF Option Page for Ads and display randomly.
	Author: Kenan Cross 
	Date: 9/1/2023
*/

//Do display in the sidebar: add this code to the text display for HTML output: <?php include('components/adLoader/adLoader-frontpage.php');

//Variable Set Up

$ads = get_field('pymnt_frontpage_ads', 'options');

if (!empty($ads)) :
	$adLength = count($ads);
	$randIndex = rand(0, $adLength - 1);
endif;
?>
<style>
	#PYMNT_report_ad.pymnt_ads {
		width: 100%;
		display: flex;
		justify-content: center;
	}

	#PYMNT_report_ad.pymnt_ads img {
		width: 100%;
		height: auto;
	}
</style>
<div id="PYMNT_report_ad" class="pymnt_ads"><!-- Newsletter Ad -->
	<div class="mb-5 mt-3">
		<a href="<?= $ads[$randIndex]['url']; ?>">
			<img src="<?= $ads[$randIndex]['ad']['url']; ?>" width="750" height="200" alt="<?= $ads[$randIndex]['label']; ?>">
		</a>
	</div>
</div>