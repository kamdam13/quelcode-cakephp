<?php
use Migrations\AbstractMigration;

class AlterPointOnRatings extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $add_check_constraint_to_check = 'ALTER TABLE ratings ADD CONSTRAINT point_constraint CHECK (point >= 1 AND point <= 5)';
        $this->execute($add_check_constraint_to_check);
        
    }

    public function down()
    {
        $drop_check_constraint_to_check = 'ALTER TABLE ratings DROP CHECK point_constraint';
        $this->execute($drop_check_constraint_to_check);
    }
}
