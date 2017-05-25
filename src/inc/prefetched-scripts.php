<?php
	use BetterResourceHints\Utilities;
	$value = Utilities::get_option("prefetch_scripts_option");
	$valueHandles = Utilities::get_option("prefetch_scripts_handles");
	$value = !$value ? 'no_scripts' : $value;
?>

<div class="options-block">
	<h2>Script Prefetching Settings</h2>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="prefetch_no_scripts">Don't Prefetch Scripts</label>
			<input type="radio"
			<?php checked($value, 'no_scripts'); ?>
			id="prefetch_no_scripts"
			name="<?php echo Utilities::get_field_name("prefetch_scripts_option"); ?>"
			value="no_scripts">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">No scripts will be prefetched.</p>
		</div>
	</div>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="prefetch_choose_scripts">Choose Scripts to Prefetch</label>
				<input type="radio"
				data-choose="true"
				<?php checked($value, 'choose_scripts'); ?>
				id="prefetch_choose_scripts"
				name="<?php echo Utilities::get_field_name("prefetch_scripts_option"); ?>"
				value="choose_scripts">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">Enter a comma-separated list of registered handles you'd like to prefetch whenever they're not enqueued on a page.</p>
		</div>
		<div class="InputBlock-row">
			<textarea
			<?php if($value !== 'choose_scripts'){ echo 'style="display: none;"'; }; ?>
			name="<?php echo Utilities::get_field_name("prefetch_scripts_handles"); ?>"><?php echo $valueHandles; ?></textarea>
		</div>
	</div>

</div>
