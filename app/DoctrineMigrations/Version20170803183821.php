<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170803183821 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE profile_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE profile (id INT NOT NULL, username VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0FF85E0677 ON profile (username)');
        $this->addSql('CREATE TABLE network_profile (network_id INT NOT NULL, profile_id INT NOT NULL, PRIMARY KEY(network_id, profile_id))');
        $this->addSql('CREATE INDEX IDX_25E47D6534128B91 ON network_profile (network_id)');
        $this->addSql('CREATE INDEX IDX_25E47D65CCFA12B8 ON network_profile (profile_id)');
        $this->addSql('ALTER TABLE network_profile ADD CONSTRAINT FK_25E47D6534128B91 FOREIGN KEY (network_id) REFERENCES network (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE network_profile ADD CONSTRAINT FK_25E47D65CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE network_account');
        $this->addSql('ALTER TABLE view DROP CONSTRAINT fk_fefdab8e9b6b5fba');
        $this->addSql('DROP INDEX idx_fefdab8e9b6b5fba');
        $this->addSql('ALTER TABLE view RENAME COLUMN account_id TO profile_id');
        $this->addSql('ALTER TABLE view ADD CONSTRAINT FK_FEFDAB8ECCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FEFDAB8ECCFA12B8 ON view (profile_id)');
        $this->addSql('ALTER TABLE forum DROP CONSTRAINT FK_852BBECDB03A8386');
        $this->addSql('ALTER TABLE forum ADD CONSTRAINT FK_852BBECDB03A8386 FOREIGN KEY (created_by_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX uniq_7d3656a4f85e0677');
        $this->addSql('ALTER TABLE account ADD profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE account DROP username');
        $this->addSql('ALTER TABLE account DROP first_name');
        $this->addSql('ALTER TABLE account DROP last_name');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A4CCFA12B8 ON account (profile_id)');
        $this->addSql('ALTER TABLE playlist DROP CONSTRAINT FK_D782112D9B6B5FBA');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D9B6B5FBA FOREIGN KEY (account_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reply DROP CONSTRAINT FK_FDA8C6E0F675F31B');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E0F675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C6F675F31B');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F675F31B FOREIGN KEY (author_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sustainability_offer DROP CONSTRAINT fk_bdc3df359b6b5fba');
        $this->addSql('DROP INDEX idx_bdc3df359b6b5fba');
        $this->addSql('ALTER TABLE sustainability_offer RENAME COLUMN account_id TO profile_id');
        $this->addSql('ALTER TABLE sustainability_offer ADD CONSTRAINT FK_BDC3DF35CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BDC3DF35CCFA12B8 ON sustainability_offer (profile_id)');
        $this->addSql('ALTER TABLE seeder DROP CONSTRAINT fk_8801cdce9b6b5fba');
        $this->addSql('DROP INDEX idx_8801cdce9b6b5fba');
        $this->addSql('ALTER TABLE seeder RENAME COLUMN account_id TO profile_id');
        $this->addSql('ALTER TABLE seeder ADD CONSTRAINT FK_8801CDCECCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8801CDCECCFA12B8 ON seeder (profile_id)');
        $this->addSql('ALTER TABLE channel DROP CONSTRAINT fk_a2f98e479b6b5fba');
        $this->addSql('DROP INDEX idx_a2f98e479b6b5fba');
        $this->addSql('ALTER TABLE channel RENAME COLUMN account_id TO profile_id');
        $this->addSql('ALTER TABLE channel ADD CONSTRAINT FK_A2F98E47CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A2F98E47CCFA12B8 ON channel (profile_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE view DROP CONSTRAINT FK_FEFDAB8ECCFA12B8');
        $this->addSql('ALTER TABLE forum DROP CONSTRAINT FK_852BBECDB03A8386');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE account DROP CONSTRAINT FK_7D3656A4CCFA12B8');
        $this->addSql('ALTER TABLE playlist DROP CONSTRAINT FK_D782112D9B6B5FBA');
        $this->addSql('ALTER TABLE reply DROP CONSTRAINT FK_FDA8C6E0F675F31B');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C6F675F31B');
        $this->addSql('ALTER TABLE sustainability_offer DROP CONSTRAINT FK_BDC3DF35CCFA12B8');
        $this->addSql('ALTER TABLE seeder DROP CONSTRAINT FK_8801CDCECCFA12B8');
        $this->addSql('ALTER TABLE network_profile DROP CONSTRAINT FK_25E47D65CCFA12B8');
        $this->addSql('ALTER TABLE channel DROP CONSTRAINT FK_A2F98E47CCFA12B8');
        $this->addSql('DROP SEQUENCE profile_id_seq CASCADE');
        $this->addSql('CREATE TABLE network_account (network_id INT NOT NULL, account_id INT NOT NULL, PRIMARY KEY(network_id, account_id))');
        $this->addSql('CREATE INDEX idx_d98581ce9b6b5fba ON network_account (account_id)');
        $this->addSql('CREATE INDEX idx_d98581ce34128b91 ON network_account (network_id)');
        $this->addSql('ALTER TABLE network_account ADD CONSTRAINT fk_d98581ce34128b91 FOREIGN KEY (network_id) REFERENCES network (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE network_account ADD CONSTRAINT fk_d98581ce9b6b5fba FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE network_profile');
        $this->addSql('DROP INDEX IDX_FEFDAB8ECCFA12B8');
        $this->addSql('ALTER TABLE view RENAME COLUMN profile_id TO account_id');
        $this->addSql('ALTER TABLE view ADD CONSTRAINT fk_fefdab8e9b6b5fba FOREIGN KEY (account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_fefdab8e9b6b5fba ON view (account_id)');
        $this->addSql('DROP INDEX IDX_8801CDCECCFA12B8');
        $this->addSql('ALTER TABLE seeder RENAME COLUMN profile_id TO account_id');
        $this->addSql('ALTER TABLE seeder ADD CONSTRAINT fk_8801cdce9b6b5fba FOREIGN KEY (account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8801cdce9b6b5fba ON seeder (account_id)');
        $this->addSql('DROP INDEX IDX_BDC3DF35CCFA12B8');
        $this->addSql('ALTER TABLE sustainability_offer RENAME COLUMN profile_id TO account_id');
        $this->addSql('ALTER TABLE sustainability_offer ADD CONSTRAINT fk_bdc3df359b6b5fba FOREIGN KEY (account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_bdc3df359b6b5fba ON sustainability_offer (account_id)');
        $this->addSql('ALTER TABLE forum DROP CONSTRAINT fk_852bbecdb03a8386');
        $this->addSql('ALTER TABLE forum ADD CONSTRAINT fk_852bbecdb03a8386 FOREIGN KEY (created_by_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT fk_794381c6f675f31b');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT fk_794381c6f675f31b FOREIGN KEY (author_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reply DROP CONSTRAINT fk_fda8c6e0f675f31b');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT fk_fda8c6e0f675f31b FOREIGN KEY (author_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX IDX_A2F98E47CCFA12B8');
        $this->addSql('ALTER TABLE channel RENAME COLUMN profile_id TO account_id');
        $this->addSql('ALTER TABLE channel ADD CONSTRAINT fk_a2f98e479b6b5fba FOREIGN KEY (account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_a2f98e479b6b5fba ON channel (account_id)');
        $this->addSql('DROP INDEX UNIQ_7D3656A4CCFA12B8');
        $this->addSql('ALTER TABLE account ADD username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE account ADD first_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE account ADD last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE account DROP profile_id');
        $this->addSql('CREATE UNIQUE INDEX uniq_7d3656a4f85e0677 ON account (username)');
        $this->addSql('ALTER TABLE playlist DROP CONSTRAINT fk_d782112d9b6b5fba');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT fk_d782112d9b6b5fba FOREIGN KEY (account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526cf675f31b');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526cf675f31b FOREIGN KEY (author_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
