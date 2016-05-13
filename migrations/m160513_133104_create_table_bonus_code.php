<?php

use yii\db\Migration;

/**
 * Handles the creation for table `bonus_code`.
 */
class m160513_133104_create_table_bonus_code extends Migration
{

    const TABLE= 'bonus_code';

    private $indexes = [

        1 => [
            'column' => 'series',
            'name' => 'series',
            'unique' => false
        ],
        2 => [
            'column' => 'number',
            'name' => 'number',
            'unique' => false
        ],
        3 =>
            [   'multiple' => true,
                'column' => ['series','number'],
                'name' => 'uniq_code',
                'unique' => true
        ]

    ];
    public function up()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey()->unsigned(),
            'series' => $this->string(4)->notNull(),
            'number' => $this->string(10)->notNull(),
            'created' => $this->timestamp()->notNull(),
            'expires' => $this->dateTime()->notNull(),
            'used' => $this->dateTime(),
            'status' => 'tinyint unsigned not null',

        ]);

        foreach($this->indexes as $index)
        {

        $this->createIndex($index['name'],self::TABLE,$index['column'],$index['unique']);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        foreach($this->indexes as $index)
        {
            $this->dropIndex($index['name'],self::TABLE);
        }
        $this->dropTable(self::TABLE);
    }
}
