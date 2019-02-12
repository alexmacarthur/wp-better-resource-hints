<?php
    use BetterResourceHints\Utilities;

$value = Utilities::get_option("preconnect_hosts_option");
    $value = !$value ? 'external_assets' : $value;
?>

<div class="options-block">
	<h2>Script Preconnecting Settings</h2>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preconnect_no_assets">Don't Preconnect Assets</label>
			<input type="radio"
			<?php checked($value, 'no_assets'); ?>
			id="preconnect_no_assets"
			name="<?php echo Utilities::get_field_name("preconnect_hosts_option"); ?>"
			value="no_assets">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">No assets will be preconnected.</p>
		</div>
	</div>

	<div class="InputBlock">
		<div class="InputBlock-row">
			<label for="preconnect_external_assets">Preconnect External Hosts</label>
				<input type="radio"
				data-choose="true"
				<?php checked($value, 'external_assets'); ?>
				id="preconnect_external_assets"
				name="<?php echo Utilities::get_field_name("preconnect_hosts_option"); ?>"
				value="external_assets">
		</div>
		<div class="InputBlock-row">
			<p class="InputBlock-description description">All CSS &amp; JS not hosted by your domain will be preconnected.</p>
		</div>
	</div>

</div>
