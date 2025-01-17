<?php
use Migrations\AbstractMigration;

class CreateTableUsersCourses extends AbstractMigration
{
  
    public function change()
    {
        $userCourses = $this->table('user_courses');
        $userCourses->addColumn('user_id', 'integer', [
            'null' => false,
        ]);
        $userCourses->addColumn('course_id', 'integer', [
            'null' => false,
        ]);
        $userCourses->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $userCourses->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $userCourses->addForeignKey('user_id', 'users', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $userCourses->addForeignKey('course_id', 'courses', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
        ]);
        $userCourses->create();
    }
    
}
