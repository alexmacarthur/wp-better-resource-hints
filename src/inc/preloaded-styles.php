<?php
	use BetterResourceHints\Utilities;
	$value = Utilities::get_option("preload_styles_option");
	$valueHandles = Utilities::get_option("preload_styles_handles");
	$value = !$value ? 'no_styles' : $value;
?>

<div class="options-block">
	<h2>Style Preloading Settings</h2>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preload_no_styles">No Stylesheets</label>
			<input type="radio"
			<?php checked($value, 'no_styles'); ?>
			id="preload_no_styles"
			name="<?php echo Utilities::get_field_name("preload_styles_option"); ?>"
			value="no_styles">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">No CSS will be preloaded. All stylesheets will load as they normally would.</p>
		</div>
	</div>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preload_all_styles">All Stylesheets</label>
			<input type="radio"
			<?php checked($value, 'all_styles'); ?>
			id="preload_all_styles"
			name="<?php echo Utilities::get_field_name("preload_styles_option"); ?>"
			value="all_styles">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">All stylesheets will be preloaded asyncronously, and activated once they're loaded. <strong>Warning:</strong> This may cause a brief flash of unstyled content, since the page will begin to render before waiting for any stylesheets have fully loaded. Your page load time will be quicker, but this flash of unstyled content may be an undesired side effect.</p>
		</div>
	</div>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preload_choose_styles">Choose Styles to Preload</label>
				<input type="radio"
				data-choose="true"
				<?php checked($value, 'choose_styles'); ?>
				id="preload_choose_styles"
				name="<?php echo Utilities::get_field_name("preload_styles_option"); ?>"
				value="choose_styles">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">Enter a comma-separated list of registered styles handles you'd like to preload whenever they're enqueued on a page. Ideally, these files would not contain any CSS critical to the initial render of the page, since preloading them may cause a flash of unstyled content. You can find these handles by looking for the 'data-handle' attribute on the tags in your source code.</p>
		</div>
		<div class="InputBlock-row">
			<textarea
			<?php if($value !== 'choose_styles'){ echo 'style="display: none;"'; }; ?>
			name="<?php echo Utilities::get_field_name("preload_styles_handles"); ?>"><?php echo $valueHandles; ?></textarea>
		</div>
	</div>

</div>
