<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231212082637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualites ADD categorie_actu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actualites ADD CONSTRAINT FK_75315B6DA8FD41FA FOREIGN KEY (categorie_actu_id) REFERENCES categorie_actu (id)');
        $this->addSql('CREATE INDEX IDX_75315B6DA8FD41FA ON actualites (categorie_actu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualites DROP FOREIGN KEY FK_75315B6DA8FD41FA');
        $this->addSql('DROP INDEX IDX_75315B6DA8FD41FA ON actualites');
        $this->addSql('ALTER TABLE actualites DROP categorie_actu_id');
    }
}
