<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateTables extends CI_Migration {

    public function up() {

        // employee_master table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'employee_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'employee_code' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'unique' => TRUE
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => TRUE
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'address' => [
                'type' => 'TEXT',
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'zip' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('employee_master');

        // leavMaster table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'leaveType' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('leavMaster');

        // leavebalance table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'employee_code' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'leaveType' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'leaveBalance' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'created_DateTime' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('leavebalance');

        // employee_leave_master table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'leaveType' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'employeeCode' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'fromDate' => [
                'type' => 'DATE',
            ],
            'toDate' => [
                'type' => 'DATE',
            ],
            'numberOfDays' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'comment' => [
                'type' => 'TEXT',
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('employee_leave_master');

        // noneworkingday table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ],
            'date' => [
                'type' => 'DATE',
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('noneworkingday');
    }

    public function down()
    {
        $this->dbforge->drop_table('employee_master');
        $this->dbforge->drop_table('leavMaster');
        $this->dbforge->drop_table('leavebalance');
        $this->dbforge->drop_table('employee_leave_master');
        $this->dbforge->drop_table('noneworkingday');
    }
}
