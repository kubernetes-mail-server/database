<?php
use Phinx\Migration\AbstractMigration;

class VirtualAliases extends AbstractMigration
{
    public function change()
    {
        $table = $this->table("virtual_aliases");
        $table
            ->addColumn("user_id", "integer", ["null" => false])
                ->addForeignKey("user_id", "virtual_users", "id", ["delete" => "CASCADE"])
            ->addColumn("email", "string", ["limit" => 100, "null" => false])
            ->save();
    }
}

