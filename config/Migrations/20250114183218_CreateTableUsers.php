<?php

use Migrations\AbstractMigration;

class CreateTableUsers extends AbstractMigration
{

    public function change()
    {

        $users = $this->table('users');
        $users->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $users->addColumn('lastname', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $users->addColumn('email', 'string', ['limit' => 200]);
        $users->addColumn('password', 'string', ['limit' => 255]);
        $users->addColumn('roles_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $users->addColumn('is_active', 'boolean', [
            'default' => true,
            'null' => false,
        ]);
        $users->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $users->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $users->addForeignKey('roles_id', 'roles', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $users->create();
    }
}
