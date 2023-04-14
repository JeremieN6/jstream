<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230404132029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime_saison ADD numero_de_saison INT NOT NULL, ADD nombre_de_saison INT NOT NULL');
        $this->addSql('ALTER TABLE saison ADD featured_image VARCHAR(255) DEFAULT NULL, DROP image_couverture');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime_saison DROP numero_de_saison, DROP nombre_de_saison');
        $this->addSql('ALTER TABLE saison ADD image_couverture VARCHAR(125) DEFAULT NULL, DROP featured_image');
    }
}
