<?php
class CinemaTatiOrsayBridge extends BridgeAbstract {

	const MAINTAINER = 'La Bécasse';
	const NAME = 'Cinema Tati Orsay';
	const URI = 'https://www.mjctati.fr/cinema';
	const CACHE_TIMEOUT = 24 * 3600;// 1 day
	const DESCRIPTION = 'Return the movies list ';

	public function collectData(){

		$html = getSimpleHTMLDOM(self::URI)
			or returnServerError('Could not request CinemaTatiOrsay.');

		foreach($html->find('a[data-date]') as $element) {
			$item = array();
			$item['title'] = $element->find('h3', 0)->plaintext;


			// $item['timestamp'] = $d->format('U');
			$item['content'] = $element->find('.similaire-img', 0)->innertext
							 . '<br/>'
							 . $element->find('.similaire-txt', 0)->innertext;

			$item['uri'] = $element->href;
			$this->items[] = $item;
		}
	}
}
