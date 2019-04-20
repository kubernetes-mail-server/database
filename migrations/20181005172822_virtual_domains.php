<?php
use Phinx\Migration\AbstractMigration;

class VirtualDomains extends AbstractMigration
{
    public function change()
    {
        $table = $this->table("virtual_domains");
        $table->addColumn("name", "string", ["limit" => 50]);
        $table->save();
    }
}
