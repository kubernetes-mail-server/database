<?php
use Phinx\Migration\AbstractMigration;

class Sieve extends AbstractMigration
{
    public function change()
    {
        $table = $this->table("sieve");
        $table
            ->addColumn("email", "string", ["limit" => 255, "null" => false])
            ->addColumn("spam_enabled", "string")
            ->addColumn("spam_threshold", "string")
            ->addColumn("reply_enabled", "string")
            ->addColumn("reply_subject", "string")
            ->addColumn("reply_body", "string")
            ->addColumn("reply_enddate", "string")
            ->save();
    }
}
