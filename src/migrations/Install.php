<?php
/**
 * Church Search plugin for Craft CMS 3.x
 *
 * Evangelical Alliance Church search functionality
 *
 * @link      https://timcoysh.co.uk
 * @copyright Copyright (c) 2018 Tim Coysh
 */

namespace aelvan\mailchimpsubscribe\migrations;

use Craft;
use craft\config\DbConfig;
use craft\db\Migration;
use aelvan\mailchimpsubscribe\MailchimpSubscribe as Plugin;

use eauk\churchsearch\ChurchSearch;

/**
 * Church Search Install Migration
 *
 * If your plugin needs to create any custom database tables when it gets installed,
 * create a migrations/ folder within your plugin folder, and save an Install.php file
 * within it using the following template:
 *
 * If you need to perform any additional actions on install/uninstall, override the
 * safeUp() and safeDown() methods.
 *
 * @author    Tim Coysh
 * @package   ChurchSearch
 * @since     1.0.0
 */
class Install extends Migration
{
    // Public Properties
    // =========================================================================

    /**
     * @var string The database driver to use
     */
    public $driver;

    // Public Methods
    // =========================================================================

    /**
     * This method contains the logic to be executed when applying this migration.
     * This method differs from [[up()]] in that the DB logic implemented here will
     * be enclosed within a DB transaction.
     * Child classes may implement this method instead of [[up()]] if the DB logic
     * needs to be within a transaction.
     *
     * @return boolean return a false value to indicate the migration fails
     * and should not proceed further. All other return values mean the migration succeeds.
     */
    public function safeUp()
    {
        $this->driver = Craft::$app->getConfig()->getDb()->driver;
        if ($this->createTables()) {
            $this->createIndexes();
            $this->addForeignKeys();
            // Refresh the db schema caches
            Craft::$app->db->schema->refresh();
            $this->insertDefaultData();
        }

        return true;
    }

    /**
     * This method contains the logic to be executed when removing this migration.
     * This method differs from [[down()]] in that the DB logic implemented here will
     * be enclosed within a DB transaction.
     * Child classes may implement this method instead of [[down()]] if the DB logic
     * needs to be within a transaction.
     *
     * @return boolean return a false value to indicate the migration fails
     * and should not proceed further. All other return values mean the migration succeeds.
     */
    public function safeDown()
    {
        $this->driver = Craft::$app->getConfig()->getDb()->driver;
        $this->removeTables();

        return true;
    }

    // Protected Methods
    // =========================================================================

    /**
     * Creates the tables needed for the Records used by the plugin
     *
     * @return bool
     */
    protected function createTables()
    {
        $tablesCreated = false;

    // churchsearch_churchsearchrecord table
        $tableSchema = Craft::$app->db->schema->getTableSchema('mailchimp_interests');
        if ($tableSchema === null) {
            $tablesCreated = true;
            $this->createTable(
                'mailchimp_interests',
                [
                    'id' => $this->primaryKey(),
                    'dateCreated' => $this->dateTime()->notNull(),
                    'dateUpdated' => $this->dateTime()->notNull(),
                    'uid' => $this->uid(),
                // Custom columns in the table
				            'group_id' => $this->string(25)->notNull()->defaultValue(''),
				            'group_name' => $this->string(255)->notNull()->defaultValue(''),
				            'parent_id' => $this->string(255)->notNull()->defaultValue(''),
				            'parent_name' => $this->string(255)->notNull()->defaultValue('')
                ]
            );
        }

        return $tablesCreated;
    }

    /**
     * Creates the indexes needed for the Records used by the plugin
     *
     * @return void
     */
    protected function createIndexes()
    {
    // churchsearch_churchsearchrecord table
        $this->createIndex(
            $this->db->getIndexName(
                'mailchimp_interests',
                true
            ),
            'mailchimp_interests',
            true
        );
        // Additional commands depending on the db driver
        switch ($this->driver) {
            case DbConfig::DRIVER_MYSQL:
                break;
            case DbConfig::DRIVER_PGSQL:
                break;
        }
    }

    /**
     * Creates the foreign keys needed for the Records used by the plugin
     *
     * @return void
     */
    protected function addForeignKeys()
    {
    // churchsearch_churchsearchrecord table
        $this->addForeignKey(
            $this->db->getForeignKeyName('mailchimp_interests', 'siteId'),
            'mailchimp_interests',
            'siteId',
            '{{%sites}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * Populates the DB with the default data.
     *
     * @return void
     */
    protected function insertDefaultData()
    {
    }

    /**
     * Removes the tables needed for the Records used by the plugin
     *
     * @return void
     */
    protected function removeTables()
    {
    // churchsearch_churchsearchrecord table
        $this->dropTableIfExists('mailchimp_interests');
    }
}
