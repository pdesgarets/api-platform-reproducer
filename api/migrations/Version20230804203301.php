<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230804203301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE my_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE my_entity (id INT NOT NULL, owner_id UUID DEFAULT NULL, foo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_924D84737E3C61F9 ON my_entity (owner_id)');
        $this->addSql('COMMENT ON COLUMN my_entity.owner_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE my_entity ADD CONSTRAINT FK_924D84737E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE my_entity_id_seq CASCADE');
        $this->addSql('ALTER TABLE my_entity DROP CONSTRAINT FK_924D84737E3C61F9');
        $this->addSql('DROP TABLE my_entity');
    }
}
