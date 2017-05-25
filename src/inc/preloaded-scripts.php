<?php
	use BetterResourceHints\Utilities;
	$value = Utilities::get_option("preload_scripts_option");
	$valueHandles = Utilities::get_option("preload_scripts_handles");
	$value = !$value ? 'footer_scripts' : $value;
?>

<div class="options-block">
	<h2>Script Preloading Settings</h2>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preload_no_scripts">Don't Preload Scripts</label>
			<input type="radio"
			<?php checked($value, 'no_scripts'); ?>
			id="preload_no_scripts"
			name="<?php echo Utilities::get_field_name("preload_scripts_option"); ?>"
			value="no_scripts">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">No JavaScript files will be preloaded. All will load as they normally would.</p>
		</div>
	</div>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preload_all_scripts">All Scripts</label>
			<input type="radio"
			<?php checked($value, 'all_scripts'); ?>
			id="preload_all_scripts"
			name="<?php echo Utilities::get_field_name("preload_scripts_option"); ?>"
			value="all_scripts">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">Every script enqueued on each page will also be preloaded, regardless of them being in the footer or head.</p>
		</div>
	</div>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preload_footer_scripts">Footer Scripts Only</label>
			<input type="radio"
			<?php checked($value, 'footer_scripts'); ?>
			id="preload_footer_scripts"
			name="<?php echo Utilities::get_field_name("preload_scripts_option"); ?>"
			value="footer_scripts">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">Only the scripts enqueued in the footer (as well as their dependencies) will be preloaded. <strong>If you're not sure what to choose, this is the recommended option.</strong></p>
		</div>
	</div>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preload_choose_scripts">Choose Scripts by Handle</label>
				<input type="radio"
				data-choose="true"
				<?php checked($value, 'choose_scripts'); ?>
				id="preload_choose_scripts"
				name="<?php echo Utilities::get_field_name("preload_scripts_option"); ?>"
				value="choose_scripts">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">Enter a comma-separated list of registered script handles you'd like to preload whenever they're enqueued on a page. You can find these handles by looking for the 'data-handle' attribute on the tags in your source code.</p>
		</div>
		<div class="InputBlock-row">
			<textarea
			<?php if($value !== 'choose_scripts'){ echo 'style="display: none;"'; }; ?>
			name="<?php echo Utilities::get_field_name("preload_scripts_handles"); ?>"><?php echo $valueHandles; ?></textarea>
		</div>
	</div>

</div>
