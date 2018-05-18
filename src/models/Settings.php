<?php
/**
 * Mailchimp Subscribe plugin for Craft CMS 3.x
 *
 * Simple Craft plugin for subscribing to a MailChimp list.
 *
 * @link      https://www.vaersaagod.no
 * @copyright Copyright (c) 2017 André Elvan
 */


namespace aelvan\mailchimpsubscribe\models;

use craft\base\Model;

class Settings extends Model
{
    public $apiKey = '';
    public $listId = '';
    public $doubleOptIn = true;
    public $interestCategories = [
			'67637e6ae9' => 'Evangelical Alliance emails',
			'5c8aac6fb4' => 'Evangelical Alliance supporter emails',
			'463b70cd81' => 'Evangelical Alliance campaigns',
			'6bbe80b092' => 'Evangelical Alliance Northern Ireland emails',
			'5195b94c0d' => 'Evangelical Alliance Scotland emails',
			'b3a1243b91' => 'Evangelical Alliance Wales emails',
			'2524ce462d' => 'South Asain Forum',
			'8cf7bc7487' => 'HR Network',
			'09a6e95f97' => 'threads'
		];
    public $interests = [
			'5e16dda053' => 'Friday Night Theology',
			'326c4f6ff9' => 'Culture Footprint',
			'e603d1b8d1' => 'Everything Advocacy',
			'9338eeed9f' => 'Public Leadership',
			'470133757b' => 'idea for leaders',
			'5d4ecd0797' => 'Press Releases',
			'7cf15d7fb1' => 'REAP',
			'd805e8b59b' => 'easilyfound.it Update',
			'2de431f403' => '21st Century Evangelicals Update',
			'e6247fd764' => 'Fundraising',

			'b8a4281f69' => 'idea',
			'19f298bca9' => 'Headlines',

			'cd8c21db93' => 'Modern Slavery Bill',

			'c1d332da34' => 'Reach',

			'bcd51866e9' => 'Scotland emails',

			'66b464fcc3' => 'Headlines: Wales',

			'289a76d25a' => 'SAF Update',

			'8122cbc191' => 'HR Network Update',

			'b9c77620ec' => 'Thursday threads'

		];
}
