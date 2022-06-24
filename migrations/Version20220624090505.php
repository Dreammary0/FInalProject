<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220624090505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, pub_house_id INT NOT NULL, title VARCHAR(40) NOT NULL, author VARCHAR(40) DEFAULT NULL, year DATE DEFAULT NULL, INDEX IDX_CBE5A331A68679BC (pub_house_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalog (id INT AUTO_INCREMENT NOT NULL, name_catalog VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalog_book (catalog_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_BE501347CC3C66FC (catalog_id), INDEX IDX_BE50134716A2B381 (book_id), PRIMARY KEY(catalog_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exemplar (id INT AUTO_INCREMENT NOT NULL, book_id INT DEFAULT NULL, id_reader_id INT NOT NULL, date_issue DATE NOT NULL, date_returne DATE DEFAULT NULL, INDEX IDX_F32A1AC116A2B381 (book_id), INDEX IDX_F32A1AC197226B10 (id_reader_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pub_house (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reader (id INT AUTO_INCREMENT NOT NULL, fio VARCHAR(100) NOT NULL, phone INT NOT NULL, adres VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331A68679BC FOREIGN KEY (pub_house_id) REFERENCES pub_house (id)');
        $this->addSql('ALTER TABLE catalog_book ADD CONSTRAINT FK_BE501347CC3C66FC FOREIGN KEY (catalog_id) REFERENCES catalog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE catalog_book ADD CONSTRAINT FK_BE50134716A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exemplar ADD CONSTRAINT FK_F32A1AC116A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE exemplar ADD CONSTRAINT FK_F32A1AC197226B10 FOREIGN KEY (id_reader_id) REFERENCES reader (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE catalog_book DROP FOREIGN KEY FK_BE50134716A2B381');
        $this->addSql('ALTER TABLE exemplar DROP FOREIGN KEY FK_F32A1AC116A2B381');
        $this->addSql('ALTER TABLE catalog_book DROP FOREIGN KEY FK_BE501347CC3C66FC');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331A68679BC');
        $this->addSql('ALTER TABLE exemplar DROP FOREIGN KEY FK_F32A1AC197226B10');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE catalog');
        $this->addSql('DROP TABLE catalog_book');
        $this->addSql('DROP TABLE exemplar');
        $this->addSql('DROP TABLE pub_house');
        $this->addSql('DROP TABLE reader');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
