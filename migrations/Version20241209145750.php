<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241209145750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coussin (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, titre VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, contenance INT NOT NULL, matiere VARCHAR(50) NOT NULL, dimensions VARCHAR(50) NOT NULL, accessoire_vendu_separement TINYINT(1) NOT NULL, poids_plein INT NOT NULL, INDEX IDX_DEAA1EFC4827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coussin ADD CONSTRAINT FK_DEAA1EFC4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coussin DROP FOREIGN KEY FK_DEAA1EFC4827B9B2');
        $this->addSql('DROP TABLE coussin');
    }
}
