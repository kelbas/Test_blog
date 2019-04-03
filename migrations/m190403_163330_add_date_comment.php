<?php

use yii\db\Migration;

/**
 * Class m190403_163330_add_date_comment
 */
class m190403_163330_add_date_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comment', 'date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190403_163330_add_date_comment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190403_163330_add_date_comment cannot be reverted.\n";

        return false;
    }
    */
}
