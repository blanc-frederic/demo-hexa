<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923222014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Tables creation';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE cards (number INT NOT NULL, set VARCHAR(255) DEFAULT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(number))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C258FD5E237E06 ON cards (name)');

        $this->addSql('CREATE TABLE decks (id VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A3FCC6325E237E06 ON decks (name)');

        $this->addSql('CREATE TABLE sets (code VARCHAR(255) NOT NULL, name VARCHAR(25) NOT NULL, is_standard BOOLEAN NOT NULL, PRIMARY KEY(code))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_948D45D15E237E06 ON sets (name)');

        $this->addSql('ALTER TABLE cards ADD CONSTRAINT FK_4C258FDE61425DC FOREIGN KEY (set) REFERENCES sets (code) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cards DROP CONSTRAINT FK_4C258FDE61425DC');

        $this->addSql('DROP TABLE cards');
        $this->addSql('DROP TABLE decks');
        $this->addSql('DROP TABLE sets');
    }
}
