<?php

class SupremaQodefLinearIcons implements iSupremaQodefIconCollection {

	public $icons;
	public $title;
	public $param;
	public $styleUrl;

	public function __construct($title = "", $param = "") {
		$this->icons = array();
		$this->title = $title;
		$this->param = $param;
		$this->setIconsArray();
		$this->styleUrl = QODE_ASSETS_ROOT . "/css/linear-icons/style.css";
	}

	public function setIconsArray() {
		$this->icons = array(
            'lnr-alarm' => '\e858',
            'lnr-apartment' => '\e801',
            'lnr-arrow-down' => '\e878',
            'lnr-arrow-down-circle' => '\e884',
            'lnr-arrow-left' => '\e879',
            'lnr-arrow-left-circle' => '\e885',
            'lnr-arrow-right' => '\e87a',
            'lnr-arrow-right-circle' => '\e886',
            'lnr-arrow-up' => '\e877',
            'lnr-arrow-up-circle' => '\e883',
            'lnr-bicycle' => '\e850',
            'lnr-bold' => '\e893',
            'lnr-book' => '\e828',
            'lnr-bookmark' => '\e829',
            'lnr-briefcase' => '\e84c',
            'lnr-bubble' => '\e83f',
            'lnr-bug' => '\e869',
            'lnr-bullhorn' => '\e859',
            'lnr-bus' => '\e84d',
            'lnr-calendar-full' => '\e836',
            'lnr-camera' => '\e826',
            'lnr-camera-video' => '\e825',
            'lnr-car' => '\e84e',
            'lnr-cart' => '\e82e',
            'lnr-chart-bars' => '\e843',
            'lnr-checkmark-circle' => '\e87f',
            'lnr-chevron-down' => '\e874',
            'lnr-chevron-down-circle' => '\e888',
            'lnr-chevron-left' => '\e875',
            'lnr-chevron-left-circle' => '\e889',
            'lnr-chevron-right' => '\e876',
            'lnr-chevron-right-circle' => '\e88a',
            'lnr-chevron-up' => '\e873',
            'lnr-chevron-up-circle' => '\e887',
            'lnr-circle-minus' => '\e882',
            'lnr-clock' => '\e864',
            'lnr-cloud' => '\e809',
            'lnr-cloud-check' => '\e80d',
            'lnr-cloud-download' => '\e80b',
            'lnr-cloud-sync' => '\e80c',
            'lnr-cloud-upload' => '\e80a',
            'lnr-code' => '\e86a',
            'lnr-coffee-cup' => '\e848',
            'lnr-cog' => '\e810',
            'lnr-construction' => '\e841',
            'lnr-crop' => '\e88b',
            'lnr-cross' => '\e870',
            'lnr-cross-circle' => '\e880',
            'lnr-database' => '\e80e',
            'lnr-diamond' => '\e845',
            'lnr-dice' => '\e812',
            'lnr-dinner' => '\e847',
            'lnr-direction-ltr' => '\e8a0',
            'lnr-direction-rtl' => '\e8a1',
            'lnr-download' => '\e865',
            'lnr-drop' => '\e804',
            'lnr-earth' => '\e853',
            'lnr-enter' => '\e81f',
            'lnr-enter-down' => '\e867',
            'lnr-envelope' => '\e818',
            'lnr-exit' => '\e820',
            'lnr-exit-up' => '\e868',
            'lnr-eye' => '\e81b',
            'lnr-file-add' => '\e81e',
            'lnr-file-empty' => '\e81d',
            'lnr-film-play' => '\e824',
            'lnr-flag' => '\e817',
            'lnr-frame-contract' => '\e88d',
            'lnr-frame-expand' => '\e88c',
            'lnr-funnel' => '\e88f',
            'lnr-gift' => '\e844',
            'lnr-graduation-hat' => '\e821',
            'lnr-hand' => '\e8a5',
            'lnr-heart' => '\e813',
            'lnr-heart-pulse' => '\e840',
            'lnr-highlight' => '\e897',
            'lnr-history' => '\e863',
            'lnr-home' => '\e800',
            'lnr-hourglass' => '\e85f',
            'lnr-inbox' => '\e81a',
            'lnr-indent-decrease' => '\e89e',
            'lnr-indent-increase' => '\e89d',
            'lnr-italic' => '\e894',
            'lnr-keyboard' => '\e837',
            'lnr-laptop' => '\e83c',
            'lnr-laptop-phone' => '\e83d',
            'lnr-layers' => '\e88e',
            'lnr-leaf' => '\e849',
            'lnr-license' => '\e822',
            'lnr-lighter' => '\e805',
            'lnr-line-spacing' => '\e89c',
            'lnr-linearicons' => '\e846',
            'lnr-link' => '\e86b',
            'lnr-list' => '\e872',
            'lnr-location' => '\e835',
            'lnr-lock' => '\e80f',
            'lnr-magic-wand' => '\e803',
            'lnr-magnifier' => '\e86f',
            'lnr-map' => '\e834',
            'lnr-map-marker' => '\e833',
            'lnr-menu' => '\e871',
            'lnr-menu-circle' => '\e87e',
            'lnr-mic' => '\e85e',
            'lnr-moon' => '\e808',
            'lnr-move' => '\e87b',
            'lnr-music-note' => '\e823',
            'lnr-mustache' => '\e857',
            'lnr-neutral' => '\e856',
            'lnr-page-break' => '\e8a2',
            'lnr-paperclip' => '\e819',
            'lnr-paw' => '\e84a',
            'lnr-pencil' => '\e802',
            'lnr-phone' => '\e831',
            'lnr-phone-handset' => '\e830',
            'lnr-picture' => '\e827',
            'lnr-pie-chart' => '\e842',
            'lnr-pilcrow' => '\e89f',
            'lnr-plus-circle' => '\e881',
            'lnr-pointer-down' => '\e8a8',
            'lnr-pointer-left' => '\\e8a9',
            'lnr-pointer-right' => '\e8a7',
            'lnr-pointer-up' => '\e8a6',
            'lnr-poop' => '\e806',
            'lnr-power-switch' => '\e83e',
            'lnr-printer' => '\e81c',
            'lnr-pushpin' => '\e832',
            'lnr-question-circle' => '\e87d',
            'lnr-redo' => '\e861',
            'lnr-rocket' => '\e84b',
            'lnr-sad' => '\e855',
            'lnr-screen' => '\e839',
            'lnr-select' => '\e852',
            'lnr-shirt' => '\e82c',
            'lnr-smartphone' => '\e83a',
            'lnr-smile' => '\e854',
            'lnr-sort-alpha-asc' => '\e8a3',
            'lnr-sort-amount-asc' => '\e8a4',
            'lnr-spell-check' => '\e838',
            'lnr-star' => '\e814',
            'lnr-star-empty' => '\e816',
            'lnr-star-half' => '\e815',
            'lnr-store' => '\e82d',
            'lnr-strikethrough' => '\e896',
            'lnr-sun' => '\e807',
            'lnr-sync' => '\e862',
            'lnr-tablet' => '\e83b',
            'lnr-tag' => '\e82f',
            'lnr-text-align-center' => '\e899',
            'lnr-text-align-justify' => '\e89b',
            'lnr-text-align-left' => '\e898',
            'lnr-text-align-right' => '\e89a',
            'lnr-text-format' => '\e890',
            'lnr-text-format-remove' => '\e891',
            'lnr-text-size' => '\e892',
            'lnr-thumbs-down' => '\e86e',
            'lnr-thumbs-up' => '\e86d',
            'lnr-train' => '\e84f',
            'lnr-trash' => '\e811',
            'lnr-underline' => '\e895',
            'lnr-undo' => '\e860',
            'lnr-unlink' => '\e86c',
            'lnr-upload' => '\e866',
            'lnr-user' => '\e82a',
            'lnr-users' => '\e82b',
            'lnr-volume' => '\e85d',
            'lnr-volume-high' => '\e85a',
            'lnr-volume-low' => '\e85c',
            'lnr-volume-medium' => '\e85b',
            'lnr-warning' => '\e87c',
            'lnr-wheelchair' => '\e851'
		);

		$icons = array();
		$icons[""] = "";
		foreach ($this->icons as $key => $value) {
			$icons[$key] = $key;
		}

		$this->icons = $icons;
	}

