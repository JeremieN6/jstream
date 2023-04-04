<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230326220454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anime_saison (id INT AUTO_INCREMENT NOT NULL, anime_id_id INT NOT NULL, nombre_de_saisons INT DEFAULT NULL, INDEX IDX_76DA51DB13EDFE68 (anime_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animes (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(125) NOT NULL, description LONGTEXT DEFAULT NULL, date_sortie DATE DEFAULT NULL, age_max INT DEFAULT NULL, featured_image VARCHAR(255) DEFAULT NULL, slug VARCHAR(120) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, saison_episode_id INT NOT NULL, numero_d_episode INT NOT NULL, titre_episode VARCHAR(255) NOT NULL, description_episode VARCHAR(255) NOT NULL, video_url VARCHAR(255) DEFAULT NULL, INDEX IDX_DDAA1CDA1DAD2F07 (saison_episode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison (id INT AUTO_INCREMENT NOT NULL, anime_id_id INT NOT NULL, saison_episode_id INT NOT NULL, nombre_de_saison INT DEFAULT NULL, numero_de_saison VARCHAR(255) DEFAULT NULL, image_couverture VARCHAR(125) DEFAULT NULL, INDEX IDX_C0D0D58613EDFE68 (anime_id_id), INDEX IDX_C0D0D5861DAD2F07 (saison_episode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison_episode (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anime_saison ADD CONSTRAINT FK_76DA51DB13EDFE68 FOREIGN KEY (anime_id_id) REFERENCES animes (id)');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA1DAD2F07 FOREIGN KEY (saison_episode_id) REFERENCES saison_episode (id)');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D58613EDFE68 FOREIGN KEY (anime_id_id) REFERENCES animes (id)');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D5861DAD2F07 FOREIGN KEY (saison_episode_id) REFERENCES saison_episode (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anime_saison DROP FOREIGN KEY FK_76DA51DB13EDFE68');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA1DAD2F07');
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D58613EDFE68');
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D5861DAD2F07');
        $this->addSql('DROP TABLE anime_saison');
        $this->addSql('DROP TABLE animes');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE saison');
        $this->addSql('DROP TABLE saison_episode');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
