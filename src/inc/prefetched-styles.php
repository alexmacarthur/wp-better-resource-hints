<?php
	use BetterResourceHints\Utilities;
	$value = Utilities::get_option("prefetch_styles_option");
	$valueHandles = Utilities::get_option("prefetch_styles_handles");
	$value = !$value ? 'no_styles' : $value;
?>

<div class="options-block">
	<h2>Style Prefetching Settings</h2>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="prefetch_no_styles">Don't Prefetch Styles</label>
			<input type="radio"
			<?php checked($value, 'no_styles'); ?>
			id="prefetch_no_styles"
			name="<?php echo Utilities::get_field_name("prefetch_styles_option"); ?>"
			value="no_styles">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">No styles will be prefetched.</p>
		</div>
	</div>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="prefetch_choose_styles">Choose Styles to Prefetched</label>
				<input type="radio"
				data-choose="true"
				<?php checked($value, 'choose_styles'); ?>
				id="prefetch_choose_styles"
				name="<?php echo Utilities::get_field_name("prefetch_styles_option"); ?>"
				value="choose_styles">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">Enter a comma-separated list of registered handles you'd like to prefetch whenever they're not enqueued on a page.</p>
		</div>
		<div class="InputBlock-row">
			<textarea
			<?php if($value !== 'choose_styles'){ echo 'style="display: none;"'; }; ?>
			name="<?php echo Utilities::get_field_name("prefetch_styles_handles"); ?>"><?php echo $valueHandles; ?></textarea>
		</div>
	</div>

</div>
