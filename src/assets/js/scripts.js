class BetterResourceHintsController {
	constructor() {

		if (document.querySelector('.settings_page_better_resource_hints') == null) {
			return;
		}

		this.handleMainRadioOptions();
		this.handleTabs();
	}

	handleTabs() {
		let allTabs = document.querySelectorAll('[data-tab-id]');

			let possibleBlocks = [];
			[].forEach.call(allTabs, (tab) => {
				possibleBlocks.push(tab.getAttribute('data-tab-id'));
			});

			[].forEach.call(allTabs, (tab) => {

				tab.addEventListener('click', (e) => {
					e.preventDefault();
					let block = e.target.getAttribute('data-tab-id');

					let url = window.location.href;
					possibleBlocks.forEach(block => {
						url = url.replace(`&active-tab=${block}`, '');
					});
					history.replaceState(null, null, `${url}&active-tab=${block}`);

					[].forEach.call(allTabs, (tab) => {
						tab.classList.remove('is-selected');
					});

					e.target.classList.add('is-selected');

					let allTabBlocks = document.querySelectorAll('.Tabs-block');
					[].forEach.call(allTabBlocks, block => {
						block.classList.remove('is-selected');
					});

					document.querySelector(`[data-tab-content="${block}"]`)
						.classList.add('is-selected');
				});
			});
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

