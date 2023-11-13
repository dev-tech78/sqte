<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026072844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categori_fiction (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_actu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actualites ADD categorie_actu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actualites ADD CONSTRAINT FK_75315B6DA8FD41FA FOREIGN KEY (categorie_actu_id) REFERENCES categorie_actu (id)');
        $this->addSql('CREATE INDEX IDX_75315B6DA8FD41FA ON actualites (categorie_actu_id)');
        $this->addSql('ALTER TABLE fiction ADD categori_fiction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiction ADD CONSTRAINT FK_6F5709FDD596E740 FOREIGN KEY (categori_fiction_id) REFERENCES categori_fiction (id)');
        $this->addSql('CREATE INDEX IDX_6F5709FDD596E740 ON fiction (categori_fiction_id)');
        $this->addSql('ALTER TABLE utils_film ADD fiction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utils_film ADD CONSTRAINT FK_49E26F39FF905AC2 FOREIGN KEY (fiction_id) REFERENCES fiction (id)');
        $this->addSql('CREATE INDEX IDX_49E26F39FF905AC2 ON utils_film (fiction_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiction DROP FOREIGN KEY FK_6F5709FDD596E740');
        $this->addSql('ALTER TABLE actualites DROP FOREIGN KEY FK_75315B6DA8FD41FA');
        $this->addSql('DROP TABLE categori_fiction');
        $this->addSql('DROP TABLE categorie_actu');
        $this->addSql('DROP INDEX IDX_75315B6DA8FD41FA ON actualites');
        $this->addSql('ALTER TABLE actualites DROP categorie_actu_id');
        $this->addSql('DROP INDEX IDX_6F5709FDD596E740 ON fiction');
        $this->addSql('ALTER TABLE fiction DROP categori_fiction_id');
        $this->addSql('ALTER TABLE utils_film DROP FOREIGN KEY FK_49E26F39FF905AC2');
        $this->addSql('DROP INDEX IDX_49E26F39FF905AC2 ON utils_film');
        $this->addSql('ALTER TABLE utils_film DROP fiction_id');
    }
}
