<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102203407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_programme (id INT AUTO_INCREMENT NOT NULL, jour VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE emission_radio ADD categorie_programme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emission_radio ADD CONSTRAINT FK_A6619A331BB83C6C FOREIGN KEY (categorie_programme_id) REFERENCES categorie_programme (id)');
        $this->addSql('CREATE INDEX IDX_A6619A331BB83C6C ON emission_radio (categorie_programme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emission_radio DROP FOREIGN KEY FK_A6619A331BB83C6C');
        $this->addSql('DROP TABLE categorie_programme');
        $this->addSql('DROP INDEX IDX_A6619A331BB83C6C ON emission_radio');
        $this->addSql('ALTER TABLE emission_radio DROP categorie_programme_id');
    }
}
