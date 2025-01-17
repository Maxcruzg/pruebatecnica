<?php
use Migrations\AbstractSeed;


    class RolesSeed extends AbstractSeed
    {
        /**
         * Run Method.
         *
         * @return void
         */
        public function run(): void
        {
            $data = [
                [
                    'name' => 'Administrador',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Usuario',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
            ];
    
            $table = $this->table('Roles');
            $table->insert($data)->save();
        }
    }
