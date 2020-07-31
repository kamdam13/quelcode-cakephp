<?php
use Migrations\AbstractMigration;

class AddRecieversToBidinfo extends AbstractMigration
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
        $table->addColumn('reciever_name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
            'after' => 'price'
        ]);
        $table->addColumn('reciever_address', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'reciever_name'
        ]);
        $table->addColumn('reciever_phone_number', 'string', [
            'default' => null,
            'limit' => 13,
            'null' => true,
            'after' => 'reciever_address'
        ]);
        $table->update();
    }
}
