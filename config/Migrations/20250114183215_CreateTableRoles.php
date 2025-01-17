<?php
use Migrations\AbstractMigration;

class CreateTableRoles extends AbstractMigration
{

    public function change()
    {

        $roles = $this->table('roles');
        $roles->addColumn('name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $roles->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $roles->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $roles->create();
    }
}
