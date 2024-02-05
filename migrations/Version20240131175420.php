<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131175420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soutien DROP FOREIGN KEY FK_99A7D3212260896E');
        $this->addSql('DROP INDEX IDX_99A7D3212260896E ON soutien');
        $this->addSql('ALTER TABLE soutien CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE relat_soutien_id relstn_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE soutien ADD CONSTRAINT FK_99A7D3212F5CD2C1 FOREIGN KEY (relstn_id) REFERENCES cat_soutien (id)');
        $this->addSql('CREATE INDEX IDX_99A7D3212F5CD2C1 ON soutien (relstn_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soutien DROP FOREIGN KEY FK_99A7D3212F5CD2C1');
        $this->addSql('DROP INDEX IDX_99A7D3212F5CD2C1 ON soutien');
        $this->addSql('ALTER TABLE soutien CHANGE price price VARCHAR(255) NOT NULL, CHANGE relstn_id relat_soutien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE soutien ADD CONSTRAINT FK_99A7D3212260896E FOREIGN KEY (relat_soutien_id) REFERENCES cat_soutien (id)');
        $this->addSql('CREATE INDEX IDX_99A7D3212260896E ON soutien (relat_soutien_id)');
    }
}
