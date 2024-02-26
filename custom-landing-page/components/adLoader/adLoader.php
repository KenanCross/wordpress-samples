<?php
/* 
	Ad Loader Component
	Purpose: Load PYMNTS promotional ads at top of page. Reference ACF Option Page for Ads and display randomly.
	Author: Kenan Cross 
	Date: 9/1/2023
*/

//Variable Set Up

$ads = get_field('pymnt_ads', 'options');
if (!empty($ads)) :
	$adLength = count($ads);
	$randIndex = rand(0, $adLength - 1);
endif;
if ((is_singular('post') && !empty(get_field('ad_toggle'))) || is_front_page()) :
?>
	<style>
		.pymnt_ads {
			width: 100%;
			display: flex;
			justify-content: center;
		}

		.pymnt_ads img {
			width: 100%;
			height: auto;
		}

		.adContainer {
			max-width: 750px;
			margin: auto;
		}

		.adContainer_large {
			max-width: 2000px;
			margin: auto;
		}
	</style>
	<?php
	if ($ads[$randIndex]['url'] != '') : ?>
		<div id="PYMNT_ad" class="bg-dark pymnt_ads">
			<!-- Newsletter Ad -->
			<div class="adContainer<?php if ($ads[$randIndex]['ad']['height'] > 900) : print('_large');
									endif; ?>">
				<a href=" <?= $ads[$randIndex]['url'] ?>">
					<img src="<?= $ads[$randIndex]['ad']['url'] ?>" width="<?= $ads[$randIndex]['ad']['width'] ?>" height="<?= $ads[$randIndex]['ad']['height'] ?>" alt="<?= $ads[$randIndex]['label'] ?>" data-report="<?= $ads[$randIndex]['label'] ?>">
				</a>
			</div>
		</div>
<?php endif;
endif; ?>