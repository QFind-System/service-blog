<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210825203759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_by INT NOT NULL, updated_by INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_E01FBE6A2B36786B (title), UNIQUE INDEX UNIQ_E01FBE6A36AC99F1 (link), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menues (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_by INT NOT NULL, updated_by INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_C3FD0F52B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pages (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, created_by INT NOT NULL, updated_by INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_2074E5752B36786B (title), UNIQUE INDEX UNIQ_2074E57536AC99F1 (link), UNIQUE INDEX UNIQ_2074E5753DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_post (page_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_DD4E7057C4663E4 (page_id), INDEX IDX_DD4E70574B89032C (post_id), PRIMARY KEY(page_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_menu (page_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_FAC12649C4663E4 (page_id), INDEX IDX_FAC12649CCD7E912 (menu_id), PRIMARY KEY(page_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, created_by INT NOT NULL, updated_by INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_885DBAFA2B36786B (title), UNIQUE INDEX UNIQ_885DBAFA36AC99F1 (link), UNIQUE INDEX UNIQ_885DBAFA3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pages ADD CONSTRAINT FK_2074E5753DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE page_post ADD CONSTRAINT FK_DD4E7057C4663E4 FOREIGN KEY (page_id) REFERENCES pages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_post ADD CONSTRAINT FK_DD4E70574B89032C FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_menu ADD CONSTRAINT FK_FAC12649C4663E4 FOREIGN KEY (page_id) REFERENCES pages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_menu ADD CONSTRAINT FK_FAC12649CCD7E912 FOREIGN KEY (menu_id) REFERENCES menues (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA3DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pages DROP FOREIGN KEY FK_2074E5753DA5256D');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA3DA5256D');
        $this->addSql('ALTER TABLE page_menu DROP FOREIGN KEY FK_FAC12649CCD7E912');
        $this->addSql('ALTER TABLE page_post DROP FOREIGN KEY FK_DD4E7057C4663E4');
        $this->addSql('ALTER TABLE page_menu DROP FOREIGN KEY FK_FAC12649C4663E4');
        $this->addSql('ALTER TABLE page_post DROP FOREIGN KEY FK_DD4E70574B89032C');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE menues');
        $this->addSql('DROP TABLE pages');
        $this->addSql('DROP TABLE page_post');
        $this->addSql('DROP TABLE page_menu');
        $this->addSql('DROP TABLE posts');
    }
}
