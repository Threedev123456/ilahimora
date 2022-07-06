<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627052350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_top_blog (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_top_home (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, boutton VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE about CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE blog CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE category ADD titre VARCHAR(255) NOT NULL, ADD contenu LONGTEXT NOT NULL, CHANGE name image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image_top_blog');
        $this->addSql('DROP TABLE image_top_home');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE about MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE about DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE about CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE blog MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE blog DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE blog CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE category ADD name VARCHAR(255) NOT NULL, DROP image, DROP titre, DROP contenu');
    }
}
