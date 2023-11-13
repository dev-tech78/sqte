<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102124247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emission_radio ADD categorie_radio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emission_radio ADD CONSTRAINT FK_A6619A336313ECB8 FOREIGN KEY (categorie_radio_id) REFERENCES categorie_radio (id)');
        $this->addSql('CREATE INDEX IDX_A6619A336313ECB8 ON emission_radio (categorie_radio_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emission_radio DROP FOREIGN KEY FK_A6619A336313ECB8');
        $this->addSql('DROP INDEX IDX_A6619A336313ECB8 ON emission_radio');
        $this->addSql('ALTER TABLE emission_radio DROP categorie_radio_id');
    }
}
