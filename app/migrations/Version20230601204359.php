<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230601204359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       
        $this->addSql('DROP INDEX uq_categories_title ON categories');
        $this->addSql('ALTER TABLE categories DROP slug, CHANGE title title VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFA12469DE2');
        $this->addSql('DROP INDEX IDX_885DBAFA12469DE2 ON posts');
        $this->addSql('ALTER TABLE posts DROP category_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, category_id_id INT DEFAULT NULL, INDEX IDX_527EDB259777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        // $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB259777D11E FOREIGN KEY (category_id_id) REFERENCES categories (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        // $this->addSql('ALTER TABLE categories ADD slug VARCHAR(64) NOT NULL, CHANGE title title VARCHAR(255) NOT NULL');
        // $this->addSql('CREATE UNIQUE INDEX uq_categories_title ON categories (title)');
        // $this->addSql('ALTER TABLE posts ADD category_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        // $this->addSql('CREATE INDEX IDX_885DBAFA12469DE2 ON posts (category_id)');
    }
}
