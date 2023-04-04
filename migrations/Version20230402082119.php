<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230402082119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime_saison DROP FOREIGN KEY FK_76DA51DB13EDFE68');
        $this->addSql('DROP INDEX IDX_76DA51DB13EDFE68 ON anime_saison');
        $this->addSql('ALTER TABLE anime_saison CHANGE anime_id anime_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE anime_saison ADD CONSTRAINT FK_76DA51DB13EDFE68 FOREIGN KEY (anime_id_id) REFERENCES animes (id)');
        $this->addSql('CREATE INDEX IDX_76DA51DB13EDFE68 ON anime_saison (anime_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime_saison DROP FOREIGN KEY FK_76DA51DB13EDFE68');
        $this->addSql('DROP INDEX IDX_76DA51DB13EDFE68 ON anime_saison');
        $this->addSql('ALTER TABLE anime_saison CHANGE anime_id_id anime_id INT NOT NULL');
        $this->addSql('ALTER TABLE anime_saison ADD CONSTRAINT FK_76DA51DB13EDFE68 FOREIGN KEY (anime_id) REFERENCES animes (id)');
        $this->addSql('CREATE INDEX IDX_76DA51DB13EDFE68 ON anime_saison (anime_id)');
    }
}
