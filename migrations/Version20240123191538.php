<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123191538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil ADD person_id INT DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B297217BBB47 FOREIGN KEY (person_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6D6B297217BBB47 ON profil (person_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B297217BBB47');
        $this->addSql('DROP INDEX UNIQ_E6D6B297217BBB47 ON profil');
        $this->addSql('ALTER TABLE profil DROP person_id, DROP slug, DROP created_at');
    }
}
