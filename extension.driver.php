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

		// Read File ---------------------------------------------------------

			$xsl = file_get_contents($context['page_data']['filelocation']);
			$xsl = @new SimpleXMLElement($xsl);
			$xsl->registerXPathNamespace("res", "http://symphony-cms.com/schemas/resources/1.0"); 

		// Events -------------------------------------------------------------

			$events = $context['page_data']['events'];
			$events = explode(',', $events);
			$events = array_merge($events, $this->getResourceNames($xsl, "event"));
			$events = array_unique($events);
			$events = implode(',', $events);

		// Datasources --------------------------------------------------------

			$datasources = $context['page_data']['data_sources'];
			$datasources = explode(',', $datasources);
			$datasources = array_merge($datasources, $this->getResourceNames($xsl, "data-source"));
			$datasources = array_unique($datasources);
			$datasources = implode(',', $datasources);

		// Apply --------------------------------------------------------------

			$context['page_data']['data_sources'] = $datasources;
			$context['page_data']['events'] = $events;
		}


	/*-------------------------------------------------------------------------
		Resources:
	-------------------------------------------------------------------------*/

		public function getResourceNames($xsl, $type) {
			$resources = array();
			foreach($xsl->xpath("//res:" . $type . "/@name") as $resource)
				array_push($resources, (string) $resource['name']);

			return $resources;
		}

	}
