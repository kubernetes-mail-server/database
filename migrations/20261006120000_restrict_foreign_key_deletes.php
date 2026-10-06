<?php
use Phinx\Migration\AbstractMigration;

/**
 * No delete may cascade.
 *
 * VirtualUsers and CreateOpendkimTables declared their foreign keys ON DELETE CASCADE, so deleting
 * one row in virtual_domains silently deleted every user of the domain (with their password
 * hashes), the domain's DKIM keys and, through opendkim_keys, its signing table entries. These keys
 * now RESTRICT: deleting a domain or a DKIM key that still has rows depending on it fails with an
 * error, and whoever wants them gone deletes the dependent rows first, deliberately.
 *
 * The earlier migrations stay as they are (they have run everywhere); this one replaces the keys
 * they created. virtual_aliases had a cascading key too, already dropped by SimplifyAliases.
 */
class RestrictForeignKeyDeletes extends AbstractMigration
{
    private const KEYS = [
        // table, column, referenced table
        ["virtual_users", "domain_id", "virtual_domains"],
        ["opendkim_keys", "domain_id", "virtual_domains"],
        ["opendkim_signing_table", "dkim_id", "opendkim_keys"],
    ];

    public function up()
    {
        $this->replaceKeys("RESTRICT");
    }

    public function down()
    {
        $this->replaceKeys("CASCADE");
    }

    private function replaceKeys(string $onDelete)
    {
        foreach (self::KEYS as [$table, $column, $referenced]) {
            $this->table($table)->dropForeignKey($column)->save();
            $this->table($table)
                ->addForeignKey($column, $referenced, "id", ["delete" => $onDelete, "update" => "RESTRICT"])
                ->save();
        }
    }
}
