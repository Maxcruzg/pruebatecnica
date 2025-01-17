<?php
use Migrations\AbstractMigration;

class AlterTableUsers extends AbstractMigration
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
        $users = $this->table('Users');
        $users->addColumn('rut', 'string', [
            'default' => null,
            'limit' => 12, 
            'null' => false, 
            'after' => 'lastname'
        ]);
        $users->update();
    }
}
