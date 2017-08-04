<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170804131111 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE view_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE forum_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE playlist_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reply_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE review_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_profile_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sustainability_offer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE video_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE seeder_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE annotation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE network_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE auth_code_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE refresh_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE access_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE channel_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subtitles_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE metadata_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ip_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE view (id INT NOT NULL, profile_id INT DEFAULT NULL, video_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FEFDAB8ECCFA12B8 ON view (profile_id)');
        $this->addSql('CREATE INDEX IDX_FEFDAB8E29C1004E ON view (video_id)');
        $this->addSql('CREATE TABLE forum (id INT NOT NULL, video_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_852BBECD29C1004E ON forum (video_id)');
        $this->addSql('CREATE INDEX IDX_852BBECDB03A8386 ON forum (created_by_id)');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, video_id INT DEFAULT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date_comment TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C29C1004E ON comment (video_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE TABLE playlist (id INT NOT NULL, channel_id INT DEFAULT NULL, network_id INT DEFAULT NULL, account_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D782112D72F5A1AA ON playlist (channel_id)');
        $this->addSql('CREATE INDEX IDX_D782112D34128B91 ON playlist (network_id)');
        $this->addSql('CREATE INDEX IDX_D782112D9B6B5FBA ON playlist (account_id)');
        $this->addSql('CREATE TABLE reply (id INT NOT NULL, review_id INT DEFAULT NULL, author_id INT DEFAULT NULL, contents VARCHAR(255) NOT NULL, date_comment TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FDA8C6E03E2E969B ON reply (review_id)');
        $this->addSql('CREATE INDEX IDX_FDA8C6E0F675F31B ON reply (author_id)');
        $this->addSql('CREATE TABLE review (id INT NOT NULL, video_id INT DEFAULT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date_comment TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_794381C629C1004E ON review (video_id)');
        $this->addSql('CREATE INDEX IDX_794381C6F675F31B ON review (author_id)');
        $this->addSql('CREATE TABLE user_profile (id INT NOT NULL, account_id INT NOT NULL, username VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D95AB405F85E0677 ON user_profile (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D95AB4059B6B5FBA ON user_profile (account_id)');
        $this->addSql('CREATE TABLE sustainability_offer (id INT NOT NULL, profile_id INT DEFAULT NULL, channel_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, duration INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BDC3DF35CCFA12B8 ON sustainability_offer (profile_id)');
        $this->addSql('CREATE INDEX IDX_BDC3DF3572F5A1AA ON sustainability_offer (channel_id)');
        $this->addSql('CREATE TABLE video (id INT NOT NULL, channel_id INT DEFAULT NULL, metadata_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, number_view INT DEFAULT NULL, hash VARCHAR(255) NOT NULL, magnet VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CC7DA2C72F5A1AA ON video (channel_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CC7DA2CDC9EE959 ON video (metadata_id)');
        $this->addSql('CREATE TABLE video_category (video_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(video_id, category_id))');
        $this->addSql('CREATE INDEX IDX_AECE2B7D29C1004E ON video_category (video_id)');
        $this->addSql('CREATE INDEX IDX_AECE2B7D12469DE2 ON video_category (category_id)');
        $this->addSql('CREATE TABLE user_account (id INT NOT NULL, email VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_253B48AEE7927C74 ON user_account (email)');
        $this->addSql('CREATE TABLE seeder (id INT NOT NULL, profile_id INT DEFAULT NULL, video_id INT DEFAULT NULL, platform VARCHAR(255) NOT NULL, ip VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8801CDCECCFA12B8 ON seeder (profile_id)');
        $this->addSql('CREATE INDEX IDX_8801CDCE29C1004E ON seeder (video_id)');
        $this->addSql('CREATE TABLE annotation (id INT NOT NULL, video_id INT DEFAULT NULL, begin_time INT NOT NULL, end_time INT NOT NULL, annotation_text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2E443EF229C1004E ON annotation (video_id)');
        $this->addSql('CREATE TABLE network (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE network_user_profile (network_id INT NOT NULL, user_profile_id INT NOT NULL, PRIMARY KEY(network_id, user_profile_id))');
        $this->addSql('CREATE INDEX IDX_BC28636D34128B91 ON network_user_profile (network_id)');
        $this->addSql('CREATE INDEX IDX_BC28636D6B9DD454 ON network_user_profile (user_profile_id)');
        $this->addSql('CREATE TABLE network_channel (network_id INT NOT NULL, channel_id INT NOT NULL, PRIMARY KEY(network_id, channel_id))');
        $this->addSql('CREATE INDEX IDX_64A592D34128B91 ON network_channel (network_id)');
        $this->addSql('CREATE INDEX IDX_64A592D72F5A1AA ON network_channel (channel_id)');
        $this->addSql('CREATE TABLE auth_code (id INT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, redirect_uri TEXT NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5933D02C5F37A13B ON auth_code (token)');
        $this->addSql('CREATE INDEX IDX_5933D02C19EB6921 ON auth_code (client_id)');
        $this->addSql('CREATE INDEX IDX_5933D02CA76ED395 ON auth_code (user_id)');
        $this->addSql('CREATE TABLE refresh_token (id INT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74F21955F37A13B ON refresh_token (token)');
        $this->addSql('CREATE INDEX IDX_C74F219519EB6921 ON refresh_token (client_id)');
        $this->addSql('CREATE INDEX IDX_C74F2195A76ED395 ON refresh_token (user_id)');
        $this->addSql('CREATE TABLE access_token (id INT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6A2DD685F37A13B ON access_token (token)');
        $this->addSql('CREATE INDEX IDX_B6A2DD6819EB6921 ON access_token (client_id)');
        $this->addSql('CREATE INDEX IDX_B6A2DD68A76ED395 ON access_token (user_id)');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, random_id VARCHAR(255) NOT NULL, redirect_uris TEXT NOT NULL, secret VARCHAR(255) NOT NULL, allowed_grant_types TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN client.redirect_uris IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN client.allowed_grant_types IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE channel (id INT NOT NULL, profile_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, tags TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2F98E475E237E06 ON channel (name)');
        $this->addSql('CREATE INDEX IDX_A2F98E47CCFA12B8 ON channel (profile_id)');
        $this->addSql('COMMENT ON COLUMN channel.tags IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE subtitles (id INT NOT NULL, video_id INT DEFAULT NULL, begin_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A739C98629C1004E ON subtitles (video_id)');
        $this->addSql('CREATE TABLE metadata (id INT NOT NULL, height INT NOT NULL, width INT NOT NULL, format VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ip_request (id INT NOT NULL, ip VARCHAR(255) NOT NULL, date_request TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, accesses INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE view ADD CONSTRAINT FK_FEFDAB8ECCFA12B8 FOREIGN KEY (profile_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE view ADD CONSTRAINT FK_FEFDAB8E29C1004E FOREIGN KEY (video_id) REFERENCES video (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum ADD CONSTRAINT FK_852BBECD29C1004E FOREIGN KEY (video_id) REFERENCES video (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE forum ADD CONSTRAINT FK_852BBECDB03A8386 FOREIGN KEY (created_by_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C29C1004E FOREIGN KEY (video_id) REFERENCES video (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D72F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D34128B91 FOREIGN KEY (network_id) REFERENCES network (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D9B6B5FBA FOREIGN KEY (account_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E03E2E969B FOREIGN KEY (review_id) REFERENCES review (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E0F675F31B FOREIGN KEY (author_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C629C1004E FOREIGN KEY (video_id) REFERENCES video (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F675F31B FOREIGN KEY (author_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB4059B6B5FBA FOREIGN KEY (account_id) REFERENCES user_account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sustainability_offer ADD CONSTRAINT FK_BDC3DF35CCFA12B8 FOREIGN KEY (profile_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sustainability_offer ADD CONSTRAINT FK_BDC3DF3572F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C72F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CDC9EE959 FOREIGN KEY (metadata_id) REFERENCES metadata (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE video_category ADD CONSTRAINT FK_AECE2B7D29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE video_category ADD CONSTRAINT FK_AECE2B7D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE seeder ADD CONSTRAINT FK_8801CDCECCFA12B8 FOREIGN KEY (profile_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE seeder ADD CONSTRAINT FK_8801CDCE29C1004E FOREIGN KEY (video_id) REFERENCES video (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE annotation ADD CONSTRAINT FK_2E443EF229C1004E FOREIGN KEY (video_id) REFERENCES video (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE network_user_profile ADD CONSTRAINT FK_BC28636D34128B91 FOREIGN KEY (network_id) REFERENCES network (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE network_user_profile ADD CONSTRAINT FK_BC28636D6B9DD454 FOREIGN KEY (user_profile_id) REFERENCES user_profile (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE network_channel ADD CONSTRAINT FK_64A592D34128B91 FOREIGN KEY (network_id) REFERENCES network (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE network_channel ADD CONSTRAINT FK_64A592D72F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE auth_code ADD CONSTRAINT FK_5933D02C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE auth_code ADD CONSTRAINT FK_5933D02CA76ED395 FOREIGN KEY (user_id) REFERENCES user_account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE refresh_token ADD CONSTRAINT FK_C74F219519EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE refresh_token ADD CONSTRAINT FK_C74F2195A76ED395 FOREIGN KEY (user_id) REFERENCES user_account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE access_token ADD CONSTRAINT FK_B6A2DD6819EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE access_token ADD CONSTRAINT FK_B6A2DD68A76ED395 FOREIGN KEY (user_id) REFERENCES user_account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE channel ADD CONSTRAINT FK_A2F98E47CCFA12B8 FOREIGN KEY (profile_id) REFERENCES user_profile (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subtitles ADD CONSTRAINT FK_A739C98629C1004E FOREIGN KEY (video_id) REFERENCES video (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE reply DROP CONSTRAINT FK_FDA8C6E03E2E969B');
        $this->addSql('ALTER TABLE view DROP CONSTRAINT FK_FEFDAB8ECCFA12B8');
        $this->addSql('ALTER TABLE forum DROP CONSTRAINT FK_852BBECDB03A8386');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE playlist DROP CONSTRAINT FK_D782112D9B6B5FBA');
        $this->addSql('ALTER TABLE reply DROP CONSTRAINT FK_FDA8C6E0F675F31B');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C6F675F31B');
        $this->addSql('ALTER TABLE sustainability_offer DROP CONSTRAINT FK_BDC3DF35CCFA12B8');
        $this->addSql('ALTER TABLE seeder DROP CONSTRAINT FK_8801CDCECCFA12B8');
        $this->addSql('ALTER TABLE network_user_profile DROP CONSTRAINT FK_BC28636D6B9DD454');
        $this->addSql('ALTER TABLE channel DROP CONSTRAINT FK_A2F98E47CCFA12B8');
        $this->addSql('ALTER TABLE view DROP CONSTRAINT FK_FEFDAB8E29C1004E');
        $this->addSql('ALTER TABLE forum DROP CONSTRAINT FK_852BBECD29C1004E');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C29C1004E');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C629C1004E');
        $this->addSql('ALTER TABLE video_category DROP CONSTRAINT FK_AECE2B7D29C1004E');
        $this->addSql('ALTER TABLE seeder DROP CONSTRAINT FK_8801CDCE29C1004E');
        $this->addSql('ALTER TABLE annotation DROP CONSTRAINT FK_2E443EF229C1004E');
        $this->addSql('ALTER TABLE subtitles DROP CONSTRAINT FK_A739C98629C1004E');
        $this->addSql('ALTER TABLE user_profile DROP CONSTRAINT FK_D95AB4059B6B5FBA');
        $this->addSql('ALTER TABLE auth_code DROP CONSTRAINT FK_5933D02CA76ED395');
        $this->addSql('ALTER TABLE refresh_token DROP CONSTRAINT FK_C74F2195A76ED395');
        $this->addSql('ALTER TABLE access_token DROP CONSTRAINT FK_B6A2DD68A76ED395');
        $this->addSql('ALTER TABLE playlist DROP CONSTRAINT FK_D782112D34128B91');
        $this->addSql('ALTER TABLE network_user_profile DROP CONSTRAINT FK_BC28636D34128B91');
        $this->addSql('ALTER TABLE network_channel DROP CONSTRAINT FK_64A592D34128B91');
        $this->addSql('ALTER TABLE auth_code DROP CONSTRAINT FK_5933D02C19EB6921');
        $this->addSql('ALTER TABLE refresh_token DROP CONSTRAINT FK_C74F219519EB6921');
        $this->addSql('ALTER TABLE access_token DROP CONSTRAINT FK_B6A2DD6819EB6921');
        $this->addSql('ALTER TABLE playlist DROP CONSTRAINT FK_D782112D72F5A1AA');
        $this->addSql('ALTER TABLE sustainability_offer DROP CONSTRAINT FK_BDC3DF3572F5A1AA');
        $this->addSql('ALTER TABLE video DROP CONSTRAINT FK_7CC7DA2C72F5A1AA');
        $this->addSql('ALTER TABLE network_channel DROP CONSTRAINT FK_64A592D72F5A1AA');
        $this->addSql('ALTER TABLE video DROP CONSTRAINT FK_7CC7DA2CDC9EE959');
        $this->addSql('ALTER TABLE video_category DROP CONSTRAINT FK_AECE2B7D12469DE2');
        $this->addSql('DROP SEQUENCE view_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE forum_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE playlist_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reply_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE review_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_profile_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sustainability_offer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE video_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_account_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE seeder_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE annotation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE network_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE auth_code_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE refresh_token_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE access_token_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE channel_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subtitles_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE metadata_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ip_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP TABLE view');
        $this->addSql('DROP TABLE forum');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE reply');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE user_profile');
        $this->addSql('DROP TABLE sustainability_offer');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE video_category');
        $this->addSql('DROP TABLE user_account');
        $this->addSql('DROP TABLE seeder');
        $this->addSql('DROP TABLE annotation');
        $this->addSql('DROP TABLE network');
        $this->addSql('DROP TABLE network_user_profile');
        $this->addSql('DROP TABLE network_channel');
        $this->addSql('DROP TABLE auth_code');
        $this->addSql('DROP TABLE refresh_token');
        $this->addSql('DROP TABLE access_token');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE channel');
        $this->addSql('DROP TABLE subtitles');
        $this->addSql('DROP TABLE metadata');
        $this->addSql('DROP TABLE ip_request');
        $this->addSql('DROP TABLE category');
    }
}
