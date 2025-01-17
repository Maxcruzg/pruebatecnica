<?php
use Migrations\AbstractMigration;

class CreateTableCourses extends AbstractMigration
{
 
    public function change()
    {

        $courses = $this->table('courses');
        $courses->addColumn('name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $courses->addColumn('description', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $courses->addColumn('start_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $courses->addColumn('end_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $courses->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $courses->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $courses->create();
    }
}
