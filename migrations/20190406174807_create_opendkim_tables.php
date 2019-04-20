<?php
use Phinx\Migration\AbstractMigration;

class CreateOpendkimTables extends AbstractMigration
{
    public function change()
    {
        $table = $this->table("opendkim_keys");
        $table
            ->addColumn("domain_name", "string", ["limit" => "255", "null" => false])
            ->addColumn("domain_id", "integer", ["null" => false])
                ->addForeignKey("domain_id", "virtual_domains", "id", ["delete" => "CASCADE"])
            ->addColumn("selector", "string", ["limit" => "63", "null" => false])
            ->addColumn("private_key", "text", ["null" => false])
            ->addColumn("public_key", "text", ["null" => false])
            ->save();

        $table = $this->table("opendkim_signing_table");
        $table
            ->addColumn("author", "string", ["limit" => "255", "null" => false])
            ->addColumn("dkim_id", "integer", ["null" => false])
                ->addForeignKey("dkim_id", "opendkim_keys", "id", ["delete" => "CASCADE"])
            ->save();
    }
}
