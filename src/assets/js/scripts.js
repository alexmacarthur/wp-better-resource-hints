class BetterResourceHintsController {
	constructor() {

		if (document.querySelector('.settings_page_better_resource_hints') == null) {
			return;
		}

		this.handleMainRadioOptions();
	}

	handleMainRadioOptions() {
		let $inputs = document.querySelectorAll('.settings_page_better_resource_hints [type="radio"]');

		[].forEach.call($inputs, ($input) => {
			$input.addEventListener('change', (e) => {
				let isChoosing = e.target.getAttribute('data-choose') !== null;

				let $closest = e.target
					.closest('.options-block')
					.querySelector('textarea');

				if ($closest === null) return;

				$closest.style.display = isChoosing
					? 'block'
					: 'none';
			});
		});
	}
}

new BetterResourceHintsController();

