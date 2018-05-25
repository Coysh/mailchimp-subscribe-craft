<?php
/**
 * Church Search plugin for Craft CMS 3.x
 *
 * Evangelical Alliance Church search functionality
 *
 * @link      https://timcoysh.co.uk
 * @copyright Copyright (c) 2018 Tim Coysh
 */

 namespace aelvan\mailchimpsubscribe\records;

 use Craft;
 use craft\base\Component;
 use craft\db\ActiveRecord;
 use aelvan\mailchimpsubscribe\MailchimpSubscribe as Plugin;
 use Mailchimp\Mailchimp;

/**
* @author    André Elvan
* @package   MailchimpSubscribe
* @since     2.0.0
*/
class MailchimpSubscribeRecord extends ActiveRecord
{
    // Public Static Methods
    // =========================================================================

     /**
     * Declares the name of the database table associated with this AR class.
     * By default this method returns the class name as the table name by calling [[Inflector::camel2id()]]
     * with prefix [[Connection::tablePrefix]]. For example if [[Connection::tablePrefix]] is `tbl_`,
     * `Customer` becomes `tbl_customer`, and `OrderItem` becomes `tbl_order_item`. You may override this method
     * if the table is not named after this convention.
     *
     * By convention, tables created by plugins should be prefixed with the plugin
     * name and an underscore.
     *
     * @return string the table name
     */
    public static function tableName()
    {
        return 'mailchimp_interests';
    }

		protected function defineAttributes()
    {
        return [
            'group_id' => AttributeType::String,
            'group_name' => AttributeType::String,
            'group_desc' => AttributeType::String,
            'group_visible' => AttributeType::Boolean,
            'parent_id' => AttributeType::String,
            'parent_name' => AttributeType::String
        ];
    }
}
