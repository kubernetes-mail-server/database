<?php
use Phinx\Migration\AbstractMigration;

class VirtualUsers extends AbstractMigration
{
    public function change()
    {
        $table = $this->table("virtual_users");
        $table
            ->addColumn("username", "string", ["limit" => 100, "null" => false])
            ->addColumn("domain_id", "integer", ["null" => false])
                ->addForeignKey("domain_id", "virtual_domains", "id", ["delete" => "CASCADE"])
            ->addColumn("password", "string", ["limit" => 255, "null" => false])
            ->addColumn("quota_limit_bytes", "integer", ["default" => 0])
            ->addColumn("is_active", "string", ["limit" => 1, "default" => "Y"])
            ->addIndex(["username", "domain_id"], ["unique" => true, "name" => "unique_email"])
            ->save();
    }
}
