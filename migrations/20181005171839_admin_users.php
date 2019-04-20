<?php
use Phinx\Migration\AbstractMigration;

class AdminUsers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table("admin_users");
        $table
            ->addColumn("username", "string", ["limit" => "255", "null" => false])
            ->addColumn("password", "string", ["limit" => "255", "null" => false])
            ->addColumn("email", "string", ["limit" => "255", "null" => false])
            ->addColumn("is_expired", "string", ["limit" => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY, "default" => 0])
            ->addColumn("is_deleted", "string", ["limit" => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY, "default" => 0])
            ->save();
    }
}
