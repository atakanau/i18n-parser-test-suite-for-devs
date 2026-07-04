/**
 * Admin JS for i18n Parser Test Suite for Devs.
 */
(function() {
	'use strict';

	document.addEventListener('DOMContentLoaded', function() {
		const wrapper = document.querySelector('.wp-i18n-test-suite-scenarios');
		const filterBar = document.querySelector('.wp-i18n-test-suite-filter-bar');
		if (!wrapper || !filterBar) return;

		const cards = wrapper.querySelectorAll('.wp-i18n-test-suite-card');

		// Handle radio filtering (single click execution)
		filterBar.querySelectorAll('input[name="wp-i18n-radio-filter"]').forEach(radio => {
			radio.addEventListener('change', function() {
				const val = this.value;
				cards.forEach(card => {
					card.style.display = (val === 'all' || card.classList.contains(val)) ? '' : 'none';
				});
			});
		});

		// Helper to toggle all visible elements
		function toggleAllVisible(show) {
			cards.forEach(card => {
				if (card.style.display !== 'none') {
					const code = card.querySelector('.wp-i18n-test-suite-code');
					const table = card.querySelector('.wp-i18n-test-suite-table');
					if (code) code.style.display = show ? '' : 'none';
					if (table) table.style.display = show ? '' : 'none';
				}
			});
		}

		// Handle bulk visibility buttons
		document.getElementById('wp-i18n-expand-all').addEventListener('click', () => toggleAllVisible(true));
		document.getElementById('wp-i18n-collapse-all').addEventListener('click', () => toggleAllVisible(false));

		// Toggle code visibility on header click
		cards.forEach(card => {
			const header = card.querySelector('h2');
			const code = card.querySelector('.wp-i18n-test-suite-code');
			const table = card.querySelector('.wp-i18n-test-suite-table');
			
			if (header && code) {
				header.style.cursor = 'pointer';
				header.addEventListener('click', () => {
					const isHidden = code.style.display === 'none';
					code.style.display = isHidden ? '' : 'none';
					if (table) table.style.display = isHidden ? '' : 'none';
				});
			}
		});
	});
})();
