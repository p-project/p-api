<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170501132641 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE annotation ALTER begin_time TYPE INTEGER USING (to_char(begin_time, \'d\')::integer)');
        $this->addSql('ALTER TABLE annotation ALTER begin_time DROP DEFAULT');
        $this->addSql('ALTER TABLE annotation ALTER end_time TYPE integer USING (to_char(end_time, \'d\')::integer)');
        $this->addSql('ALTER TABLE annotation ALTER end_time DROP DEFAULT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE annotation ALTER begin_time TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE annotation ALTER begin_time DROP DEFAULT');
        $this->addSql('ALTER TABLE annotation ALTER end_time TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE annotation ALTER end_time DROP DEFAULT');
    }
}
