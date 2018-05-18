<?php
/**
 * Mailchimp Subscribe plugin for Craft CMS 3.x
 *
 * Simple Craft plugin for subscribing to a MailChimp list.
 *
 * @link      https://www.vaersaagod.no
 * @copyright Copyright (c) 2017 André Elvan
 */

namespace aelvan\mailchimpsubscribe;

use aelvan\mailchimpsubscribe\models\Settings;
use aelvan\mailchimpsubscribe\services\MailchimpSubscribeService as SubscribeService;
use aelvan\mailchimpsubscribe\variables\MailchimpSubscribeVariable;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use craft\web\UrlManager;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class MailchimpSubscribe
 *
 * @author    André Elvan
 * @package   MailchimpSubscribe
 * @since     2.0.0
 *
 * @property  SubscribeService $mailchimpSubscribe
 */
class MailchimpSubscribe extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var MailchimpSubscribe
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->set('mailchimpSubscribe', '\aelvan\mailchimpsubscribe\services\MailchimpSubscribeService');

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('mailchimpSubscribe', MailchimpSubscribeVariable::class);
            }
        );

				// Register our site routes
				Event::on(
						UrlManager::class,
						UrlManager::EVENT_REGISTER_SITE_URL_RULES,
						function (RegisterUrlRulesEvent $event) {
								$event->rules['siteActionTrigger1'] = 'mailchimp-subscribe/list';
						}
				);

    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

}
