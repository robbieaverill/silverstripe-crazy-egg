<?php

namespace SilverStripe\CrazyEgg;

use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\ViewableData;

class TagProvider extends ViewableData
{
    /**
     * @var bool
     */
    private static $enabled = true;

    /**
     * @return bool
     */
    public function isEnabled()
    {
        if (!defined("CRAZY_EGG_APP_KEY")
            || !defined("CRAZY_EGG_APP_SECRET")
            || !defined("CRAZY_EGG_ACCOUNT_NUMBER")
            || !$this->config()->enabled
        ) {
            return false;
        }

        return true;
    }

    /**
     * @return null|DBHTMLText
     */
    public function forTemplate()
    {
        if (!$this->isEnabled()) {
            return null;
        }

        $parts = str_split(CRAZY_EGG_ACCOUNT_NUMBER, 4);
        $accountNumber = $parts[0] . "/" . $parts[1];

        return $this->renderWith(
            "CrazyEggScriptTags",
            array(
                "CrazyEggAccountNumber" => $accountNumber,
            )
        );
    }
}
