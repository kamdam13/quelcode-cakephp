<?php
use Migrations\AbstractMigration;

class ChangeCulumnnameOnBiditemimgages extends AbstractMigration
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
        $table = $this->table('biditemimages');
        $table->renameColumn('biditem_image_file_name','image_file_name');
        $table->update();
    }
}
