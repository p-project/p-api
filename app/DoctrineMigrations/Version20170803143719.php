<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170803143719 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE profile DROP CONSTRAINT fk_8157aa0f9b6b5fba');
        $this->addSql('DROP INDEX uniq_8157aa0f9b6b5fba');
        $this->addSql('ALTER TABLE profile DROP account_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE profile ADD account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT fk_8157aa0f9b6b5fba FOREIGN KEY (account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_8157aa0f9b6b5fba ON profile (account_id)');
    }
}
