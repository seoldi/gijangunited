/* ----------------
ResponsiveTabs.js
Author: Pete Love | www.petelove.com
Version: 1.10
------------------- */

var RESPONSIVEUI = {};

(function($) {

	RESPONSIVEUI.responsiveTabs = function () {
		var $tabSets = $('.responsive-tabs');

		if (!$tabSets.hasClass('restabs_enabled')) {	// if we haven't already called this function and enabled tabs
			$tabSets.addClass('restabs_enabled'); 

			//loop through all sets of tabs on the page
			var tablistcount = 1;

			$tabSets.each(function() {

				var $tabs = $(this);

				// add tab heading and tab panel classes
				$tabs.children('div.tit').addClass('restabs_head');
				$tabs.children('div.info').addClass('restabs_panel');

				// determine if markup already identifies the active tab panel for this set of tabs
				// if not then set first heading and tab to be the active one
				var $activePanel = $tabs.find('.restabs_panel_active');
				if(!$activePanel.length) {
					$activePanel = $tabs.find('.restabs_panel').first().addClass('restabs_panel_active');
				}

				$tabs.find('.restabs_panel').not('.restabs_panel_active').hide().attr('aria-hidden','true'); //hide all except active panel
				$activePanel.attr('aria-hidden', 'false');
				/* make active tab panel hidden for mobile */
				$activePanel.addClass('restabs_panel_closed_acc_only');

				// wrap tabs in container - to be dynamically resized to help prevent page jump
				var $tabsWrapper = $('<div/>', {'class': 'restabs_wrapper' });
				$tabs.wrap($tabsWrapper);

				var highestHeight = 0;

				// determine height of tallest tab panel. Used later to prevent page jump when tabs are clicked
				$tabs.find('.restabs_panel').each(function() {
					var tabHeight = $(this).height();
					if (tabHeight > highestHeight) {
						highestHeight = tabHeight;
					}
				});

				//create the tab list
				var $tabList = $('<ul/>', { 'class': 'restabs_list', 'role': 'tablist' });

				//loop through each heading in set
				var tabcount = 1;
				$tabs.find('.restabs_head').each(function() {

					var $tabHeading = $(this);
					var $tabPanel = $(this).next();

					$tabHeading.attr('tabindex', 0);

					// CREATE TAB ITEMS (VISIBLE ON DESKTOP)
					//create tab list item from heading
					//associate tab list item with tab panel
					var $tabListItem = $('<li/>', { 
						'class': 'restabs_list_item',
						id: 'tablist' + tablistcount + '-tab' + tabcount,
						'aria-controls': 'tablist' + tablistcount +'-panel' + tabcount,
						'role': 'tab',
						tabindex: 0,
						text: $tabHeading.text(),
						keydown: function (objEvent) {
							if (objEvent.keyCode === 13) { // if user presses 'enter'
								$tabListItem.click();
							}
						},
						click: function() {
							//Show associated panel

							//set height of tab container to highest panel height to avoid page jump
							$tabsWrapper.css('height', highestHeight);

							// remove hidden mobile class from any other panel as we'll want that panel to be open at mobile size
							$tabs.find('.restabs_panel_closed_acc_only').removeClass('restabs_panel_closed_acc_only');
							
							// close current panel and remove active state from its (hidden on desktop) heading
							$tabs.find('.restabs_panel_active').toggle().removeClass('restabs_panel_active').attr('aria-hidden','true').prev().removeClass('restabs_head_active');
							
							//make this tab panel active
							$tabPanel.toggle().addClass('restabs_panel_active').attr('aria-hidden','false');

							//make the hidden heading active
							$tabHeading.addClass('restabs_head_active');

							//remove active state from currently active tab list item
							$tabList.find('.restabs_list_item_active').removeClass('restabs_list_item_active');

							//make this tab active
							$tabListItem.addClass('restabs_list_item_active');

							//reset height of tab panels to auto
							$tabsWrapper.css('height', 'auto');
						}
					});
					
					//associate tab panel with tab list item
					$tabPanel.attr({
						'role': 'tabpanel',
						'aria-labelledby': $tabListItem.attr('id'),
						id: 'tablist' + tablistcount + '-panel' + tabcount
					});

					// if this is the active panel then make it the active tab item
					if($tabPanel.hasClass('restabs_panel_active')) {
						$tabListItem.addClass('restabs_list_item_active');
					}

					// add tab item
					$tabList.append($tabListItem);

					
					// TAB HEADINGS (VISIBLE ON MOBILE)
					// if user presses 'enter' on tab heading trigger the click event
					$tabHeading.keydown(function(objEvent) {
						if (objEvent.keyCode === 13) {
							$tabHeading.click();
						}
					});

					//toggle tab panel if click heading (on mobile)
					$tabHeading.click(function() {

						// remove any hidden mobile class
						$tabs.find('.restabs_panel_closed_acc_only').removeClass('restabs_panel_closed_acc_only');

						// if this isn't currently active
						if (!$tabHeading.hasClass('restabs_head_active')){

							var oldActivePos,
								$activeHeading = $tabs.find('.restabs_head_active');
								
							// if there is an active heading, get its position
							if($activeHeading.length) {
								oldActivePos = $activeHeading.offset().top;
							}
							
							// close currently active panel and remove active state from any hidden heading
							$tabs.find('.restabs_panel_active').slideToggle().removeClass('restabs_panel_active').prev().removeClass('restabs_head_active');
							
							//close all tabs
							$tabs.find('.restabs_panel').hide().attr('aria-hidden','true');

							//open this panel
							$tabPanel.slideToggle().addClass('restabs_panel_active').attr('aria-hidden','false');

							// make this heading active
							$tabHeading.addClass('restabs_head_active');

							var $currentActive = $tabs.find('.restabs_list_item_active');

							//set the active tab list item (for desktop)
							$currentActive.removeClass('restabs_list_item_active');
							var panelId = $tabPanel.attr('id');
							var tabId = panelId.replace('panel','tab');
							$('#' + tabId).addClass('restabs_list_item_active');

							//scroll to active heading only if it is below previous one
							var tabsPos = $tabs.offset().top;
							var newActivePos = ($tabHeading.offset().top) - 15;
							if(oldActivePos < newActivePos) {
								$('html, body').animate({ scrollTop: tabsPos }, 0).animate({ scrollTop: newActivePos }, 400);
							}
							
						}

						// if this tab panel is already active
						else {

							// hide panel but give it special restabs_panel_closed_acc_only class so that it can be visible at desktop size
							$tabPanel.removeClass('restabs_panel_active').slideToggle(function () { $(this).addClass('restabs_panel_closed_acc_only'); });

							//remove active heading class
							$tabHeading.removeClass('restabs_head_active');

							//don't alter classes on tabs as we want it active if put back to desktop size
						}
						
					});

					tabcount ++;

				});

				// add finished tab list to its container
				$tabs.prepend($tabList);

				// next set of tabs on page
				tablistcount ++;
			});
		}
	};
})(jQuery);
