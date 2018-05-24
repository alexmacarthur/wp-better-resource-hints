<?php
	use BetterResourceHints\Utilities;
	$value = Utilities::get_option("preload_assets_enable_server_push");
?>

<div class="options-block">
	<h2>Server Push Preloaded Resources</h2>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preload_assets_enable_server_push">Yes, Server Push Preloaded Assets</label>
			<input type="checkbox"
			<?php checked($value, 'on'); ?>
			id="preload_assets_enable_server_push"
			name="<?php echo Utilities::get_field_name("preload_assets_enable_server_push"); ?>">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">If checked, every preloaded asset will also have a prefetch header sent to server push the asset. <strong>You must be using a server with server push enabled for this to work.</strong></p>
		</div>
	</div>
</div>
