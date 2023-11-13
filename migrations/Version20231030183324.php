<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231030183324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182320295647');
        $this->addSql('DROP TABLE categorie_atelier');
        $this->addSql('ALTER TABLE actualites CHANGE categorie_actu_id categorie_actu_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_E1BB182320295647 ON atelier');
        $this->addSql('ALTER TABLE atelier DROP catatelier_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_atelier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE actualites CHANGE categorie_actu_id categorie_actu_id INT NOT NULL');
        $this->addSql('ALTER TABLE atelier ADD catatelier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182320295647 FOREIGN KEY (catatelier_id) REFERENCES categorie_atelier (id)');
        $this->addSql('CREATE INDEX IDX_E1BB182320295647 ON atelier (catatelier_id)');
    }
}
