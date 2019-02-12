<?php
    use BetterResourceHints\Utilities;

$value = Utilities::get_option("preconnect_hosts_enable_server_push");
?>

<div class="options-block">
	<h2>Server Push Preconnected Resources</h2>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preconnect_hosts_enable_server_push">Yes, Server Push Preconnected Hosts</label>
			<input type="checkbox"
			<?php checked($value, 'on'); ?>
			id="preconnect_hosts_enable_server_push"
			name="<?php echo Utilities::get_field_name("preconnect_hosts_enable_server_push"); ?>">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">If checked, every preconnected asset will also have a preconnect header sent to server push the asset. <strong>You must be using a server with server push enabled for this to work.</strong></p>
		</div>
	</div>
</div>
