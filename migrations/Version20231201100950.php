<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201100950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE programme ADD categorie_programme_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF1BB83C6C FOREIGN KEY (categorie_programme_id) REFERENCES categorie_programme (id)');
        $this->addSql('CREATE INDEX IDX_3DDCB9FF1BB83C6C ON programme (categorie_programme_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF1BB83C6C');
        $this->addSql('DROP INDEX IDX_3DDCB9FF1BB83C6C ON programme');
        $this->addSql('ALTER TABLE programme DROP categorie_programme_id');
    }
}
