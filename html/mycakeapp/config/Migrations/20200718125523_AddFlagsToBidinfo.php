<?php
use Migrations\AbstractMigration;

class AddFlagsToBidinfo extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('bidinfo');
        $table->addColumn('is_shipped', 'boolean', [
            'default' => false,
            'null' => false,
            'after' => 'reciever_phone_number'
        ]);
        $table->addColumn('is_recieved', 'boolean', [
            'default' => false,
            'null' => false,
            'after' => 'is_shipped'
        ]);
        $table->addColumn('is_rated_by_shipper', 'boolean', [
            'default' => false,
            'null' => false,
            'after' => "is_recieved"
        ]);
        $table->addColumn('is_rated_by_reciever', 'boolean', [
            'default' => false,
            'null' => false,
            'after' => 'is_rated_by_shipper'
        ]);
        $table->update();
    }
}
