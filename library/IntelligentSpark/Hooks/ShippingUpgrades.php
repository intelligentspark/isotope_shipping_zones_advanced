<?php

/**
 * Isotope eCommerce for Contao Open Source CMS
 *
 * Copyright (C) 2009-2014 terminal42 gmbh & Isotope eCommerce Workgroup
 *
 * @package    Isotope
 * @link       http://isotopeecommerce.org
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

namespace IntelligentSpark\Hooks;

use Isotope\Isotope;
use Isotope\Template;
use IntelligentSpark\CheckoutStep;

class ShippingUpgrades {

    /**
     * @param $objCheckoutStep
     * @return void
     */
    public function shippingMethodSubmit($objCheckoutStep) {
        var_dump(\Input::post('shipping'));
        exit;
    }

    /**
     * @param $objCheckoutStep
     * @param $objShippingModule
     * @return string;
     */
    public function renderUpgradeOptions($objCheckoutStep,$objShippingModule) {

        $objTemplate = new Template('iso_checkout_step_shipping_upgrades');

        $objTemplate->module_id = $objShippingModule->id;
        $objTemplate->options = deserialize($objShippingModule->upgrade_options,true);

        return $objTemplate->parse();
    }

    public function preCheckout($objOrder, $objModule) {
        $objOrder->delivery_date = Isotope::getCart()->delivery_date;
        $objOrder->save();
        \System::log("delivery date as saved: ".$objOrder->delivery_date,__METHOD__,TL_GENERAL);
        return true;
    }
}