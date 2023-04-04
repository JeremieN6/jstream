<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230404144330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA1DAD2F07');
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D5861DAD2F07');
        $this->addSql('CREATE TABLE saison_episodes (id INT AUTO_INCREMENT NOT NULL, saison_id_id INT DEFAULT NULL, episode_id_id INT DEFAULT NULL, created_at DATE DEFAULT NULL, updated_at DATE DEFAULT NULL, INDEX IDX_B28C07F1CB7B5AFE (saison_id_id), INDEX IDX_B28C07F1444E6803 (episode_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE saison_episodes ADD CONSTRAINT FK_B28C07F1CB7B5AFE FOREIGN KEY (saison_id_id) REFERENCES saison (id)');
        $this->addSql('ALTER TABLE saison_episodes ADD CONSTRAINT FK_B28C07F1444E6803 FOREIGN KEY (episode_id_id) REFERENCES episode (id)');
        $this->addSql('DROP TABLE saison_episode');
        $this->addSql('ALTER TABLE anime_saison ADD date_sortie DATE DEFAULT NULL, DROP numero_de_saison, DROP nombre_de_saison');
        $this->addSql('DROP INDEX IDX_DDAA1CDA1DAD2F07 ON episode');
        $this->addSql('ALTER TABLE episode ADD created_at DATE DEFAULT NULL, ADD updated_at DATE DEFAULT NULL, CHANGE saison_episode_id saison_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDACB7B5AFE FOREIGN KEY (saison_id_id) REFERENCES saison (id)');
        $this->addSql('CREATE INDEX IDX_DDAA1CDACB7B5AFE ON episode (saison_id_id)');
        $this->addSql('DROP INDEX IDX_C0D0D5861DAD2F07 ON saison');
        $this->addSql('ALTER TABLE saison ADD created_at DATE DEFAULT NULL, ADD updated_at DATE DEFAULT NULL, DROP saison_episode_id, DROP numero_de_saison');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE saison_episode (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE saison_episodes DROP FOREIGN KEY FK_B28C07F1CB7B5AFE');
        $this->addSql('ALTER TABLE saison_episodes DROP FOREIGN KEY FK_B28C07F1444E6803');
        $this->addSql('DROP TABLE saison_episodes');
        $this->addSql('ALTER TABLE anime_saison ADD numero_de_saison INT NOT NULL, ADD nombre_de_saison INT NOT NULL, DROP date_sortie');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDACB7B5AFE');
        $this->addSql('DROP INDEX IDX_DDAA1CDACB7B5AFE ON episode');
        $this->addSql('ALTER TABLE episode DROP created_at, DROP updated_at, CHANGE saison_id_id saison_episode_id INT NOT NULL');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA1DAD2F07 FOREIGN KEY (saison_episode_id) REFERENCES saison_episode (id)');
        $this->addSql('CREATE INDEX IDX_DDAA1CDA1DAD2F07 ON episode (saison_episode_id)');
        $this->addSql('ALTER TABLE saison ADD saison_episode_id INT NOT NULL, ADD numero_de_saison VARCHAR(255) DEFAULT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D5861DAD2F07 FOREIGN KEY (saison_episode_id) REFERENCES saison_episode (id)');
        $this->addSql('CREATE INDEX IDX_C0D0D5861DAD2F07 ON saison (saison_episode_id)');
    }
}
