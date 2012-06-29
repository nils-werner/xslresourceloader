<?php

	class Extension_XSLResourceLoader extends Extension {
	/*-------------------------------------------------------------------------
		Definition:
	-------------------------------------------------------------------------*/

		public function getSubscribedDelegates() {
			return array(
				array(
					'page'		=> '/frontend/',
					'delegate'	=> 'FrontendPageResolved',
					'callback'	=> 'manipulatePageData'
				)
			);
		}

		public function manipulatePageData($context) {
		// Events -------------------------------------------------------------

			$events = $context['page_data']['events'];
			$events = explode(',', $events);
			$events = array_merge($events, $this->getEventNames());
			$events = array_unique($events);
			$events = implode(',', $events);

		// Datasources --------------------------------------------------------

			$datasources = $context['page_data']['data_sources'];
			$datasources = explode(',', $datasources);
			$datasources = array_merge($datasources, $this->getDSNames());
			$datasources = array_unique($datasources);
			$datasources = implode(',', $datasources);

		// Apply --------------------------------------------------------------

			$context['page_data']['data_sources'] = $datasources;
			$context['page_data']['events'] = $events;
		}


	/*-------------------------------------------------------------------------
		Events:
	-------------------------------------------------------------------------*/

		public function getEventNames() {
			return explode(',', Symphony::Configuration()->get('event-names', 'globalresourceloader'));
		}

	/*-------------------------------------------------------------------------
		Datasources:
	-------------------------------------------------------------------------*/

		public function getDSNames() {
			return explode(',', Symphony::Configuration()->get('ds-names', 'globalresourceloader'));
		}

	}