	public function getIconsArray() {
		return $this->icons;
	}

	public function render($icon, $params = array()) {
		$html = '';
		extract($params);
		$iconAttributesString = '';
		$iconClass = '';
		if (isset($icon_attributes) && count($icon_attributes)) {
			foreach ($icon_attributes as $icon_attr_name => $icon_attr_val) {
				if ($icon_attr_name === 'class') {
					$iconClass = $icon_attr_val;
					unset($icon_attributes[$icon_attr_name]);
				} else {
					$iconAttributesString .= $icon_attr_name . '="' . $icon_attr_val . '" ';
				}
			}
		}

		if (isset($before_icon) && $before_icon !== '') {
			$beforeIconAttrString = '';
			if (isset($before_icon_attributes) && count($before_icon_attributes)) {
				foreach ($before_icon_attributes as $before_icon_attr_name => $before_icon_attr_val) {
					$beforeIconAttrString .= $before_icon_attr_name . '="' . $before_icon_attr_val . '" ';
				}
			}

			$html .= '<' . $before_icon . ' ' . $beforeIconAttrString . '>';
		}

		$html .= '<i class="qodef-icon-linear-icon lnr ' . $icon . ' ' . $iconClass . '" ' . $iconAttributesString . '></i>';

		if (isset($before_icon) && $before_icon !== '') {
			$html .= '</' . $before_icon . '>';
		}

		return $html;
	}

    public function getSearchIcon() {
        return $this->render('lnr-magnifier');
    }

	public function getSearchClose() {

		return $this->render('lnr-cross');
	}

	public function getMenuSideIcon() {

		return $this->render('lnr-menu');
	}

	public function getBackToTopIcon() {

		return $this->render('lnr-chevron-up');
	}

	public function getMobileMenuIcon() {

		return $this->render('lnr-menu');
	}


    /**
     * Checks if icon collection has social icons
     * @return mixed
     */
    public function hasSocialIcons() {
        return false;
    }


}