<?php
use Migrations\AbstractMigration;

class AlterTableCourses extends AbstractMigration
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
        $courses = $this->table('courses');
        $courses->addColumn('is_active', 'boolean', [
            'default' => true,
            'null' => false,
        ]);

        $courses->update();
    }
}
