(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(document).ready(function () {
		var ldwpforo_settings = $('#ldwpforo_course_selector-sortables').html();
		if (typeof ldwpforo_settings !== 'undefined') {
			var wpforo_class = learndashwpforo.wpforo_foums_body_class;
			var wpforo_class = adminpage;
			$('body.' + wpforo_class + ' #postbox-container-2 #normal-sortables').append(ldwpforo_settings);
			$('#ldwpforo_course_selector-sortables').hide();
		}
	});

	// Support tab
	$(document).ready(function () {
		var acc = document.getElementsByClassName("wbcom-faq-accordion");
		var i;
		for (i = 0; i < acc.length; i++) {
			acc[i].onclick = function () {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
					panel.style.maxHeight = null;
				} else {
					panel.style.maxHeight = panel.scrollHeight + "px";
				}
			}
		}
		$(document).on(
			'click', '.wbcom-faq-accordion', function () {
				return false;
			}
		);

	});

})(jQuery);
