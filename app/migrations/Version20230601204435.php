<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230601204435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    //    $this->addSql('ALTER TABLE categories ADD slug VARCHAR(64) NOT NULL, CHANGE title title VARCHAR(255) NOT NULL');
    //     $this->addSql('ALTER TABLE posts ADD category_id INT DEFAULT NULL');
    //     $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    //     $this->addSql('CREATE INDEX IDX_885DBAFA12469DE2 ON posts (category_id)');
    }
}
